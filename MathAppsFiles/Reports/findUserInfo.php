<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Mathapps User Info Search</title>
     <link rel="stylesheet" type="text/css" href="findInfo.css" />
</head>

<body class="body">
<div class="wholePage" id="wholePage" >

<div class="TopRow" id="topRow">

    <?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
    <br>You are not logged in. Return to Main Page.
    <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
    </div></div>
    <?php };?>

    <?php if (isset($_SESSION["UsersName"])) {
        if ($_SESSION["UsersName"] == "AdminWheel") {?>
        <span><a href="../AdminPage.php"><button id="backButton">Back to Admin Page</button></a><label for="testDownload">User Info Search</label>
        <button id="testDownload" onclick="chooseCsv()">Download CSV File</button></span>
</div>

<div class="MainBoxes" id="HeaderPicker" >
    <div id="pickHeaders">
        <p><b>Pick Headers</b></p>
        <span><label for="RealName"><input type="checkbox" id="RealName" name="Headers" value="RealName" onchange="choosePath()" checked/>RealName</label>
        <label for="UserName"><input type="checkbox" id="UserName" name="Headers" value="UserName" onchange="choosePath()" />UserName</label>
        <label for="Class"><input type="checkbox" id="Period" name="Headers" value="Period" onchange="choosePath()"checked/>Period</label>
        <label for="Grade"><input type="checkbox" id="Grade" name="Headers" value="Grade" onchange="choosePath()"checked/>Grade</label>
        <label for="EnterWord"><input type="checkbox" id="EnterWord" name="Headers" value="EnterWord" onchange="choosePath()"/>EnterWord</label></span>
    </div>

    <div id="sortOne">
        <p><b>First Sort</b></p>
        <span><label for="sortName"><input type="radio" id="sortName" name="sortOne" value="RealName" onchange="choosePath()" checked/>RealName</label>
        <label for="sortUserName"><input type="radio" id="sortUserName" name="sortOne" value="UserName" onchange="choosePath()"/>UserName</label>
        <label for="sortPeriod"><input type="radio" id="sortPeriod" name="sortOne" value="Period" onchange="choosePath()"/>Period</label>
        <label for="sortGrade"><input type="radio" id="sortGrade" name="sortOne" value="Grade" onchange="choosePath()"/>Grade</label></span>
    </div>

    <div id="sortTwo">
        <p><b>Second Sort</b></p>
        <span><label for="sortNone2"><input type="radio" id="sortNone2" name="sortTwo" value="" onchange="choosePath()" checked/>None</label>
        <label for="sortName2"><input type="radio" id="sortName2" name="sortTwo" value="RealName" onchange="choosePath()"/>RealName</label>
        <label for="sortUserName2"><input type="radio" id="sortUserName2" name="sortTwo" value="UserName" onchange="choosePath()" />UserName</label>
        <label for="sortPeriod2"><input type="radio" id="sortPeriod2" name="sortTwo" value="Period" onchange="choosePath()"/>Period</label>
        <label for="sortGrade2"><input type="radio" id="sortGrade2" name="sortTwo" value="Grade" onchange="choosePath()"/>Grade</label></span>
    </div>
</div>

<div class="MainBoxes" id="UserNamePicker" >
<?php include_once 'makeUserList.php'; ?>
</div>

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



<div class="MainBoxes" id="scoreText">Score Info Goes Here</div>

</div>

<script src="JsFindInfo.js"></script>
<?php }};?>
</body>
</html>