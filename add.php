<?php
header("Content-Type: text/html; charset=gb2312");
$id=$_GET["id"];
$name=$_GET["content"];
$link=new mysqli("localhost","root","");
if (mysqli_connect_errno())  {
    echo "���ݿ����������ʧ�ܣ�<BR>";
    die();
}
$link->select_db("maou") or die("���ݿ�ѡ��ʧ�ܣ�<BR>");
$link->query("set names gbk");
if($id!=NULL&&$name!=NULL){
    $upsql="update message_board set replay='$name' where id='$id'";
    mysqli_query($link, $upsql);
}
header("refresh:0;url=content2.php?pageno=1");
?>