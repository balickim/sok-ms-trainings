<?php
include_once '../../databaseConnection.php';

class Training{
  
    private $conn;
    private $table_name = "trainings";
  
    public $trainingid;
    public $poolid;
    public $startdate;
    public $enddate;
    public $description;
  
    public function __construct($db){
        $this->conn = $db;
    }

function read(){

    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT trainingid, poolid, startdate, enddate, description FROM trainings LIMIT 2";
  
    $stmt = pg_query($db, $query);
    // $stmt = pg_query($db, "SELECT trainingid, poolid FROM trainings");
  
    return $stmt;
}
}
?>