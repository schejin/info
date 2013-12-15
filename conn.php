<?php
  $con = mysql_connect($config['db']['host'], $config['db']['username'], $config['db']['password']);
  mysql_select_db($config['db']['database'], $con);
  mysql_query("SET NAMES utf8");
?>