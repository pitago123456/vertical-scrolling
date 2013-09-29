<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    
    session_start();
    if(isset($_SESSION['nmaquyen']) && isset($_SESSION['nmaso'])){
    header("Content-Type: application/vnd.ms-word;");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Content-Disposition: attachment; filename=LLKH.doc"); 
    echo '<html><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'; 
      
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NgoaiNgu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/QuaTrinhCongTac.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/VaiTro.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/MucDo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/ViTri.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CongTrinhKhoaHoc.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DongTacGia.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/TenDTG.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Configs/database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CanBo.php');
    
    $quyen = $_SESSION['nmaquyen'];
    if($quyen=='QL' || $quyen=='KH')    $maso = $_GET['maso'];
    else if($quyen=='CB') $maso = $_SESSION['nmaso'];
     
    $cb = new CanBo();
    $cb->setMaSo($maso);
    $result = $cb->thongtinCanBo();
    $rows = mysql_fetch_array($result);
    

    ?>  
    <style type="text/css">
<!--
body{
    font-size: 17px;
    font-family: Times New Roman;
    
}  
.right{
    text-decoration: none;
    text-align: right;
    height: 20px;
}
.main-content{
    
    width:100%;
    margin-top: 15px;
    float: left;
    padding: 4px 4px 15px 4px;
      
}
.bgedit{
   width: 100%;
   height: auto; 
   position :relative; 
}
table.ref
{
border: 1px solid black;
border-collapse:collapse;
width:100%;
margin: 0 auto;
font-size: 17px;

}
table.ref td,th 
{
border:1px solid black;
padding:3px;
vertical-align:top;
}
.row {
    clear:both;
    width:90%;
    margin:0 auto;
   
}
.row2 {
    clear:both;
    padding-left:19%;
    width: 100%;
}

.bch{ 
    float:left;
    width:48%; 
   margin:4px 0 0 0;
 }
.bcw{ 
    float:left;
    width:100%; 
   margin:4px 0 0 0;
 }
.bcw2{ 
    float:left;
    width:100%; 
   margin:0 0 0 20px;
 }
  

.line {
    border-bottom:1px solid #000;
    height:15px;
    }
.mini_line {    
    height:15px;
    width: 100%;
    margin: 0 auto;
    }

-->
</style>
<body>
    <div class="main-content">
        <div style="text-align: center; margin: -15 0 0 0;" ><h2> Phụ Lục V</h2></div>
        <div style="text-align: center; margin: -15 0 0 0;" ><h2> LÝ LỊCH KHOA HỌC</h2></div>
        <div style="text-align: center; margin: -15 0 0 0;" >(Kèm theo Thông tư số: 08/2011/TT-BGDĐT ngày 17 tháng 2 năm 2011</div>
        <div style="text-align: center;" > của Bộ trưởng Bộ Giáo dục và Đào Tạo)</div>
        
        <table style="width:100%; border-bottom:1px solid #000;"></table>
      <div class="info-edit">
            <div id="lylichsoluoc" style="float:left;width:48%; margin:4px 0 0 0;" >
            <h3> I. LÝ LỊCH SƠ LƯỢC</h3>
            
            </div> <!--  END lylichsoluoc -->
             <div class="bgedit" id="peinfo"> 
             <table style="width: 100%;">
             <tr><td style="width: 50%;">Họ Và Tên: <?php echo $rows['CB_HoTen'] ; $hoten = $rows['CB_HoTen']; ?></td>
             <td style="width: 50%;">Giới Tính: <?php if($rows['CB_Phai']=='0') echo 'Nam' ; else  echo 'Nữ' ;?></td></tr>
             
             <tr><td style="width: 50%;">Ngày Sinh: <?php echo $rows['CB_NgaySinh'] ; ?></td>
             <td style="width: 50%;">Nơi Sinh: <?php  echo $rows['CB_NoiSinh'];  ?></td></tr>
             <tr><td style="width: 50%;">Quê Quán: <?php echo $rows['CB_QueQuan'] ; ?></td>
             <td style="width: 50%;">Dân Tộc: <?php  echo $rows['CB_DanToc']; ?></td></tr>
             <tr><td style="width: 50%;">Chức Danh Khoa Học: <?php if($rows['CB_ChucDanhKH']=='') echo 'Không có';
                                   else echo $rows['CB_ChucDanhKH'];?></td>
             <td style="width: 50%;">Chức Vụ: <?php if($rows['CB_ChucVu']=='') echo 'Không có';
                                    else  echo $rows['CB_ChucVu'];  ?></td></tr>
             <tr><td colspan="2" >Địa Chỉ Liên Hệ: <?php echo $rows['CB_DiaChi'] ; ?></td></tr>
             <tr><td style="width: 50%;">Email: <?php echo $rows['CB_Email'] ; ?></td>
             <td style="width: 50%;">Điện Thoại Cơ Quan: <?php echo $rows['CB_DT_CQ'] ; ?></td></tr>
             <tr><td style="width: 50%;">Điện Thoại Nhà Riêng: <?php echo $rows['CB_DT_NR'] ; ?></td>
             <td style="width: 50%;"></td>Điện Thoại Di Động: <?php echo $rows['CB_DT_DD'] ; ?></tr>
             
             </table>
                         
            </div><!--  END bgedit peinfo -->
            
            
      </div><!--  END info-edit -->
   <!-------------------------------------------------------------------------------------------------------------->   
      <div class="row mini-line"></div>
      <div class="info-edit">
            <div id="quatrinhdaotao" class="row">
            <h3> II. QUÁ TRÌNH ĐÀO TẠO</h3>
            
            </div> <!--  END Qua Trinh Dao Tao -->
             <div class="bgedit" id="inschool">
                    <?php
	                  $sc = new BangCap();
                      $sc->setMaSo($maso);
                      $g_sc = $sc->thongtinBangCap();
                      $cnt_bc = mysql_num_rows($g_sc);
                      if($cnt_bc<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>';
                      while($res= mysql_fetch_array($g_sc))
                      {
                ?>
                 <table style="width: 100%;">
                 <tr><td style="width: 50%;">Loại Bằng: <?php echo $res['LBC_Ten']; ?></td>
                <td style="width: 50%;">Hệ Đào Tạo: <?php echo $res['BC_HeDaoTao']; ?></td></tr>
                <tr><td style="width: 50%;">Nơi Đào Tạo: <?php echo $res['BC_NoiDaoTao'] ; ?></td>
                 <td style="width: 50%;">Ngành Học: <?php echo $res['BC_NganhHoc'] ; ?></td></tr>
                 <tr><td style="width: 50%;">Chuyên Ngành: <?php echo $res['BC_ChuyenNganh'] ; ?></td>
                <td style="width: 50%;">Nước Đào Tạo: <?php echo $res['BC_NuocDaoTao'] ; ?></td></tr>
                <tr><td colspan="2">Tên Luận Án:<?php echo $res['BC_TenDeTai'] ; ?></td></tr>
                 <tr><td colspan="2">Năm Hoàn Thành: <?php echo $res['BC_NamHoanThanh'] ; ?></td></tr>
                
                 </table>
                
                <div class="row mini_line"></div>              
                 <?php 
                        }
                ?>              
                <!---------------------------------------------------------------> 
                <div class="row"> <h4>Ngoại Ngữ</h4> </div>
                <table style="width: 100%;">
                <?php
	                  $sc = new NgoaiNgu();
                      $sc->setMaSo($maso);
                      $g_sc = $sc->thongtinNgoaiNgu();
                      $cnt_nn = mysql_num_rows($g_sc);                      
                      if($cnt_nn<=0) echo '<div class="row"><span class="bcw">Chưa có</span></div>';
                      while($res= mysql_fetch_array($g_sc))
                      {                                             
                       
                ?>   
                
                <tr><td style="width: 50%;">Loại Ngoại Ngữ: <?php echo $res['LNN_Ten'];?></td>
                <td style="width: 50%;">Mức Độ Sử Dụng: <?php echo $res['NN_MucDo'];  ?></td></tr>
                           
                
                    
                <?php                   
                       
                        }
                ?>  
                </table>             
                <!--------------------------------------------------------------->
                                     
            </div><!--  END bgedit inschool -->
            
            
      </div><!--  END info-edit -->
     <!--------------------------------------------------------------------------------------------------------------> 
      <div class="info-edit">
            <div id="congtacchuyenmon" class="row">
            <h3>III. QUÁ TRÌNH CÔNG TÁC CHUYÊN MÔN</h3>
            
            </div> <!--  END QuaTrinhCongTacChuyenMon -->
            <div class="bgedit" id="inwork">
            <table class="ref">
           <tr><th>Thời Gian</th><th>Nơi Công Tác</th><th>Công Việc Đảm Nhận</th></tr>
           
            <?php
	                  $wo = new QuaTrinhCongTac();
                      $wo->setMaSo($maso);
                      $g_sc = $wo->thongtinQuaTrinhCongTac();
                      $cnt_ct = mysql_num_rows($g_sc);                      
                      if($cnt_ct<=0) echo '<tr><td>Chưa có</td><td>Chưa có</td><td>Chưa có</td></tr>';
                      while($res= mysql_fetch_array($g_sc))
                      {                             
                ?>
                <tr><td style="width: 25%;"><?php echo $res['CT_TGBatDau'];?> -- <?php echo $res['CT_TGKetThuc'];?></td>
                <td style="width: 45%;" ><?php echo $res['CT_NoiCongTac'];  ?></td>
                <td style="width: 30%;"><?php echo $res['CT_CongViecDamNhan'];  ?></td></tr>                      
                <?php 
                        }
                ?> 
                </table> 
                <div class="row mini_line"></div>              
                <!--------------------------------------------------------------->
                </div><!--  END bgedit congtachuyenmon -->
      </div><!--  END info-edit -->
      <!--------------------------------------------------------------------------------------------------------------> 
      <div class="info-edit">
            <div id="nghiencuukhoahoc" class="row" >
            <h3> IV. QUÁ TRÌNH NGHIÊN CỨU KHOA HỌC</h3>            
            </div> <!--   QuaTrinhNghienCuuKhoaHoc -->
            <div class="bgedit" id="insci">
            <div class="row"> <h4>1. Đề Tài Nghiên Cứu Khoa Học</h4> </div>
            <table class="ref">
           <tr><th>Tên đề tài nghiên cứu</th><th>Năm bắt đầu/năm hoàn thành</th><th>Cấp đề tài</th><th>Trách nhiệm tham gia trong đề tài</th></tr>
            <?php
	              $vt = new VaiTro();
                  $vt->setMaSo($maso);
                  $g_nc = $vt->thongtinVaiTro();
                  $cnt_vtro = mysql_num_rows($g_nc);
                  if($cnt_vtro<=0) echo '<tr><td>Chưa có</td><td>Chưa có</td><td>Chưa có</td><td>Chưa có</td></tr>'; 
                  while($ras= mysql_fetch_array($g_nc))
                   {
                      $nc = new DeTaiNghienCuu();
                      $nc->setNC_Ma($ras['NC_Ma']);
                      $g_sc = $nc->thongtinDeTaiNghienCuu();
                      $res= mysql_fetch_array($g_sc);
                   ?>
                <tr><td style="width: 55%;"><?php echo $res['NC_Ten'];  ?></td>
                <td style="width: 15%;" ><?php echo $res['NC_NamBD'];?>     - <?php echo $res['NC_NamHT'];?></td>
                <td style="width: 15%;"><?php echo $res['CDT_Ten'];?></td>
                <td style="width: 15%;" ><?php echo $ras['VT_VaiTro'];?></td></tr>   
                
                       <?php } ?>
                </table>                
                <!--------------------------------------------------------------->
     <div class="row"> <h4>2. Sách Và Giáo Trình Xuất Bản</h4> </div>
            <?php
	              $md = new MucDo();
                  $md->setMaSo($maso);
                  $g_bo = $md->thongtinMucDo();
                  $c_md =  mysql_num_rows($g_bo);
                  if($c_md<=0) echo '<div class="row"><span class="bcw2">Chưa có</span></div>'; 
                  $p = 1; 
                  while($ras= mysql_fetch_array($g_bo))
                   {    
                      echo '<div class="row"><span class="bcw2">'.$p.'. ';$p++;
                      $book = new SachGiaoTrinh();
                      $book->setSGT_Ma($ras['SGT_Ma']);
                      $g_sc = $book->thongtinSachGiaoTrinh();
                      $res= mysql_fetch_array($g_sc);
                    //lay danh sach dong tac gia
                      $g_dtg_bk = $md->dsDongThamGiaBK2($ras['SGT_Ma']);
                      //$c_dtg =  mysql_num_rows($g_dtg_bk);                      
                      while ( $rs= mysql_fetch_array($g_dtg_bk)) {
                            echo $rs['CB_HoTen'].', '; 
                            }
                       $dtg = new TenDTG();
                       $dtg->setSGT_Ma($ras['SGT_Ma']);
                       $gdtg2 = $dtg->thongtinTenDTG();
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                         echo $rs['TDTG_Ten'].', ';                        
                       }
                        echo $res['SGT_Ten'].', Nhà xuất bản ',$res['SGT_NXB'].', '.$res['SGT_NamXB'].'</span></div>';                  
                                                              
                       }
                ?>                
                
                <!--------------------------------------------------------------->
            <div class="row mini-line"></div>         
            <div class="row"> <h4>3. Công Trình Nghiên Cứu Khoa Học</h4> </div>
            <?php
	              $vti = new ViTri();
                  $vti->setMaSo($maso);
                  $g_kh = $vti->thongtinViTri();
                  $c_vt =  mysql_num_rows($g_kh);
                  if($c_vt<=0) echo '<div class="row"><span class="bcw2">Chưa có</span></div>'; 
                  $p = 1;
                  while($ras= mysql_fetch_array($g_kh))
                   {
                     echo '<div class="row"><span class="bcw2">'.$p.'. ';$p++;
                      $kh = new CongTrinhKhoaHoc();
                      $kh->setKH_Ma($ras['KH_Ma']);
                      $g_sc = $kh->thongtinCongTrinhKhoaHoc();
                      $res= mysql_fetch_array($g_sc);                      
                      
                      $g_dtg_kh = $vti->dsDongThamGiaKH2($ras['KH_Ma']);
                      //$c_dtg =  mysql_num_rows($g_dtg_kh);
                      while($rs= mysql_fetch_array($g_dtg_kh))
                       {
                            echo $rs['CB_HoTen'].', ';                    
                       }
                       $dtg = new DongTacGia();
                       $dtg->setKH_Ma($ras['KH_Ma']);
                       $gdtg2 = $dtg->thongtinDongTacGia();
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                        echo $rs['DTG_Ten'].', '; 
                        } 
                         echo $res['KH_Ten'].', '.$res['KH_TenTapChi'].', '.$res['KH_SoTapChi']
                         .', pp. '.$res['KH_Trang'].', '.$res['KH_NXB'] .', '.$res['KH_NamCongBo'].'</span></div>'; 
                        
                     } 
                   }
                ?>
                
        </div>
        </div>
        </div>    
  </body>   </html>