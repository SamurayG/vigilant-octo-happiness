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
 
$sql = "SELECT id, name, phone, vaccine, register_date, vaccine_number FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	$list = [];
	$index = 0;
    // 输出数据
    while($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"]. " - 姓名: " . $row["name"]. " - 电话号码: " . $row["phone"]. " - 预约日期: " . $row["register_date"]. " - 疫苗种类: " . $row["vaccine"]. " - 疫苗类型: " . $row["vaccine_number"]. " <br>";
		$vaccine_arr = unserialize($row['vaccine']);
		$row['vaccine_str'] = implode(',', $vaccine_arr);

		print_r($vaccine_str); //

        $list[$index] = $row;
        $index++;

    }
} 

$conn->close();
?>


<html>
<head>
<meta charset="utf-8">
</head>
<body>

	<input type="button" value="新增" onclick='window.location.href="checkin.html"' /> <br> 



	<table border="1" style="border-collapse: collapse;">
		<tr>
			<th>ID</th> 	
			<th>姓名</th>
			<th>电话号码</th>
			<th>预约日期</th>
			<th>疫苗种类</th>
			<th>疫苗类型</th>
			<th>操作</th>

		</tr>
		<?php if ($list) { ?>
			<?php foreach($list as $key=>$val){ ?>
			<tr>
				<td><?php echo $val['id']; ?></td>
				<td><?php echo $val['name']; ?></td>
				<td><?php echo $val['phone']; ?></td>
				<td><?php echo $val['register_date']; ?></td>
				<td><?php echo $val['vaccine_str']; ?></td>
				<td><?php echo $val['vaccine_number']; ?></td>
				<td><a href="edit.php?id=<?php echo $val['id']; ?>">编辑</a>|<a href="delete.php?id=<?php echo $val['id']; ?>">删除</a></td>
			</tr>
			<?php } ?>
		<?php } ?>
	</table>
</body>
</html>