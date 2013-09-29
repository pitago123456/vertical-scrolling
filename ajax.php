<?php

/**
 * @author lioxca
 * @copyright 2012
 */
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CanBo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/QuanLyKhoaHoc.php');
    
    if(isset($_GET['id'])){
        $cb = new CanBo();
        $cb->setMaSo($_GET['id']);
        if ($cb->isExits("NguoiDung","ND_ID='".$cb->getMaSo()."'") <= 0){
				 echo "0";
				 	}
        else{
        $res = mysql_fetch_array($cb->thongtinCanBo());
        echo $res['CB_HoTen'];
        }
    } else if(isset($_GET['maso']) && isset($_GET['khoa'])&& isset($_GET['bomon'])){
            
        $canbo = new CanBo();
        $canbo->setMaSo($_GET['maso']);                      
        $res = $canbo->thongtinCanBo2(' and BM_Ma='.$_GET['bomon']);
        while($row=mysql_fetch_array($res))
            {
                echo $row['CB_HoTen'];
            }
            
        }
    else if(isset($_GET['masocbql']) ){
            
        $quanly = new QuanLyKhoaHoc();
        $quanly->setMaSo($_GET['masocbql']);                      
        $res = $quanly->thongtinQuanLy();
        while($row=mysql_fetch_array($res))
            {
                echo $row['QL_HoTen'];
            }
            
        }
    else if(isset($_GET['khoa'])){
            
        $bomon = new BoMon();
        echo '<select name="cbobomon" id="cbobm"><option value="">Tất cả</option>';                        
        $res = $bomon->dsBM($_GET['khoa']);
        while($row=mysql_fetch_array($res))
            {
                echo '<option value="'.$row['BM_Ma'].'">'.$row['BM_Ten'].'</option>';
            }
         echo '</select>';   
    }


?>