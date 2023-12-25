<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php ini_set('display_errors', true);?>
<?php require_once 'config.php';
$data = json_decode(file_get_contents("php://input"));

$UserName=$data->UserName;
#echo strlen($UserName);
if (strlen($UserName) > 1) {
    $sql = 'UPDATE MathKids SET EnterWord = "" WHERE UserName = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$UserName]);
    echo $UserName."'s password is reset.";
} else {
    echo "Something did not work on the reset.";
}
?>