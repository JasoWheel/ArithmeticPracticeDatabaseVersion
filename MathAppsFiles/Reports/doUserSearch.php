<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php ini_set('display_errors', false);?>
<?php require_once '../config.php';
$data = json_decode(file_get_contents("php://input"));

$UserName = $Grades = $Headers = $Titles = $Games = $What = "";
$UserName = $_SESSION["UsersName"];
$Headers = $data->Headers; #Text for SELECT clause
$Titles = $data->Titles;
$Games = $data->Games;
$Dates = $data->Dates;
$Sort = $data->Sort;
$Sort1 = makeArray($Sort);
$Dates1 = makeArray($Dates);
$Titles1 = makeArray($Titles); #used for making table headers and as keys for selecting values
$From = "MathKids JOIN PlayedGames ON PlayedGames.UserName = MathKids.UserName JOIN MathGames ON MathGames.GameNameber = PlayedGames.GameNameber"; #Text for FROM clause
$pickName = "PlayedGames.UserName = '".$UserName."'";
$pickGame = "PlayedGames.GameNameber IN (".$Games.")";
if ($Dates1[0] !== "") {
    $pickDates = "DATE(LastTime) BETWEEN '".$Dates1[0]."' AND '".$Dates1[1]."'";
}
if ($Sort1[1] === "") {
    $pickSort = "ORDER BY ".$Sort1[0];
} else {
    $pickSort = "ORDER BY ".$Sort1[0].", ".$Sort1[1];
}

$What = makeWhat(); #Text for WHERE clause

if ($What === "") {
    //echo "None Selected"; #output back to UserScoreSearch.php
    exit("No report Data Selected");
}   else {
    $sql = "SELECT $Headers FROM $From WHERE $What";
    if ($What !== "") {
        sendSelected();
    } else {
        exit("No report Data Selected");
    }
}

function sendSelected() { #send query to Db
    global $sql, $conn;
    try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pd = $conn->prepare($sql);
    $pd->execute();
    $pd->setFetchMode(PDO::FETCH_ASSOC);
    makeTable($pd);
    } catch (PDOException $ex) {
        echo "You cannot Sort on Percent if it is not selected as a Header above.";
        #echo $ex;
    }
}

function makeTable($pd) { #output back to UserScoreSearch.php
    global $Titles1;
    $Colmns = count($Titles1);
    $Heads = 0;
    echo "<div id=\"reportTable\"> 
        <table id=\"outputTable\">
        <thead>
            <tr>";
            while ($Colmns > 0) {
                echo "<th>".$Titles1[$Heads]."</th>";
                $Colmns--;
                $Heads++;
            }
    echo "</tr></thead><tbody>";
    while ($row = $pd->fetch()) {
        $Cells = count($Titles1);
        $Insert = 0;
        echo "<tr>";
            while ($Cells > 0) {
                echo "<td>".$row[$Titles1[$Insert]]."</td>";
                $Insert++;
                $Cells--; 
            }
        echo "</tr>";
    }
    echo "</tbody></table></div>";
}

function makeWhat() { #builds WHERE clause
    global $UserName, $Games, $Dates, $pickName, $pickGame, $pickDates, $pickSort;
    $what = "";
    if ($UserName !== "") {
            $what = " ".$pickName;
        } 
    if ($Games !== "") {
        if ($what === "") {
            $what = " ".$pickGame;
        } else { $what = $what." AND ".$pickGame; }
    }
    if ($Dates !== "") {
        if ($what === "") {
            $what = " ".$pickDates;
        } else { $what = $what." AND ".$pickDates; }
    } if ($what !== "") {
        $what = $what." ".$pickSort;
    }

    return $what;
}

function makeArray($Inpt) { #turn comma separated string into array
    $Arr = explode(",", $Inpt);
    Return $Arr;
}
?>