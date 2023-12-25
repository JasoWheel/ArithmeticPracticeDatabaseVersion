let functionChoice = "neutral";

function chooseCsv() {
    if (functionChoice === "neutral") {
        //tell user to pick below
    }
    if (functionChoice === "custom") {
        startCsvDownload();
    }
    if (functionChoice === "individual") {
        startIndivCsvDownload();
    }
}

function choosePath() {
    if (functionChoice === "neutral") {
        //tell user to pick below
    }
    if (functionChoice === "custom") {
        pickNames();
    }
    if (functionChoice === "individual") {
        pickUser();
    }
}

function pickNames() { //Custrom Search prepares score data search parameters
    functionChoice = "custom";
    Gd = ""; //this sends the grade levels to pick
    Gd = doGradeArray();
    Pd = ""; //this sends the class periods to pick
    Pd = doPeriodArray();
    Hdrs = ""; //this is used to make the dB Select
    Hdrs = doHdrsArray();
    Titles = ""; //this is used to call the values and set the table headers
    Titles = doTitlesArray();
    Sort = "";
    Sort = doIndSortArray(Sort);
    
    let xhr = new XMLHttpRequest();
    let url = "doFindInfoSearch.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (this.responseText == "") {
                document.getElementById("scoreText").innerHTML = "None Selected";
            } else {
                document.getElementById("scoreText").innerHTML = this.responseText;
            }
        }
    };

    var data = JSON.stringify({ "Period": Pd, "Grade": Gd, "Headers": Hdrs, "Titles": Titles, "Sort": Sort});
    xhr.send(data);
}

function doTitlesArray() {
    let arry = "";
    let allTitles = document.getElementsByName("Headers");
    for (i=0; i<allTitles.length; i++) {
        if (allTitles[i].checked === true) {
            if (arry === "") {
                arry += allTitles[i].id;
            } else {
                arry += ","+allTitles[i].id;
            }
        }
    } //console.log(arry);
    return arry;
}

function doHdrsArray () {
    let arry = "";
    let allHdrs = document.getElementsByName("Headers");
    for (i=0; i<allHdrs.length; i++) {
        if (allHdrs[i].checked === true) {
            if (arry === "") {
                arry += allHdrs[i].value;
            } else {
                arry += ","+allHdrs[i].value;
            }
        }
    } //console.log(arry);
    return arry;
}

function doGradeArray() {
    let arry="";
    let allGrades = document.getElementsByName("GradeLevel");
    for (i=0; i<allGrades.length; i++) {
        if (allGrades[i].checked === true) {
            if (arry === "") {
                arry += allGrades[i].value;
            } else {
                arry += ","+allGrades[i].value;
            }
        }
    } //console.log(arry);
    return arry;
}

function doPeriodArray() {
    let arry="";
    let allPeriods = document.getElementsByName("Periods");
    for (i=0; i<allPeriods.length; i++) {
        if (allPeriods[i].checked === true) {
            if (arry === "") {
                arry += allPeriods[i].value;
            } else {
                arry += ","+allPeriods[i].value;
            }
        }
    } //console.log(arry);
    return arry;
}

function startCsvDownload() { //prepares csv download search parameters
    Gd = ""; //this sends the grade levels to pick
    Gd = doGradeArray();
    Pd = ""; //this sends the class periods to pick
    Pd = doPeriodArray();
    Hdrs = ""; //this is used to make the dB Select
    Hdrs = doHdrsArray();
    Titles = ""; //this is used to call the values and set the table headers
    Titles = doTitlesArray();
    Sort = "";
    Sort = doIndSortArray(Sort);

    let xhr = new XMLHttpRequest();
    let url = "dofindInfoCsv.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (this.responseText == "No report Data Selected") {
                    document.getElementById("fillText").innerHTML = "You need to select a report<br>before you can download a file.";
                } else {
                    sendCsvFile();
                }
            }
        }
    };

    var data = JSON.stringify({ "Period": Pd, "Grade": Gd, "Headers": Hdrs, "Titles": Titles, "Sort": Sort});
    xhr.send(data);
}

function sendCsvFile() {
    window.location.href = "sendMadeCsv.php";
}

//above this is for custom score search, below for individual search

function pickUser() { //individual search data
    functionChoice = "individual";
    Hdrs = ""; //this is used to make the dB Select
    Hdrs = doHdrsArray();
    Titles = ""; //this is used to call the values and set the table headers
    Titles = doTitlesArray();
    Sort = "";
    Sort = doIndSortArray(Sort);
    GetId = findChecked(); //the picked username for the search

    let xhr = new XMLHttpRequest();
    let url = "doFindInfoSearch.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (this.responseText == "") {
                document.getElementById("scoreText").innerHTML = "Not Working";
            } else {
                document.getElementById("scoreText").innerHTML = this.responseText;
            }
        }
    };
    var data = JSON.stringify({ "UserName": GetId, "Headers": Hdrs, "Titles": Titles, "Sort": Sort});
    //var data = JSON.stringify({ "UserName": GetId});
    xhr.send(data);
}

function findChecked() {
    var CheckName = document.getElementsByName('CheckName');
    var getId; //this is the username selected
    for(var i=0; i< CheckName.length; i++) {
        if(CheckName[i].checked) {
            getId = CheckName[i].value; }
    } return getId;
}

function doIndSortArray(arry) {
    arry= "";
    var Sort1a = document.getElementsByName('sortOne');
    var SortFirst; //this is the sort selected
    for(var i=0; i< Sort1a.length; i++) {
        if(Sort1a[i].checked) {
            SortFirst = Sort1a[i].value; }
    }
    var Sort2a = document.getElementsByName('sortTwo');
    var SortSecond; //this is the sort selected
    for(var i=0; i< Sort2a.length; i++) {
        if(Sort2a[i].checked) {
            SortSecond = Sort2a[i].value; }
    }
    arry += `${SortFirst},${SortSecond}`;
    return arry;
}

function startIndivCsvDownload() {
    Hdrs = ""; //this is used to make the dB Select
    Hdrs = doHdrsArray();
    Titles = ""; //this is used to call the values and set the table headers
    Titles = doTitlesArray();
    Sort = "";
    Sort = doIndSortArray(Sort);
    GetId = findChecked(); //the picked username for the search

    let xhr = new XMLHttpRequest();
    let url = "dofindInfoCsv.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (this.responseText == "No report Data Selected") {
                    document.getElementById("fillText").innerHTML = "You need to select a report<br>before you can download a file.";
                } else {
                    sendCsvFile();
                }
            }
        }
    };
    var data = JSON.stringify({ "UserName": GetId, "Headers": Hdrs, "Titles": Titles, "Sort": Sort});
    xhr.send(data);
}