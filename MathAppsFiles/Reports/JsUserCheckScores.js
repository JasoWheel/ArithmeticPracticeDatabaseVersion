function UserScoreGet() { //prepares score data search parameters
    Hdrs = ""; //this is used to make the dB Select
    Hdrs = doArray("RealName", Hdrs, "RealName");
    Hdrs = doArray("Game", Hdrs, "PlayedGames.GameNameber AS Game");
    Hdrs = doArray("Answered", Hdrs, "Answered");
    Hdrs = doArray("Correct", Hdrs, "Correct");
    Hdrs = doArray("Percent", Hdrs, "ROUND(Correct / Answered * 100, 1) AS Percent");
    Hdrs = doArray("Date", Hdrs, "CONCAT(DAYOFMONTH(TIMESTAMP(PlayedGames.StartTime)),\"-\" , MONTHNAME(TIMESTAMP(PlayedGames.StartTime))) AS Date");
    Titles = ""; //this is used to call the values and set the table headers
    Titles = doArray("RealName", Titles, "RealName");
    Titles = doArray("Game", Titles, "Game");
    Titles = doArray("Answered", Titles, "Answered");
    Titles = doArray("Correct", Titles, "Correct");
    Titles = doArray("Percent", Titles, "Percent");
    Titles = doArray("Date", Titles, "Date");
    Games = ""; //this chooses games to pick
    Games = doArray("Game 0", Games, "0");
    Games = doArray("Game 1", Games, "1");
    Games = doArray("Game 2", Games, "2");
    Games = doArray("Game 3", Games, "3");
    Games = doArray("Game 4", Games, "4");
    Games = doArray("Game 5", Games, "5");
    Games = doArray("Game 6A", Games, "\"6A\"");
    Games = doArray("Game 6B", Games, "\"6B\"");
    Games = doArray("Game 7", Games, "7");
    Games = doArray("Game 8", Games, "8");
    Games = doArray("Game 9", Games, "9");
    Games = doArray("Game 10", Games, "10");
    Games = doArray("Game 11", Games, "11");
    Games = doArray("Game 12", Games, "12");
    Dates = "";
    Dates = doDatesArray(Dates);
    Sort = "";
    Sort = doUserSortArray(Sort);

    let xhr = new XMLHttpRequest();
    let url = "doUserSearch.php";
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

    var data = JSON.stringify({"Headers": Hdrs, "Titles": Titles, "Games": Games, "Dates": Dates, "Sort": Sort});
    xhr.send(data);
}

function doUserSortArray(arry) {
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

function doArray (element, arry, value) { //this adds the value to the array if checked on page
    const NewElement = document.getElementById(element);
    if (NewElement.checked == true) {
        if (arry === "") {
            arry += `${value}`;
        } else {
            arry += `,${value}`;
        }
    } return arry;
}

function doDatesArray(arry) {
    const startDay = document.getElementById("startDay").value;
    const endDay = document.getElementById("endDay").value;
    if (startDay !== "" && endDay !== "") {
        arry += `${startDay},${endDay}`;
        return arry;
    } else {
        arry = "";
        return arry;
    }
}

function resetDatesAlone() {
    document.getElementById("startDay").value = "";
    document.getElementById("endDay").value = "";
    UserScoreGet();
}

function startUserCsvDownload() { //prepares csv download search parameters
    Hdrs = ""; //this is used to make the dB Select
    Hdrs = doArray("RealName", Hdrs, "RealName");
    Hdrs = doArray("Game", Hdrs, "PlayedGames.GameNameber AS Game");
    Hdrs = doArray("Answered", Hdrs, "Answered");
    Hdrs = doArray("Correct", Hdrs, "Correct");
    Hdrs = doArray("Percent", Hdrs, "ROUND(Correct / Answered * 100, 1) AS Percent");
    Hdrs = doArray("Date", Hdrs, "CONCAT(DAYOFMONTH(TIMESTAMP(PlayedGames.StartTime)),\"-\" , MONTHNAME(TIMESTAMP(PlayedGames.StartTime))) AS Date");
    Titles = ""; //this is used to call the values and set the table headers
    Titles = doArray("RealName", Titles, "RealName");
    Titles = doArray("Game", Titles, "Game");
    Titles = doArray("Answered", Titles, "Answered");
    Titles = doArray("Correct", Titles, "Correct");
    Titles = doArray("Percent", Titles, "Percent");
    Titles = doArray("Date", Titles, "Date");
    Games = ""; //this chooses games to pick
    Games = doArray("Game 0", Games, "0");
    Games = doArray("Game 1", Games, "1");
    Games = doArray("Game 2", Games, "2");
    Games = doArray("Game 3", Games, "3");
    Games = doArray("Game 4", Games, "4");
    Games = doArray("Game 5", Games, "5");
    Games = doArray("Game 6A", Games, "\"6A\"");
    Games = doArray("Game 6B", Games, "\"6B\"");
    Games = doArray("Game 7", Games, "7");
    Games = doArray("Game 8", Games, "8");
    Games = doArray("Game 9", Games, "9");
    Games = doArray("Game 10", Games, "10");
    Games = doArray("Game 11", Games, "11");
    Games = doArray("Game 12", Games, "12");
    Dates = "";
    Dates = doDatesArray(Dates);
    Sort = "";
    Sort = doUserSortArray(Sort);

    let xhr = new XMLHttpRequest();
    let url = "doUserCsvDownLd.php";
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

    var data = JSON.stringify({"Headers": Hdrs, "Titles": Titles, "Games": Games, "Dates": Dates, "Sort": Sort});
    xhr.send(data);
}

function sendCsvFile() {
    window.location.href = "sendMadeCsv.php";
}