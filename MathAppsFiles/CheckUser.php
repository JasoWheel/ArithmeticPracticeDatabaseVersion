<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<?php require_once("config.php");?> 
<?php
$data = json_decode(file_get_contents("php://input"));

$UserName=$data->UserName; 
$Password=$data->EnterWord; 
$Grade=$data->Grade; 
$Period=$data->Period; 
$RealName=$data->RealName;

$user ="SELECT * FROM MathKids WHERE UserName = '$UserName'";
$try = $conn->query($user);
$rows = $try->fetchAll();
$countedRows = count($rows);

if ($countedRows == 0) { #make a new user
    $_SESSION["newUsersName"] = $data->UserName;
    $_SESSION["newUsersPassword"] = $data->EnterWord;
    $_SESSION["newUsersGrade"] = $data->Grade;
    $_SESSION["newUsersPeriod"] = $data->Period;
    $_SESSION["newRealName"] = $data->RealName;
    $stmt = $conn->prepare('INSERT into MathKids(UserName, EnterWord, Grade, Period, RealName) VALUES(?,?,?,?,?)');
    $res=$stmt->execute([$UserName, $Password, $Grade, $Period, $RealName]);
} else {
    $_SESSION["UserExists"] = $data->UserName;
}
?>