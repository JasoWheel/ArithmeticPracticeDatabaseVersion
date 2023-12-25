function CheckNewUser(){
    let UserName = document.querySelector('#UserName');
    let Password = document.querySelector('#Password');
    let Grade = document.querySelector('#Grade');
    let Period = document.querySelector('#Period');
    let RealName = document.querySelector('#RealName');
        
    let xhr = new XMLHttpRequest();
    let url = "CheckUser.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            goResults();
        }
    };

    var data = JSON.stringify({ "UserName": UserName.value, "EnterWord": Password.value, "Grade": Grade.value, "Period": Period.value, "RealName": RealName.value });
    xhr.send(data);
}

function goResults(){
    window.location.href = "submissionResults.php";
}

function LogInCheck() {
    let UserName = document.querySelector('#LogUserName');
    let Password = document.querySelector('#LogPassword');
    let xhr = new XMLHttpRequest();
    let url = "LogInCheck.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
 
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
           doLogIn();
       };
    };
 
    var data = JSON.stringify({ "UserName": UserName.value, "Password": Password.value });
    xhr.send(data);
}

function doLogIn() {
    window.location.href = "doLogIn.php";
}

function newPassword() {
    let PasswordA = document.querySelector('#LogPasswordA');
    let PasswordB = document.querySelector('#LogPasswordB');
    let xhr = new XMLHttpRequest();
    let url = "setNewPassword.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
 
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
           pwResetComplete();
       };
    };
 
    var data = JSON.stringify({ "PasswordA": PasswordA.value, "PasswordB": PasswordB.value });
    xhr.send(data);
}

function pwResetComplete() {
    window.location.href = "pwResetComplete.php";
}

function goGame() {
    window.location.href = "PlayGame.php";
}

function loadGamesCsv() { //I don't think this is used anymore??
    let xhr = new XMLHttpRequest();
    let url = "LoadGamesCsv.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            goHome();
        }
    };

    var data = JSON.stringify({ "UserName": "bob"});
    xhr.send(data);
}

function goHome() {
    window.location.href = "OptionsPage.php";
}
        
function doEnterKey(e) { //enter key submits login if both filled in
if (e.which === 13) {
    var enteredName = document.getElementById("LogUserName").value;
    var enteredPassword = document.getElementById("LogPassword").value;
    var NameLength = enteredName.length;
    var PasswordLength = enteredPassword.length;
        if (NameLength > 2 && PasswordLength >2) {
            LogInCheck();
        }
    }
}

function readBulkCsv(input) { //reads csv file as string then sends to test function
    let inputFile = input.files[0];
    let reader = new FileReader();
    reader.readAsText(inputFile);

    reader.onload = () => {
        var bulkCsvText = reader.result;
        checkBulkCsv(bulkCsvText);
    }
}

function checkBulkCsv(inputString) { //ensures csv string has proper headers then sends to php
    //let removeNR = inputString.replace( /[\r]+/gm, "");
    //let newString = removeNR.split(/\n/);
    let newString = inputString.replace( /[\r]+/g, "").split(/\n/);
    if (newString[0] === "UserName,EnterWord,Grade,Period,RealName") { //put header info here to check
        let xhr = new XMLHttpRequest();
        let url = "bulkUserNameCheck.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "text/csv");
     
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("bulkInfo").innerHTML = this.responseText;
                //document.getElementById("bulkInfo").innerHTML = rowData;
           };
        };
        xhr.send(inputString);
    } else {
        document.getElementById("bulkInfo").innerHTML = "CSV File does not contain the correct header.";
    }
    
}

let getId=["hi"];

function displayUser() {
    getId = findChecked();
    //console.log(getId);
    let UserText = "Name: "+getId[0]+" -- User: "+getId[1];
    document.getElementById("showKid").innerHTML=UserText;
}

function resetPassword() {
    if (getId[0] !== "hi") {
        let resetUser = getId[1];
        let xhr = new XMLHttpRequest();
        let url = "resetPw.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json");
     
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("showKid").innerHTML = this.responseText;
                //document.getElementById("showKid").innerHTML=resetUser+"'s Password is reset.";
           };
        };
     
        var data = JSON.stringify({ "UserName": resetUser});
        xhr.send(data);
    } else {
        document.getElementById("showKid").innerHTML="You must choose a user first.";
    }
}


function findChecked() {
    var CheckName = document.getElementsByName('CheckName');
    getId = [];
    for(var i=0; i< CheckName.length; i++) {
        if(CheckName[i].checked) {
            getId.push(CheckName[i].id); //realName
            getId.push(CheckName[i].value); //UserName
            return getId;
        }
    } 
}