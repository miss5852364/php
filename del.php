<?php
header("content-type:text/html;charset=utf-8");          //���ñ���
/* ��ȡ�û��������Ϣ�����浽���ݿ� */
$cue_username=$_GET['author'];
$link=mysqli_connect("localhost","root","") or die("���ݿ�����ʧ��");
mysqli_select_db($link, "maou") or die("���ݿ�ѡ��ʧ��");
mysqli_query($link,"set names utf8");
$sql="delete from message_board where email='$cue_username'";
if(mysqli_query($link, $sql) or die("ִ�д���"))
    header("refresh:0;url=content2.php?pageno=1");
?>