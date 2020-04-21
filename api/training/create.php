<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../../databaseConnection.php';
include_once '../objects/training.php';

$database = new Database();
$db = $database->getConnection();

$training = new training($db);

$data = json_decode(file_get_contents("php://input"));
if(
    !empty($data->poolid) &&
    !empty($data->startdate) &&
    !empty($data->enddate) &&
    !empty($data->description)
){
    $training->poolid = $data->poolid;
    $training->startdate = date('Y-m-d H:i:s');
    $training->enddate = date('Y-m-d H:i:s');
    $training->description = $data->description;

    if($training->create()){
        http_response_code(201);
        echo json_encode(array("message" => "training was created."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create training."));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create training. Data is incomplete."));
}
?>