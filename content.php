<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>���԰���ҳ</title>
<style type="text/css">
@charset "utf-8";
body
{
padding: 0px;margin: 0px;
background-image: url(./images/bk4.jpg);
background-repeat:no-repeat;
background-size: 100% 100%;
background-attachment: fixed;}
a{text-decoration:none;}
#header{width: auto;min-height: 70px;line-height: 70px;}
#header{border-bottom: medium solid #39A631;}
span.title_con{font-family:"΢���ź�";font-style: normal;font-size: 2em;font-weight:800 ;color: #39A631;padding-left: 1em;}
#content{width: auto;height:28em;text-align: center;}
#footer{width: auto;min-height: 60px;line-height:60px;}
#footer{border-top: thin solid #39A631;}
.con{width: 35%;height: 21em;margin-top:4em;}
.con{border: thin solid #8EC172;}
.con_title{background-color: #8EC172;width: auto;height: 3.5em;line-height: 3.5em;text-align: center;}
.con_title_sp{font-family: "΢���ź�";font-size: 1.5em;font-weight: 800;color: #FFF;}
.con_input{margin: 2em 0 1em 0;}
.submit-btn{width: 8em;height: 2em;background-color: #62ab00;border-radius: 4px;border: 0px;color: #fff;font-family:"΢���ź�";font-size: 1em;font-weight: bold;}
.con_input span{font-family: "΢���ź�";font-size: 1em;font-weight: bold;color: #333;}
.con_input input{width: 15em;padding: 0.5em 1em;border: 1px solid #bbb;}
.con_input1 span{font-family: "΢���ź�";font-size: 1em;font-weight: bold;color: #333;}
.con_input1 input{width: 6.4em;padding: 0.5em 1em;border: 1px solid #bbb;}
.yanz {width: 7.2em;margin-bottom:-0.7em;}
.con_input1 b{float: right;margin-right: 1em;margin-left: -7.5em;margin-bottom: -2em;margin-top: 1em;font-size:0.9em;}
.submit-btn{margin: 1em 0 1em 0;}
.con_select{margin-left: 2em;font-family:"΢���ź�";font-size: 1em;color: #333;}
.footer2{width:auto;text-align:center;margin-top: 10px;}
.unchanged {
			border: 0;
			}
#customers
  {
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  width:1000px;
  border-collapse:collapse;
  }

#customers td, #customers th 
  {
  font-size:1.2em;
  border:1px solid #98bf21;

  }

#customers th 
  {
  font-size:1.2em;
  text-align:center;
  padding-top:5px;
  padding-bottom:4px;
  background-color:yellow;
  color:#ffffff;
  }

#customers tr.alt td 
  {
  color:#000000;
  background-color:#EAF2D3;
  }
</style>
</head>
<body>
<?php 
  header("Content-Type: text/html; charset=gb2312");  
  $pageno=$_GET['pageno'];
  $link=new mysqli("localhost","root","");
  if (mysqli_connect_errno())  {
    echo "���ݿ����������ʧ�ܣ�<BR>";  
    die();
  }
  $link->select_db("maou") or die("���ݿ�ѡ��ʧ�ܣ�<BR>");
  $link->query("set names gbk");
  $sql="select * from message_board";
  $result=$link->query($sql);
  $rows=$result->num_rows;  //�ܼ�¼��
  if ($rows==0)  {
    echo "û�����������ļ�¼��";
    die();
  }
  $pagesize=5;  //ÿҳ�ļ�¼��
  $pagecount=ceil($rows/$pagesize);  //��ҳ��
  //$pageno��ֵΪ��ǰҳ��ҳ��
  if (!isset($pageno)||$pageno<1)
    $pageno=1;
  if ($pageno>$pagecount)
    $pageno=$pagecount;
  $offset=($pageno-1)*$pagesize;
  $result->data_seek($offset);
?>
<br>
<div align="center"><strong><h1>���԰���ҳ</h1></strong> </div>
<br><br>
<table width="90%" border="1" align="center" id="customers">
  <tr> 
  	<th><div align="center">���</div></th>
    <th><div align="center">����</div></th>
    <th><div align="center">����</div></th>
    <th><div align="center">��������</div></th>
    <th><div align="center">�ظ�����</div></th>
  </tr>
<?php 
  $i=0;
  $j=($pageno-1)*5+1;
  while($row=$result->fetch_object())  {
?>
  <tr> 
   	<td><div align="center"><?php echo $j; ?></div></td>
    <td><div align="center"><?php echo $row->username; ?></div></td>
    <td><div align="center"><?php echo $row->email; ?></div></td>
    <td><div align="center"><?php echo $row->message; ?></div></td>
    <td><div align="center">
    	<?php 
    	if($row->replay==NULL)
    	    echo "��δ���";
    	else
    	   echo $row->replay; 
    	?>   
    </div></td>
  </tr>
<?php 
  $i=$i+1;
  $j=$j+1;
  if ($i==$pagesize)
    break; 
  }
  $result->free();
  $link->close(); 
?>
</table>
<br>
<br>
<div align="center" style="font-size:1.2em;">
[��<?php echo $pageno; ?>ҳ/��<?php echo $pagecount; ?>ҳ]
<?php 
$href=$_SERVER["PHP_SELF"];
if ($pageno<>1) {
?>
  <a href="<?php echo $href; ?>?pageno=1">��ҳ</a>
  <a href="<?php echo $href; ?>?pageno=<?php echo $pageno-1; ?>">��һҳ</a>
<?php
}
if ($pageno<>$pagecount) {
?>
<a href="<?php echo $href; ?>?pageno=<?php echo $pageno+1; ?>">��һҳ</a>
<a href="<?php echo $href; ?>?pageno=<?php echo $pagecount; ?>">βҳ</a>
<?php 
}
?>
[��<?php echo $rows; ?>����¼]
</div>
<div style="width:280px;margin:auto;margin-top:50px;">
<input style="font-size:1.2em;" type="button" value="������ҳ��" onclick="window.location.href='my_blog.html'">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input style="font-size:1.2em;" type="button" value="����Ա��¼" onclick="window.location.href='login.html'">
</div>
<div class="con_panel" style="display: none">
	<form method="post" action="login.php">
		<div class="con_input">
			<span>�û�����</span><input type="text" placeholder="ѧ��/����"  name="username" value="" id="username" />
		</div>
		<div class="con_input">
			<span>��&nbsp;&nbsp;&nbsp;&nbsp;�룺</span><input type="password" name="password" placeholder="����" value="" id="password" />
		</div>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="��    ¼"   onclick="window.location.href='login.html'"/>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="��   ��">
</div>
<script type="text/javascript">
	
</script>
</body>
</html>
