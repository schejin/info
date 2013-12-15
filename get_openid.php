<?php
  require_once(dirname(__FILE__)."/config.php");
  include_once("./class/Oauth.class.php");
  
  if (isset($_GET['site']) && isset($_GET['code']) && isset($_GET['state'])) {

    $site = $_GET['site'];
    if ($site) {
      $oauth = new Oauth($site);

      $access_token = $oauth->callback();
      //echo $access_token;
      $openid = $oauth->get_openid();
      //echo $openid;
      
      if ($_SESSION['auth_for'] == 'login'){
        $token = substr(uniqid(rand()), -6);
        $_SESSION['token'] = $token ;
        $login_url = "./auth_login.php?site=$site&id=$openid&token=$token";
        header("Location:$login_url");
      }

    }
  } else {
      //没有拿到数据直接跳转到首页 
      header("Location:".'/');
  }

?>