<?php
  require(dirname(__FILE__).'/config.php');
  require(dirname(__FILE__).'/conn.php');

  $tmp_token = $_SESSION['token'];

  if ($tmp_token == $_GET['token']) {
     $site = $_GET['site'];
     $authid = $_GET['id'];
          
     $sql = "select * from user where $site"."id = '$authid'";
     
     if ($result = mysql_query($sql)) {
        // 如果用户已存在则直接分享
        if($rs = mysql_fetch_object($result)) {
           do_share($site, $authid);     
        }
        else {
        // 如果用户不存在则创建一个新用户，然后分享  
          build_user_by($site,$authid);
        }
     }
  }

  // 分享
  function do_share($site, $authid) {
    $token = substr(uniqid(rand()), -6);
    $_SESSION['token'] = $token ;
    $share_url = "./do_share.php?site=$site";
    header("Location:$share_url");
    // require(dirname(__FILE__)."/do_share.php?site=$site");s
  }
 
  // 创建用户
  function add_user($name,$gender,$avatar,$location,$site,$id) {
    $execsql="insert into user (name,gender,avatar,location,site,$site"."id) values
              ('".$name."','".$gender."','".$avatar."','".$location."','".$site."','".$id."')";

    if (!mysql_query($execsql)) {
       echo "<script>alert('该注册失败!')</script>";
    }
    return true;
  }            

  //绑定用户
  function build_user_by($site,$authid) {
    require(dirname(__FILE__)."/config.php");
    include_once("./class/Oauth.class.php");
       
    $oauth = new Oauth($site);
    $user = array();
    
    if($site == 'qq'){
      $user_info = $oauth->get_qq_user_info($authid);   
      if($user_info['ret'] == 0) {
        $user['id'] = $authid;
        $user['name'] = $user_info['data']['nick'];
        $user['gender']   = $user_info['data']['sex']; 
        $user['avatar'] = $user_info['data']['head'];   
        $user['location'] = $user_info['data']['location'];
      } 
    }elseif ($site == 'sina') {
      $user_info = $oauth->get_sina_user_info($authid);
      //print_r($user_info);
      if($user_info['ret'] == 0) {
        $user['id'] = $user_info['id'];
        $user['name'] = $user_info['screen_name'];  
        $user['gender']   = $user_info['gender'];       
        $user['avatar'] = $user_info['profile_image_url'];    
        $user['location'] = $user_info['location'];        
      }
    }
    // print_r($user_info);   
    // do _share
    add_user($user['name'],$user['gender'],$user['avatar'],$user['location'],$site,$user['id']);
    do_share($site, $authid);
  }

?>
