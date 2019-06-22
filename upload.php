<?php
$fileName = $_FILES['file']['name'];
$serverFile = $fileName;
$result = copy($_FILES['file']['tmp_name'], 'uploads/'.$serverFile);
$returnData = array( "serverFile" => $serverFile );
header('Content-Type: application/json');
echo json_encode($returnData);