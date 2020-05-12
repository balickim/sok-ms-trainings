<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../../databaseConnection.php';
include_once '../objects/training.php';
include_once '../authorization.php';

$database = new Database();
$db = $database->getConnection();

$training = new training($db);
  
$training->id = isset($_GET['id']) ? $_GET['id'] : die();
$headers = apache_request_headers();

if(authorize($headers['Authorization']))
{
    $result = $training->readOne();  

        $trainings_arr=array();
        $trainings_arr["training"]=array();

        $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
        array_push($trainings_arr["training"], $row);
        http_response_code(200);
    
        echo json_encode($trainings_arr);
}
?>