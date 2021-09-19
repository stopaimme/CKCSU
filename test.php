<?php
header('Content-type:text/html;charset=utf-8');

include('php/connect.php');
session_start();

$name = "黄文翀";
$result = mysqli_query($conn, "SELECT * FROM pot WHERE dp_name = '宣传与网络中心'");
if(!$result){
    echo mysqli_error($conn);
}
$row = mysqli_fetch_array($result);
if(!$row){
    echo 'NULL';
}
echo $row['name'];

?>