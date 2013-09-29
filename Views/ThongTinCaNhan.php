<?php

/**
 * @author lioxca
 * @copyright 2012
 */
    include_once('Models/QuanLyKhoaHoc.php');
    include_once('Models/Khoa.php');
    $nmaquyen = $_SESSION['nmaquyen'];
    $nmaso = $_SESSION['nmaso'];
    


?>
    <link href="Libraries/css/thongtincanhan.css" rel="stylesheet" type="text/css"/>
        <div class="ttcanhan">
            <div class="color">
            <h3>Thông Tin Cá Nhân</h3>
            <div class="cn_row">
          		<span class="left">Họ Và Tên:</span>
          		<span class="right">
                  
              <?php
                
            	if($nmaquyen=='AD'){echo 'Admin '.$nmaso;}
                if($nmaquyen=='QL'){
                    
                $ql = new QuanLyKhoaHoc();
                $ql->setMaSo($nmaso);
                $row= mysql_fetch_array($ql->thongtinQuanLy()); 
                echo $row['QL_HoTen'];
                }
                if($nmaquyen=='KH'){
                    
                  $khoa = new Khoa();
                  $khoa->setMaSo($nmaso);
                  $row= mysql_fetch_array($khoa->thongtinKhoa());
                  echo $row['Khoa_Ten'];  
                }
             ?>
                  
                  </span>
            </div>
        </div>
        </div>