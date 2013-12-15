<?php
/* PHP SDK
 * @version 2.0.0
 * @author HeJin
 */

define("CLASS_PATH","./class/");

require_once(CLASS_PATH."Recorder.class.php");
require_once(CLASS_PATH."URL.class.php");
require_once(CLASS_PATH."ErrorCase.class.php");

class Oauth{
    
    const VERSION = "2.0";
    
    protected $recorder;
    public $urlUtils;
    protected $error;

    function __construct($site){
        require(dirname(__FILE__).'/../config.php');
        $this->site = $site;
        $this->recorder = new Recorder($site);
        $this->urlUtils = new URL();
        $this->error = new ErrorCase();
        $this->config = $config['oauth'][$this->site];
    }

    public function login(){
        
        //-------生成唯一随机串防CSRF攻击
        $state = md5(uniqid(rand(), TRUE));
        $this->recorder->write('state',$state);
        //-------构造请求参数列表
        
        if($this->site == 'sina') {
            $keysArr = array(
                "response_type" => "code",
                "client_id" => $this->config['appid'],
                "redirect_uri" => urlencode($this->config['callback']),
                "state" => $state,
                "forcelogin" =>"true"
                );
            $login_url =  $this->urlUtils->combineURL($this->config['auth_code_url'], $keysArr);
        }
        else {
            $keysArr = array(
                "response_type" => "code",
                "client_id" => $this->config['appid'],
                "redirect_uri" => urlencode($this->config['callback']),
                "state" => $state
                );
            $login_url =  $this->urlUtils->combineURL($this->config['auth_code_url'], $keysArr);
        }    

        // echo $login_url;
        header("Location:$login_url");
    }

    public function callback(){
        $state = $this->recorder->read("state");

        //-------请求参数列表
        $keysArr = array(
            "grant_type" => "authorization_code",
            "client_id" => $this->config['appid'],
            "redirect_uri" => urlencode($this->config['callback']),
            "client_secret" => $this->config['appkey'],
            "code" => $_GET['code']
        );

        //------构造请求access_token的url
        $token_url = $this->urlUtils->combineURL($this->config['access_token_url'], $keysArr);
        $response = $this->urlUtils->get_contents($token_url, ($this->config['method'] == 'post' ? 1 : 0), $keysArr);
        //echo $response;
        $params = array();
        if($this->site == 'qq'){
          parse_str($response, $params);
          $_SESSION["PROVIDER::OPENID"] =  $params["openid"];       
        } else {
          $params = json_decode($response, true);
        }
        
        $this->recorder->write("access_token", $params["access_token"]);
        return $params["access_token"];

    }

    public function get_openid(){
        if ($this->site == 'qq'){
           // $this->recorder->write("openid", $_SESSION["PROVIDER::OPENID"]);
           $openid_column  = $_SESSION["PROVIDER::OPENID"];
           return $openid_column;
        } else {            
            //-------请求参数列表
            $keysArr = array(
                "access_token" => $this->recorder->read("access_token")
            );

            $graph_url = $this->urlUtils->combineURL($this->config['openid_url'], $keysArr);
            $response = $this->urlUtils->get_contents($graph_url, ($this->config['method'] == 'post' ? 1 : 0), $keysArr);

            //--------检测错误是否发生
            if(strpos($response, "callback") !== false && $this->site == 'qq'){

                $lpos = strpos($response, "(");
                $rpos = strrpos($response, ")");
                $response = substr($response, $lpos + 1, $rpos - $lpos -1);
            }
           // echo $response;
            $user = json_decode($response);
            if(isset($user->error)){
                $this->error->showError($user->error, $user->error_description);
            }
            $openid_column = $this->config['openid_column'];
            return $user->$openid_column;  
        } 
    }

    public function get_qq_user_info($openid){
        //-------QQ请求参数列表
        $keysArr = array(
            "access_token" => $this->recorder->read("access_token"),
            "oauth_consumer_key" => $this->config['appid'],
            "openid" => $_SESSION["PROVIDER::OPENID"],
            "oauth_version"  => "2.a",            
            array("format" => "json"),
        );

        $base_url = "https://open.t.qq.com/api/user/info";
        $graph_url = $this->urlUtils->combineURL($base_url, $keysArr);
        // echo "url: ".$graph_url;
        $response = $this->urlUtils->get_contents($graph_url, 0, $keysArr);

        //--------检测错误是否发生
        if(strpos($response, "callback") !== false && $this->site == 'qq'){

            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }
        
        $user = json_decode($response,1);
        $_SESSION["PROVIDER::OPENID"] = '';
        return $user;  
    }

    public function get_sina_user_info($uid){
        $keysArr = array(
            "access_token" => $this->recorder->read("access_token"),
            "uid" => $uid,
            array("format" => "json")
        );
        
        $base_url = "https://api.weibo.com/2/users/show.json";
   
        $graph_url = $this->urlUtils->combineURL($base_url, $keysArr);
        //echo "url: ".$graph_url;
        //https://api.weibo.com/2/users/show.json?access_token=2.00p6prJBqsnpvB37b17126ebgqZnkC&uid=1061948885
        $response = $this->urlUtils->get_contents($graph_url, 0, $keysArr);

        //--------检测错误是否发生
        if(strpos($response, "callback") !== false){

            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }
        
        $user = json_decode($response,1);
        return $user;  
    }
}
