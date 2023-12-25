<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Mathapps Logged User Search</title>
     <link rel="stylesheet" type="text/css" href="UserReport.css" />
</head>

<body class="body">
<div class="wholePage" id="wholePage" >

<?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
 <br>You are not logged in.<br>Return to Main Page.
 <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
 </div></div></div>
<?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>

<div class="TopRow" id="topRow">
    <span><a href="../PlayGame.php"><button id="backButton">Back to Games Page</button></a><label for="testDownload"><?php echo $_SESSION["RealName"]." Scores Search"?></label>
    <button id="testDownload" onclick="startUserCsvDownload()">Download CSV File</button></span>
</div>

<div class="MainBoxes" id="HeaderPicker" >
<div>
    <p><b>Pick Headers to Display</b></p>
    <label for="RealName"><input type="checkbox" id="RealName" name="RealName" value="MathKids.RealName" onchange="UserScoreGet()" checked/>RealName</label>
    <label for="Game"><input type="checkbox" id="Game" name="Game" value="PlayedGames.GameNameber" onchange="UserScoreGet()" checked/>Game</label>
    <label for="Answered"><input type="checkbox" id="Answered" name="Answered" value="PlayedGames.Answered" onchange="UserScoreGet()" checked/>Answered</label>
    <label for="Correct"><input type="checkbox" id="Correct" name="Correct" value="PlayedGames.Correct" onchange="UserScoreGet()" checked/>Correct</label>
    <label for="Percent"><input type="checkbox" id="Percent" name="Percent" value="PlayedGames.Percent" onchange="UserScoreGet()" checked/>Percent</label>
    <label for="Date"><input type="checkbox" id="Date" name="Date" value="PlayedGames.LastTime" onchange="UserScoreGet()"checked/>Date</label>
</div></div>

<div class="MainBoxes" id="scoreText">Select Game Buttons<br>on the left side to start</div>

<div class="MainBoxes" id="UserNamePicker" >
<h3>Use buttons below to<br>filter and sort your scores</h3>
</div>

<div class="MainBoxes" id="GamePicker" >
<div id="GamesAndSort">
    <div id=pickGames>
    <p><b>Pick Games</b></p>
    <span><label for="Game 0"><input type="checkbox" id="Game 0" name="Game 0" onchange="UserScoreGet()"/>Game 0</label>
    <label for="Game 1"><input type="checkbox" id="Game 1" name="Game 1" onchange="UserScoreGet()"/>Game 1</label>
    <label for="Game 2"><input type="checkbox" id="Game 2" name="Game 2" onchange="UserScoreGet()"/>Game 2</label>
    <label for="Game 3"><input type="checkbox" id="Game 3" name="Game 3" onchange="UserScoreGet()"/>Game 3</label></span>
    <span><label for="Game 4"><input type="checkbox" id="Game 4" name="Game 4" onchange="UserScoreGet()"/>Game 4</label>
    <label for="Game 5"><input type="checkbox" id="Game 5" name="Game 5" onchange="UserScoreGet()"/>Game 5</label>
    <label for="Game 6A"><input type="checkbox" id="Game 6A" name="Game 6A" onchange="UserScoreGet()"/>Game 6A</label>
    <label for="Game 6B"><input type="checkbox" id="Game 6B" name="Game 6B" onchange="UserScoreGet()"/>Game 6B</label>
    <label for="Game 7"><input type="checkbox" id="Game 7" name="Game 7" onchange="UserScoreGet()"/>Game 7</label></span>
    <span><label for="Game 8"><input type="checkbox" id="Game 8" name="Game 8" onchange="UserScoreGet()"/>Game 8</label>
    <label for="Game 9"><input type="checkbox" id="Game 9" name="Game 9" onchange="UserScoreGet()"/>Game 9</label>
    <label for="Game 10"><input type="checkbox" id="Game 10" name="Game 10" onchange="UserScoreGet()"/>Game 10</label>
    <label for="Game 11"><input type="checkbox" id="Game 11" name="Game 11" onchange="UserScoreGet()"/>Game 11</label>
    <label for="Game 12"><input type="checkbox" id="Game 12" name="Game 12" onchange="UserScoreGet()"/>Game 12</label></span>
    </div>

    <div id="sortOne">
    <p><b>First Sort</b></p>
    <span>
    <label for="sortGame"><input type="radio" id="sortGame" name="sortOne" value="MathGames.sortGameNumber" onchange="UserScoreGet()"/>Game</label>
    <label for="sortPercent"><input type="radio" id="sortPercent" name="sortOne" value="Percent DESC" onchange="UserScoreGet()"/>Percent</label></span>
    <span><label for="sortDate"><input type="radio" id="sortDate" name="sortOne" value="CAST(PlayedGames.LastTime AS DATE) DESC" onchange="UserScoreGet()" checked/>Date</label></span>
</div>

    <div id="sortTwo">
    <p><b>Second Sort</b></p>
    <span><label for="sortNone2"><input type="radio" id="sortNone2" name="sortTwo" value="" onchange="UserScoreGet()" checked/>None</label>
    <label for="sortGame2"><input type="radio" id="sortGame2" name="sortTwo" value="MathGames.sortGameNumber" onchange="UserScoreGet()"/>Game</label></span>
    <span><label for="sortPercent2"><input type="radio" id="sortPercent2" name="sortTwo" value="Percent DESC" onchange="UserScoreGet()"/>Percent</label>
    <label for="sortDate2"><input type="radio" id="sortDate2" name="sortTwo" value="CAST(PlayedGames.LastTime AS DATE) DESC" onchange="UserScoreGet()"/>Date</label></span>
    </div>
</div></div>

<div class="MainBoxes" id="DateChooser">
    <p style="font-size:1.5vw; margin: 0px 0px 0px 0px"><b >Check Scores<br> between and including these dates:</b></p>
    <span id="span"><input type="date" id="startDay" name="startDay" value="" style="width:150">
    <input type="date" id="endDay" name="endDay" value="" style="width:150"></span>
    <span><button class="submitDate" onclick="UserScoreGet()">Submit with Dates</button>
    <button class="submitDate" onclick="resetDatesAlone()">Reset Dates</button></span>
</div>

</div>

<script src="JsUserCheckScores.js"></script>
<?php };?>
</body>
</html>