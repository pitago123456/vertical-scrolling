<?php
  
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/QuanLyKhoaHoc.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $cbql = new QuanLyKhoaHoc();
    $macb = $_POST['txtmaso'];
    $tenquanly = $_POST['txttenquanly'];
    $cbql->setMaSo($macb);
    $cbql->setTenQuanLy($tenquanly);
    
    
    if (isset($_POST['btnthem'])){
    $user = new NguoiDung();
    $user->setMaSo(trim($macb));
    $user->setMatKhau(md5('123456'));
    $user->setMaQuyen('QL');
    $user->themNguoiDung();
        if ($cbql->isExits("QuanLyKhoaHoc","ND_ID='".$cbql->getMaSo()."'") <= 0  ){
            if ($cbql->themQuanLy() > 0){
                echo "<script language=javascript> alert('Đã thêm thành công!'); </script>";
                 require('Views/CapNhatQuanLy.php');
            }
            else{
                echo "<script language=javascript> alert('Không thêm được!'); </script>";
                 require('Views/CapNhatQuanLy.php');
            } 
        }
        else{
            echo "<script language=javascript> alert('Mã CB Quản Lý đã tồn tại, vui lòng nhập mã khác!'); </script>";
            require('Views/CapNhatQuanLy.php');
        }
         
    }
    if (isset($_POST['btnsua'])){
       
            if ($cbql->suaQuanLy() > 0){
                echo "<script language=javascript> alert('Đã sửa thành công!'); </script>";
                 require('Views/CapNhatQuanLy.php');
            }
            else{
                echo "<script language=javascript> alert('Không sửa được!'); </script>";
                 require('Views/CapNhatQuanLy.php');
            } 
        
         
    }
    if (isset($_POST['btnxoa'])){
       
               if ($cbql->xoaQuanLy() > 0){
                $user = new NguoiDung();
                $user->setMaSo(trim($macb));
                $user->xoaNguoiDung();
                echo "<script language=javascript> alert('Đã xóa thành công!'); </script>";
                 require('Views/CapNhatQuanLy.php');
            }
            else{
                echo "<script language=javascript> alert('Không xóa được!'); </script>";
                 require('Views/CapNhatQuanLy.php');
            } 
        
         
    }
    if (isset($_POST['load'])){
      error_reporting(E_ALL ^ E_NOTICE);
        require_once 'excel_reader.php';
        $data = new Spreadsheet_Excel_Reader($_FILES["file"]["tmp_name"],true,'UTF-8');
     //in ra tieu de cua bang ket qua
     echo "<table align='center' class='font' width='450' border='0' cellspacing='0' cellpadding='0'>";
          echo "<tr>";
            echo "<td class='main_1'><img border='0' src='Libraries/images/tbl_left.gif' width='10' height='25' /></td>";
            echo "<td align='center' class='main_1' colspan='2'>Danh sách Thực Hiện Upload</td>";
            echo "<td class='main_1'><p align='right'><img border='0' src='Libraries/images/tbl_right.gif' width='10' height='25' /></p></td>";
          echo "</tr>";
          echo "<tr >";
            
                echo "<td width='30' align='center' class='main_3'>STT</td>";
                echo "<td width='50' align='center' class='main_3'>Mã CBQL </td>";
                echo "<td width='200' align='center' class='main_3'>Tên CBQL </td>";                
        		echo "<td width='50' align='center' class='main_3'>Trạng Thái</td>";
                
                echo "</tr>";   
        	
    for($i=1;$i<=$data->rowcount($sheet_index=0);$i++)
    {
        $ci = ($i%2) + 1;
        echo "<tr>";
		echo "<td align='center' class='main_3'>".$i."</td>";
        echo "<td class='level_1_$ci' align='center'>".$data->val($i,'A')."</td>";
		echo "<td class='level_1_$ci' align='left'>".$data->val($i,'B')."</td>";        		
        			
    //echo '<pre>Mã Khoa: '.$data->val($i,'A').' Tên Khoa: '.$data->val($i,'B').'</pre>';
    $cbqle = new QuanLyKhoaHoc();
    $macb = $data->val($i,'A');
    $tenquanly = $data->val($i,'B');
    $cbql->setMaSo($macb);
    $cbql->setTenQuanLy($tenquanly);    
    $user = new NguoiDung();
    $user->setMaSo(trim($macb));
    $user->setMatKhau(md5('123456'));
    $user->setMaQuyen('QL');
    $user->themNguoiDung();
    if ($cbql->isExits("QuanLyKhoaHoc","ND_ID='".$cbql->getMaSo()."'") <= 0  ){
            if ($cbql->themQuanLy() > 0){
        			echo "<td class='level_1_$ci' align='center'>OK</td></tr>";
            }
            else{
                	echo "<td class='level_1_$ci' align='center'>bị trùng</td></tr>";
            } 
        }
        else{
            //QuanLy da ton tai
            	echo "<td class='level_1_$ci' align='center'>bị trùng</td></tr>";
        }
               
    } 
    echo "</table><br/><br/>"; 
     //include
     require('Views/CapNhatQuanLy.php');
    }
  }                                
  else include_once('Views/CapNhatQuanLy.php');
?>
