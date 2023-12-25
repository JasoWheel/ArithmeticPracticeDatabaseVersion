<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<?php require_once("../config.php");?> 

<?php $data = json_decode(file_get_contents("php://input"));
#This inserts a new row into PlayedGames table then returns PlayId and makes session var
if (isset ($_SESSION["GameId"])) {
    unset($_SESSION["GameId"]);
}
if (isset ($_SESSION["UsersName"])) {
    $_SESSION["GameNameber"] = $data->GameNameber;
    $UserName = $_SESSION["UsersName"];
    $GameNumber = $data->GameNameber;
    $stmt = $conn->prepare("INSERT INTO PlayedGames (GameNameber, UserName, Answered, Correct, Missed) VALUES ('$GameNumber', '$UserName', '0', '0', '0')");
    $stmt->execute();
    $_SESSION["GameId"] = $conn->lastInsertID();
    }
?>