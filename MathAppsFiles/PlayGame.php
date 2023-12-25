<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>Game Play Page.</title>
    <link rel="stylesheet" type="text/css" href="gamePage.css" />
</head>
<body id="body">

<span><label id="header" style="color:green;">MyMathApps Games</label>
<?php
    if (isset($_SESSION["UsersName"])) {?>
        <a href="Reports/UserScoreSearch.php"><button>Check Your Scores</button></a>
        <a href="OptionsPage.php" hidden><button>Back to Main Page</button></a>
        <a href="logOut.php"><button>Log Out</button></a>
        </span>
        <?php };?><br>

<?php if (isset($_SESSION["UsersName"])) {
    if ($_SESSION["UsersName"] === "AdminWheel") {
        echo "Hello Boss, pick a math game.";
    } else {
        echo "Hello ".$_SESSION["RealName"].", pick a math game.";};
    }?>

<?php
    if (isset($_SESSION["UsersName"])) {?>
    
    <div class="gameStart" >
        <span><div class="gamePairs" id="gamesZero">
            #0: Multiply and Divide<br>Positive Numbers (1 - 9)
            <div >    <a href="Games/T0TouchScreen.php">    <button>Game 0 Touch</button>    </a></div>
            <div >    <a href="Games/K0KeyPad.php">    <button>Game 0 Keys</button>    </a></div></div>
        <div class="gamePairs" id="gamesOne">
            #1: Multiply and Divide<br>Positive Numbers (2 - 12)
            <div >    <a href="Games/T1TouchScreen.php">    <button>Game 1 Touch</button>    </a></div>
            <div >    <a href="Games/K1KeyPad.php">    <button>Game 1 Keys</button>    </a>    </div></div>
        <div class="gamePairs" id="gamesTwo">
            #2: Add and Subtract<br>Positive Numbers
            <div >    <a href="Games/T2PosTwoNumSum.php">    <button>Game 2 Touch</button>    </a></div>
            <div >    <a href="Games/K2PosTwoNumSum.php">    <button>Game 2 Keys</button>    </a></div></div>
        <div class="gamePairs" id="gamesThree">
            #3: Random Operations<br>Positive Numbers
            <div >    <a href="Games/T3PosRandom.php">    <button>Game 3 Touch</button>    </a></div>
            <div >    <a href="Games/K3PosRandom.php">    <button>Game 3 Keys</button>    </a></div></div></span>
        <span><div class="gamePairs" id="gamesFour">
            #4: Two-Step Math<br>Positive Numbers
            <div >    <a href="Games/T4PosTwoStep.php">    <button>Game 4 Touch</button>    </a></div>
            <div >    <a href="Games/K4PosTwoStep.php">    <button>Game 4 Keys</button>    </a></div></div>   
        <div class="gamePairs" id="gamesFive">
            #5: Multiply and Divide<br>Integers
            <div >    <a href="Games/T5MultDivInt.php">    <button>Game 5 Touch</button>    </a></div>
            <div >    <a href="Games/K5MultDivInt.php">    <button>Game 5 Keys</button>    </a></div></div>   
        <div class="gamePairs" id="gamesSixA">
            #6A: Add and Subtract<br>Two Integers (Easy)
            <div >    <a href="Games/T6ATouchScreen.php">    <button>Game 6A Touch</button>    </a></div>
            <div >    <a href="Games/K6AKeyPad.php">    <button>Game 6A Keys</button>    </a>    </div></div>  
        <div class="gamePairs" id="gamesSixB">
            #6B: Add/Subtract<br>Two Integers (Harder)
            <div >    <a href="Games/T6BTwoNumSumInt.php">    <button>Game 6B Touch</button>    </a></div>
            <div >    <a href="Games/K6BTwoNumSumInt.php">    <button>Game 6B Keys</button>    </a></div></div></span>
        <span><div class="gamePairs" id="gamesSeven">
            #7: Add and Subtract<br>Three Integers
            <div >    <a href="Games/T7ThreeNumSumInt.php">    <button>Game 7 Touch</button>    </a></div>
            <div >    <a href="Games/K7ThreeNumSumInt.php">    <button>Game 7 Keys</button>    </a></div></div>    
        <div class="gamePairs" id="gamesEight">
            #8: Add and Subtract<br>Many Integers
            <div >    <a href="Games/T8ManyIntSum.php">    <button>Game 8 Touch</button>    </a></div>
            <div >    <a href="Games/K8ManyIntSum.php">    <button>Game 8 Keys</button>    </a></div></div>
        <div class="gamePairs" id="gamesNine">
            #9: Easy Random Math<br>Integers
            <div >    <a href="Games/T9EasyRandom.php">    <button>Game 9 Touch</button>    </a></div>
            <div >    <a href="Games/K9EasyRandom.php">    <button>Game 9 Keys</button>    </a></div></div>
        <div class="gamePairs" id="gamesTen">
            #10: Harder Random Math<br>Integers
            <div >    <a href="Games/T10HardRandom.php">    <button>Game 10 Touch</button>    </a></div>
            <div >    <a href="Games/K10HardRandom.php">    <button>Game 10 Keys</button>    </a></div></div></span>
        <span><div class="gamePairs" id="gamesEleven">
            #11: Two-Step Math<br>Integers
            <div >    <a href="Games/T11TouchScreenTwoStep.php">    <button>Game 11 Touch</button>    </a></div>
            <div >    <a href="Games/K11KeyPadTwoStep.php">    <button>Game 11 Keys</button>    </a></div></div>
        <div class="gamePairs" id="gamesEleven">
            #12: Long Division -or-<br>Improper Fraction to<br>Mixed Number
            <div >    <a href="Games/longDivision.php">    <button>Game 12</button>    </a></div>
        </div></span>
    </div>
    <?php };?>

<?php if (!isset($_SESSION["UsersName"])) {?>
        You are not logged in. Return to Main Page.
        <a href="OptionsPage.php"><button>Back to Main Page</button></a><br>
<?php };?>


<?php if (isset($_SESSION["UsersName"])) {
    if ($_SESSION["UsersName"] === "AdminWheel") {?>
        <div >
        <a href="OptionsPage.php"><button>Back to Main Page</button></a>
        </div>
<?php };} ?><br>

</body>
</html>