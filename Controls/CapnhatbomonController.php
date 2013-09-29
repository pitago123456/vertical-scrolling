<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mabm = $_POST['txtmabm'];
        $tenbm = $_POST['txttenbm'];
        $makhoa = $_POST['cbokhoa'];
        $bm = new BoMon();
        $bm->setMaBM($mabm);
        $bm->setTenBM($tenbm);
        $bm->setMaSo($makhoa);
        if (isset($_POST['btnthem'])){
            if ($bm->isExits("BoMon","BM_Ma='".$bm->getMaBM()."'") > 0  ){
                echo "<script language=javascript> alert('Mã b? môn dã t?n t?i, vui lòng nh?p mã khác!'); </script>";
                require("Views/Capnhatbomon.php");
            }
            else{
                if ($bm->themBM() > 0){
                    echo "<script language=javascript> alert('Ðã thêm thành công!'); </script>";
                    require("Views/Capnhatbomon.php");
                }
                else{
                    echo $bm->getQuery();
                    echo "<script language=javascript> alert('Không thêm du?c!'); </script>";
                    require("Views/Capnhatbomon.php");
                } 
                
            }
             
        }
        else if (isset($_POST['btnsua'])){
           
                if ($bm->suaBM() > 0){
                    echo "<script language=javascript> alert('Ðã s?a thành công!'); </script>";
                    require("Views/Capnhatbomon.php");
                }
                else{
                    echo "<script language=javascript> alert('Không s?a du?c!'); </script>";
                    require("Views/Capnhatbomon.php");
                } 
            
             
        }
        else if (isset($_POST['btnxoa'])){
            
            if ($bm->isExits("CanBo","BM_Ma='".$bm->getMaBM()."'") > 0  ){
                echo "<script language=javascript> alert('Không th? xóa b? môn này. Ð? xóa xin vui lòng xóa h?t các cán b? thu?c b? môn này!'); </script>";
                require("Views/Capnhatbomon.php");
                
            }
            else{
                if ($bm->xoaBM() > 0){
                    echo "<script language=javascript> alert('Ðã xóa thành công!'); </script>";
                    require("Views/Capnhatbomon.php");
                }
                else{
                    echo "<script language=javascript> alert('Không xóa du?c!'); </script>";
                    require("Views/Capnhatbomon.php");
                } 
            }
             
        }
         else if (isset($_POST['load'])){
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
                echo "<td width='50' align='center' class='main_3'>Mã Khoa </td>";
                echo "<td width='50' align='center' class='main_3'>Mã Bộ Môn </td>";
                echo "<td width='150' align='center' class='main_3'>Tên Bộ Môn </td>";                
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
    
    $bmon = new BoMon();
    $bmon->setMaSo($data->val($i,'A'));
    $bmon->setMaBM($data->val($i,'B'));
    $bmon->setTenBM($data->val($i,'C'));
    
    if ($bmon->isExits("BoMon","BM_Ma='".$bmon->getMaBM()."'") <= 0  ){
            if ($bmon->themBM() > 0){
        			echo "<td class='level_1_$ci' align='center'>OK</td></tr>";
            }
            else{
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
     require("Views/Capnhatbomon.php");
    }
      else  require("Views/Capnhatbomon.php");
            
    }                                
    else include_once('Views/Capnhatbomon.php');
?>
