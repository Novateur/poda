<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = sanitize($_POST['id']);
	
	$sql = "SELECT * FROM locations WHERE company = {$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "State: ".get_state_name($r['state'])."<br/>
			City: ".get_city_name($r['city'])."<br/>
			Address: {$r['addr']}<hr/>";
		}
	}
	else
	{
		echo "No location has been added yet";
	}
	
?>