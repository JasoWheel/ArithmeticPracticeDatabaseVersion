<?php if(session_status() == PHP_SESSION_NONE) session_start();
session_destroy(); ?>
<?php session_start();?>
<?php require_once("config.php");/*create database connection*/?>
<?php
$data = json_decode(file_get_contents("php://input"));
$UserName=$data->UserName; 
$Password=$data->Password;

$blnkPw = 'SELECT * FROM MathKids WHERE UserName = ? AND EnterWord = ""';
$missPw = $conn->prepare($blnkPw);
$missPw->execute([$UserName]);
$emptyPw = $missPw->rowCount();

if ($emptyPw > 0) {
    $_SESSION["emptyPassword"] = "yes";
    $_SESSION["emptyUserName"] = $UserName;
    } else {
            $sql = 'SELECT UserName, RealName FROM MathKids WHERE UserName = ? AND EnterWord = ?';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$UserName, $Password]);
            $found = $stmt->rowCount();
                if ($found > 0){
                    $_SESSION["OkToLogin"] = "yes";
                    $_SESSION["UsersName"] = $UserName;
                    $row = $stmt -> fetch();
                    $_SESSION["RealName"] = $row[1];
                    }    
                    else {
                        $_SESSION["OkToLogin"] = "no";
                    }} ?>