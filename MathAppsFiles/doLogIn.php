<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>Login Results</title>
	<link rel="stylesheet" type="text/css" href="gamePage.css" />
</head>
<body id="body" style="text-align:center;">
<h2 style="color:green;">Log-In Results</h2>

<div > 
<?php if (isset($_SESSION["OkToLogin"])) {
    if ($_SESSION["OkToLogin"] === "yes") {
        if ($_SESSION["UsersName"] === "AdminWheel") {
            echo "You are now logged in ".$_SESSION["RealName"];
        } else {
            #echo "You are logged in as ". $_SESSION["UsersName"].".<br>";
            Header("location: PlayGame.php");
        }
?></div>
    
<div >
<a href="PlayGame.php">
    <button>Start a New Game</button></a>
</div>
    
<div >
<a href="Reports/UserScoreSearch.php">
    <button>Check Your Scores</button></a>
</div>

<div >
    <a href="logOut.php">
      <button>Log Out</button>
    </a>

<?php if (isset($_SESSION["UsersName"])) {?>
    <?php if ($_SESSION["UsersName"] == "AdminWheel") {?>
        <div >
        <a href="AdminPage.php">
        <button>Do Admin Stuff</button></a>
        </div>
<?php }};?>

</div><br>
    
<?php }
if ($_SESSION["OkToLogin"] === "no"){
    echo "Your log in attempt failed.";?>
    <div >
    <input id="LogUserName" placeholder="Insert LogIn Name" type="text" onkeyup="doEnterKey(event)"/> 
    <input id="LogPassword" placeholder="Insert LogIn Password" type="password" onkeyup="doEnterKey(event)"/> <br>
    <button onclick="LogInCheck()">Click to Log In</button> <br><br>
    <p>If you want to play without logging in... </p><br>
    <p>Log in as Name = <b>guest</b> and Password = <b>guest</b> <br><br></p>
    </div>
<?php };} ?>

<?php if (isset($_SESSION["emptyPassword"])) {
    if ($_SESSION["emptyPassword"] === "yes") {;
        echo "Hello ". $_SESSION["emptyUserName"].". You do not have a Password."?>
        <div >
            <p>Enter your new password twice.<br>
            Password cannot be more than 10 letters and numbers, and is CASE sensitive.</p>
            <input id="LogPasswordA" placeholder="Enter New Password" type="text" /> 
            <input id="LogPasswordB" placeholder="Enter New Password" type="text" /><br>
            <button onclick="newPassword()">Click to Set Password</button> <br/>
        </div>
        <div >
            <p>Or..<br>If you want to play without logging in...<br>
            Log in as Name = guest and Password = guest </p>
            <input id="LogUserName" placeholder="Insert LogIn Name" type="text" onkeyup="doEnterKey(event)"/> 
            <input id="LogPassword" placeholder="Insert LogIn Password" type="password" onkeyup="doEnterKey(event)"/> <br>
                <button onclick="LogInCheck()">Click to Log In</button> <br>
        </div>
    <?php };}?>
     
<script src="JSoptions.js"></script>
</body>
</html>