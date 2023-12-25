<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>It Worked Page.</title>
	<link rel="stylesheet" type="text/css" href="gamePage.css" />
</head>
<body id="body" style="text-align:center;">
<h2 style="color:green;">New User Submission Results</h2>
<?php if (isset($_SESSION["newUsersName"])) {?>
    <p> <?php
    echo "New User Name is ". $_SESSION["newUsersName"].".<br>";
    echo "Password is ". $_SESSION["newUsersPassword"].".<br>";
    echo "Grade Level is ". $_SESSION["newUsersGrade"].".<br>";
    echo "Class Period is ". $_SESSION["newUsersPeriod"].".<br>";
    echo "Real Name is ". $_SESSION["newRealName"].".<br>";
    unset($_SESSION["newUsersName"]);
    ?>
    </p><br>
    <div ><a href="AdminPage.php"><button>Back to Admin Page</button></a>
    </div>

<?php } else {?>
    <div >
    <?php echo "Sorry, ". $_SESSION["UserExists"]." already used".".<br>";?>
        <p></p>Pick a different UserName.</p>
    </div><br>
    <div >
    <a href="MakeUser.php">
    <button>Create New User</button></a>
    </div>
    </br><p>or</p></br>
    <div >
    <a href="AdminPage.php">
      <button>Back to Admin Page</button>
    </a>
    </div>
<?php }; ?>
</body>
</html>