<?php
$con=mysqli_connect("localhost","root","111111","myDB");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}

$id = $_GET['id'];
if(!$id){
	echo "参数错误";exit;
}

$res = mysqli_query($con,"DELETE FROM myguests WHERE id={$id}");

if($res){
	//echo "delete success";
	header("location:read.php");
}

mysqli_close($con);
?>