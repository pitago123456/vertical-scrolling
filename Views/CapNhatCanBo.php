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

	var maso = document.capnhatcanbo.txtmaso.value;
	var ten = document.capnhatcanbo.txthoten.value;	
	var khoa = document.capnhatcanbo.cbokhoa.value;
	var bomon = document.capnhatcanbo.cbobomon.value; 
	
    if ( khoa ==''){
		alert("Xin vui lòng chọn khoa!");
		return false;
	}else if (bomon==''){
		alert("Xin vui lòng chọn bộ môn!");
		return false;
	}else if ( maso == ""){
		alert("Xin vui lòng nhập mã số!");
		return false;
	}else if(ten == ""){
	   alert("Xin vui lòng nhập họ tên!");
		return false;
	}
	 
    return true;
}

function empty(){
	document.capnhatcanbo.txtmaso.value = "";
    document.capnhatcanbo.txtmaso.focus();
	document.capnhatcanbo.txthoten.value = "";
	//document.capnhatcanbo.btnsua.disabled=true;
    //document.capnhatcanbo.txthoten.disabled=false;
    //document.capnhatcanbo.btnxoa.disabled=true;
	
}
function confirmDelete(){
    if (confirm("Bạn có chắc muốn xóa cán bộ này không?")){
        checkField();
    }
    return false;
    
}
function confirmUpdate(){
    if (confirm("Bạn có chắc muốn sửa thông tin của cán bộ này không?")){
        checkField();
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

    <form name="capnhatcanbo" method="POST" enctype="multipart/form-data">
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
        <td>
         <div class="box">
        <span>Khoa:</span>    
        <select name="cbokhoa" id="cbokhoa" onchange="return find_bm();">
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
    </select>    
    <span>Bộ Môn:</span>
    <div id="cbobomon">   
    <select  name="cbobomon" id="cbobm">
                          <option value="">Tất cả</option>                          
    </select>
    </div> 
    </div>
    <div class="box">
    <span>Mã số cán bộ: </span>
     <input  type="text" class="a_getid" placeholder="Nhập mã số" name="txtmaso" id="txtmaso" onkeyup="find_hoten();" onchange="find_hoten();" size="8" maxlength="8" />
     <?php 
				if (isset($_POST['txtmaso'])){
                    echo "<script language=\"javascript\">document.capnhatcanbo.txtmaso.value='$maso'</script>";
                }
    ?>
    <span>Họ tên cán bộ: </span>
     <input  type="text"  name="txthoten"  id="txthoten"  placeholder="Nhập họ tên" value="" size="30" maxlength="80"  />
     <?php 
				if (isset($_POST['txthoten'])){
                   // echo "<script language=\"javascript\">document.capnhatcanbo.txthoten.value='$holot'</script>";
                }
    ?>
     </div>
        
        
     </td></tr>
           
      <tr>
        <td colspan="6" align="center">
            <input type="button" name="btntaomoi" value="Tạo mới" class="button_1" onclick="empty();"/>&nbsp;
			<input type="submit" name="btnthem" value="Thêm" class="button_1" onclick="return checkField();"/>&nbsp;
			<input type="submit"  name="btnsua" value="Sửa" class="button_1" onclick="return checkField();"/>&nbsp;
			<input type="submit"  name="btnxoa" value="Xóa" class="button_1" onclick="return checkField();"/>		</td>
        </tr>
        <tr>
        <td colspan="6"><input type="file" name="file" style="min-width: 400px;" />
        <input type="submit" name="load" class="button_1" value="upload file Excel" /></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
</div>