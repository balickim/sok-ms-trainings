<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../databaseConnection.php';
include_once '../objects/training.php';
  
// instantiate database and training object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$training = new training($db);
  
// query trainings
$stmt = $training->read();
$num = pg_num_rows($stmt);
  
// check if more than 0 record found
if($num>0){
  
    // trainings array
    $trainings_arr=array();
    $trainings_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = pg_fetch_object($stmt)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        
        // extract($row);
  
        $training_item=array(
            "trainingid" => $trainingid,
            "poolid" => $poolid,
            "startdate" => $startdate,
            "enddate" => $enddate,
            "description" => html_entity_decode($description)
        );
  
        array_push($trainings_arr["records"], $training_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show trainings data in json format
    echo json_encode($trainings_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no trainings found
    echo json_encode(
        array("message" => "No trainings found.")
    );
}