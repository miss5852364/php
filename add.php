<?php
header("Content-Type: text/html; charset=gb2312");
$id=$_GET["id"];
$name=$_GET["content"];
$link=new mysqli("localhost","root","");
if (mysqli_connect_errno())  {
    echo "数据库服务器连接失败！<BR>";
    die();
}
$link->select_db("maou") or die("数据库选择失败！<BR>");
$link->query("set names gbk");
if($id!=NULL&&$name!=NULL){
    $upsql="update message_board set replay='$name' where id='$id'";
    mysqli_query($link, $upsql);
}
header("refresh:0;url=content2.php?pageno=1");
?>