<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Mathapps Individual User Search</title>
     <link rel="stylesheet" type="text/css" href="IndvReport.css" />
</head>

<body class="body">
<div class="wholePage" id="wholePage" >

<div class="TopRow" id="topRow">

<?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
 <br>You are not logged in. Return to Main Page.
 <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
 </div></div></div>
<?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>

    <span><a href="../AdminPage.php"><button id="backButton">Back to Admin Page</button></a><label for="testDownload">Individual User Search</label>
<?php if ($_SESSION["UsersName"] == "AdminWheel") {?>
    <button id="testDownload" onclick="startIndivCsvDownload()">Download CSV File</button></span>
</div>

<div class="MainBoxes" id="HeaderPicker" >
<div>
    <p><b>Pick Headers</b></p>
    <label for="RealName"><input type="checkbox" id="RealName" name="Headers" value="RealName" onchange="pickUser()" checked/>RealName</label>
    <label for="Class"><input type="checkbox" id="Period" name="Headers" value="Period" onchange="pickUser()"checked/>Period</label>
    <label for="Grade"><input type="checkbox" id="Grade" name="Headers" value="Grade" onchange="pickUser()"checked/>Grade</label>
    <label for="Game"><input type="checkbox" id="Game" name="Headers" value="PlayedGames.GameNameber AS Game" onchange="pickUser()" checked/>Game</label>
    <label for="Answered"><input type="checkbox" id="Answered" name="Headers" value="Answered" onchange="pickUser()" checked/>Answered</label>
    <label for="Correct"><input type="checkbox" id="Correct" name="Headers" value="Correct" onchange="pickUser()" checked/>Correct</label>
    <label for="Percent"><input type="checkbox" id="Percent" name="Headers" value="ROUND(Correct / Answered * 100, 1) AS Percent" onchange="pickUser()" checked/>Percent</label>
    <label for="Date"><input type="checkbox" id="Date" name="Headers" value="CONCAT(DAYOFMONTH(TIMESTAMP(PlayedGames.StartTime)),&quot;-&quot; , MONTHNAME(TIMESTAMP(PlayedGames.StartTime))) AS Date" onchange="pickUser()"checked/>Date</label>
    <label for="EnterWord"><input type="checkbox" id="EnterWord" name="Headers" value="EnterWord" onchange="pickUser()"/>EnterWord</label>
</div></div>

<div class="MainBoxes" id="UserNamePicker" >
<?php include_once 'makeUserList.php'; ?>
</div>

<div class="MainBoxes" id="scoreText">Score Info Goes Here</div>

<div class="MainBoxes" id="GamePicker" >
<div id="GamesAndSort">
    <div id=pickGames>
    <p><b>Pick Games</b></p>
    <span><label for="0"><input type="checkbox" id="0" name="GameTags" onchange="pickUser()"/>Game 0</label>
    <label for="1"><input type="checkbox" id="1" name="GameTags" onchange="pickUser()"/>Game 1</label>
    <label for="2"><input type="checkbox" id="2" name="GameTags" onchange="pickUser()"/>Game 2</label>
    <label for="3"><input type="checkbox" id="3" name="GameTags" onchange="pickUser()"/>Game 3</label>
    <label for="4"><input type="checkbox" id="4" name="GameTags" onchange="pickUser()"/>Game 4</label>
    <label for="5"><input type="checkbox" id="5" name="GameTags" onchange="pickUser()"/>Game 5</label>
    <label for="6A"><input type="checkbox" id="6A" name="GameTags" onchange="pickUser()"/>Game 6A</label></span>
    <span><label for="6B"><input type="checkbox" id="6B" name="GameTags" onchange="pickUser()"/>Game 6B</label>
    <label for="7"><input type="checkbox" id="7" name="GameTags" onchange="pickUser()"/>Game 7</label>
    <label for="8"><input type="checkbox" id="8" name="GameTags" onchange="pickUser()"/>Game 8</label>
    <label for="9"><input type="checkbox" id="9" name="GameTags" onchange="pickUser()"/>Game 9</label>
    <label for="10"><input type="checkbox" id="10" name="GameTags" onchange="pickUser()"/>Game 10</label>
    <label for="11"><input type="checkbox" id="11" name="GameTags" onchange="pickUser()"/>Game 11</label>
    <label for="12"><input type="checkbox" id="12" name="GameTags" onchange="pickUser()"/>Game 12</label></span>
    </div>

    <div id="sortOne">
    <p><b>First Sort</b></p>
    <span><label for="sortNone"><input type="radio" id="sortNone" name="sortOne" value="" onchange="pickUser()"/>None</label>
    <label for="sortGame"><input type="radio" id="sortGame" name="sortOne" value="MathGames.sortGameNumber" onchange="pickUser()"/>Game</label>
    <label for="sortPercent"><input type="radio" id="sortPercent" name="sortOne" value="Percent DESC" onchange="pickUser()"/>Percent</label>
    <label for="sortDate"><input type="radio" id="sortDate" name="sortOne" value="CAST(PlayedGames.LastTime AS DATE) DESC" onchange="pickUser()" checked/>Date</label></span>
    </div>

    <div id="sortTwo">
    <p><b>Second Sort</b></p>
    <span><label for="sortNone2"><input type="radio" id="sortNone2" name="sortTwo" value="" onchange="pickUser()" checked/>None</label>
    <label for="sortGame2"><input type="radio" id="sortGame2" name="sortTwo" value="MathGames.sortGameNumber" onchange="pickUser()"/>Game</label>
    <label for="sortPercent2"><input type="radio" id="sortPercent2" name="sortTwo" value="Percent DESC" onchange="pickUser()"/>Percent</label>
    <label for="sortDate2"><input type="radio" id="sortDate2" name="sortTwo" value="CAST(PlayedGames.LastTime AS DATE) DESC" onchange="pickUser()"/>Date</label></span>
    </div>
</div></div>

<div class="MainBoxes" id="DateChooser">
    <p style="font-size:1vw; margin: 0px 0px 0px 0px"><b >Check Scores between and including these dates:</b></p>
    <span id="span"><input type="date" id="startDay" name="startDay" value="" style="width:150">
    <input type="date" id="endDay" name="endDay" value="" style="width:150">
    <button class="submitDate" onclick="pickUser()">Submit with Dates</button>
    <button class="submitDate" onclick="resetDatesUser()">Reset Dates</button></span>
</div>

</div>

<script src="JsCheckScores.js"></script>
<?php };?>
<?php };?>
</body>
</html>