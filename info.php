<?php
header("content-type:text/html;charset=utf-8");          //���ñ���
	/* ��ȡ�û��������Ϣ�����浽���ݿ� */
 	$cue_username=$_GET['username'];
	$cue_email=$_GET['email'];
	$cur_message=$_GET["message"];
	$link=mysqli_connect("localhost","root","") or die("���ݿ�����ʧ��");
	mysqli_select_db($link, "maou") or die("���ݿ�ѡ��ʧ��");
	mysqli_query($link,"set names utf8");
	$sql="insert into message_board(username,email,message)values('$cue_username','$cue_email','$cur_message')";
	if(mysqli_query($link, $sql) or die("ִ�д���"))
	   header("refresh:0;url=content.php?pageno=1");
?>