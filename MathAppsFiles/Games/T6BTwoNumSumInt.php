<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head>
  <link rel = "stylesheet" href = "NewOrg.css">
  <title> #6 TwoNumber Sum Integers </title>
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
    <div class="topStuff" id="title">(#6 "B") Add and Subtract (Sum) Practice<br>Integers(2 Numbers)

<?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
 <br>You are not logged in. Return to Main Page.
 <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
 </div></div></div>
<?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>

      <div id="SecToEnd">
        You have 30 seconds to answer.
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
    <div id="Gstat">Game Stats</div>
    <div id="timeUpdate">time</div><!--timer-->
    <div class="sumStats">
      <div>2 Numbers</div>
    </div>
    <div class="sumStats">
      <div id="twoCorr">0</div>
      <div class="for">for</div>
      <div id="twoTotal">0</div>
    </div>
    <div class="sumStats">
      <div id="twoPrct">x</div>
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
        <input type="text" id="myText" onkeyup="enterKey(event)" value ="" autoblur>
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

var a = 0, d = 0, c = 0,ans = 0, correct = 0, yours = 0, answered = 0, score = 0, was = "", shouldBe = "", waiting = "";
var  twoCor = 0, twoTot = 0, twoPct = 0, moreCor = 0, moreTot = 0, morePct = 0, qKind = "";
var t1, t2, tDiff, min, sec;//timer
var set = [], finalAns = 0, qSet = [];
var fired = true; // enter key disabled
var smile = 0, frown = 0, gameNameber = "6B"; //use these along with answered to update score function //New for Db************
var fixedTime = 25000;

//start math section
function doMath() {
  document.getElementById("myText").disabled=false; //make input allowed*********
  document.getElementById("continueButton").style.visibility = 'hidden';
  document.getElementById("right").innerHTML = "";
  document.getElementById("answerButton").style.visibility = 'visible';
  twoTot++;
  if (answered < 50 && answered % 2 == 0) {
    doAdd();
  } else if (answered < 50){
    doSubt();
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

function doAdd() {
  c = selectNumber();
  d = selectNumber();
  ans = c + d;
  if (c > 0) {
    c = "+"+c;
  }
  if (d > 0) {
    d = "+"+d;
  }
  document.getElementById("question").innerHTML = "What is  \(" + c + "\) + " + "\(" + d + "\)?";
  //document.getElementById("answer").innerHTML = "";
  //correct = ans.toString();
  document.getElementById("myText").value = "";
  //document.getElementById("yourAnswer").innerHTML = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = "it is";
  //shouldBe = ans;
  scramble(ans);//make scramble set
  ans = 0;//make scramble set
  answerSleep();
  return
}

function doSubt() {
  c = selectNumber();
  d = selectNumber();
  ans = c - d;
  if (c > 0) {
    c = "+"+c;
  }
  if (d > 0) {
    d = "+"+d;
  }
  document.getElementById("question").innerHTML = "What is  \(" + c + "\) - " + "\(" + d + "\)?";
  //document.getElementById("answer").innerHTML = "";
  //correct = ans.toString();
  document.getElementById("myText").value = "";
  //document.getElementById("yourAnswer").innerHTML = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = "it is";
  //shouldBe = ans;
  scramble(ans);//make scramble set
  ans = 0;//make scramble set
  answerSleep();
  return
}

function selectNumber() {
  a = Math.floor((Math.random() * 50)+1);

  b = Math.floor(Math.random() * 100)
  if (b % 2 == 0) {
    a = a * -1;
  }
  return a;
}
//end math section

//Start of Stats Calculation
function correctAnswer() {
  twoCor++;
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
  if (twoTot > 0) {
    twoPct = (twoCor / twoTot) * 100;
    twoPct = twoPct.toFixed(1);
}}

function writeStats() {
  document.getElementById("twoCorr").innerHTML = twoCor;
  document.getElementById("twoTotal").innerHTML = twoTot;
  document.getElementById("twoPrct").innerHTML = twoPct;
  //document.getElementById("moreCorr").innerHTML = moreCor;
  //document.getElementById("moreTotal").innerHTML = moreTot;
  //document.getElementById("morePrct").innerHTML = morePct;
}
//End of Stats Calculation
</script>
<?php };?>
<script type="text/javascript" src="TsOutsideJSgamePlay.js"></script>

</body>
</html>
