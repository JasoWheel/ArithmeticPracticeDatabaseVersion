<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>MathApps Custom Score Search</title>
     <link rel="stylesheet" type="text/css" href="searchReports.css" />
</head>

<body class="body">
<div class="wholePage" id="wholePage" >

<div class="MainBoxes" id="topRow">
<?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
 <br>You are not logged in. Return to Main Page.
 <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
 </div></div></div>
<?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>
    <span><a href="../AdminPage.php"><button id="backButton">Back to Admin Page</button></a><label for="backButton">Custom Game Score Search</label>
<?php if ($_SESSION["UsersName"] == "AdminWheel") {?>
    <button id="testDownload" onclick="startCsvDownload()">Download CSV File</button></span>
</div>

<div class="MainBoxes" id="HeaderPicker" >

<div>
    <p><b>Pick Headers</b></p>
    <label for="RealName"><input type="checkbox" id="RealName" name="Headers" value="RealName" onchange="pickNames()" checked/>RealName</label>
    <label for="UserName"><input type="checkbox" id="UserName" name="Headers" value="MathKids.UserName" onchange="pickNames()" />UserName</label>
    <label for="Class"><input type="checkbox" id="Period" name="Headers" value="Period" onchange="pickNames()"checked/>Period</label>
    <label for="Grade"><input type="checkbox" id="Grade" name="Headers" value="Grade" onchange="pickNames()"checked/>Grade</label>
    <label for="Game"><input type="checkbox" id="Game" name="Headers" value="PlayedGames.GameNameber AS Game" onchange="pickNames()" checked/>Game</label>
    <label for="Answered"><input type="checkbox" id="Answered" name="Headers" value="Answered" onchange="pickNames()" checked/>Answered</label>
    <label for="Correct"><input type="checkbox" id="Correct" name="Headers" value="Correct" onchange="pickNames()" checked/>Correct</label>
    <label for="Percent"><input type="checkbox" id="Percent" name="Headers" value="ROUND(Correct / Answered * 100, 1) AS Percent" onchange="pickNames()" checked/>Percent</label>
    <label for="Date"><input type="checkbox" id="Date" name="Headers" value="CONCAT(DAYOFMONTH(TIMESTAMP(PlayedGames.StartTime)),&quot;-&quot; , MONTHNAME(TIMESTAMP(PlayedGames.StartTime))) AS Date" onchange="pickNames()"checked/>Date</label>
    <label for="EnterWord"><input type="checkbox" id="EnterWord" name="Headers" value="EnterWord" onchange="pickNames()"/>EnterWord</label>
</div></div>

<div class="MainBoxes" id="UserGroupPicker" >
<div>
    <p><b>Pick Students by Period</b></p>
    <label for="Period1"><input type="checkbox" id="Period1" name="Periods" value="1" onchange="pickNames()"/>1st Period</label>
    <label for="Period2"><input type="checkbox" id="Period2" name="Periods" value="2" onchange="pickNames()"/>2nd Period</label>
    <label for="Period3"><input type="checkbox" id="Period3" name="Periods" value="3" onchange="pickNames()"/>3rd Period</label><br>
    <label for="Period4"><input type="checkbox" id="Period4" name="Periods" value="4" onchange="pickNames()"/>4th Period</label>
    <label for="Period5"><input type="checkbox" id="Period5" name="Periods" value="5" onchange="pickNames()"/>5th Period</label>
    <label for="Period6"><input type="checkbox" id="Period6" name="Periods" value="6" onchange="pickNames()"/>6th Period</label>
    <label for="Period12"><input type="checkbox" id="Period12" name="Periods" value="12" onchange="pickNames()"/>12th Period</label>
<br>----------and/or-----------
    <p><b>Pick Students by Grade</b></p>
    <label for="Grade5"><input type="checkbox" id="Grade5" name="GradeLevel" value="5" onchange="pickNames()"/>5th Grade</label>
    <label for="Grade6"><input type="checkbox" id="Grade6" name="GradeLevel" value="6" onchange="pickNames()"/>6th Grade</label>
    <label for="Grade7"><input type="checkbox" id="Grade7" name="GradeLevel" value="7" onchange="pickNames()"/>7th Grade</label>
    <label for="Grade8"><input type="checkbox" id="Grade8" name="GradeLevel" value="8" onchange="pickNames()"/>8th Grade</label></div>
</div>

<div class="MainBoxes" id="fillText">Score Info Goes Here</div>

<div class="MainBoxes" id="GamePicker" >
<div id="GamesAndSort">
    <div id=pickGames>
    <p><b>Pick Games</b></p>
    <span><label for="0"><input type="checkbox" id="0" name="GameTags" onchange="pickNames()"/>Game 0</label>
    <label for="1"><input type="checkbox" id="1" name="GameTags" onchange="pickNames()"/>Game 1</label>
    <label for="2"><input type="checkbox" id="2" name="GameTags" onchange="pickNames()"/>Game 2</label>
    <label for="3"><input type="checkbox" id="3" name="GameTags" onchange="pickNames()"/>Game 3</label>
    <label for="4"><input type="checkbox" id="4" name="GameTags" onchange="pickNames()"/>Game 4</label></span>
    <span><label for="5"><input type="checkbox" id="5" name="GameTags" onchange="pickNames()"/>Game 5</label>
    <label for="6A"><input type="checkbox" id="6A" name="GameTags" onchange="pickNames()"/>Game 6A</label>
    <label for="6B"><input type="checkbox" id="6B" name="GameTags" onchange="pickNames()"/>Game 6B</label>
    <label for="7"><input type="checkbox" id="7" name="GameTags" onchange="pickNames()"/>Game 7</label></span>
    <span><label for="8"><input type="checkbox" id="8" name="GameTags" onchange="pickNames()"/>Game 8</label>
    <label for="9"><input type="checkbox" id="9" name="GameTags" onchange="pickNames()"/>Game 9</label>
    <label for="10"><input type="checkbox" id="10" name="GameTags" onchange="pickNames()"/>Game 10</label>
    <label for="11"><input type="checkbox" id="11" name="GameTags" onchange="pickNames()"/>Game 11</label>
    <label for="12"><input type="checkbox" id="12" name="GameTags" onchange="pickNames()"/>Game 12</label></span>
    </div>

    <div id="sortOne">
    <span><label for="sortName"><input type="radio" id="sortName" name="sortOne" value="MathKids.RealName" onchange="pickNames()" checked/>Name</label>
    <label for="sortPeriod"><input type="radio" id="sortPeriod" name="sortOne" value="Period" onchange="pickNames()"/>Period</label>
    <label for="sortGrade"><input type="radio" id="sortGrade" name="sortOne" value="Grade" onchange="pickNames()"/>Grade</label></span>
    <p><b>First Sort</b></p>
    <span><label for="sortGame"><input type="radio" id="sortGame" name="sortOne" value="MathGames.sortGameNumber" onchange="pickNames()"/>Game</label>
    <label for="sortPercent"><input type="radio" id="sortPercent" name="sortOne" value="Percent DESC" onchange="pickNames()"/>Percent</label>
    <label for="sortDate"><input type="radio" id="sortDate" name="sortOne" value="CAST(PlayedGames.LastTime AS DATE) DESC" onchange="pickNames()"/>Date</label></span>
    </div>

    <div id="sortTwo">
    <span><label for="sortNone2"><input type="radio" id="sortNone2" name="sortTwo" value="" onchange="pickNames()" checked/>None</label>
    <label for="sortName2"><input type="radio" id="sortName2" name="sortTwo" value="MathKids.RealName" onchange="pickNames()"/>Name</label>
    <label for="sortPeriod2"><input type="radio" id="sortPeriod2" name="sortTwo" value="Period" onchange="pickNames()"/>Period</label>
    <label for="sortGrade2"><input type="radio" id="sortGrade2" name="sortTwo" value="Grade" onchange="pickNames()"/>Grade</label></span>
    <p><b>Second Sort</b></p>
    <span><label for="sortGame2"><input type="radio" id="sortGame2" name="sortTwo" value="MathGames.sortGameNumber" onchange="pickNames()"/>Game</label>
    <label for="sortPercent2"><input type="radio" id="sortPercent2" name="sortTwo" value="Percent DESC" onchange="pickNames()"/>Percent</label>
    <label for="sortDate2"><input type="radio" id="sortDate2" name="sortTwo" value="CAST(PlayedGames.LastTime AS DATE) DESC" onchange="pickNames()"/>Date</label></span>
    </div>
</div></div>

<div class="MainBoxes" id="DateChooser">
    <p><b>Check Scores between and including these dates:</b></p>
    <span id="span"><input type="date" id="startDay" name="startDay" value="" style="width:150">
    <input type="date" id="endDay" name="endDay" value="" style="width:150">
    <button class="submitDate" onclick="pickNames()">Submit with Dates</button>
    <button class="submitDate" onclick="resetDates()">Reset Dates</button></span>
</div>

</div>

<script src="JsCheckScores.js"></script>
<?php };?>
<?php };?>
</body>
</html>