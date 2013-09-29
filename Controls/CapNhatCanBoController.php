<?php
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CanBo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    $maso = trim($_POST['txtmaso']);    
    $holot = trim(substr($_POST['txthoten'],0,strrpos($_POST['txthoten'],' ')));
    $ten = trim(substr($_POST['txthoten'],strrpos($_POST['txthoten'],' ')));
    $mabm = $_POST['cbobomon'];
	$makhoa = $_POST['cbokhoa'];
    
    $cb = new CanBo();
    $cb->setMaSo($maso);
    $cb->setHoLot($holot);
    $cb->setTen($ten);
    
    
    if (isset($_POST['btnthem'])){
        
        if ($cb->isExits("NguoiDung","ND_ID='".$cb->getMaSo()."'") > 0){
             echo "<script language=javascript> alert('Cán bộ đã tồn tại!'); </script>";
             require('Views/CapNhatCanBo.php');
        }else if ($cb->isExits("BoMon","BM_Ma='".$mabm."'") <= 0){
             echo "<script language=javascript> alert('Không tồn tại khoa và bộ môn này!'); </script>";
             require('Views/CapNhatCanBo.php');
        }
        else{
            mysql_query("BEGIN TRAN");
            $i = 0;
            $user = new NguoiDung();
            $user->setMaSo(trim($maso));
            $user->setMatKhau(md5('123456'));
            $user->setMaQuyen('CB');
            $i = 0;
            if ($user->themNguoiDung() > 0){
                if ($cb->themCanBo($mabm) > 0) { $i = 1; mysql_query("COMMIT");   }                 
            }
            if ($i > 0){
                echo "<script language=javascript> alert('Đã thêm thành công!'); </script>";
                require('Views/CapNhatCanBo.php');
            }
            else{
                echo "<script language=javascript> alert('Thêm không được!'); </script>";
                require('Views/CapNhatCanBo.php');
            }
        }
		
    }
	else if (isset($_POST['btnsua'])){
			 if ($cb->isExits("NguoiDung","ND_ID='".$cb->getMaSo()."'") <= 0){
             echo "<script language=javascript> alert('Cán bộ không tồn tại!'); </script>";
             require('Views/CapNhatCanBo.php');
        }else if ($cb->isExits("BoMon","BM_Ma='".$mabm."'") <= 0){
             echo "<script language=javascript> alert('Không tồn tại khoa và bộ môn này!'); </script>";
             require('Views/CapNhatCanBo.php');
        }
			else{
				mysql_query("BEGIN TRAN");
				$i = 0;
				if ($cb->suaCanBo2() > 0){ mysql_query("COMMIT"); $i = 1;}					
				
				if ($i > 0){
					echo "<script language=javascript> alert('Đã sửa thành công!'); </script>";
					require('Views/CapNhatCanBo.php');
				}
				else{
					echo "<script language=javascript> alert('Sửa không được!'); </script>";
					require('Views/CapNhatCanBo.php');
				}
		}
	}
    else if (isset($_POST['btnxoa'])){
        if ($cb->isExits("NguoiDung","ND_ID='".$cb->getMaSo()."'") <= 0){
             echo "<script language=javascript> alert('Cán bộ không tồn tại!'); </script>";
             require('Views/CapNhatCanBo.php');
        }else if ($cb->isExits("BoMon","BM_Ma='".$mabm."'") <= 0){
             echo "<script language=javascript> alert('Không tồn tại khoa và bộ môn này!'); </script>";
             require('Views/CapNhatCanBo.php');
        }
        else{
            mysql_query("BEGIN TRAN");
            $i = 0;
            if ($cb->xoaCanBo() > 0){
                        $user = new NguoiDung();
                        $user->setMaSo(trim($maso));
                        if ($user->xoaNguoiDung() > 0){
                            
                            $i = 1;
                        }
            }  mysql_query("COMMIT"); 
                    
            
            if ($i > 0){
                echo "<script language=javascript> alert('Đã xóa thành công!'); </script>";
                require('Views/CapNhatCanBo.php');
            }
            else{
                echo "<script language=javascript> alert('Xóa không được!'); </script>";
                require('Views/CapNhatCanBo.php');
            }
        }
		
    }else if (isset($_POST['load'])){
         error_reporting(E_ALL ^ E_NOTICE);
        require_once 'excel_reader.php';
        //echo $_FILES["ex"]["tmp_name"];
        $data = new Spreadsheet_Excel_Reader($_FILES["file"]["tmp_name"],true,'UTF-8');
        //$data = new Spreadsheet_Excel_Reader('DSBM.xls',true,'UTF-8');
     //in ra tieu de cua bang ket qua
     echo "<table align='center' class='font'  width='450' border='0' cellspacing='0' cellpadding='0'>";
          echo "<tr>";
            echo "<td class='main_1'><img border='0' src='Libraries/images/tbl_left.gif' width='10' height='25' /></td>";
            echo "<td align='center' class='main_1' colspan='3'>Danh sách Thực Hiện Upload</td>";
            echo "<td class='main_1'><p align='right'><img border='0' src='Libraries/images/tbl_right.gif' width='10' height='25' /></p></td>";
          echo "</tr>";
          echo "<tr >";
            
                echo "<td width='30' align='center' class='main_3'>STT</td>";              
                echo "<td width='50' align='center' class='main_3'>Mã Bộ Môn </td>";
                  echo "<td width='50' align='center' class='main_3'>Mã Số CB </td>";
                echo "<td width='150' align='center' class='main_3'>Tên CB </td>";                
        		echo "<td width='50' align='center' class='main_3'>Trạng Thái</td>";
                
                echo "</tr>";   
    echo  $data->rowcount($sheet_index=0);   	
    for($i=1;$i<=$data->rowcount($sheet_index=0);$i++)
    {
        $ci = ($i%2) + 1;
        echo "<tr>";
		echo "<td align='center' class='main_3'>".$i."</td>";
        echo "<td class='level_1_$ci' align='center'>".$data->val($i,'A')."</td>";
		echo "<td class='level_1_$ci' align='center'>".$data->val($i,'B')."</td>";
        echo "<td class='level_1_$ci' align='left'>".$data->val($i,'C')."</td>";        		
    
    
    $holot = trim(substr($data->val($i,'C'),0,strrpos($data->val($i,'C'),' ')));
    $ten = trim(substr($data->val($i,'C'),strrpos($data->val($i,'C'),' ')));
    $mabm = $data->val($i,'A');	   
    $cb = new CanBo();
    $cb->setMaSo($data->val($i,'B'));
    $cb->setHoLot($holot);
    $cb->setTen($ten);
                
    $user = new NguoiDung();
    $user->setMaSo(trim($data->val($i,'B')));
    $user->setMatKhau(md5('123456'));
    $user->setMaQuyen('CB');
    
    
    if ($user->isExits("NguoiDung","ND_ID='".$user->getMaSo()."'") <= 0  ){
         
         if ($user->themNguoiDung() > 0){
            if ($cb->themCanBo($mabm) > 0)  echo "<td class='level_1_$ci' align='center'>OK</td></tr>";               
        } else{
                	echo "<td class='level_1_$ci' align='center'>bị trùng</td></tr>";
            } 
        }
        else{
            //khoa da ton tai
            	echo "<td class='level_1_$ci' align='center'>bị trùng</td></tr>";
        }
               
    } 
    echo "</table><br/><br/>"; 
     //include
     require('Views/CapNhatCanBo.php');
    }
	else require('Views/CapNhatCanBo.php');
    
  }                                
  else include_once('Views/CapNhatCanBo.php');
?>
