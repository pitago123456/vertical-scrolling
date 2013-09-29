<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
        $khoa = new Khoa();
        $res=$khoa->dsKhoa();

?>
<script language="javascript">
function checkField(){
	var loaicb = document.capnhatcanbo.cboloaicb.value;
	var maso = document.capnhatcanbo.txtmaso.value;
	var holot = document.capnhatcanbo.txtholot.value;
	var ten = document.capnhatcanbo.txtten.value;
	var ngaysinh = document.capnhatcanbo.txtngaysinh.value;
	var indexphai = document.capnhatcanbo.cbophai.selectedIndex;
	var sodt = document.capnhatcanbo.txtsodt.value;
	var diachi = document.capnhatcanbo.txtdiachi.value;
	var email = document.capnhatcanbo.txtemail.value;
	var indexhocvi = document.capnhatcanbo.cbohocvi.selectedIndex;
	var nghiepvu = document.capnhatcanbo.txtnghiepvu.value;
	
	var indexchucdanh = document.capnhatcanbo.cbochucdanh.selectedIndex;
	
	var indexbomon = document.capnhatcanbo.cbobomon.selectedIndex;
	if (loaicb="" || maso == "" || holot == "" || ten == "" || ngaysinh == "" || sodt == "" || diachi == "" || email == "" || indexhocvi == 0 ){
		alert("Xin vui lòng nhập đầy đủ thông tin được yêu cầu!");
		return false;
	}
	else if (holot.length > 40){
		alert("Họ lót có độ dài không quá 40 kí tự!");
		return false;
	}
	else if (ten.length > 10){
		alert("Tên có độ dài không quá 10 kí tự!");
		return false;
	}
	else if (sodt.length > 12){
		alert("Số điện thoại có độ dài không quá 12 kí tự!");
		return false;
	}
	else if (diachi.length > 100){
		alert("Địac chỉ có độ dài không quá 100 kí tự!");
		return false;
	}
	else if (email.length > 50){
		alert("Email có độ dài không quá 50 kí tự!");
		return false;
	}
	else if (loaicb=="DT" || loaicb=="AD"){
	 
	 	if (nghiepvu == ""){
			alert("Xin vui lòng nhập đầy đủ thông tin được yêu cầu!");
			return false;
		}
		else if (nghiepvu.length > 100){
			alert("Nghiệp vụ có độ dài không quá 100 kí tự!");
			return false;
		}
	 }
	 else{
	 	if ( indexchucdanh == 0 || indexbomon == 0){
			alert("Xin vui lòng nhập đầy đủ thông tin được yêu cầu!");
			return false;
		}
	 
	 }
	 return true;
}
function nhap(loaicb){
    
    if (loaicb=="DT" || loaicb=="AD"){
        document.capnhatcanbo.txtnghiepvu.disabled = false;
        //document.capnhatcanbo.cbokhoa.disabled = true;
        document.capnhatcanbo.cbobomon.disabled = true;
        document.capnhatcanbo.cbochucvu.disabled = true;
		document.capnhatcanbo.cbochucdanh.disabled = true;
    }
	else{
        document.capnhatcanbo.txtnghiepvu.disabled = true;
	 	//document.capnhatcanbo.cbokhoa.disabled = false;
        document.capnhatcanbo.cbobomon.disabled = false;
        document.capnhatcanbo.cbochucvu.disabled = false;
		document.capnhatcanbo.cbochucdanh.disabled = false;
	}
}


function empty(){
	//document.capnhatcanbo.cboloaicb.selectedIndex = 0;
	document.capnhatcanbo.txtmaso.value = "";
	document.capnhatcanbo.txtholot.value = "";
	document.capnhatcanbo.txtten.value = "";
	document.capnhatcanbo.txtngaysinh.value = "";
	document.capnhatcanbo.cbophai.selectedIndex = 0;
	document.capnhatcanbo.txtsodt.value = "";
	document.capnhatcanbo.txtdiachi.value = "";
	document.capnhatcanbo.txtemail.value = "";
	document.capnhatcanbo.cbohocvi.selectedIndex = 0;
	document.capnhatcanbo.txtnghiepvu.value = "";
	document.capnhatcanbo.cbobomon.selectedIndex = 0;
	document.capnhatcanbo.cbochucdanh.selectedIndex = 0;
	document.capnhatcanbo.cbochucvu.selectedIndex = 0;
	//document.capnhatcanbo.btnsua.disabled=true;
    //document.capnhatcanbo.btnxoa.disabled=true;
	
}
function confirmDelete(){
    if (confirm("Bạn có chắc muốn cán bộ này không?")){
        return true;
    }
    return false;
    
}
function confirmUpdate(){
    if (confirm("Bạn có chắc muốn sửa thông tin của cán bộ này không?")){
        return true;
    }
    return false;
    
}
</script>
<!---------------------------------phan auto complete------------------------------------------------------->
<link rel="stylesheet" href="./Libraries/css/jquery.ui.all.css"/>	
	<script src="./Libraries/js/jquery.ui.core.js"></script>
	<script src="./Libraries/js/jquery.ui.widget.js"></script>
	<script src="./Libraries/js/jquery.ui.position.js"></script>
	<script src="./Libraries/js/jquery.ui.autocomplete.js"></script>
	<style>
	.ui-autocomplete-loading { background: white url('./Libraries/images/ui-anim_basic_16x16.gif') right center no-repeat; }
	</style>
	<script>
	$(function() {
	   $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 1});       
              
	});
	</script>
<!---------------------------------het phan auto complete------------------------------------------------------->
<div id="main" class="min-height">
<link rel="stylesheet" type="text/css" href="./Libraries/css/capnhatcanbo.css" />
<script type="text/javascript" src="Libraries/js/capnhatcanbo.js"></script>

    <form name="capnhatcanbo" method="POST">
<table align="center" class="font" width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class=main_1><img border="0" src="Libraries/images/tbl_left.gif" width="10" height="25" /></td>
    <td align=center class=main_1>Cập Nhật Cán Bộ </td>
    <td class=main_1><p align="right"><img border="0" src="Libraries/images/tbl_right.gif" width="10" height="25" /></p></td>
  </tr>
  
  <tr bgcolor="#dae9f3">
    <td class="border_1" colspan="3" valign="top"><table width="700" border="0" align="center">
      <tr>
        <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
        <td width="80" align="right">Khoa: </td>
        <td>			
			<select name="cbokhoa" id="cbokhoa" onchange="return find_bm()">
              <option value=""></option>
              <?php
						
					$kh = new Khoa();
					
					$result = $kh->dsKhoa();
					while ($rows = mysql_fetch_array($result)){
						echo "<option value='".$rows['ND_ID']."'>".$rows['Khoa_Ten']."</option>";
					}
					 if (isset($_POST['cbokhoa'])) {
						
						echo "<script language=\"javascript\">";
						
						echo "for (var i = 0; i< document.capnhatcanbo.cbokhoa.length; i++){";
						echo "if (document.capnhatcanbo.cbokhoa[i].value == '$mabm'){";
						echo "document.capnhatcanbo.cbokhoa.selectedIndex = i;";
						echo "break;";
						echo "}";
						echo "}";
						
						echo "</script>";
					}		
						
				?>
            </select></td>
        <td width="80" align="right">Bộ Môn: </td>
        <td>			
		<div id="cbobomon">	<select name="cbobomon" >
              <option value=""></option>
            </select>
        </div>
            </td>
        </tr>
      <tr>
        
        <td width="80" align="right">MSCB: </td>
        <td width="93">
			<input class="a_getid" name="txtmaso" type="text" id="txtmaso" size="15" onkeyup="hienThiThongTinCB(this.value);"/>
			<?php 
				if (isset($_POST['txtmaso'])){
                    echo "<script language=\"javascript\">document.capnhatcanbo.txtmaso.value='$maso'</script>";
                }
			?>		
        </td>
            
        <td width="80" align="right">Họ Tên: </td>
        <td width="190">
			<input name="txthoten" type="text" id="txthoten" size="20"/>
			<?php 
				if (isset($_POST['txthoten'])){
                    echo "<script language=\"javascript\">document.capnhatcanbo.txthoten.value='$holot'</script>";
                }
			?>
		</td>
      </tr>
      
      <tr>
        <td colspan="6" align="center"><input type="button" name="btntaomoi" value="Tạo mới" class="button_1" onclick="empty();taoMaCB();"/>&nbsp;
			<input type="submit" name="btnthem" value="Thêm" class="button_1" onclick="return checkField();"/>&nbsp;
			<input type="submit" name="btnsua" value="Sửa" class="button_1" onclick="return checkField();"/>&nbsp;
			<input type="submit" name="btnxoa" value="Xóa" class="button_1" onclick="confirmDelete();"/>		</td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
</div>