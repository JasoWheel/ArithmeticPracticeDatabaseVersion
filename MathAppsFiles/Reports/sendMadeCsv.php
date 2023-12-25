<?php if(session_status() == PHP_SESSION_NONE) if(session_status() == PHP_SESSION_NONE) session_start();?>
<?php #this opens/downloads/deletes the csv file
$filePath = $_SESSION["DownLoadFile"];
$fileName = $_SESSION["fileName"];
$fp = fopen("Downloads/$fileName", 'r');

header("Content-Description: File Transfer");
header('Content-Type: Application/octet-stream');
header("Content-Disposition: attachment; filename="."$fileName");
readfile("Downloads/$fileName");
unlink("Downloads/$fileName");
fclose($fp);
?>