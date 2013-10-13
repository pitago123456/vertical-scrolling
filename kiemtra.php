<?php 
ob_start(); 


function kiemtra($u, $p){
if (($u=="lcnguyen")&&($p=="chao ban"))
return true;
else return false;
}

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
if (kiemtra($username, $password)) {
// di den trang lam viec --> Welcome.php
setcookie("username",$username);
header("Location: welcome.php"); 
}
else {
// di den trang --> login.php
header("Location: login.php?error=1"); 
}
?>
<html>
<body>
<table width="1024" border="1">
<tr>
<td colspan = "3"> <h3> Tieu de </h3></td>
</tr>
<tr>
<td width="150"> menu 
<ul>
<li><a href="login.php"> Dang nhap </a></li>
<li><a href="logout.php"> Thoat </a></li>
</ul>
</td>
<td>  Trang dang nhap <br>
<form action = "kiemtra.php" method = "post">

<table>
<tr> 
	<td> Username </td>
	<td> <input type = "text" name = "username"/></td>
</tr>
<tr> 
	<td> Password </td>
	<td> <input type = "password" name ="password"/></td>
</tr>
<tr> 
	<td> <input type = "submit" value="Dang nhap"/> </td>
	<td> <input type = "reset" value ="Thoat"> </td>
</tr>

</table>
</form>
</td>
<td width="250"> thanh phan</td>
</tr>
</table>
</body>
</html>
