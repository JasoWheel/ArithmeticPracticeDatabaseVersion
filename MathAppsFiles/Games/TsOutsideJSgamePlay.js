//start keyboard and keypad control
function input(e) {//add text of key button
  if (document.getElementById("myText").disabled===false){
    var myText = document.getElementById("myText");
    myText.value = myText.value + e.value;
    document.getElementById("myText").blur();}//Reblur}
}

function NegPosSwitch() {
  var myText = document.getElementById("myText");
  if (document.getElementById("myText").disabled===false) {
    if (myText.value[0] != "-") {
    myText.value = ("-" + myText.value);//add neg in front
    document.getElementById("myText").blur();
  } else {
    myText.value = myText.value.slice(1, );//delete neg from front
    document.getElementById("myText").blur();
}}}

function del() {//delete last value from string
  if (document.getElementById("myText").disabled===false) {
    var myText = document.getElementById("myText");
    myText.value = myText.value.substr(0, myText.value.length - 1);
    document.getElementById("myText").blur();
}}

function enterKey(e) { //check answer on enter keyup if active
  if (e.keyCode === 13 && fired == false) {
    checkAnswer();
  }
}

function enableEnter() {// enable enter key
  fired = false;
}
//end keyboard and keypad control

function startGame() {
  t1 = Date.now();//timer
  makeSet();//make scramble set
  doMath();
  var thebody = document.getElementById("qAndA");
  var strtButton = document.getElementById("startbtn");
  thebody.removeChild(strtButton);
  startNewGame(gameNameber); //New for Db*****************************
}

//Begin Scramble and check answer
function makeSet() {
  i=10;
  while (i>0) {
    i--;
    var num = selectScrambleNumber();
    set.push(num);
  }
  return set;
}

function selectScrambleNumber() {
  a = Math.floor((Math.random() * 50)+1);
  b = Math.floor(Math.random() * 100);
  if (b % 2 === 0) {
    a = a * -1;
  }
  return a;
}

function scramble(it) {//return set with changed answer, number that changed it, and operation
  var j = Math.floor(Math.random()*10);
  var k = Math.floor(Math.random()*3);
  var qCode = set[j];
  qSet = [];
  if (k===0) {
    qSet.push(it * qCode);
  } else if (k==1){
    qSet.push(it + qCode);
  } else {
    qSet.push(it - qCode);
  }
  qSet.push(j);
  qSet.push(k);
  ans = 0;
  qCode=0;
  return qSet;
}

function dCode() {//decodes scrambled set to original answer.
  if (qSet[2] === 0) {
    finalAns = qSet[0]/set[qSet[1]];
  } else if (qSet[2]==1) {
    finalAns = qSet[0] - set[qSet[1]];
  } else {
    finalAns = qSet[0] + set[qSet[1]];
  }
  return finalAns;
}

function checkAnswer() {
  document.getElementById("myText").disabled=true; //lock input*
  fired = true; //disable enter key
  t2 = Date.now();//timer
  tDiff = (t2 - t1)/1000;//timer
  min = Math.floor(tDiff/60)//timer
  sec = Math.floor(tDiff % 60);//timer
  if (sec < 10) {//timer add 0 to single seconds
    sec = "0" + sec;
  }
  document.getElementById("timeUpdate").innerHTML = min + ":" + sec;//timer
  stopSleep();
  correct = dCode().toString();//Scramble
  shouldBe = correct;//Scramble
  document.getElementById("answerButton").style.backgroundColor = "";
  document.getElementById("answerButton").style.visibility = 'hidden';
  yours = document.getElementById("myText").value;
  yours = yours.replace(/ /g,"");//delete whitespace from answer
  if (yours === correct || yours === ("+" + correct)) {
    score ++;
    answered ++;
    correctAnswer();
    document.getElementById("result").innerHTML = "Yahoo!!";
    document.getElementById("answered").innerHTML = answered;
    document.getElementById("total").innerHTML = score;
    window.setTimeout(doMath, 1500)
  } else {
    score --;
    answered ++;
    wrongAnswer();
    document.getElementById("result").innerHTML = was;
    document.getElementById("right").innerHTML = shouldBe;
    document.getElementById("answered").innerHTML = answered;
    document.getElementById("total").innerHTML = score;
    window.setTimeout(seeNext, 5000);
  }
}
//End Scramble Scramble and check answer

//start timer section
function seeNext() { //make next question button visible after missed
  document.getElementById("continueButton").style.visibility = 'visible';
}

function answerSleep() {//fixed amount of time until 5 seconds left
  enter = setTimeout(enableEnter, 2000);// wait 2 seconds before enableing enter key
  waiting = setTimeout(fiveLeft, fixedTime);//
}//

function fiveLeft() {//
  document.getElementById("answerButton").style.backgroundColor = "orange";//
  waiting = setTimeout(noneLeft, 5000);//
}//

function noneLeft() {
  document.getElementById("answerButton").style.backgroundColor = "red";//
  waiting = setTimeout(checkAnswer, 1000);//
}

function stopSleep() {//
  clearTimeout(waiting);//
}
// end timer section

//Start of Data section ***New for Db

function goHome(){ //go back to pick a game page //New for Db*******
  //window.location.href = "http://localhost/MathApps/PlayGame.php";
  window.location.href = "../PlayGame.php";
}
        
function smileScore() {
  smile++;
  updateGame(answered, smile, frown);
}

function frownScore() {
  frown++;
  updateGame(answered, smile, frown);
}

function startNewGame(game) { //start new game in database
  let xhr = new XMLHttpRequest();
  let url = "startGame.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Create a state change callback
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        //goHome(); //inactive. only used to check functionality
    }
  };

  var data = JSON.stringify({ "GameNameber": game});
  xhr.send(data);
}
        
function updateGame(answered, smile, frown) { //send score to database
  let xhr = new XMLHttpRequest();
  let url = "updateGameScore.php";
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Create a state change callback
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      //goHome(); //not active, only used to check functionality
    }
  };

  var data = JSON.stringify({ "Answered": answered, "Correct": smile, "Missed": frown});
  xhr.send(data);
}
//end data section

//begin cheat protect
window.addEventListener("focus", itIsOn);
let warnings = 0;

function itIsOn() {
  warnings++;
  if(warnings === 1) {
    window.alert("You must stay in this window during the game!");
  }
  if(warnings === 3) {
    window.alert("Last Warning... stay on the page.");
  }
  if(warnings > 4) {
    window.alert("You must start again. Stay in this window for the entire game.");
    warnings = -1;
    goHome();
  }
} //end cheat protect

//disable autocomplete chrome
let boxForInput = document.getElementById("myText");
boxForInput.autocomplete = 'off';
//end disable