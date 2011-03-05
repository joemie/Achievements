<?php
  include 'mysql_connection.php';
  
  function getRealIpAddr()
  {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
	{   
		//check ip from shared internet 
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
		//to check if ip is passed from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else 
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
		return $ip;
  }
	
 /* FIIIXX MEEE NOWWW */
  function incrementCounter()
  {
	$query = "UPDATE `progress` SET";
  }
  
  function addUser()
  {
	$ip = $_SERVER['REMOTE_ADDR'];
	$knownIPs = mysql_query("SELECT * FROM `users` WHERE `IP` = '$ip'");
	$recognizedip = validIP($ip);
	  
	if(! $recognizedip )
	{
      $query = "INSERT INTO `users` VALUES ('', '$ip', '$level', '$points')";
	  $write = mysql_query($query);
	}
  }
  function validIP($ip)
  {
    $validip = true;
    while($row = mysql_fetch_object($knownIPs))
    {
	  if($row->ip == $ip)  //if the ip is already added
	  {
	  	$validip = false;
	  }
    }
	return $validip;
  }
  
  function fetchAchievement()
  {
    $url = mysql_real_escape_string($_GET["url"]);
	
	$query = "SELECT * FROM `achievements` WHERE `url` = '$url'";
	$queryResult = mysql_query($query)
              or die("invalid query" . mysql_error());
	$numObjects = count($queryResult);
	
	$jArray = array();
	while($row = mysql_fetch_object($queryResult))
	{
		$objects = array();
		$objects["achievementID"] = $row->achievementID;
		$objects["title"] = $row->title;
		$objects["description"] = $row->description;
		$objects["points"] = $row->points;
		$objects["url"] = $row->url;
		$jArray[] = $objects;
	}	
	return json_encode($jArray);
  }
  
?>
