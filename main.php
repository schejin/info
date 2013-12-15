<?php
  include_once ("./class/Oauth.class.php");

  $auth_type = $_GET ["auth_type"];
  $type = $_GET ['type'];

  if (isset ( $type )) {

		if ($type == 'login') {
			$_SESSION ['auth_for'] = 'login';
		}
	
		if (isset ( $auth_type )) {		
				$oauth = new Oauth ( $auth_type );
				$oauth->login ();
		}
	}
?>
