<?php

  $config = array(
    'db' => array(
      'host' => '127.0.0.1',
      'username' => 'root',
      'password' => 'hj0929',
      'database' => 'info'
    ),
    'oauth' => array(
      'qq' => array(
        // App Key:801456766          
        // App Secret:fd8b94e245e29626739117fc7e451e35
        'appid' => '801456766',
        'appkey' => 'fd8b94e245e29626739117fc7e451e35',
        'callback' => 'http://infocusphone.com/info/get_openid.php?site=qq',
        'auth_code_url' => 'https://open.t.qq.com/cgi-bin/oauth2/authorize',
        'access_token_url' => 'https://open.t.qq.com/cgi-bin/oauth2/access_token',
        'openid_column' => 'openid',
        'method' => 'get'
      ),
      'sina' => array(
        // App Key：249736550
        // App Sercet：1d95f6b1156a026e4bbff014a76cbf8b
        'appid' => '249736550',
        'appkey' => '1d95f6b1156a026e4bbff014a76cbf8b',
        'callback' => 'http://infocusphone.com/info/get_openid.php?site=sina',
        'auth_code_url' => 'https://api.weibo.com/oauth2/authorize',
        'access_token_url' => 'https://api.weibo.com/oauth2/access_token',
        'openid_url' => 'https://api.weibo.com/oauth2/get_token_info',
        'openid_column' => 'uid',
        'method' => 'post'
      )
    )
  )
?>
