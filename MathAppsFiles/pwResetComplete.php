<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>ResetPage.</title>
	<link rel="stylesheet" type="text/css" href="gamePage.css" />
</head>
<body id="body" style="text-align:center;">
<h2 style="color:green;">Password Reset Results</h2>

<?php if ($_SESSION["PasswordsMatch"] === "yes") {?>

<p><?php echo "Hello ".$_SESSION["emptyUserName"]."."?></p>
<p>Your Password has been set, you can now log in.</p>
    <div >
        <input id="LogUserName" placeholder="Insert LogIn Name" type="text" onkeyup="doEnterKey(event)"/> 
        <input id="LogPassword" placeholder="Insert LogIn Password" type="password" onkeyup="doEnterKey(event)"/> <br>
        <button onclick="LogInCheck()">Click to Log In</button>
        <p>If you want to play without logging in...<br>Log in as Name = guest and Password = guest</p>
            <input id="LogUserName" placeholder="Insert LogIn Name" type="text" onkeyup="doEnterKey(event)"/> 
            <input id="LogPassword" placeholder="Insert LogIn Password" type="password" onkeyup="doEnterKey(event)"/> <br>
            <button onclick="LogInCheck()">Click to Log In</button>
    </div> 
<?php };?>

<?php if ($_SESSION["PasswordsMatch"] === "no") {?>
<p><?php echo "Hello ".$_SESSION["emptyUserName"].". The Passwords you entered did not match."?></p>
<div >
        <p>Try again. Enter your new password twice.<br>
        Password cannot be more than 10 letters and numbers</p>
        <input id="LogPasswordA" placeholder="Enter New Password" type="text" /> 
        <input id="LogPasswordB" placeholder="Enter New Password" type="text" /><br>
        <button onclick="newPassword()">Click to Set Password</button> <br/>
    </div>
    <div >
        <p>or...<br>If you want to play without logging in...<br>
        Log in as Name = guest and Password = guest </p>
            <input id="LogUserName" placeholder="Insert LogIn Name" type="text" onkeyup="doEnterKey(event)"/> 
            <input id="LogPassword" placeholder="Insert LogIn Password" type="password" onkeyup="doEnterKey(event)"/> <br>
            <button onclick="LogInCheck()">Click to Log In</button>
    </div>
<?php };?>

<script src="JSoptions.js"></script>
</body>
</html>