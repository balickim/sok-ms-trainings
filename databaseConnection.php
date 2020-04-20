<?php
class Database{
    private $host = "balarama.db.elephantsql.com";
    private $port = 5432;
    private $db_name = "usizxsav";
    private $username = "usizxsav";
    private $password = "o1barTrUtY9B74KXnYaOTAoYEj3CCTfg";
    public $dbconn;
  
    public function getConnection(){
  
        $this->dbconn = null;

        $this->dbconn = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" . $this->db_name . " user=" . $this->username . " password=" . $this->password) 
        or die("Could not connect");
  
        return $this->dbconn;
    }
}
?>