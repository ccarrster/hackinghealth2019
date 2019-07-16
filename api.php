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

	if($action == 'viewEvents'){
		$events = [];
		$query = "select * from event;";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$events[$row['id']] = $row;
			}
		}
		echo(json_encode($events));
	}

	if($action == 'getrelations'){
		$relations = [];
		$query = "select * from relationship where (a_id = '".mysqli_real_escape_string($link, $_POST['id'])."' and a_type = '".mysqli_real_escape_string($link, $_POST['type'])."') OR (b_id = '".mysqli_real_escape_string($link, $_POST['id'])."' and b_type = '".mysqli_real_escape_string($link, $_POST['type'])."');";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$relations[$row['id']] = $row;
			}
		}
		echo(json_encode($relations));
	}

	if($action == 'getlocation'){
		$locations = [];
		$query = "select * from location where id = '".mysqli_real_escape_string($link, $_POST['id'])."';";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$locations[$row['id']] = $row;
			}
		}
		echo(json_encode($locations));
	}

	if($action == 'getsuggestion'){
		$suggestions = [];
		$query = "select * from suggestion where id = '".mysqli_real_escape_string($link, $_POST['id'])."';";
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$suggestions[$row['id']] = $row;
			}
		}
		echo(json_encode($suggestions));
	}

	if($action == 'createevent'){
		$date = $_POST['date'];
		$time = $_POST['time'];
		$start = 'null';
		if($date != '' && $time != ''){
			$start = "'".$date . ' ' . $time . ':00'."'";
		}
		$enddate = $_POST['enddate'];
		$endtime = $_POST['endtime'];
		$end = 'null';
		if($enddate != '' && $endtime != ''){
			$end = "'".$enddate . ' ' . $endtime . ':00'."'";
		}
		$query = "insert into event (name, description, website, start, end, age, cost, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."',  '".mysqli_real_escape_string($link, $_POST['website'])."', ".mysqli_real_escape_string($link, $start).", ".mysqli_real_escape_string($link, $end).", '".mysqli_real_escape_string($link, $_POST['age'])."', '".mysqli_real_escape_string($link, $_POST['cost'])."', now(), now());";
		mysqli_query($link, $query);
		echo(json_encode(mysqli_insert_id($link)));
	}

	if($action == 'createorganization'){
		$query = "insert into organization (name, description, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', now(), now());";
		mysqli_query($link, $query);
		echo(json_encode(mysqli_insert_id($link)));
	}

	if($action == 'createseries'){
		$query = "insert into series (name, description, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', now(), now());";
		mysqli_query($link, $query);
		echo(json_encode(mysqli_insert_id($link)));
	}

	if($action == 'createrelationship'){
		$a_type = $_POST['a_type'];
		$a_id = $_POST['a_id'];
		$b_type = $_POST['b_type'];
		$b_id = $_POST['b_id'];
		$query = "insert into relationship (type, a_type, a_id, b_type, b_id, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['type'])."', '".mysqli_real_escape_string($link, $a_type)."', '".mysqli_real_escape_string($link, $a_id)."', '".mysqli_real_escape_string($link, $b_type)."', '".mysqli_real_escape_string($link, $b_id)."', now(), now());";
		mysqli_query($link, $query);
	}

	if($action == 'createlocation'){
		$query = "insert into location (name, description, street, city, province, postal, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', '".mysqli_real_escape_string($link, $_POST['street'])."', '".mysqli_real_escape_string($link, $_POST['city'])."', '".mysqli_real_escape_string($link, $_POST['province'])."', '".mysqli_real_escape_string($link, $_POST['postal'])."', now(), now());";
		$result = mysqli_query($link, $query);
		echo(json_encode(mysqli_insert_id($link)));
	}


	if($action == 'suggestionstatusupdate'){
		$query = "update suggestion set status = '".mysqli_real_escape_string($link, $_POST['status'])."' where id = '".mysqli_real_escape_string($link, $_POST['id'])."';";
		$result = mysqli_query($link, $query);
		echo(json_encode($result));
	}

}

