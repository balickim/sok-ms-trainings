<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../../databaseConnection.php';
include_once '../objects/training.php';
  
$training = new training($db);
  
$result = $training->read();
$num = pg_num_rows($result);

if($num>0){
    $trainings_arr=array();
    $trainings_arr["trainings"]=array();

    while ($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
        array_push($trainings_arr["trainings"], $row);
    }
    http_response_code(200);
  
    echo json_encode($trainings_arr);
}else{
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No trainings found.")
    );
}