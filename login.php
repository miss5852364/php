<?php
header("content-type:text/html;charset=gbk");         //设置编码
error_reporting(0);
session_start();
// 是否初始化过会话？
if (! isset($_SESSION['name'])) {
    if ($_POST['username']!="") {
        $username = $_POST['username'];
        //echo $username;
        $pswd=$_POST['password'];
        //echo $pswd;
        //连接MySQL服务器，打开数据库
        $link=mysqli_connect("localhost","root","")
        or die("数据库服务器连接失败！<BR>");
        mysqli_select_db($link,"maou") or die("数据库选择失败！<BR>");
        mysqli_query($link,"set names utf-8");
        //在users表中查找用户
        $sql = "select UserId from admin where UserId='$username' and PassWord='$pswd'";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_array($result);
        //如果找到用户，设置会话变量
        if (mysqli_num_rows($result) == 1) {
            //$_SESSION['qx'] = mysql_result($result,0,"qx");
            $_SESSION['username'] = $row['UserId'];
            header("refresh:0;url=content2.php?pageno=1");
        }
        else {
            //header("refresh:2;url=login.html");
            echo "请输入正确的账号密码";
        }
        
    }
}
?>
