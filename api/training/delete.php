<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../../databaseConnection.php';
include_once '../objects/training.php';

$database = new Database();
$db = $database->getConnection();

$training = new training($db);
  
$training->id = isset($_GET['id']) ? $_GET['id'] : die();

if($training->delete()){
        http_response_code(201);
        echo json_encode(array("message" => "training was deleted."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete training."));
    }

?>