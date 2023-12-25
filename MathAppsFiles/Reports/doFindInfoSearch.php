<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php ini_set('display_errors', false);?>
<?php require_once '../config.php';
$data = json_decode(file_get_contents("php://input"));

$UserName = $Periods = $Grades = $Headers = $Titles = $Games = $What = "";
$UserName = $data->UserName;
$Periods = $data->Period;
$Grades = $data->Grade;
$Headers = $data->Headers; #Text for SELECT clause
$Titles = $data->Titles;
$Sort = $data->Sort;
$Sort1 = makeArray($Sort);
$Titles1 = makeArray($Titles); #used for making table headers and as keys for selecting values
$From = "MathKids"; #Text for FROM clause
$pickName = "UserName = '".$UserName."'";
$pickGrade = "Grade IN (".$Grades.")";
$pickPeriod = "Period IN (".$Periods.")";
if ($Sort1[1] === "") {
    $pickSort = "ORDER BY ".$Sort1[0];
} else {
    $pickSort = "ORDER BY ".$Sort1[0].", ".$Sort1[1];
}

#echo "Hi+$Grades+Ho";
if (is_null($UserName) === False) {
    #echo "no un";
}
if (is_null($Grades) === False) {
    #echo "no gr";
}
if (is_null($Periods) === False) {
    #echo "no pd";
}
if (is_null($Sort) === False) {
    #echo "no st";
}
$What = makeWhat(); #Text for WHERE clause
#echo $What;

if ($What === "") {
    //echo "None Selected"; #output back to customSearch.php
    exit("No report Data Selected");
}   else {
    $sql = "SELECT $Headers FROM $From WHERE $What";
    #echo $sql;
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
        #echo "You cannot Sort on Percent if it is not selected as a Header above.";
        echo $ex;
    }
}

function makeTable($pd) { #output back to customSearch.php
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
    global $UserName, $Periods, $Grades, $pickName, $pickGrade, $pickPeriod, $pickSort;
    $what = "";
    if ((is_null($UserName) === False)) {
        $what = " ".$pickName;
    } 
    if (is_null($Grades) === False && $Grades !== "") {
        if ($what === "") {
            $what = " ".$pickGrade;
        } else { $what = $what." AND ".$pickGrade; }
    }
    if (is_null($Periods) === False && $Periods !== "") {
        if ($what === "") {
            $what = " ".$pickPeriod;
        } else { $what = $what." AND ".$pickPeriod; }
    }
    if (is_null($Grades) === False) {
        if ($what !== "") {
            $what = $what." ".$pickSort;
        }
    }

    return $what;
}

function makeArray($Inpt) { #turn comma separated string into array
    $Arr = explode(",", $Inpt);
    Return $Arr;
}
?>