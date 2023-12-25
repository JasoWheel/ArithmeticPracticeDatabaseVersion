<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php require_once("config.php");/*create database connection*/?>
<?php
$data = json_decode(file_get_contents("php://input"));
$UserName = $_SESSION["emptyUserName"];
$PasswordA=$data->PasswordA;
$PasswordB=$data->PasswordB;
echo $UserName.",".$PasswordA.",".$PasswordB;

if ($PasswordA != $PasswordB) {
    $_SESSION["PasswordsMatch"] = "no";
}

if ($PasswordA == $PasswordB) {
    $_SESSION["PasswordsMatch"] = "yes";
    $sql = 'UPDATE MathKids SET EnterWord = ? WHERE UserName = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$PasswordA, $UserName]);
    
} ?>