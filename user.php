<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
  <h3>User Information</h3>
  <?php
  require(dirname(__FILE__).'/config.php');
  require(dirname(__FILE__).'/conn.php');
  $sql = "select id,name,gender,qqid,sinaid,site,created_at from user order by id asc";
  // echo $sql;
  $result = mysql_query($sql);
  echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Gender</th><th>Site</th><th>qqid</th><th>sinaid</th><th>created_at</th></tr>";

  while($row = mysql_fetch_array($result)){
	  echo "<tr>";
	  echo "<td>" . $row['id'] . "</td>";
	  echo "<td>" . $row['name'] . "</td>";
	  echo "<td>" . $row['gender'] . "</td>";
	  echo "<td>" . $row['site'] . "</td>";
	  echo "<td>" . $row['qqid'] . "</td>";
	  echo "<td>" . $row['sinaid'] . "</td>";
	  echo "<td>" . $row['created_at'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";
	mysql_close($con); 
?>
</body>
</html>

