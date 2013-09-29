
<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
        
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/ViTri.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CongTrinhKhoaHoc.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DongTacGia.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');   
    
    if(isset($_SESSION['nmaquyen'])) {
    $quyen = $_SESSION['nmaquyen'];
    $maso = $_SESSION['nmaso'];
    $ten = $_SESSION['nten'];
    if($quyen=='QL' || $quyen=='KH'){       
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['ncb']))$ncb=trim($_GET['ncb']);       else $ncb = 'n'; 
    $text = '';
    if($khoa != 'n')
    {
        $k = new Khoa();
        $k->setMaSo($khoa);        
        $text .= 'Khoa '.$k->tenKhoa();//strtoupper($k->tenKhoa());
    }    
    if($ncb != 'n') $text .= ' Năm '.$ncb;
    //lay ngay thang hien tai
    $now = getdate();
    $e_now = 'Cần Thơ, ngày '.$now['mday'].' tháng '.$now['mon'].' năm '.$now['year'].'.';
   ?> 
   
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<link href="../Libraries/css/inbcnghiencuu.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<button id="del" style="float: right;" onclick="document.getElementById('del').style.display = 'none'; print();">
<img border="0" src="../Libraries/images/print.gif" align="absmiddle"/>In Trang Này</button> 
    
<div class="box">
    <span class="h_left">TRƯỜNG ĐẠI HỌC CẦN THƠ</span>
    <span class="h_right">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</span>
</div>
<div class="box">
    <span class="h_left" style="font-weight: bold;">PHÒNG QUẢN LÝ KHOA HỌC</span>
    <span class="h_right">Độc lập - Tự do - Hạnh Phúc</span>
</div>
<div class="box">
    <span class="h_left" ><div class="line"></div></span>
    <span class="h_right"><div class="line"></div></span>
</div>
<div class="box" style="margin-top: 20px ;">
   <span class="h_left"> <img  src="../Libraries/images/ctu.gif" /></span>
    <span  style="width: 59%;  text-align:center; float:right;"><em><?php echo $e_now; ?> </em></span>
</div>
<div class="box" ></div>
<div class="title">BÁO CÁO CÔNG TRÌNH NGHIÊN CỨU KHOA HỌC</div>
<div class="title" style="margin-top: 20px;"><?php echo $text; ?></div>
 <div class="big-box-res">
   
   <?php
    $que = '';
    //bat dau lay ra danh sach cac khoa dua theo du lieu nhap ban dau
    $dskhoa = new Khoa();    
    if($khoa!='n') $que = ' where ND_ID = '.$khoa;
    $g = $dskhoa->dsKhoa2($que);
    while($row = mysql_fetch_array($g))//tuong ung voi moi khoa tim dc thi tra ra ket qua tuong ung 
    { 
    ?>
        
    <table class="ref">
    <tr><th colspan="8" ><?php echo $row['Khoa_Ten'];  ?></th></tr>
    <tr class="header"><th>STT</th><th>Tên Công Trình Nghiên Cứu</th><th>Tác Giả</th><th>Tên Tạp Chí</th>
    <th>Nhà Xuất Bản</th><th>Số Tạp Chí</th><th>Trang</th><th>Năm Công Bố</th></tr>
    
    <?php 
    $line = 1; 
    $que = '';
    //bat dau lay ra cac vi tri,ten cong trinh va ten dong tac gia de xem xet
    $vtri = new ViTri();    
    $que = ' and e.ND_ID = '.$row['ND_ID'];
    if($bm!='n') $que .= ' and e.BM_Ma = '.$bm;    
    if($ncb!='n') $que .= ' and KH_NamCongBo = "'.$ncb.'"';
    $g2 = $vtri->dsDongThamGiaKH3($que,'');
    $cnt = mysql_num_rows($g2);    
    
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua   
    
       while($ras = mysql_fetch_array($g2)){ 
        $bc = new BangCap();
        $ctkh = new CongTrinhKhoaHoc();
        $ctkh->setKH_Ma($ras['KH_Ma']);
        $grkh = $ctkh->thongtinCongTrinhKhoaHoc(); 
        $res  =  mysql_fetch_array($grkh);
          
         $p = ' class ="line_l" ';
        if($line%2) $p = ' class ="line_c" ';  
         echo '<tr'.$p.'><td class="center bold">'.$line.'</td><td>'.$res['KH_Ten'].'</td><td>';
     
                        $g_dtg_kh = $vtri->dsDongThamGiaKH2($ras['KH_Ma']);
                      //$c_dtg =  mysql_num_rows($g_dtg_kh);
                      $bool = 1;
                      while($rs= mysql_fetch_array($g_dtg_kh))
                       {
                            if($bool)$bool= 0; else echo ', ';
                            $r = $bc->hocvicaonhat($rs['ND_ID']);
                            if($r != '')$r .= '.';
                            echo $r.$rs['CB_HoTen'];         
                       }
                       $dtg = new DongTacGia();
                       $dtg->setKH_Ma($ras['KH_Ma']);
                       $gdtg2 = $dtg->thongtinDongTacGia();
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                        echo ', '.$rs['DTG_Ten']; 
                        }
     
      echo '</td><td>'.$res['KH_TenTapChi'].'</td><td>'.$res['KH_NXB'].'</td><td class="center">'.$res['KH_SoTapChi'].'</td>
     <td class="center">'.$res['KH_Trang'].'</td><td class="center">'.$res['KH_NamCongBo'].'</td></tr>';
     $line ++;
    }}  else echo '<tr><td colspan="8">Chưa có Công trình nghiên cứu khoa học nào</td></tr>';
    //dong tong cong cac de tai
    echo '<tr><td colspan="8"><div class="row">Tổng cộng có : <span class="bold">'.$cnt.'</span> Công trình nghiên cứu khoa học.</div></td></tr>';
    ?>
    </table>    
    <div class="row" ><h4></h4></div>
 <?php
	  
    
    
    }}}
    ?>
    <div class="box">
    <span class="s_right">Người Lập Báo Cáo</span>
    </div><div class="box">
    <span class="s_right" style="margin-top:100px;"><?php echo $ten;  ?></span>
    </div>
    </div>
    </body>
</html>