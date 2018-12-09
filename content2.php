<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留言板主页</title>
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
    echo "数据库服务器连接失败！<BR>";  
    die();
  }
  $link->select_db("maou") or die("数据库选择失败！<BR>");
  $link->query("set names gbk");
  $sql="select * from message_board";
  $result=$link->query($sql);
  $rows=$result->num_rows;  //总记录数
  if ($rows==0)  {
    echo "没有满足条件的记录！";
    die();
  }
  $pagesize=5;  //每页的记录数
  $pagecount=ceil($rows/$pagesize);  //总页数
  //$pageno的值为当前页的页号
  if (!isset($pageno)||$pageno<1)
    $pageno=1;
  if ($pageno>$pagecount)
    $pageno=$pagecount;
  $offset=($pageno-1)*$pagesize;
  $result->data_seek($offset);
?>
<br>
<div align="center"><strong><h2>留言板主页</h2></strong> </div>
<br><br>
当前管理员是：<?php 
 session_start();
 $name=$_SESSION['username'];
 echo $name;
?>（
<a href="logout.php" style="text-decoration:underline; color:red;font-size:1.5em">注销</a>）
<br><br>
<table width="90%" border="1" align="center" id="customers">
  <tr> 
    <th>序号</th>
    <th>作者</th>
    <th>邮箱</th>
    <th>发言内容</th>
    <th>回复内容</th>
    <th>删除留言</th>
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
    	    echo "<input type=\"button\" onclick=\"getout(this)\" value=\"添加回复\"?";
    	else
    	   echo $row->replay; 
    	?>
    </td>
    <td>
    	<?php 
    	    echo "<a onclick=\"getdel(this)\" style=\"color:green;text-decoration:underline;\">删除</a>";
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
[第<?php echo $pageno; ?>页/共<?php echo $pagecount; ?>页]
<?php 
$href=$_SERVER["PHP_SELF"];
if ($pageno<>1) {
?>
  <a href="<?php echo $href; ?>?pageno=1">首页</a>
  <a href="<?php echo $href; ?>?pageno=<?php echo $pageno-1; ?>">上一页</a>
<?php
}
if ($pageno<>$pagecount) {
?>
<a href="<?php echo $href; ?>?pageno=<?php echo $pageno+1; ?>">下一页</a>
<a href="<?php echo $href; ?>?pageno=<?php echo $pagecount; ?>">尾页</a>
<?php 
}
?>
[共<?php echo $rows; ?>条记录]
</div>
<script type="text/javascript">
function getout(obj){
	var messageStr = "输入回复信息：";
    var defaultStr = "请输入回复的内容";
    //点击取消 返回null
    //如果什么都不写 并 点击确定的话，返回一个空字符串
    var content = window.prompt(messageStr, defaultStr); 
    $replay=content;
    var str= $(obj).parent().parent().find("td").get(0);	
	$id=$(str).text();
	if($replay=="请输入回复的内容"||$replay==null)
		alert("请输入有效值，谢谢");
	else
		window.location.href="add.php?id="+$id+"&content="+$replay;
}
function getdel(obj){
	var str= $(obj).parent().parent().find("td").get(2);	
	var $author=$(str).text();
	if(confirm('确定删除吗?'))
		window.location.href="del.php?author="+$author;
    
}

</script>
</body>
</html>
