<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php ini_set('display_errors', true);?>
<?php require_once 'config.php';
$data = json_decode(file_get_contents("php://input"));

$DeleteNumber=$data->DeleteNumber;
//echo strlen($DeleteNumber);
if (strlen($DeleteNumber) > 0) {
    $sql = 'DELETE FROM PlayedGames WHERE Answered < ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$DeleteNumber]);
    $quantDeleted = $stmt->rowCount();
    echo $quantDeleted." game scores deleted.";
} else {
    echo "Something did not work.";
}
?>