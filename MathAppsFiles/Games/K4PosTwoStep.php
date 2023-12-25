<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>

<head>
  <link rel = "stylesheet" href = "NewOrg.css">
  <title> #4 Positive Two Step </title>
</head>

<body class="wholeBody" id="body">
<div id="gameBox">

  <div id="topRow">
    <div class="topStuff" id="questions" style="color:red";>
      <div>
        Questions:
      </div>
      <div>
        <div class="scoreNum" id="answered">0</div>
      </div>
    </div>
    <div class="topStuff" id="title">(#4) Two Step Practice<br>Mult/Div then Add/Subt

<?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
 <br>You are not logged in. Return to Main Page.
 <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
 </div></div></div>
<?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>

      <div id="SecToEnd">
        60 Seconds to Answer
      </div>
    </div>
    <div class="topStuff" id="score">
      <div>
        Score:
      </div>
      <div>
        <div id="total" class="scoreNum">0</div>
      </div>
    </div>
  </div>

  <div id="stats">
    <div id="Gstat">Game Stats:</div>
    <div id="timeUpdate">time</div><!--timer-->
      <div class="sumStats">
        <div>Multiply:</div>
      </div>
      <div class="sumStats">
        <div id="multCorr">0</div>
        <div class="for">for</div>
        <div id="multTotal">0</div>
      </div>
      <div class="sumStats">
        <div id="multPrct">x</div>
        <div>%</div>
      </div>
      <div class="sumStats">
        <div>Divide:</div>
      </div>
      <div class="sumStats">
        <div id="divCorr">0</div>
        <div class="for">for</div>
        <div id="divTotal">0</div>
      </div>
      <div class="sumStats">
        <div id="divPrct">x</div>
        <div>%</div>
      </div>
  </div>

  <div id="actionBox">
    <div id="qAndA" >
      <button class="button button1" id="startbtn" onclick="startGame()"> Start Game </button>
      <button class="button button1" id="continueButton" style="visibility:hidden" onclick="doMath()"> Next Question </button>
      <div class="lines" id="qLine">
        <div id="question">
          Question Goes Here
        </div>
      </div>
      <div class="rBox">
        <div id="rLine">
          <div id="result">Feedback</div>
        </div>
        <div id="ritLine">
          <div id="right">Answer if Wrong</div>
        </div>
      </div>
      <div class="input" >Your Answer: <br>
        <input type="text" id="myText" onkeyup="enterKey(event)" value ="" autofocus>
      </div>
      <div class=button>
        <button class="button" id="answerButton" onclick="checkAnswer()" style="visibility:hidden"> Click here to check. </button>
      </div>
    </div>
  </div>

  <div id="keyboard">
    <button class="key" id="btn1" value="1" onclick="input(this)">1</button>
    <button class="key" id="btn2" value="2" onclick="input(this)" >2</button>
    <button class="key" id="btn3" value="3" onclick="input(this)" >3</button>
    <button class="key" id="btn4" value="4" onclick="input(this)" >4</button>
    <button class="key" id="btn5" value="5" onclick="input(this)" >5</button>
    <button class="key" id="btn6" value="6" onclick="input(this)" >6</button>
    <button class="key" id="btn7" value="7" onclick="input(this)" >7</button>
    <button class="key" id="btn8" value="8" onclick="input(this)" >8</button>
    <button class="key" id="btn9" value="9" onclick="input(this)" >9</button>
    <button class="key" id="btnDel" value="<<" onclick="del()" >back</button>
    <button class="key" id="btnNeg" value="-/+" onclick="NegPosSwitch()" >+/-</button>
    <button class="key" id="btn0" value="0" onclick="input(this)" >0</button>
  </div>
  
  <div id="footer">
    Refresh Page to Restart. == or ==>  <button class="key" onclick="goHome()">Click Here to Return to Game Page</button>
  </div>
</div>

<script type="text/javascript">

var answered = 0, ptype = 0, divTot = 0, qKind, multTot = 0, pType, cNum, c, d, dNum, ans, ansNum, mdString, sumNumber, sumSign, finalAnswer, mathString, sumNumString, sgn, waiting, score = 0, yours, multCor = 0, divCor = 0, multPct, divPct, was = "is";
var t1, t2, tDiff, min, sec;//timer
var set = [], finalAns = 0, qSet = [];
var fired = true; // enter key disabled
var smile = 0, frown = 0, gameNameber = "4"; //use these along with answered to update score function //New for Db************
var fixedTime = 55000;

//start math section
function doMath() {//pick kind of question
  document.getElementById("myText").disabled=false; //make input allowed**********
  document.getElementById("continueButton").style.visibility = 'hidden';
  document.getElementById("right").innerHTML = "";
  document.getElementById("answerButton").style.visibility = 'visible';
  if (answered < 50) {
    var qType = pickType();
    if (qType == 1) {
      doDiv();
      divTot++;
      qKind = "Div";
      getSum();
    }
    if (qType == 2) {
      doMult();
      multTot++;
      qKind = "Mult";
      getSum();
    }
    scramble(finalAnswer);//make scramble set
    finalAnswer = 0;//make scramble set
    answerSleep(55000);

  } else {
    t2 = Date.now();//timer
    tDiff = (t2 - t1)/1000;//timer
    min = Math.floor(tDiff/60)//timer
    sec = Math.floor(tDiff % 60);//timer
    document.getElementById("question").innerHTML = "Game Over: " + min + " minutes " + sec + " seconds";//timer
    document.getElementById("result").innerHTML = "Refresh page to start over."
    document.getElementById("answerButton").style.visibility = 'hidden';
  }
}

function pickType() { //1, 2, 3
  pType = Math.ceil(Math.random()*2);
  return pType;
}
//End of Start and Pick Question

//Start of summation part
function getSum() {
  var frontBack = pickType();
  sumNumber = selectNumber();
  sumSign = pickSign();
  sumNumString = " " + sumNumber + " ";

  if (frontBack == 1) {
    if (sumSign == "+") {
      finalAnswer = sumNumber + ans;
      mathString = sumNumString + sumSign + " " + mdString;
    }
    if (sumSign == "-") {
      finalAnswer = sumNumber - ans;
      mathString = sumNumString + sumSign + " " + mdString;
      if (finalAnswer < 0) {
        finalAnswer = ans - sumNumber;
        mathString = mdString + sumSign + " " + sumNumString;
      }
    }
  }
  if (frontBack == 2) {
    if (sumSign == "+") {
      finalAnswer = ans + sumNumber;
      mathString = mdString + sumSign + " " + sumNumString;
    }
    if (sumSign == "-") {
      finalAnswer = ans - sumNumber;
      mathString = mdString + sumSign + " " + sumNumString;
      if (finalAnswer < 0) {
        finalAnswer = sumNumber - ans;
        mathString = sumNumString + sumSign + " " + mdString;
      }
    }
  }
  //correct = finalAnswer.toString();
  postQuestion();
}

function postQuestion() {
  document.getElementById("question").innerHTML = mathString;
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").focus();
}

function selectNumber() {
  a = Math.floor((Math.random() * 25)+1);
  return a;
}

function pickSign() {
  ran=Math.ceil((Math.random())*100);
  if (ran > 50) {
    sgn = "-";
  } else {
    sgn = "+";
  }
  return sgn;
}
//End of summation part

//Start of Multiply Divide Questions Called by doMult() or doDive()
function doMult() {
  c = select12Number();
  var cNum = c;
  d = select12Number();
  var dNum = d;
  ans = c * d;
  mdString = cNum + " &bull; "+ dNum + " ";
  return
}

function doDiv() {
  c = select12Number();
  d = select12Number();
  var dNum = d;
  ans = c * d;
  var ansNum = ans;
  mdString = ansNum + " &divide; " + dNum + " ";
  ans = c;
  return
}

function select12Number() { //returns a negative or positive number 2 thru 12
  a = Math.floor(Math.random() * 100);
  if (a<4) {
    a = 2
  } else if (a>3 && a<9){
    a = 3
  } else if (a>8 && a<17){
    a = 4
  } else if (a>16 && a<26){
    a = 5
  } else if (a>25 && a<36){
    a = 6
  } else if (a>35 && a<47){
    a = 7
  } else if (a>46 && a<58){
    a = 8
  } else if (a>57 && a<73){
    a = 9
  } else if (a>72 && a<81){
    a = 10
  } else if (a>80 && a<93){
    a = 11
  } else if (a>92){
    a = 12
  }
  return a;
}
//End of Multiply/Divide Questions
//end math section

//Start of Stats Calculation
function correctAnswer() {
  if (qKind == "Mult") {
    multCor++;
  }
  if (qKind == "Div") {
    divCor++;
  }
  smileScore(); //New for Db*********************
  calculatePercent();
  writeStats();
}

function wrongAnswer() {
  frownScore(); //New for Db*****************************
  calculatePercent();
  writeStats();
}

function calculatePercent() {
  if (multTot > 0) {
    multPct = (multCor / multTot) * 100;
    multPct = multPct.toFixed(1);
  }
  if (divTot > 0) {
    divPct = (divCor / divTot) * 100;
    divPct = divPct.toFixed(1);
  }
}

function writeStats() {
  document.getElementById("multCorr").innerHTML = multCor;
  document.getElementById("multTotal").innerHTML = multTot;
  document.getElementById("multPrct").innerHTML = multPct;
  document.getElementById("divCorr").innerHTML = divCor;
  document.getElementById("divTotal").innerHTML = divTot;
  document.getElementById("divPrct").innerHTML = divPct;
}
//End of Stats Calculation
</script>
<?php };?>
<script type="text/javascript" src="KpOutsideJSgamePlay.js"></script>
</body>
</html>