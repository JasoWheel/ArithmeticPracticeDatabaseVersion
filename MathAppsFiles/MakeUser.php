<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>JavaScript | Sending JSON data to server.</title>
  <link rel="stylesheet" type="text/css" href="makeUser.css" />
</head>
<body id="body" style="text-align:center;">

<div id="WholePage">

  <div id="theTop">
    <div id="goBackButton">
    <p id="PageName" style="color:green;">New User and Password Reset</p>
    <a href="AdminPage.php"><button>Back to Admin Page</button></a>
    </div>
  </div>

  <?php if ($_SESSION["UsersName"] === "AdminWheel") {?>

  <div id="newUserInput">
    <p id="result" style="color:black">Input New User Information</p>
    <div id="inputParts">
      <input id="UserName" placeholder="UserName Here" type="text" required/> 
      <input id="Password" placeholder="Password Here" type="text" required/> <br/>
      <input id="Grade" placeholder="Grade Here" type="number" required/> 
      <input id="Period" placeholder="Class Period Here" type="number" required/><br/>
      <input id="RealName" placeholder="Real Name Here" type="text" required/> <br/>
      <!-- Button to send data -->
      <button onclick="CheckNewUser()">makeNewUser</button>
    </div>
  </div>



  <div class="MainBoxes" id="UserNamePicker" >
    <?php include_once 'makeUserListCopy.php';?>
  </div>
  

  <div id="resetArea">
    <p id="showKid">Select student on right<br>for password reset.</p>
    <button onclick="resetPassword()">Reset Password</button>
  </div>

  <?php };?>

</div>

<script src="JSindex.js"></script>
</body>
</html>