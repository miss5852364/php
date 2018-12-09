<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>留言板主页</title>
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
span.title_con{font-family:"微软雅黑";font-style: normal;font-size: 2em;font-weight:800 ;color: #39A631;padding-left: 1em;}
#content{width: auto;height:28em;text-align: center;}
#footer{width: auto;min-height: 60px;line-height:60px;}
#footer{border-top: thin solid #39A631;}
.con{width: 35%;height: 21em;margin-top:4em;}
.con{border: thin solid #8EC172;}
.con_title{background-color: #8EC172;width: auto;height: 3.5em;line-height: 3.5em;text-align: center;}
.con_title_sp{font-family: "微软雅黑";font-size: 1.5em;font-weight: 800;color: #FFF;}
.con_input{margin: 2em 0 1em 0;}
.submit-btn{width: 8em;height: 2em;background-color: #62ab00;border-radius: 4px;border: 0px;color: #fff;font-family:"微软雅黑";font-size: 1em;font-weight: bold;}
.con_input span{font-family: "微软雅黑";font-size: 1em;font-weight: bold;color: #333;}
.con_input input{width: 15em;padding: 0.5em 1em;border: 1px solid #bbb;}
.con_input1 span{font-family: "微软雅黑";font-size: 1em;font-weight: bold;color: #333;}
.con_input1 input{width: 6.4em;padding: 0.5em 1em;border: 1px solid #bbb;}
.yanz {width: 7.2em;margin-bottom:-0.7em;}
.con_input1 b{float: right;margin-right: 1em;margin-left: -7.5em;margin-bottom: -2em;margin-top: 1em;font-size:0.9em;}
.submit-btn{margin: 1em 0 1em 0;}
.con_select{margin-left: 2em;font-family:"微软雅黑";font-size: 1em;color: #333;}
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
<div align="center"><strong><h1>留言板主页</h1></strong> </div>
<br><br>
<table width="90%" border="1" align="center" id="customers">
  <tr> 
  	<th><div align="center">序号</div></th>
    <th><div align="center">作者</div></th>
    <th><div align="center">邮箱</div></th>
    <th><div align="center">发言内容</div></th>
    <th><div align="center">回复内容</div></th>
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
    	    echo "暂未解答";
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
<div style="width:280px;margin:auto;margin-top:50px;">
<input style="font-size:1.2em;" type="button" value="返回主页面" onclick="window.location.href='my_blog.html'">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input style="font-size:1.2em;" type="button" value="管理员登录" onclick="window.location.href='login.html'">
</div>
<div class="con_panel" style="display: none">
	<form method="post" action="login.php">
		<div class="con_input">
			<span>用户名：</span><input type="text" placeholder="学号/工号"  name="username" value="" id="username" />
		</div>
		<div class="con_input">
			<span>密&nbsp;&nbsp;&nbsp;&nbsp;码：</span><input type="password" name="password" placeholder="密码" value="" id="password" />
		</div>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="登    录"   onclick="window.location.href='login.html'"/>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="重   置">
</div>
<script type="text/javascript">
	
</script>
</body>
</html>
