<?php 
include_once 'databaseConnection.php';

$database = new Database();
$db = $database->getConnection();

$stat = pg_connection_status($db);
  if ($stat === PGSQL_CONNECTION_OK) {
      echo 'Connection status ok';
  } else {
      echo 'Connection status bad';
  } 
  
echo '</br>';

$result = pg_query($db, "SELECT trainingid, poolid FROM trainings");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "name: $row[0]  surname: $row[1]";
  echo "<br />\n";
}

?>