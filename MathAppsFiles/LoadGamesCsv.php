<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<?php require_once("config.php");?> 
<?php
#This loads game data into "MathGames" table if there is a csv file in the main folder
$GameData = fopen("GamesImport.csv", "r") or die("File Missing");
if ($GameData !== FALSE) {
    while (! feof($GameData)) {
        $Data = fgetcsv($GameData, 100, ",");
        $stmt = $conn->prepare("INSERT INTO MathGames (GameNameber, GameName) VALUES ('$Data[0]', '$Data[1]')");
        $stmt->execute();
        #echo $Data[0]."  ".$Data[1];
    }
}
?>