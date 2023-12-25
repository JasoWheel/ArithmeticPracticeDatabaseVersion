<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>

<head>
  <link rel = "stylesheet" href = "longDiv.css">
  <title> Game 12 </title>
</head>

<body class="WholeBody" id="body">

<div id="Title" > Long Division (Improper Fraction to Mixed Number)
<?php if (!isset($_SESSION["UsersName"])) {?>
        <br>You are not logged in. Return to Main Page.
        <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
<?php };?>
</div>

<?php
    if (isset($_SESSION["UsersName"])) {?>

<div id="DivisionLand" >

<div id="floatingButton"><button id="nextBtn" class="key3" onclick="nextFocus()">Next Box</button></div>
<div id="floatingButton2"><button id="backBtn" class="key3" onclick="backFocus()">Back a Box</button></div>
<div id="floatingButton3"><button id="endBtn" class="key3" onclick="startGame()" >Start</button></div>

<div class="longDivRows" id="row1"><span class="dot1" hidden></span>
  <span class="longDiv">
  <input class="numBox" id="r1c1" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled >
  <input class="numBox" id="r1c2" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r1c3" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()" onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c4" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()" onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c5" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()"  onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c6" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()"  onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c7" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()"  onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c8" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()"  onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c9" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()"  onkeyup="enterKey(event)" disabled>
  <input class="numBox" id="r1c10" type="text" inputmode="numeric" name="numBox" maxlength="1" onfocus="findActive()"  onkeyup="enterKey(event)" disabled>
</span></div>

<div class="longDivRows" id="row2"><span class="dot" hidden></span><span class="dot1" hidden></span>
  <span class="longDiv">
  <input class="numBox" id="r2c1" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c2" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c3" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c4" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c5" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c6" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c7" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c8" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c9" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
  <input class="numBox" id="r2c10" type="text" inputmode="numeric" name="numBox" maxlength="1" disabled>
</span></div>

<?php 
  for ($rNum = 3; $rNum<19; $rNum++) {
    echo "  <div class=\"longDivRowsA\" id=\"row".$rNum."\">
    <span class=\"longDiv\">
    <input class=\"numBox\" id=\"r".$rNum."c1\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" style=\"border-color: transparent\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c2\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" style=\"border-color: transparent\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c3\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" style=\"margin-left:-0.15vw\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c4\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c5\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c6\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c7\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c8\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c9\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
    <input class=\"numBox\" id=\"r".$rNum."c10\" type\"text\" inputmode=\"numeric\" name=\"numBox\" maxlength=\"1\" onfocus=\"findActive()\" onkeyup=\"enterKey(event)\" disabled>
</span>
    </div>";
  }
?></div>

<div id="GameButtons">
  <div id="numerator">?????</div>
  <div id="denominator">??</div>
  <div id="equals"><button id="equals1" style="visibility:visible">=</button></div>
  <div id="final">
  <div id="Fwhole">Whole#</div><div id="Fnumer">rem</div><div id="Fdenom">??</div>
  </div>
  <div id="enterMe"><button id="enterMe1" style="visibility:visible"><?php echo "Hello ".$_SESSION["RealName"]?></button></div>
  <div id="begin1"><button id="begin" class="key3" onclick="startGame()" autofocus>Click or Spacebar to Start</button></div> <!--this button gets changed as game progresses -->
</div>

<div id="keysInstructions"> 
  <div id="instructions">
    <div id="instrA">Do division with the fraction above.<br>The answer is the whole number.<br>The remainder is the numerator.</div>
    <div id="picture"><img src="divExample.jpg" width=92% height=92%></div>
    <div id="instrB"><p>Step 1: Multiply the top number by the divisor then enter it under remainder. <br><br>Step 2: Subtract to get new remainder.</p></div>
    <div id="instrC"><p>Green boxes were correct. Pink boxes were not. Enter "0" in spaces that would be blank.</p></div>
  </div>

  <div id="keyboard">
    <button class="key" name="keypads" id="btn1" value="1" onclick="input(this);checkFilled()">1</button>
    <button class="key" name="keypads" id="btn2" value="2" onclick="input(this);checkFilled()" >2</button>
    <button class="key" name="keypads" id="btn3" value="3" onclick="input(this);checkFilled()" >3</button>
    <button class="key" name="keypads" id="btn4" value="4" onclick="input(this);checkFilled()" >4</button>
    <button class="key" name="keypads" id="btn5" value="5" onclick="input(this);checkFilled()" >5</button>
    <button class="key" name="keypads" id="btn6" value="6" onclick="input(this);checkFilled()" >6</button>
    <button class="key" name="keypads" id="btn7" value="7" onclick="input(this);checkFilled()" >7</button>
    <button class="key" name="keypads" id="btn8" value="8" onclick="input(this);checkFilled()" >8</button>
    <button class="key" name="keypads" id="btn9" value="9" onclick="input(this);checkFilled()" >9</button>
    <button class="key" name="keypads" id="btnDel" value="<<" onclick="backFocus();checkFilled()" >back</button>
    <button class="key" name="keypads" id="btnNeg" value="" onclick="input(this);checkFilled()" >next</button>
    <button class="key" name="keypads" id="btn0" value="0" onclick="input(this);checkFilled()" >0</button>
  </div>
</div>

<div id="stats">
  <div id="leftStats">
    <span><label for="answered" id="L1">Answered:  </label><label id="answered" class="scoreBox">00</label></span>
    <span><label for="correct" id="L2">Correct:  </label><label id="correct" class="scoreBox">00</label></span>
    <span><label for="missed" id="L3">Missed:  </label><label id="missed" class="scoreBox">00</label></span>
  </div>

  <div id="leftStPct">
    <span><label for="totalPct" id="Lpct">Total Percentage:<br></label><label id="totalPct" class="scoreBox">n/a</label></span>
  </div>

  <div id="rightStats">
  <span><label for="problemNumber" id="R1">Problem #  </label><label id="problemNumber" class="scoreBox">1</label></span>
  <span><label for="totalProblems" id="R2">Problems Solved:  </label><label id="totalProblems" class="scoreBox">00</label></span>
  <span><label for="correctProblems" id="R3">Problems Correct:  </label><label id="correctProblems" class="scoreBox">00</label></span>
  </div>

  <div id="rightStPct">
    <span><label for="problemPct" id="Rpct">Problem Percentage:<br></label><label id="problemPct" class="scoreBox">n/a</label></span>
  </div>
</div>

<div id="bottom">
    Refresh Page to Restart. == or ==>>vv  <button class="key1" onclick="goHome()">Click Here to Return to Game Page</button>
</div>

<?php };?>

<script type="text/javascript" src="longDiv.js"></script>
</body>
</html>