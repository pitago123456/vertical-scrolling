<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
   
    if(isset($_SESSION['nmaquyen'])) {
    $quyen = $_SESSION['nmaquyen'];
    $maso = $_SESSION['nmaso'];
    $ten = $_SESSION['nten'];
    if($quyen=='QL' || $quyen=='KH'){         
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['cdt']))$cdt=$_GET['cdt'];            else $cdt = 'n';
    if(isset($_GET['nbd']))$nbd=trim($_GET['nbd']);       else $nbd = 'n';
    if(isset($_GET['nkt']))$nkt=trim($_GET['nkt']);       else $nkt = 'n';
    $text = '';
    if($khoa != 'n')
    {
        $k = new Khoa();
        $k->setMaSo($khoa);        
        $text .= 'Khoa '.$k->tenKhoa();//strtoupper($k->tenKhoa());
    }
    if($cdt != 'n') 
    {
        $cd = new CapDeTai();
        $cd->setCDTMa($cdt);        
        $text .= ' Cấp '.$cd->TenCDT();//strtoupper($k->tenKhoa());
    }
    if($nkt != 'n') $text .= ' Năm '.$nkt;
    
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
<div class="title">THỐNG KÊ ĐỀ TÀI NGHIÊN CỨU KHOA HỌC</div>
<div class="title" style="margin-top: 20px;"><?php echo $text; ?></div>
 <div class="big-box-res">
   
   <?php
	

    $que = '';
    $dskhoa = new Khoa();    
    if($khoa!='n') $que = ' where ND_ID = '.$khoa;
    $g = $dskhoa->dsKhoa2($que);
    while($row = mysql_fetch_array($g))//tuong ung voi moi khoa tim dc thi tra ra ket qua tuong ung 
    {
    $line = 1;
    ?>
    <table class="ref">
    <tr><th colspan="5" ><?php echo $row['Khoa_Ten'];  ?></th></tr>
    <tr class="header"><th>Bộ Môn</th><th>Năm</th><th>Cấp Trường</th><th>Cấp Bộ</th><th>Cấp Nhà Nước</th></tr>
    <?php 
    if($bm!='n') $que2 = ' and BM_Ma = '.$bm;  else $que2 = '';
    $bomon = new BoMon();
    $g2 = $bomon->dsBM2($row['ND_ID'],$que2);//lay danh sach cac bo mon truc thuoc khoa
    while($row2 = mysql_fetch_array($g2))//tuong ung voi moi bo mon thi lay ra danh sach hoc vi tuong ung
    {
    $sql =  ' and BM_Ma = '.$row2['BM_Ma'];
    if($cdt!='n') $sql .= ' and CDT_Ma = "'.$cdt.'"';
    if($nbd!='n') $sql .= ' and NC_NamBD = "'.$nbd.'"';
    if($nkt!='n') $sql .= ' and NC_NamHT = "'.$nkt.'"';     
     $nc = new DeTaiNghienCuu();
     //khoi tao cac bien de lay so nam 
     $g3 = $nc->thongkeNamDeTai($sql);
     $sonam = mysql_num_rows($g3);
     $count = $sonam + 1;
     echo '<tr class ="line_l center bold"><th rowspan="'.$count.'">'.$row2['BM_Ten'].'</th>'; 
      if($sonam>0){//neu co ton tai it nhat 1 de tai thuoc bo mon do
     $nam =$truong = $bo = $nn = array();$cnt = 0;
     while($row3 = mysql_fetch_array($g3)){
        $nam[$cnt] = $row3['0'];
        $truong[$cnt] = $bo[$cnt] = $nn[$cnt] = 0;
        $cnt++;
     }
     //lay so de tai cu the theo tung nam
     $g4 = $nc->thongkeDeTai($sql); 
     $cnt = 0; 
     while($row4 = mysql_fetch_array($g4)){
       if(!($row4['nc_namht']== $nam[$cnt])) $cnt++;//neu nam da khac thi tang bien dem len va cong cai khac
       if($row4['cdt_ma']=='CDT03') $truong[$cnt] = $row4['tong'];
       else if($row4['cdt_ma']=='CDT02') $bo[$cnt] = $row4['tong'];
       else if($row4['cdt_ma']=='CDT01') $nn[$cnt] = $row4['tong'];
     }
     $line = 2;
     $st = $sb = $snn = 0;
     for($i=0;$i<$sonam;$i++){ //bat dau in ra noi dung thong ke
        $p = ' class ="line_l center bold" ';
       if($line%2) $p = ' class ="line_c center bold" '; 
       if($i!=0) echo '<tr'.$p.'>';
       echo '<td>'.$nam[$i].'</td><td>'.$truong[$i].'</td><td>'.$bo[$i].'</td><td>'.$nn[$i].'</td></tr>';
      //cong lai cac bien de tiep tuc
      $line++; $st += $truong[$i]; $sb += $bo[$i]; $snn += $nn[$i];
     }
     $stc = $st+$sb+$snn;
     echo '<tr class="center bold" ><td>Tổng Cộng: '.$stc.' Đề Tài.</td><td>'.$st.'</td><td>'.$sb.'</td><td>'.$snn.'</td></tr>';
    }
    else echo '<td colspan="4">Không có đề tài nghiên cứu nào</td></tr>';
    }
    
      
    ?>
    </table>
    <div class="row"><h4></h4></div>
    
    <?php
	  
    }}}
    
    ?>
   <div class="box">
    <span class="s_right">Người Lập Thống Kê</span>
    </div><div class="box">
    <span class="s_right" style="margin-top:100px;"><?php echo $ten;  ?></span>
    </div>
    
</div>
</body>
</html>