<?php
  include 'mysql_connection.php';
  $value = mysql_real_escape_string($_GET["url"]);
  //echo $value;
  //echo "</br>";
  
// $query = "SELECT * FROM `test` WHERE `url` = '$value'";
$query = "SELECT * FROM `test`";
 echo "Our query is $query<br />";
$result = mysql_query($query)
            or die("invalid query" . mysql_error());
 echo "Number of rows returned: " . mysql_num_rows($result) . "<br />";
    
 while($row = mysql_fetch_object($result))
 {
    echo $row->aName;
    echo "</br>";
 }
?>


