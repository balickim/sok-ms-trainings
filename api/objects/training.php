<?php
include_once '../../databaseConnection.php';

class Training{
  
    private $conn;
    private $table_name = "trainings";
  
    public $trainingid;
    public $startdate;
    public $enddate;
    public $description;
  
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT trainingid, startdate, enddate, description FROM trainings";
        $result = pg_query($db, $query);
    
        return $result;
    }

    function create(){
        $database = new Database();
        $db = $database->getConnection();

        $query = "INSERT INTO trainings (startdate, enddate, description) VALUES ($1, $2, $3)";
        $result = pg_prepare($db, NULL, $query);
    
        $this->startdate=htmlspecialchars(strip_tags($this->startdate));
        $this->enddate=htmlspecialchars(strip_tags($this->enddate));
        $this->description=htmlspecialchars(strip_tags($this->description));
    
        return pg_execute($db, null, array($this->startdate, $this->enddate, $this->description));      
    }

    function readOne(){
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT startdate, enddate, description from trainings WHERE trainingid = ($1)";
        $result = pg_prepare($db, NULL, $query);
    
        return pg_execute($db, null, array($this->id));
    }

    function update(){
        $database = new Database();
        $db = $database->getConnection();

        $query = "UPDATE trainings SET startdate = ($1), enddate = ($2), description = ($3) WHERE trainingid = ($4)";
        $result = pg_prepare($db, NULL, $query);

        $this->trainingid=htmlspecialchars(strip_tags($this->trainingid));
        $this->startdate=htmlspecialchars(strip_tags($this->startdate));
        $this->enddate=htmlspecialchars(strip_tags($this->enddate));
        $this->description=htmlspecialchars(strip_tags($this->description));
    
        return pg_execute($db, null, array($this->startdate, $this->enddate, $this->description, $this->trainingid));
    }

    function delete(){
        $database = new Database();
        $db = $database->getConnection();

        $query = "DELETE FROM trainings WHERE trainingid = ($1)";
        $result = pg_prepare($db, NULL, $query);

        return pg_execute($db, null, array($this->id));
    }
}
?>