<?php
/**
 * @author lioxca
 * @copyright 2012
 */

    
?>
<script language="javascript">
    function check(){
        if (document.frmdangnhap.txtmaso.value=="" || document.frmdangnhap.txtmatkhau.value==""){
            alert ("Tên đăng nhập và mật khẩu không được để trống!");
            return false;
        }
        return true;
    }
    
    
</script>

<script type="text/javascript">
$(document).ready(function() {
             $('div.menu').hide();
            });
</script>
<link href="Libraries/css/Dangnhap.css" rel="stylesheet" type="text/css"/>


<form name="frmdangnhap" action="index.php?option=dangnhap" method="post" >
    <div class="dangnhap">
        <div class="color">
        <h3>ĐĂNG NHẬP</h3>
            <div class="dn_row">
          		<span class="left">Mã số:</span>
          		<span class="right"><input name="txtmaso" type="text" size="25"/></span>
            </div>
            <div class="dn_row">
          		<span class="left">Mật khẩu: </span>
          		<span class="right"><input name="txtmatkhau" type="password" size="25"/></span>
            </div>
          	<div class="dn_row" align="center">
          		<input name="btndangnhap" type="submit" value="Đăng nhập" onclick="return check();" />
            </div>
        </div>					
    </div>
</form>
 

