<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
?>
<script type="text/javascript">

function getValue(id){
    
    
	document.capnhatbm.txtmabm.value=document.getElementById("mabm" + id).innerHTML;
    document.capnhatbm.txttenbm.value=document.getElementById("tenbm" + id).innerHTML;
   	document.capnhatbm.txtmabm.readOnly = true;
	document.capnhatbm.txtmabm.style.backgroundColor = '#cccccc'; 	
    document.capnhatbm.btnsua.disabled=false;
    document.capnhatbm.btnxoa.disabled=false;
	
}
function confirmDelete(){
    if (confirm("Bạn có chắc muốn xóa bộ môn này không?")){
        return true;
    }
    return false;
    
}
function confirmUpdate(){
    if (confirm("Bạn có chắc muốn sửa thông tin của bộ môn này không?")){
        return true;
    }
    return false;
    
}
function checkField(){
	if (document.capnhatbm.txtmabm.value == "" || document.capnhatbm.txttenbm.value == ""){
		alert("Mã bộ môn và tên bộ môn không được để trống!");
		return false;
	}
    
    if (document.capnhatbm.txttenbm.value.length > 80){
        alert("Tên bộ môn có chiều dài không quá 80 kí tự!");
        return false;
    }   
	return true;
}

function empty(){
    document.capnhatbm.txtmabm.value = "";
	document.capnhatbm.txttenbm.value = "";
	document.capnhatbm.txtmabm.style.backgroundColor = '#ffffff'; 
	document.capnhatbm.txtmabm.readOnly = false;
	document.capnhatbm.btnsua.disabled=true;
    document.capnhatbm.btnxoa.disabled=true;
	document.capnhatbm.txtmabm.focus();
}


</script>

<body>
<div class="min-height">
<form name="capnhatbm" method="POST" enctype="multipart/form-data">
<table align="center" class="font" width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class='main_1'><img border="0" src="Libraries/images/tbl_left.gif" width="10" height="25" /></td>
    <td align=center class=main_1>Cập Nhật Bộ Môn </td>
    <td class=main_1><p align="right"><img border="0" src="Libraries/images/tbl_right.gif" width="10" height="25" /></p></td>
  </tr>
  <tr bgcolor="#dae9f3">
    <td class="border_1" colspan="3" valign="top"><table width="380" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>Khoa</td>
        <td>
			<select name="cbokhoa" onchange="document.capnhatbm.submit();">
				<option value=" "></option>
				<?php
					$khoa = new Khoa();
					$result = $khoa->dsKhoa();
                    while ($rows = mysql_fetch_array($result)){
                        echo "<option value='".$rows['ND_ID']."'>".$rows['Khoa_Ten']."</option>";
                    }
				?>
			</select>
		</td>
      </tr>
      <tr>
        <td>Mã BM </td>
        <td colspan="3"><input name="txtmabm" type="text" id="txtmabm" size="10" maxlength="100" ></td>
        </tr>
      <tr>
        <td>Tên BM </td>
        <td align="left" style="font-size: 12;"><input name="txttenbm" type="text" id="txttenbm" size="40" maxlength="100" /></td>
         <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //$makhoa = $_POST['cbokhoa'];
                //$tenkhoa = $_POST['txttenkhoa'];
                echo "<script language=\"javascript\">";
                
                echo "for (var i = 0; i< document.capnhatbm.cbokhoa.length; i++){";
                echo "if (document.capnhatbm.cbokhoa[i].value == '$makhoa'){";
                echo "document.capnhatbm.cbokhoa.selectedIndex = i;";
                echo "break;";
                echo "}";
                echo "}";
               // echo "document.capnhatbm.txtmabm.value='$mabm';";
               // echo "document.capnhatbm.txttenbm.value='$tenbm';";
                echo "</script>";
            }
        ?>
        </tr>
      <tr>
        <td colspan="4" align="center"><input name="btntaomoi" type="button" class="button_1" id="btntaomoi" value="Tạo mới" onclick="empty();"/>
          <input type="submit" name="btnthem" value="Thêm" class="button_1" onclick="return checkField();"/>
            <input type="submit" name="btnsua" value="Sửa" class="button_1" disabled="true" onclick="return confirmUpdate();"/>
            <input type="submit" name="btnxoa" value="Xóa" class="button_1"  disabled="true" onclick="return confirmDelete();"/>        
          </td>
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
//if ($_SERVER['REQUEST_METHOD'] == 'POST') 
//{
    
    if (isset($_POST['cbokhoa'])){
	$bm = new BoMon();    
	$result = $bm->dsBM($makhoa);
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
                echo "<td width='50' align='center' class='main_3'>Mã BM </td>";
                echo "<td width='200' align='center' class='main_3'>Tên Bộ Môn </td>";
               
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
        			echo "<td class='level_1_$ci' align='center'><div id='mabm$i'>".$row['BM_Ma']."</div></td>";
        			echo "<td class='level_1_$ci' align='center'><div id='tenbm$i'>".$row['BM_Ten']."</div></td>";
                    
        			
        		
        			echo "<td class='level_1_$ci' align='center'><input type='radio' name='chkchon' value='$i' onclick='getValue(this.value);'></td>";
        		
        			echo "</tr>";
        		
        			if($i==$end) echo "<tbody style='display:none;'>";
        		}
        		echo "</tbody>";
        	
        
        
              echo "<tr>";
                echo "<td align='left' colspan='2'><span style=' color:#008000'>Tổng số:$num";
                  
                echo "</span></td>";               
              echo "</tr>";
            echo "</table></td>";
          echo "</tr>";
        echo "</table>";
    }
//}
?>
</form>
</div>
</body>

