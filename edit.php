<!DOCTYPE html>
<html>
<body>
<?php
$link = mysqli_connect("127.0.0.1", "root", "F3ckth1s", "community");

if(isset($_POST['formtype'])){
	$formatType = $_POST['formtype'];
	if($formatType == 'createevent'){
		$query = "insert into event (name, description, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', now(), now());";
		mysqli_query($link, $query);
	} elseif($formatType == 'createorganization'){
		$query = "insert into organization (name, description, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', now(), now());";
		mysqli_query($link, $query);
	} elseif($formatType == 'createlocation'){
		$query = "insert into location (name, description, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', now(), now());";
		mysqli_query($link, $query);
	} elseif($formatType == 'createresource'){
		$query = "insert into resource (name, description, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['description'])."', now(), now());";
		mysqli_query($link, $query);
	} elseif($formatType == 'createrelationship'){
		$splitA = explode('_', $_POST['a']);
		$splitB = explode('_', $_POST['b']);
		$a_type = $splitA[0];
		$a_id = $splitA[1];
		$b_type = $splitB[0];
		$b_id = $splitB[1];
		$query = "insert into relationship (type, a_type, a_id, b_type, b_id, updated_at, created_at) values('".mysqli_real_escape_string($link, $_POST['type'])."', '".mysqli_real_escape_string($link, $a_type)."', '".mysqli_real_escape_string($link, $a_id)."', '".mysqli_real_escape_string($link, $b_type)."', '".mysqli_real_escape_string($link, $b_id)."', now(), now());";
		mysqli_query($link, $query);
	} elseif($formatType == 'deleteevent'){
		$query = "delete from event where id = ".mysqli_real_escape_string($link, $_POST['id']).";";
		mysqli_query($link, $query);
	} elseif($formatType == 'deleteorganization'){
		$query = "delete from organization where id = ".mysqli_real_escape_string($link, $_POST['id']).";";
		mysqli_query($link, $query);
	} elseif($formatType == 'deletelocation'){
		$query = "delete from location where id = ".mysqli_real_escape_string($link, $_POST['id']).";";
		mysqli_query($link, $query);
	} elseif($formatType == 'deleteresource'){
		$query = "delete from resource where id = ".mysqli_real_escape_string($link, $_POST['id']).";";
		mysqli_query($link, $query);
	} elseif($formatType == 'deleterelationship'){
		$query = "delete from relationship where id = ".mysqli_real_escape_string($link, $_POST['id']).";";
		mysqli_query($link, $query);
	}
}

$events = [];
$eventQuery = "select * from event";
$result = mysqli_query($link, $eventQuery);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
}
$organizations = [];
$organizationQuery = "select * from organization";
$organizationResult = mysqli_query($link, $organizationQuery);
if (mysqli_num_rows($organizationResult) > 0) {
    while($row = mysqli_fetch_assoc($organizationResult)) {
        $organizations[] = $row;
    }
}
$locations = [];
$locationQuery = "select * from location";
$locationResult = mysqli_query($link, $locationQuery);
if (mysqli_num_rows($locationResult) > 0) {
    while($row = mysqli_fetch_assoc($locationResult)) {
        $locations[] = $row;
    }
}
$resources = [];
$resourceQuery = "select * from resource";
$resourceResult = mysqli_query($link, $resourceQuery);
if (mysqli_num_rows($resourceResult) > 0) {
    while($row = mysqli_fetch_assoc($resourceResult)) {
        $resources[] = $row;
    }
}
$relationships = [];
$parentRelationships = [];
$childRelationships = [];
$relationshipQuery = "select * from relationship";
$relationshipResult = mysqli_query($link, $relationshipQuery);
if (mysqli_num_rows($relationshipResult) > 0) {
    while($row = mysqli_fetch_assoc($relationshipResult)) {
        $relationships[] = $row;
        if(!isset($parentRelationships[$row['a_type'].'_'.$row['a_id']])){
        	$parentRelationships[$row['a_type'].'_'.$row['a_id']] = [];
        }
        $parentRelationships[$row['a_type'].'_'.$row['a_id']][] = $row;
        if(!isset($childRelationships[$row['b_type'].'_'.$row['b_id']])){
        	$childRelationships[$row['b_type'].'_'.$row['b_id']] = [];
        }
        $childRelationships[$row['b_type'].'_'.$row['b_id']][] = $row;
    }
}



?>
<form method="post">
	<input type="hidden" name="formtype" value="createevent">
	Name <input type="text" name="name">
	Description <textarea name="description"></textarea>
	<input type="submit" value="Create Event">
</form>
<form method="post">
	<input type="hidden" name="formtype" value="createorganization">
	Name <input type="text" name="name">
	Description <textarea name="description"></textarea>
	<input type="submit" value="Create Organization">
</form>
<form method="post">
	<input type="hidden" name="formtype" value="createlocation">
	Name <input type="text" name="name">
	Description <textarea name="description"></textarea>
	<input type="submit" value="Create Location">
</form>
<form method="post">
	<input type="hidden" name="formtype" value="createresource">
	Name <input type="text" name="name">
	Description <textarea name="description"></textarea>
	<input type="submit" value="Create Resource">
</form>
<form method="post">
	<input type="hidden" name="formtype" value="createrelationship">
	<input type="text" name="type">
	<select name="a">
		<?php
		foreach($events as $target){
			echo('<option value="event_'.$target['id'].'">'.$target['name'].'</option>');
		}
		foreach($organizations as $target){
			echo('<option value="organization_'.$target['id'].'">'.$target['name'].'</option>');
		}
		foreach($locations as $target){
			echo('<option value="location_'.$target['id'].'">'.$target['name'].'</option>');
		}
		foreach($resources as $target){
			echo('<option value="resource_'.$target['id'].'">'.$target['name'].'</option>');
		}
		?>
	</select>
	<select name="b">
		<?php
		foreach($events as $target){
			echo('<option value="event_'.$target['id'].'">'.$target['name'].'</option>');
		}
		foreach($organizations as $target){
			echo('<option value="organization_'.$target['id'].'">'.$target['name'].'</option>');
		}
		foreach($locations as $target){
			echo('<option value="location_'.$target['id'].'">'.$target['name'].'</option>');
		}
		foreach($resources as $target){
			echo('<option value="resource_'.$target['id'].'">'.$target['name'].'</option>');
		}
		?>
	</select>
	<input type="submit" value="Create Relationship">
</form>
<div>Events</div>
<div>
	<?php
	foreach($events as $event){
		echo('<div>');
		foreach($event as $key=>$value){
			echo('<div>'.$key.': '.$value.'<div>');
		}
		echo('<form method="post"><input type="hidden" name="formtype" value="deleteevent"><input type="hidden" name="id" value="'.$event['id'].'"><input type="submit" value="Delete"></form></div>');
	}
	?>
</div>
<div>Organizations</div>
<div>
	<?php
	foreach($organizations as $organization){
		echo('<div>');
		foreach($organization as $key=>$value){
			echo('<div>'.$key.': '.$value.'<div>');
		}
		echo('<form method="post"><input type="hidden" name="formtype" value="deleteorganization"><input type="hidden" name="id" value="'.$organization['id'].'"><input type="submit" value="Delete"></form></div>');
		//TODO clean this up into lists of links and on each type
		//Also split up by relationship type
		if(isset($parentRelationships['organization_'.$organization['id']])){
			var_dump($parentRelationships['organization_'.$organization['id']]);
		}
		if(isset($childRelationships['organization_'.$organization['id']])){
			var_dump($childRelationships['organization_'.$organization['id']]);
		}
	}
	?>
</div>
<div>Locations</div>
<div>
	<?php
	foreach($locations as $location){
		echo('<div>');
		foreach($location as $key=>$value){
			echo('<div>'.$key.': '.$value.'<div>');
		}
		echo('<form method="post"><input type="hidden" name="formtype" value="deletelocation"><input type="hidden" name="id" value="'.$location['id'].'"><input type="submit" value="Delete"></form></div>');
	}
	?>
</div>
<div>Resources</div>
<div>
	<?php
	foreach($resources as $resource){
		echo('<div>');
		foreach($resource as $key=>$value){
			echo('<div>'.$key.': '.$value.'<div>');
		}
		echo('<form method="post"><input type="hidden" name="formtype" value="deleteresource"><input type="hidden" name="id" value="'.$resource['id'].'"><input type="submit" value="Delete"></form></div>');
	}
	?>
</div>
<div>Relationships</div>
<div>
	<?php
	foreach($relationships as $relationship){
		echo('<div>');
		foreach($relationship as $key=>$value){
			echo('<div>'.$key.': '.$value.'<div>');
		}
		echo('<form method="post"><input type="hidden" name="formtype" value="deleterelationship"><input type="hidden" name="id" value="'.$relationship['id'].'"><input type="submit" value="Delete"></form></div>');
	}
	?>
</div>
</body>
</html>