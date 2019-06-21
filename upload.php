<?php
$fileName = 'cats.png';
$serverFile = time().$fileName;
$fp = fopen('uploads/'.$serverFile,'w'); //Prepends timestamp to prevent overwriting
foreach($_POST as $data){
	fwrite($fp, $data);
}
fclose($fp);
$returnData = array( "serverFile" => $serverFile );
echo json_encode($returnData);