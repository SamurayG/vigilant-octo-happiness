<?php
$servername = "localhost";
$username = "root";
$password = "111111";
$dbname = "myDB";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$id = $_GET['id'];
 
$sql = "SELECT id, name, phone, vaccine, register_date, vaccine_number FROM MyGuests where id={$id}";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {

	$list = [];
	$index = 0;

	$row = $result->fetch_assoc();
	$row['vaccine_arr'] = unserialize($row['vaccine']);

//	print_r($row);

} else {
    echo "0 结果";
}

$conn->close();




?>

<html>
<head>
<meta charset="utf-8">
<title>疫苗登记</title>
</head>
<body>
 
<form action="update.php" method="post">
名字: <input type="text" name="name" value="<?php echo $row["name"]; ?>"> <br>
电话: <input type="text" name="phone" value="<?php echo $row["phone"]; ?>"> <br>
预约日期: <input type="text" name="register_date" value="<?php echo $row["id"]; ?>"> <br/>


疫苗种类:
<label><input type="checkbox" name="vaccine[]" value="复兴" <?php if( in_array('复兴', $row['vaccine_arr']) ){ echo "checked"; } ?> />复兴 </label>
<label><input type="checkbox" name="vaccine[]" value="科兴" <?php if( in_array('科兴', $row['vaccine_arr']) ){ echo "checked"; } ?> />科兴 </label>
<label><input type="checkbox" name="vaccine[]" value="智飞" <?php if( in_array('智飞', $row['vaccine_arr']) ){ echo "checked"; } ?> />智飞 </label>


接种类型：
<label><input type="radio" name="vaccine_number" value="第一针" <?php if($row['vaccine_number'] == '第一针'){ echo "checked"; } ?> />第一针 </label>
<label><input type="radio" name="vaccine_number" value="第二针" <?php if($row['vaccine_number'] == '第二针'){ echo "checked"; } ?> />第二针 </label> <br>


<input type="submit" value="提交">

<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
</form>
 
</body>
</html>
