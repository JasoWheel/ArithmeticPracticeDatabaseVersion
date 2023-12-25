<?php if(session_status() == PHP_SESSION_NONE) session_start();?>
<!DOCTYPE html>
<html>

<head>
  <link rel = "stylesheet" href = "NewOrg.css">
  <title> #10 Harder Random </title>
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
    <div class="topStuff" id="title" >
      (#10) Add, Subtract, Multiply and Divide Practice<br>Harder Integers

<?php if (!isset($_SESSION["UsersName"])) {?> <!--add to all games-->
 <br>You are not logged in. Return to Main Page.
 <a href="..//OptionsPage.php"><button>Back to Main Page</button></a><br>
 </div></div></div>
<?php };?>

<?php if (isset($_SESSION["UsersName"])) {?>

      <div style="display:flex; justify-content:center;"><div id="SecondTitle">Seconds to Answer:  </div>
      <div id="SecToEnd"> Time will be here!</div></div>
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
      <div>Sums:</div>
    </div>
    <div class="sumStats">
      <div id="sumCorr">0</div>
      <div class="for">for</div>
      <div id="sumTotal">0</div>
    </div>
    <div class="sumStats">
      <div id=sumPrct>x</div>
      <div>%</div>
    </div>
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

var a = 0;
var d = 0;
var c = 0;
var e = 0;
var ans = 0;
var correct = 0;
var yours = 0;
var answered = 0;
var score = 0;
var was = ""
var shouldBe = "";
var waiting = "";
var quant = 0;
var sgn;
var questTime;
var sumCor = 0, sumTot = 0, sumPct = 0, multCor = 0, multTot = 0, multPct = 0, divCor = 0, divTot = 0, divPct = 0, qKind = "";
var t1, t2, tDiff, min, sec;//timer
var set = [], finalAns = 0, qSet = [];
var fired = true; // enter key disabled
var smile = 0, frown = 0, gameNameber = "10"; //use these along with answered to update score function //New for Db************
var fixedTime = "";

//start math section
function doMath() {//pick kind of question
  document.getElementById("myText").disabled=false; //make input allowed****************
  document.getElementById("continueButton").style.visibility = 'hidden';
  document.getElementById("right").innerHTML = "";
  document.getElementById("answerButton").style.visibility = 'visible';
  if (answered < 50) {
    var qType = pickType();
    if (qType == 1) {
      doDiv();
      divTot++;
      qKind = "Div";
    }
    if (qType == 2) {
      doMult();
      multTot++;
      qKind = "Mult";
    }
    if (qType > 2) {
      askQuestion();
      sumTot++;
      qKind = "Sum"
    }

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
  pType = Math.ceil(Math.random()*3);
  return pType;
}

//Start of Addition Subtraction Problem called by askQuestion()
function askQuestion() {
  many = pickRandom()
  makeString(many);
  scramble(ans);//make scramble set
  ans = 0;//make scramble set
  //correct = ans.toString();
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = "it is";
  //houldBe = ans;
  if (many == 2) {
    fixedTime= 15000;
    document.getElementById("SecToEnd").innerHTML = "-->20";
  } else if (many == 3) {
    fixedTime = 40000;
      document.getElementById("SecToEnd").innerHTML = "-->45";
  } else {
    fixedTime = 75000;
    document.getElementById("SecToEnd").innerHTML = "-->80";
  }
  answerSleep();
  return
}

function pickRandom() { //2 thru 6
  quant = Math.ceil(Math.random()*5);
  quant = quant + 1;
  return quant;
}

function makeString(i) {
  //i=10;
  str="";
  sum = 0;
  t = "+";
  s = 0;
  while (i > 0) {
    if (i > 1) {
      s = selectNumber();
      if (s > 0) {
        str = str.concat("\(+" + s + "\) ");
      } else {str = str.concat("\(" + s + "\) ");
      }
      if (t == "+") {
        sum = sum + s;
      } else {
        sum = sum - s
      }
      t = pickSign();
      str = str.concat(" " + t + " ");
      i--;
    } else {
      var s = selectNumber();
      if (t == "+") {
        sum = sum + s;
      } else {
        sum = sum - s
      }
      if (s > 0) {
        str = str.concat("\(+" + s + "\) ");
      } else {str = str.concat("\(" + s + "\) ");
      }
      i--;
    }
  }
  document.getElementById("question").innerHTML=str;
  //document.getElementById("test2").innerHTML=sum;
  ans = sum;
  return ans;
}

function selectNumber() {
  a = Math.floor((Math.random() * 25)+1);

  b = Math.floor(Math.random() * 100)
  if (b % 2 == 0) {
    a = a * -1;
  }
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
//End of Addition/Subtraction Question

//Start of Multiply Divide Questions Called by doMult() or doDive()
function doMult() {
  c = select12Number();
  if (c > 0) {
    var cNum = "+" + c;
  } else {cNum = c}
  d = select12Number();
  if (d > 0) {
    var dNum = "+" + d;
  } else {dNum = d}
  ans = c * d;
  document.getElementById("question").innerHTML = "What is  " + "\(" + cNum + "\) " + " &bull; " + "\(" + dNum + "\) " + "?";
  //correct = ans;
  //correct = ans.toString();
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = " is ";
  //shouldBe = ans;
  scramble(ans);//make scramble set
  ans = 0;//make scramble set
  fixedTime = 15000;
  answerSleep();
  document.getElementById("SecToEnd").innerHTML = "-->20";
  return
}

function doDiv() {
  c = select12Number();
  d = select12Number();
  if (d > 0) {
    var dNum = "+" + d;
  } else {dNum = d}
  ans = c * d;
  if (ans > 0) {
    var ansNum = "+" + ans;
  } else {ansNum = ans}
  document.getElementById("question").innerHTML = "What is  " + "\(" + ansNum + "\) " + " &divide; " + "\(" + dNum + "\) " + "?";
  document.getElementById("myText").value = "";
  document.getElementById("result").innerHTML = "???";
  document.getElementById("myText").blur();
  was = " is ";
  //shouldBe = c
  //correct = c.toString();
  scramble(c);//make scramble set
  c = 0;//make scramble set
  fixedTime = 15000;
  answerSleep();
  document.getElementById("SecToEnd").innerHTML = "-->20";
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
  b = Math.floor(Math.random() * 100)
  if (b % 2 == 0) {
    a = a * -1;
  }
  return a;
}
//End of Multiply/Divide Questions
//end math section

//Start of Stats Calculation
function correctAnswer() {
  if (qKind == "Sum") {
    sumCor++;
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
}

function wrongAnswer() {
  frownScore(); //New for Db********************
  calculatePercent();
  writeStats();
}

function calculatePercent() {
  if (sumTot > 0) {
    sumPct = (sumCor / sumTot) * 100;
    sumPct = sumPct.toFixed(1);
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
  document.getElementById("sumCorr").innerHTML = sumCor;
  document.getElementById("sumTotal").innerHTML = sumTot;
  document.getElementById("sumPrct").innerHTML = sumPct;
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