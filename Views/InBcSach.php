<?php

/**
 * @author lioxca
 * @copyright 2012
*/  
session_start();
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/MucDo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/TenDTG.php');
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
<div class="title">BÁO CÁO SÁCH VÀ GIÁO TRÌNH</div>
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
    $line = 1;
    ?>      
    <table class="ref">
    <tr><th colspan="5" ><?php echo $row['Khoa_Ten'];  ?></th></tr>
    <tr class="header"><th>STT</th><th>Tên Sách(Giáo Trình)</th><th>Tác Giả</th><th>Nhà Xuất Bản</th><th>Năm Xuất Bản</th></tr>
    <?php 
    //bat dau lay ra cac vi tri,ten cong trinh va ten dong tac gia de xem xet
    $mdo = new MucDo();
    $que = ' and e.ND_ID = '.$row['ND_ID'];
    if($bm!='n') $que .= ' and e.BM_Ma = '.$bm;// 
    if($ncb!='n') $que .= ' and SGT_NamXB = "'.$ncb.'"';
    $g2 = $mdo->dsDongThamGiaBK3($que,'');
    $cnt = mysql_num_rows($g2);    
    
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua 
       while($ras = mysql_fetch_array($g2)){  
        $sgt = new SachGiaoTrinh();
        $bc = new BangCap();
        $sgt->setSGT_Ma($ras['SGT_Ma']);
        $grsgt = $sgt->thongtinSachGiaoTrinh(); 
        $res  =  mysql_fetch_array($grsgt);          
        $p = ' class ="line_l" ';
        if($line%2) $p = ' class ="line_c" ';    
        echo '<tr '.$p.'><td class="center bold">'.$line.'</td><td>'.$res['SGT_Ten'].'</td><td>';
     
                        //lay danh sach dong tac gia
                      $g_dtg_bk = $mdo->dsDongThamGiaBK2($ras['SGT_Ma']);
                      //$c_dtg =  mysql_num_rows($g_dtg_bk); \
                      $bool = 1;                     
                      while ( $rs= mysql_fetch_array($g_dtg_bk)) {
                            if($bool)$bool= 0; else echo ', ';
                            $r = $bc->hocvicaonhat($rs['ND_ID']);
                            if($r != '')$r .= '.';
                            echo $r.$rs['CB_HoTen'];   
                            }
                       $dtg = new TenDTG();
                       $dtg->setSGT_Ma($ras['SGT_Ma']);
                       $gdtg2 = $dtg->thongtinTenDTG();
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                         echo ', '.$rs['TDTG_Ten'];                        
                       }     
         echo '</td><td>'.$res['SGT_NXB'].'</td><td class="center">'.$res['SGT_NamXB'].'</td></tr>';
         $line++;
        }
    }
    else echo '<tr><td colspan="5">Chưa có sách và giáo trình nào</td></tr>';
    //dong tong cong cac de tai
    echo '<tr><td colspan="5"><div class="row">Tổng cộng có : <span class="bold">'.$cnt.'</span> cuốn sách và giáo trình.</div></td></tr>';
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