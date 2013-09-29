

<head>

<script language="javascript">
    function checkValue(){
		if (document.doimatkhau.txtmatkhaumoi1.value=="" || document.doimatkhau.txtmatkhaumoi2.value=="" || document.doimatkhau.txtmatkhauht.value==""){
            alert ("Xin nhập đầy đủ vào các mục!");
            return false;
        }
        if (document.doimatkhau.txtmatkhaumoi1.value != document.doimatkhau.txtmatkhaumoi2.value){
            alert ("Mật khẩu xác nhận không đúng!");
            return false;
        }
        return true;
    }
	function empty(){
		document.doimatkhau.txtmatkhaumoi1.value = "";
		document.doimatkhau.txtmatkhaumoi2.value = "";
        document.doimatkhau.txtmatkhauht.value=""        ;
		
        
    }
</script>


<link href="Libraries/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="min-height">

<form name="doimatkhau"  method="POST" >
  <table align="center" class="font" width="320" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class=main_1>
	  	<img border="0" src="Libraries/images/tbl_left.gif" width="10" height="25" />
	  </td>
      <td align=center class="main_1">ĐỔI MẬT KHẨU</td>
      <td class="main_1">
	  	<p align="right">
			<img border="0" src="Libraries/images/tbl_right.gif" width="10" height="25" />
		</p>
	  </td>
    </tr>
    <tr >
      <td colspan="3" valign="top" bgcolor="#dae9f3" class="border_1">
	  	<table width="320" border="0" align="center">
        	<tr>
          		<td height="5px" colspan="2">&nbsp;</td>
       		</tr>
            <!--Sua tai day: them vao-->
            <tr>
          		<td width="120" align="right" class="text">Mật khẩu HT </td>
          		<td width="200" align="center"><input name="txtmatkhauht" type="password" id="txtmatkhauht" size="25"></td>
       		</tr>
            <!--Het sua-->
        	<tr>
          		<td width="120" align="right" class="text">Mật khẩu mới </td>
          		<td width="200" align="center"><input name="txtmatkhaumoi1" type="password" id="txtmatkhaumoi1" size="25"></td>
       		</tr>
        	<tr>
          		<td class="text" align="right">Nhập lại</td>
          		<td align="center"><input name="txtmatkhaumoi2" type="password" id="txtmatkhaumoi2" size="25"></td>
        	</tr>
			
        	<tr>
          		<td colspan="2" align="center">
					<input name="btnluulai" type="submit" value="Lưu lại" class="button_1" onClick="return checkValue();">
            		&nbsp;&nbsp;
                    <input name="btnhuybo" type="button"  value="Hủy bỏ" class="button_1" onClick="empty();">
                </td>
          	</tr>
      	</table></td>
    </tr>
  </table>

</form>
  </div>
 
</body>

