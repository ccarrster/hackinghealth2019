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

	if($action == 'reviewsuggestions'){
		$events = [];
		$query = "select * from suggestion;";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$events[$row['id']] = $row;
			}
		}
		echo(json_encode($events));
	}

	if($action == 'createevent'){
		$date = $_POST['date'];
		$time = $_POST['time'];
		$start = 'null';
		if($date != '' && $time != ''){
			$start = $date . ' ' . $time . ':00';
		}
		$enddate = $_POST['enddate'];
		$endtime = $_POST['endtime'];
		$end = 'null';
		if($enddate != '' && $endtime != ''){
			$end = $enddate . ' ' . $endtime . ':00';
		}
		$query = "insert into event (name, description, website, start, end, age, cost, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."',  '".mysqli_real_escape_string($link, $_POST['website'])."', '".mysqli_real_escape_string($link, $start)."', '".mysqli_real_escape_string($link, $end)."', '".mysqli_real_escape_string($link, $_POST['age'])."', '".mysqli_real_escape_string($link, $_POST['cost'])."', now(), now());";
		var_dump($query);
		mysqli_query($link, $query);
	}


	if($action == 'suggestionstatusupdate'){
		$query = "update suggestion set status = '".mysqli_real_escape_string($link, $_POST['status'])."' where id = '".mysqli_real_escape_string($link, $_POST['id'])."';";
		$result = mysqli_query($link, $query);
		echo(json_encode($result));
	}

}

