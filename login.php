<?php
header("content-type:text/html;charset=gbk");         //���ñ���
error_reporting(0);
session_start();
// �Ƿ��ʼ�����Ự��
if (! isset($_SESSION['name'])) {
    if ($_POST['username']!="") {
        $username = $_POST['username'];
        //echo $username;
        $pswd=$_POST['password'];
        //echo $pswd;
        //����MySQL�������������ݿ�
        $link=mysqli_connect("localhost","root","")
        or die("���ݿ����������ʧ�ܣ�<BR>");
        mysqli_select_db($link,"maou") or die("���ݿ�ѡ��ʧ�ܣ�<BR>");
        mysqli_query($link,"set names utf-8");
        //��users���в����û�
        $sql = "select UserId from admin where UserId='$username' and PassWord='$pswd'";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_array($result);
        //����ҵ��û������ûỰ����
        if (mysqli_num_rows($result) == 1) {
            //$_SESSION['qx'] = mysql_result($result,0,"qx");
            $_SESSION['username'] = $row['UserId'];
            header("refresh:0;url=content2.php?pageno=1");
        }
        else {
            //header("refresh:2;url=login.html");
            echo "��������ȷ���˺�����";
        }
        
    }
}
?>
