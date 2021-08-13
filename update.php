<?php
error_reporting(E_ALL);
$con=mysqli_connect("localhost","root","111111","myDB");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

$id = $_POST['id'];
if(!$id){
	echo "参数错误";exit;
}

$_POST['vaccine'] = serialize($_POST['vaccine']);


$res = mysqli_query($con,"UPDATE myGuests SET name='$_POST[name]', phone='$_POST[phone]', register_date='$_POST[register_date]', vaccine='$_POST[vaccine]', vaccine_number ='$_POST[vaccine_number]' WHERE id={$id}");

if($res !== false){
	echo 'success';
	header("location:read.php");
}else{
	echo 'false';
}

mysqli_close($con); 
?>