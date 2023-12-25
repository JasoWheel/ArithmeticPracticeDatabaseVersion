<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>Main Options Page.</title>
	<link rel="stylesheet" type="text/css" href="gamePage.css" />
</head>
<body id="body" style="text-align:center;">
<h2 style="color:green;">MyMathApps - Administer Page</h2>

<!-- show if no username is set-->
<?php
    if (!isset($_SESSION["UsersName"])) {?>
        You are not logged in. Return to Main Page.
        <a href="OptionsPage.php"><button>Back to Main Page</button></a><br>
        <?php };?>

<?php
    if (isset($_SESSION["UsersName"])) {
        echo "Hello Boss, you can proceed.";
    };?>
<br>

<?php if (isset($_SESSION["UsersName"])) {?>
    <?php if ($_SESSION["UsersName"] == "AdminWheel") {?>
        <div >
            <a href="MakeUser.php"><button>New Single User or Password Reset</button></a>
        </div>

        <div >
            <a href="Reports/customSearch.php"><button>Custom Score Report</button></a>
        </div>

        <div >
            <a href="Reports/IndividualSearch.php"><button>Individual Score Report</button></a>
        </div>
        
        <div >
            <a href="Reports/findUserInfo.php"><button>User Info Search</button></a>
        </div>

        <div >
            <a href="DeleteShorts.php"><button>Delete Short Games</button></a>
        </div><br>

        <div id="makeMany">
            <label for="bulkInfo">Select .csv file for bulk user upload</label><input id="bulkInput" name="bulkInput" type="file" accept=".csv" onchange="readBulkCsv(this)">
            <p id="bulkInfo">UserName,EnterWord,Grade,Period,RealName</p>
        </div>

        <div id="gamesAdder" hidden>
            <span><label>Add Games: GamesImport.csv in main folder, then click.</label><a href="LoadGamesCsv.php"><button>Load Games from CSV</button></a></span>
        </div><br>
<?php }}; ?>
        
<?php
    if (isset($_SESSION["UsersName"])) {?>
       <div >
        <a href="logOut.php"><button>Log Out</button></a>
        <a href="OptionsPage.php"><button>Back to Main Page</button></a>
        </div>
        <?php };?>

<script src="JSindex.js"></script>
</body>
</html>
