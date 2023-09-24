<?php
if (!session_id()) {
    session_start();
}

$btn_count = $_SESSION['btn_count'];
$array_save = $_SESSION['array_save'];
$access_save = $_SESSION['access_save'];
$btn_count=$btn_count+1;

echo "<br>";

$link = @mysqli_connect(
    'localhost',
    'root',
    '',
    '107php');

$timestamp = uniqid();
$timestamp = date('YmdHis');

$sql = "INSERT INTO `mymaster` (`id`, `freq`) VALUES ('$timestamp', '$btn_count')";
mysqli_query($link, $sql);

$turn = 1;
foreach ($access_save as $record) {
    print_r($record); 
    $rec = intval(implode('', $record['rec']));
    echo "rec: $rec"; 
    $sql2 = "INSERT INTO `mydetail` (`id`, `turn`, `rec`) VALUES ('$timestamp', '$turn', '$rec')";
    mysqli_query($link, $sql2);
    $turn++;
}

mysqli_close($link);


?>