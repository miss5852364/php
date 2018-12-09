<?php
header("content-type:text/html;charset=utf-8");          //设置编码
	/* 获取用户输入的信息，保存到数据库 */
 	$cue_username=$_GET['username'];
	$cue_email=$_GET['email'];
	$cur_message=$_GET["message"];
	$link=mysqli_connect("localhost","root","") or die("数据库连接失败");
	mysqli_select_db($link, "maou") or die("数据库选择失败");
	mysqli_query($link,"set names utf8");
	$sql="insert into message_board(username,email,message)values('$cue_username','$cue_email','$cur_message')";
	if(mysqli_query($link, $sql) or die("执行错误"))
	   header("refresh:0;url=content.php?pageno=1");
?>