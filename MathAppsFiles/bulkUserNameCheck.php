<?php if(session_status() == PHP_SESSION_NONE) session_start();?> 
<?php require_once("config.php");?> 
<?php
$data = file_get_contents("php://input");
$data1 = explode("\n", preg_replace("/\r/", "", $data)); #input as an array of strings
$headers = explode(",", $data1[0]); #array of header fields
$stringRows = count($data1); # number of rows of data, including headers
$UserHead = $headers[0]; #username header
$UsedUpNames = ""; #for logging used names
$Arr = $Arr1 = 1; #used to start picking names after header row

for ( $i=$stringRows; $i>1; $i--) { #check if usernames are used
    global $Arr, $data1, $UserHead, $UsedUpNames, $conn;
    $RowInputs = explode(",", $data1[$Arr]);
    $NameSearch = "SELECT count(*) FROM MathKids WHERE $UserHead = '$RowInputs[0]'";
    $Arr++;
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pd = $conn->prepare($NameSearch);
        $pd->execute();
        $pd->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo $ex;
        }
    $count = $pd->fetchColumn(); # should be 1 if name exists or 0 if it does not.
    if ($count > 0) { # if name is used, add it to the list
        if ($UsedUpNames === "") {
            $UsedUpNames = $RowInputs[0];
        } else {
            $UsedUpNames = $UsedUpNames.",".$RowInputs[0];
        }
    }
}

if ($UsedUpNames === "") { #if all users are new, call function to make new, else report used names
    SendNewUsers();
} else {
    echo "<br>The Used Names are (".$UsedUpNames.")";
}

function SendNewUsers() { #add new users to database
    global $stringRows;
    for ( $i=$stringRows; $i>1; $i--) {
        global $data1, $Arr1, $conn;
        $Row = explode(",", $data1[$Arr1]);
        try {
            $sql = "INSERT into MathKids ($data1[0]) VALUES ('$Row[0]','$Row[1]','$Row[2]','$Row[3]','$Row[4]')";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pd = $conn->prepare($sql);
            $pd->execute();
            $pd->setFetchMode(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                echo $ex;
            }
        $Sent = $data1[$Arr1];
        echo "Sent User: ".$Sent."<br>";
        $Arr1++;
    }
}
?>