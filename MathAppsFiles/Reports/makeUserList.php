<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php ini_set("display_errors", false);
require_once '../config.php';
#this builds username list on Individual search page

$sql1 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 1 ORDER BY RealName';
$sql2 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 2 ORDER BY RealName';
$sql3 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 3 ORDER BY RealName';
$sql4 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 4 ORDER BY RealName';
$sql5 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 5 ORDER BY RealName';
$sql6 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 6 ORDER BY RealName';
$sql12 = 'SELECT UserName, RealName, Grade FROM MathKids WHERE Period = 12 ORDER BY RealName';

$data1 = sendRequest($sql1);
$data2 = sendRequest($sql2);
$data3 = sendRequest($sql3);
$data4 = sendRequest($sql4);
$data5 = sendRequest($sql5);
$data6 = sendRequest($sql6);
$data12 = sendRequest($sql12);

#echo $row['UserName']."/".$row['RealName']."/".$row['Grade']."<br>";
echo "
<div id=\"namesOne\"><p><b>1st Pd Names</b></p>
 <div class=\"NameBoxes\" id=\"P1NamesText\">";
 while ($row = $data1->fetch()) {
    echo "<label for=".$row['UserName']."><input type=\"radio\" id=".$row['UserName']." name=\"CheckName\" value=".$row['UserName']." onchange=\"pickUser()\" />".$row['RealName']."/".$row['UserName']."/".$row['Grade']."</label><br>";
};
echo "</div></div>

<div id=\"namesTwo\"><p><b>2nd Pd Names</b></p>
 <div class=\"NameBoxes\" id=\"P2NamesText\">";
 while ($row = $data2->fetch()) {
    echo "<label for=".$row['UserName']."><input type=\"radio\" id=".$row['UserName']." name=\"CheckName\" value=".$row['UserName']." onchange=\"pickUser()\" />".$row['RealName']."/".$row['UserName']."/".$row['Grade']."</label><br>";
};
echo "</div></div>

<div id=\"namesThree\"><p><b>3rd Pd Names</b></p>
 <div class=\"NameBoxes\" id=\"P3NamesText\">";
 while ($row = $data3->fetch()) {
    echo "<label for=".$row['UserName']."><input type=\"radio\" id=".$row['UserName']." name=\"CheckName\" value=".$row['UserName']." onchange=\"pickUser()\" />".$row['RealName']."/".$row['UserName']."/".$row['Grade']."</label><br>";
};
echo "</div></div>

<div id=\"namesFour\"><p><b>4th Pd Names</b></p>
 <div class=\"NameBoxes\" id=\"P4NamesText\">";
 while ($row = $data4->fetch()) {
    echo "<label for=".$row['UserName']."><input type=\"radio\" id=".$row['UserName']." name=\"CheckName\" value=".$row['UserName']." onchange=\"pickUser()\" />".$row['RealName']."/".$row['UserName']."/".$row['Grade']."</label><br>";
};
echo "</div></div>

<div id=\"namesFive\"><p><b>5th Pd Names</b></p>
 <div class=\"NameBoxes\" id=\"P5NamesText\">";
 while ($row = $data5->fetch()) {
    echo "<label for=".$row['UserName']."><input type=\"radio\" id=".$row['UserName']." name=\"CheckName\" value=".$row['UserName']." onchange=\"pickUser()\" />".$row['RealName']."/".$row['UserName']."/".$row['Grade']."</label><br>";
};
echo "</div></div>

<div id=\"namesSix\"><p><b>6th Pd Names</b></p>
 <div class=\"NameBoxes\" id=\"P6NamesText\">";
 while ($row = $data6->fetch()) {
    echo "<label for=".$row['UserName']."><input type=\"radio\" id=".$row['UserName']." name=\"CheckName\" value=".$row['UserName']." onchange=\"pickUser()\" />".$row['RealName']."/".$row['UserName']."/".$row['Grade']."</label><br>";
};
echo "</div></div>";

function sendRequest($input) {
    global $conn;
    try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pd = $conn->prepare($input);
    $pd->execute();
    $pd->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        echo "Something is wrong.";
        echo $ex;
    }
    return $pd;
}
?>