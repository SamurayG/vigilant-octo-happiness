<?php
$servername = "localhost";
$username = "root";
$password = "111111";
$dbname = "myDB";
 


$_POST['vaccine_str'] = serialize($_POST['vaccine']);

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "INSERT INTO MyGuests (name, phone, vaccine, register_date, vaccine_number)
VALUES ('$_POST[name]', '$_POST[phone]', '$_POST[vaccine_str]', '$_POST[register_date]', '$_POST[vaccine_number]')";
 
if ($conn->query($sql) === TRUE) {
    //echo "新记录插入成功";
    header("location:read.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>