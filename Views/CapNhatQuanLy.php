<?php 
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/QuanLyKhoaHoc.php');
?>
<script type="text/javascript">

function getValue(id){        
	document.capnhatquanly.txtmaso.value=document.getElementById("maso" + id).innerHTML;
	document.capnhatquanly.txtmaso.readOnly = true;
    document.capnhatquanly.txtmaso.style.backgroundColor = '#cccccc'; 
	document.capnhatquanly.txttenquanly.value=document.getElementById("tenquanly" + id).innerHTML;
    document.capnhatquanly.btnsua.disabled=false;
    document.capnhatquanly.btnxoa.disabled=false;
	
}
function confirmDelete(){
    if (confirm("Bạn có chắc muốn xóa cán bộ quản lý khoa học này không?")){
        return true;
    }
    return false;
    
}
function confirmUpdate(){
    if (confirm("Bạn có chắc muốn sửa thông tin của cán bộ quản lý khoa học này không?")){
        return true;
    }
    return false;
    
}
function checkField(){
	if ( document.capnhatquanly.txtmaso.value == "" || document.capnhatquanly.txttenquanly.value == ""){
		alert("Mã số và tên cán bộ quản lý khoa học không được để trống");
		return false;
	}
    
    if (document.capnhatquanly.txttenquanly.value.length >80 ){
		alert("Tên cán bộ quản lý khoa học có chiều dài không quá 80 kí tự!");
        document.capnhatquanly.txttenquanly.focus = true;
		return false;
	}
	return true;
}
function empty(){
	document.capnhatquanly.txtmaso.value = "";
    
	document.capnhatquanly.txtmaso.readOnly = false;
    document.capnhatquanly.txtmaso.style.backgroundColor = '#ffffff'; 
	document.capnhatquanly.txttenquanly.value = "";
	document.capnhatquanly.btnsua.disabled=true;
    document.capnhatquanly.btnxoa.disabled=true;
	document.capnhatquanly.txtmaso.focus();
}
function find_hoten() //ham lay thong tin ten cua can bo bang ma so
    {        
    
    maso = document.getElementById('txtmaso').value;
    //alert(maso);
    
    var xmlhttp;
    if (window.XMLHttpRequest)
      { //code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      { //code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
         document.getElementById('txttenquanly').value =xmlhttp.responseText;
        // alert(xmlhttp.responseText);    	   
         xmlhttp = null;          
           
        }
      }
     xmlhttp.open("GET","ajax.php?masocbql="+maso+"&q="+Math.random(),true);
     xmlhttp.send();
    
    return false;
    }    

</script>


<div class="min-height">
<form name="capnhatquanly" method="POST" enctype="multipart/form-data">
<table align="center" class="font" width="450" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class=main_1><img border="0" src="Libraries/images/tbl_left.gif" width="10" height="25" /></td>
    <td align=center class=main_1>Cập Nhật Cán Bộ Quản Lý Khoa Học </td>
    <td class=main_1><p align="right"><img border="0" src="Libraries/images/tbl_right.gif" width="10" height="25" /></p></td>
  </tr>
  <tr bgcolor="#dae9f3">
    <td class="border_1" colspan="3" valign="top"><table width="420" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>Mã Số: </td>
        <td colspan="3"><input type="text" name="txtmaso" autocomplete="off" id="txtmaso" size="10" onkeyup="find_hoten();" onchange="find_hoten();" maxlength="100" /><br/>
       
</td>
        </tr>
      <tr>
        <td>Tên CBQL: </td>
        <td align="left" style="font-size: 12;"><input name="txttenquanly" id="txttenquanly" type="text" size="40" maxlength="100" /></td>
         <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $maso = $_POST['txtmaso'];
                $tenquanly = $_POST['txttenquanly'];
                echo "<script language=\"javascript\">";
                echo "document.capnhatquanly.txtmaso.value='$maso';";
                echo "document.capnhatquanly.txttenquanly.value='$tenquanly';";
                echo "</script>";
            }
        ?>
        </tr>
        
      <tr>
        <td colspan="4" align="center"><input name="btntaomoi" type="button" class="button_1" id="btntaomoi" value="Tạo mới" onclick="empty();"/>
          <input type="submit" name="btnthem" value="Thêm" class="button_1" onclick="return checkField();"/>
            <input type="submit" name="btnsua" value="Sửa" class="button_1"  onclick="return confirmUpdate();"/>
            <input type="submit" name="btnxoa" value="Xóa" class="button_1"   onclick="return confirmDelete();"/>        </td>
      </tr>
      <tr>
        <td colspan="4"><input type="file" name="file"  />
        <input type="submit" name="load" class="button_1" value="upload file Excel" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<br/>
<br/>
 
</form>
</div>


