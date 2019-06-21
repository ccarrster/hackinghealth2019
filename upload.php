<?php
$fileName = $_FILES['file']['name'];
$serverFile = $fileName;
copy($_FILES['file']['tmp_name'], 'uploads/'.$serverFile);
$returnData = array( "serverFile" => $serverFile );
echo json_encode($returnData);
