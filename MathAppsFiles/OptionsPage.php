<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>Main Options Page.</title>
	<link rel="stylesheet" type="text/css" href="gamePage.css" />
</head>
<body id="body" style="text-align:center;">
<h2 style="color:green;">MyMathApps Games (Studio)</h2>

<!-- show if no username is set-->
<?php
    if (!isset($_SESSION["UsersName"])) {?>
    <div >
        <p>Please Log In to continue.</p>
            <input id="LogUserName" placeholder="Insert LogIn Name" type="text" onkeyup="doEnterKey(event)"/> 
            <input id="LogPassword" placeholder="Insert LogIn Password" type="password" onkeyup="doEnterKey(event)"/> <br>
            <button onclick="LogInCheck()">Click to Log In</button> <br><br>
            Or... <br/>If you want to play without logging in... <br>
            Log in as Name = <b>guest</b> and Password = <b>guest</b> <br>
    </div><br>
<?php };?>
    
<?php
    if (isset($_SESSION["UsersName"])) {
        if ($_SESSION['UsersName'] === "AdminWheel") {
            echo "Hello Boss, you can proceed.";
        } else {
            #echo "Hello ".$_SESSION["UsersName"].", you can proceed.";
            Header("location: PlayGame.php"); #send non-Admin user to game page
        }
    };?>
<br>

<?php
    if (isset($_SESSION["UsersName"])) {?>
        <div >
        <a href="PlayGame.php">
        <button>Start a New Game</button></a>
        </div>
        <?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>
    <?php if ($_SESSION["UsersName"] == "AdminWheel") {?>
        <div >
        <a href="AdminPage.php">
        <button>Do Admin Stuff</button></a>
        </div>
        <?php };?>
        
<?php
    if (isset($_SESSION["UsersName"])) {?>
       <div >
        <a href="logOut.php">
          <button>Log Out</button>
        </a>
        </div>
        <?php }};?>

</body>

<script src="JSoptions.js"></script>
</html>