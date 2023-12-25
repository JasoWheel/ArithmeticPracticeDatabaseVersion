<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>
<head>
  <link rel = "stylesheet" href = "NewOrg.css">
  <title> #3 Random Positive </title>
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
    <div class="topStuff" id="title">(#3) Add, Subtract, Multiply and Divide Practice<br>All Positive Numbers

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

  <div id="stats" style="font-size:55%;">
    <div id="Gstat">Game Stats:</div>
    <div id="timeUpdate">time</div><!--timer-->
    <div class="sumStats">
      <div>Addition:</div>
    </div>
    <div class="sumStats">
      <div id="addCorr">0</div>
      <div class="for">for</div>
      <div id="addTotal">0</div>
    </div>
    <div class="sumStats">
      <div id="addPrct">x</div>
      <div>%</div>
    </div>
    <div class="sumStats">
      <div>Subtraction:</div>
    </div>
    <div class="sumStats">
      <div id="subtCorr">0</div>
      <div class="for">for</div>
      <div id="subtTotal">0</div>
    </div>
    <div class="sumStats">
      <div id="subtPrct">x</div>
      <div>%</div>
    </div>
    <div class="sumStats">
      <div>Multiplication:</div>
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
      <div>Division</div>
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
var  addCor = 0, addTot = 0, addPct = 0, subtCor = 0, subtTot = 0, subtPct = 0, qKind = "", multTot = 0, multCor = 0, multPct = 0, divTot = 0, divCor = 0, divPct = 0;
var t1, t2, tDiff, min, sec;//timer
var set = [], finalAns = 0, qSet = [];
var fired = true; // enter key disabled
var smile = 0, frown = 0, gameNameber = "3"; //use these along with answered to update score function //New for Db************
var fixedTime = 25000;

//start math section
function doMath() {
  document.getElementById("myText").disabled=false; //make input allowed*************
  document.getElementById("continueButton").style.visibility = 'hidden';
  document.getElementById("right").innerHTML = "";
  document.getElementById("answerButton").style.visibility = 'visible';
  if (answered < 50) {
    var choice = Math.ceil(Math.random()*4);
    if (choice == 1) {
      doAdd();
    }
    if (choice == 2) {
      doSubt();
    }
    if (choice == 3) {
      doMult();
    }
    if (choice == 4) {
      doDiv();
    }

  } else {
    t2 = Date.now();//timer
    tDiff = (t2 - t1)/1000;//timer
    min = Math.floor(tDiff/60)//timer
    sec = Math.floor(tDiff % 60);//timer
    document.getElementById("question").innerHTML = "Game Over: " + min + " minutes " + sec + " seconds";//timer
    document.getElementById("result").innerHTML = "Refresh page to start over.";
    document.getElementById("answerButton").style.visibility = 'hidden';
  }
}

function doAdd() {
  addTot++;
  qKind = "Add";
  c = selectNumber();
  d = selectNumber();
  ans = c + d;
  document.getElementById("question").innerHTML = "What is " + c + " + " + d + "?";
  //correct = ans.toString();
  document.getElementById("myText").value = "";
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
  subtTot++;
  qKind = "Subt";
  c = selectNumber();
  d = selectNumber();
  ans = c - d;
  var ansString = "What is " + c + " - " + d + "?";
  if (ans < 0){
    ans = d - c;
    ansString = "What is  " + d + " - " + c + "?";
  }
  document.getElementById("question").innerHTML = ansString;
  //correct = ans.toString();
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = "it is";
  //shouldBe = ans;
  scramble(ans);//make scramble set
  ans = 0;//make scramble set
  answerSleep();
  return
}

function doMult() {
  multTot++;
  qKind = "Mult";
  c = select12Number();
  d = select12Number();
  ans = c * d;
  document.getElementById("question").innerHTML = "What is  " + c + " &bull; " + d + "?";
  //correct = ans.toString();
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = " is ";
  //shouldBe = ans;
  scramble(ans);//make scramble set
  ans = 0;//make scramble set
  answerSleep();
  return
}

function doDiv() {
  divTot++;
  qKind = "Div";
  c = select12Number();
  d = select12Number();
  ans = c * d;
  document.getElementById("question").innerHTML = "What is  " + ans + " &divide; " + d + "?";
  //correct = c.toString();
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = " is ";
  //shouldBe = c
  scramble(c);//make scramble set
  c = 0;//make scramble set
  answerSleep();
  return
}

function select12Number() { //returns a positive number
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

function selectNumber() {
  a = Math.floor((Math.random() * 50)+1);
  return a;
}
//end math section


//Start of Stats Calculation
function correctAnswer() {
  if (qKind == "Add") {
    addCor++;
  }
  if (qKind == "Subt") {
    subtCor++;
  }
  if (qKind == "Mult") {
    multCor++;
  }
  if (qKind == "Div") {
    divCor++;
  }
  smileScore(); //New for Db*********************
  calculatePercent();
  writeStats();
  writeMoreStats();
}

function wrongAnswer() {
  frownScore(); //New for Db*****************************
  calculatePercent();
  writeStats();
  writeMoreStats();
}

function calculatePercent() {
  if (addTot > 0) {
    addPct = (addCor / addTot) * 100;
    addPct = addPct.toFixed(1);
  }
  if (subtTot > 0) {
    subtPct = (subtCor / subtTot) * 100;
    subtPct = subtPct.toFixed(1);
  }
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
  document.getElementById("addCorr").innerHTML = addCor;
  document.getElementById("addTotal").innerHTML = addTot;
  document.getElementById("addPrct").innerHTML = addPct;
  document.getElementById("subtCorr").innerHTML = subtCor;
  document.getElementById("subtTotal").innerHTML = subtTot;
  document.getElementById("subtPrct").innerHTML = subtPct;
}

function writeMoreStats() {
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
<script type="text/javascript" src="TsOutsideJSgamePlay.js"></script>
</body>
</html>
