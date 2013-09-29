<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
?>
<script type="text/javascript">

function getValue(id){        
	document.capnhatkhoa.txtmakhoa.value=document.getElementById("makhoa" + id).innerHTML;
	document.capnhatkhoa.txtmakhoa.readOnly = true;
    document.capnhatkhoa.txtmakhoa.style.backgroundColor = '#cccccc'; 
	document.capnhatkhoa.txttenkhoa.value=document.getElementById("tenkhoa" + id).innerHTML;
    document.capnhatkhoa.btnsua.disabled=false;
    document.capnhatkhoa.btnxoa.disabled=false;
	
}
function confirmDelete(){
    if (confirm("Bạn có chắc muốn xóa khoa này không?")){
        return true;
    }
    return false;
    
}
function confirmUpdate(){
    if (confirm("Bạn có chắc muốn sửa thông tin của khoa này không?")){
        return true;
    }
    return false;
    
}
function checkField(){
	if ( document.capnhatkhoa.txtmakhoa.value == "" || document.capnhatkhoa.txttenkhoa.value == ""){
		alert("Mã khoa và tên khoa không được để trống");
		return false;
	}
    
    if (document.capnhatkhoa.txttenkhoa.value.length >80 ){
		alert("Tên khoa có chiều dài không quá 80 kí tự!");
        document.capnhatkhoa.txttenkhoa.focus = true;
		return false;
	}
	return true;
}
function empty(){
	document.capnhatkhoa.txtmakhoa.value = "";
    
	document.capnhatkhoa.txtmakhoa.readOnly = false;
    document.capnhatkhoa.txtmakhoa.style.backgroundColor = '#ffffff'; 
	document.capnhatkhoa.txttenkhoa.value = "";
	document.capnhatkhoa.btnsua.disabled=true;
    document.capnhatkhoa.btnxoa.disabled=true;
	document.capnhatkhoa.txtmakhoa.focus();
}


</script>


<div class="min-height">
<form name="capnhatkhoa" method="POST" enctype="multipart/form-data">
<table align="center" class="font" width="450" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class=main_1><img border="0" src="Libraries/images/tbl_left.gif" width="10" height="25" /></td>
    <td align=center class=main_1>Cập Nhật Khoa </td>
    <td class=main_1><p align="right"><img border="0" src="Libraries/images/tbl_right.gif" width="10" height="25" /></p></td>
  </tr>
  <tr bgcolor="#dae9f3">
    <td class="border_1" colspan="3" valign="top"><table width="380" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>Mã khoa </td>
        <td colspan="3"><input type="text" name="txtmakhoa" size="10" maxlength="100" ><br>
       
</td>
        </tr>
      <tr>
        <td>Tên khoa </td>
        <td align="left" style="font-size: 12;"><input name="txttenkhoa" type="text" size="40" maxlength="100" /></td>
         <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $makhoa = $_POST['txtmakhoa'];
                $tenkhoa = $_POST['txttenkhoa'];
                echo "<script language=\"javascript\">";
                echo "document.capnhatkhoa.txtmakhoa.value='$makhoa';";
                echo "document.capnhatkhoa.txttenkhoa.value='$tenkhoa';";
                echo "</script>";
            }
        ?>
        </tr>
        
      <tr>
        <td colspan="4" align="center"><input name="btntaomoi" type="button" class="button_1" id="btntaomoi" value="Tạo mới" onclick="empty();"/>
          <input type="submit" name="btnthem" value="Thêm" class="button_1" onclick="return checkField();"/>
            <input type="submit" name="btnsua" value="Sửa" class="button_1" disabled="true" onclick="return confirmUpdate();"/>
            <input type="submit" name="btnxoa" value="Xóa" class="button_1"  disabled="true"  onclick="return confirmDelete();"/>        </td>
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
 <?php

	$khoa = new Khoa();
	$result = $khoa->dsKhoa();
        echo "<table align='center' class='font' width='450' border='0' cellspacing='0' cellpadding='0'>";
          echo "<tr>";
            echo "<td class='main_1'><img border='0' src='Libraries/images/tbl_left.gif' width='10' height='25' /></td>";
            echo "<td align='center' class='main_1'>Danh sách Khoa</td>";
            echo "<td class='main_1'><p align='right'><img border='0' src='Libraries/images/tbl_right.gif' width='10' height='25' /></p></td>";
          echo "</tr>";
          echo "<tr >";
            echo "<td class='border_1' colspan='3' valign='top'><table width='450' class='border_1' style='border:none' id='tbmain' cellpadding='0' cellspacing='0'>";
              echo "<tr>";
                echo "<td width='30' align='center' class='main_3'>STT</td>";
                echo "<td width='50' align='center' class='main_3'>Mã Khoa </td>";
                echo "<td width='200' align='center' class='main_3'>Tên Khoa </td>";
                
        		echo "<td width='50' align='center' class='main_3'>Chọn</td>";
                
                echo "</tr>";
             
          
        	
        		$curPg=1;
           		$bg=($curPg-1)*10+1;
        		$end=$bg+9;	
        		$num=mysql_num_rows($result);
        		$i=0;
        		$ci=0;
        		echo "<tbody style='display:none;'>";
        		while($row=mysql_fetch_array($result))
        		{
        			$i++;
        			$ci=2-$i%2;
        			if($i==$bg) echo "</tbody>";
        			echo "<tr>";
        			echo "<td align='center' class='main_3'>".$i."</td>";
        			echo "<td class='level_1_$ci' align='center'><div id='makhoa$i'>".$row['ND_ID']."</div></td>";
        			echo "<td class='level_1_$ci' align='left'><div id='tenkhoa$i'>".$row['Khoa_Ten']."</div></td>";
        		
        			
        		
        			echo "<td class='level_1_$ci' align='center'><input type='radio' name='chkchon' value='$i' onClick='getValue(this.value);' ></td>";
        		
        			echo "</tr>";
        		
        			if($i==$end) echo "<tbody style='display:none;'>";
        		}
        		echo "</tbody>";
        	
        
        
              echo "<tr>";
                echo "<td align='left' colspan='2'><span style=' color:#008000'>Tổng số khoa:$num";
                  
                echo "</span></td>";
                echo "<td align='right' colspan='2'><font color='green'>";
				//echo paging($num,$curPg,10,10,'index.php?option=capnhatkhoa');
				echo "</font></td>";
              echo "</tr>";
            echo "</table></td>";
          echo "</tr>";
        echo "</table>";
    //}
//}
?>
</form>
</div>


