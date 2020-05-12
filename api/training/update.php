<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../../databaseConnection.php';
include_once '../objects/training.php';
include_once '../authorization.php';

$database = new Database();
$db = $database->getConnection();

$training = new training($db);

$headers = apache_request_headers();

if(authorize($headers['Authorization']))
{
    $data = json_decode(file_get_contents("php://input"));
    if(
        !empty($data->trainingid) &&
        !empty($data->startdate) &&
        !empty($data->enddate) &&
        !empty($data->description)
    ){
        $training->trainingid = $data->trainingid;
        $training->startdate = date('Y-m-d H:i:s');
        $training->enddate = date('Y-m-d H:i:s');
        $training->description = $data->description;

        if($training->update()){
            http_response_code(201);
            echo json_encode(array("message" => "training was updated."));
        }else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update training."));
        }
    }else{
        http_response_code(400);
        echo json_encode(array("message" => "Unable to update training. Data is incomplete."));
    }
}
?>