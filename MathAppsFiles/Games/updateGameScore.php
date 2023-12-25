<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<?php require_once("../config.php");?> 

<?php $data = json_decode(file_get_contents("php://input"));
if (isset ($_SESSION["UsersName"]) && isset($_SESSION["GameId"])) {
    $Answered = $data->Answered;
    $Correct = $data->Correct;
    $Missed = $data->Missed;
    $UserName = $_SESSION["UsersName"];
    $GameId = $_SESSION["GameId"];
    $stmt = $conn->prepare("UPDATE PlayedGames SET Answered = '$Answered', Correct = '$Correct', Missed = '$Missed' WHERE PlayId = $GameId");
    $stmt->execute();
    }

?>