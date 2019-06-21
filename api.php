<?php

$link = mysqli_connect("127.0.0.1", "root", "F3ckth1s", "community");
if(isset($_POST['action'])){
	$action = $_POST['action'];

	if($action == 'suggestevent'){
		$query = "insert into suggestion (description, website, find, imagepath, status, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['description'])."', '".mysqli_real_escape_string($link, $_POST['website'])."', '".mysqli_real_escape_string($link, $_POST['find'])."', '".mysqli_real_escape_string($link, $_POST['imagepath'])."', '".mysqli_real_escape_string($link, 'new')."', now(), now());";
		mysqli_query($link, $query);
	}

	if($action == 'reviewevents'){
		$events = [];
		$query = "select * from suggestion where status = 'new';";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $events[$row['id']] = $row;
		    }
		}
		echo(json_encode($events));
	}
}

