<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();
$databaseHost='';
$databaseUser=''; 
$databasePassword=''; 
$databaseName='';
try {
  $conn = new PDO("mysql:host=".$databaseHost.";dbname=".$databaseName, $databaseUser, $databasePassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  #echo 'Database Connected Successfully'; 
} catch(PDOException $error) {
  echo "Something went wrong " . $error->getMessage();
}
?>
