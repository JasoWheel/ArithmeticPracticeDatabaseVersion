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