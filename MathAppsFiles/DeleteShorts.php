<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<!DOCTYPE html>
<html>
<head><meta charset="us-ascii">
	<title>Delete Short Games</title>
  <link rel="stylesheet" type="text/css" href="DeleteScores.css" />
</head>
<body id="body" style="text-align:center;">

<div id="WholePage">

  <div id="theTop">
    <div id="goBackButton">
    <p id="PageName" style="color:green;">Delete Short Game Scores</p>
    <a href="AdminPage.php"><button>Back to Admin Page</button></a>
    </div>
  </div>

  <?php if ($_SESSION["UsersName"] === "AdminWheel") {?>

  <div id="newUserInput">
    <p id="result" style="color:black">Delete all Games w/Answered Below:</p>
    <div id="inputParts">
              <!-- Button to send data -->
      <button onclick="DeleteAnsweredBelow()">Delete All w/ Answered < </button>
        <select id="PickNumber" onchange="setChosenNumber()">
            <?php for ($i = 0; $i < 26; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select><br>
        <div id="ResponseArea">
            <p> You picked less than </p>
            <div id="NumPicked">0</div>
            <p> answered questions to delete </p>
        </div>
    </div>
  </div>

  <div class="MainBoxes" id="UserNamePicker" >
    <?php include_once 'makeUserListCopy.php';?>
  </div>
  

  <div id="resetArea">
    <p id="showKid">Select student on right<br>for games delete.</p>
    <div id="inputParts2">
        <button onclick="individualDeleteBelow()">Delete Scores Below</button>
        <select id="PickNumber2" onchange="setChosenNumber2()">
            <?php for ($i = 0; $i < 26; $i++) : ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select><br>
            <div id="ResponseArea2">
                <p> You picked less than </p>
                <div id="NumPicked2">0</div>
                <p> answered questions to delete </p>
            </div>
        </div>
  </div>

  <?php };?>

</div>

<script>
function setChosenNumber() {
    let chosen = document.querySelector('#PickNumber').value;
    //console.log(chosen);
    let theText = "You picked less than<br>"+chosen+"<br>answered questions to delete.";
    document.getElementById("ResponseArea").innerHTML=theText;      
   // document.getElementById("NumPicked").innerHTML=chosen;
}

function DeleteAnsweredBelow() {
    let numToDelete = document.querySelector('#PickNumber').value;
    if (numToDelete !== "0") {
    let xhr = new XMLHttpRequest();
    let url = "sendDeleteShorts.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("ResponseArea").innerHTML = this.responseText;
        };
    };
    
    var data = JSON.stringify({ "DeleteNumber": numToDelete});
    xhr.send(data);
} else {
    document.getElementById("ResponseArea").innerHTML = "You must pick a number greater than 0.";
}
}

function setChosenNumber2() {
    let chosen2 = document.querySelector('#PickNumber2').value;
    //console.log(chosen);
    let theText2 = "You picked less than<br>"+chosen2+"<br>answered questions to delete.";
    document.getElementById("ResponseArea2").innerHTML=theText2;      
}

function individualDeleteBelow() {
        let deleteUser = getId[1];
        let numToDelete2 = document.querySelector('#PickNumber2').value;
    if (getId[0] !== "hi" && numToDelete2 !== "0") {
        let xhr = new XMLHttpRequest();
        let url = "sendDeleteIndividualShorts.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
     
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("ResponseArea2").innerHTML = this.responseText;
                //document.getElementById("showKid").innerHTML=resetUser+"'s Password is reset.";
           };
        };
     
        var data = JSON.stringify({ "UserName": deleteUser, "DeleteNumber": numToDelete2});
        xhr.send(data);
    } else {
        document.getElementById("ResponseArea2").innerHTML="You must choose a user and number over 0 first.";
    }
}
</script>

<script src="deleteShorts.js"></script>
</body>
</html>