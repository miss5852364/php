<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>���԰���ҳ</title>
<style type="text/css">
body
{
padding: 0px;margin: 0px;
background-image: url(./images_1/1140x500-1.jpg);
background-repeat:no-repeat;
background-size: 100% 100%;
background-attachment: fixed;}
#customers
  {
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  width:90%;
  border-collapse:collapse;
  }

#customers td, #customers th 
  {
  font-size:1.2em;
  border:1px solid #98bf21;
  text-align:center;

  }

#customers th 
  {
  font-size:1.2em;
  text-align:center;
  padding-top:5px;
  padding-bottom:4px;
  background-color:yellow;
  color:black;
  }

#customers tr.alt td 
  {
  color:#000000;
  background-color:#EAF2D3;
  }
</style>
<script src="jquery-1.11.3.js"></script>
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
<div align="center"><strong><h2>���԰���ҳ</h2></strong> </div>
<br><br>
��ǰ����Ա�ǣ�<?php 
 session_start();
 $name=$_SESSION['username'];
 echo $name;
?>��
<a href="logout.php" style="text-decoration:underline; color:red;font-size:1.5em">ע��</a>��
<br><br>
<table width="90%" border="1" align="center" id="customers">
  <tr> 
    <th>���</th>
    <th>����</th>
    <th>����</th>
    <th>��������</th>
    <th>�ظ�����</th>
    <th>ɾ������</th>
  </tr>
<?php 
  $i=0;	
  $j=($pageno-1)*5+1;
  while($row=$result->fetch_object())  {
?>
  <tr> 
    <td><?php echo $j; ?></td>
    <td><?php echo $row->username; ?></td>
    <td><?php echo $row->email; ?></td>
    <td><?php echo $row->message; ?></td>
    <td>
    	<?php 
    	if($row->replay==NULL)
    	    echo "<input type=\"button\" onclick=\"getout(this)\" value=\"��ӻظ�\"?";
    	else
    	   echo $row->replay; 
    	?>
    </td>
    <td>
    	<?php 
    	    echo "<a onclick=\"getdel(this)\" style=\"color:green;text-decoration:underline;\">ɾ��</a>";
    	?>
    </td>
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
<div align="center">
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
<script type="text/javascript">
function getout(obj){
	var messageStr = "����ظ���Ϣ��";
    var defaultStr = "������ظ�������";
    //���ȡ�� ����null
    //���ʲô����д �� ���ȷ���Ļ�������һ�����ַ���
    var content = window.prompt(messageStr, defaultStr); 
    $replay=content;
    var str= $(obj).parent().parent().find("td").get(0);	
	$id=$(str).text();
	if($replay=="������ظ�������"||$replay==null)
		alert("��������Чֵ��лл");
	else
		window.location.href="add.php?id="+$id+"&content="+$replay;
}
function getdel(obj){
	var str= $(obj).parent().parent().find("td").get(2);	
	var $author=$(str).text();
	if(confirm('ȷ��ɾ����?'))
		window.location.href="del.php?author="+$author;
    
}

</script>
</body>
</html>
