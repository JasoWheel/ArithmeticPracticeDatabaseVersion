<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php #ini_set('display_errors', false);?>
<?php require_once '../config.php';
$data = json_decode(file_get_contents("php://input"));

$UserName = $Grades = $Headers = $Titles = $Games = $What = "";
$UserName = $data->UserName;
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
    //echo "None Selected"; #output back to customSearch.php
    exit("No report Data Selected");
}   else {
    if ($What !== "") {
        $sql = "SELECT $Headers FROM $From WHERE $What";
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
    makeCsv($pd);
    } catch (PDOException $ex) {
        exit("No report Data Selected");
        #echo $ex;
    }
}

function makeCsv($pd) { #create csv file to download
    global $Titles1;
    $Colmns = count($Titles1);
    $Heads = 0;
    $fileName = "ScoreRprt" . date('dMy-His') . ".csv";
    $fp = fopen("Downloads/$fileName", 'w');
    $_SESSION["DownLoadFile"] = "Downloads/$fileName";
    $_SESSION["fileName"] = $fileName;
    $HeaderRow = array();
    while ($Colmns > 0) {
        $HeaderRow[] = $Titles1[$Heads];
        $Colmns--;
        $Heads++;
    } fputcsv($fp, $HeaderRow);

    while ($row = $pd->fetch()) {
        $theRow = array();
        $Cells = count($Titles1);
        $Insert = 0;
            while ($Cells > 0) {
                    $theRow[] = $row[$Titles1[$Insert]];
                    $Insert++;
                    $Cells--;
                
            } fputcsv($fp, $theRow);
    }
    //header("Content-Description: File Transfer");
    //header('Content-Type: Application/octet-stream');
    //header("Content-Disposition: attachment; filename="."$fileName");
    //readfile("Downloads/$fileName");
    //unlink("Downloads/$fileName");
    fclose($fp);
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