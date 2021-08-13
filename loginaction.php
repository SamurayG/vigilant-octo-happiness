<?php
// $Id:$ //声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (!empty($username) && !empty($password)) { //建立连接
    $conn = mysqli_connect('localhost', 'root', '111111', 'mydb'); //准备SQL语句
    $sql_select = "SELECT username,password FROM user WHERE username = '$username' AND password = '$password'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名或密码是否正确
    if ($username == $row['username'] && $password == $row['password']) 
    { 
        //登录成功
        session_start(); //创建session
        $_SESSION['user'] = $username; //写入日志
        header("Location:loginsucc.php"); //关闭数据库,跳转至loginsucc.php
        mysqli_close($conn);
    }
    else 
    { 
        //用户名或密码错误，赋值err为1
        header("Location:login.php?err=1");
    }
} else { //用户名或密码为空，赋值err为2
    header("Location:login.php?err=2");
} ?>
