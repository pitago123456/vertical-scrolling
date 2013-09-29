<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/VaiTro.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CapDeTai.php');
   
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
<div class="title">BÁO CÁO ĐỀ TÀI NGHIÊN CỨU KHOA HỌC</div>
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
    <tr><th colspan="6" ><?php echo $row['Khoa_Ten'];  ?></th></tr>
    <tr class="header"><th>STT</th><th>Tên Đề Tài Nghiên Cứu</th><th>Năm Bắt Đầu</th><th>Năm Hoàn Thành</th>
    <th>Cấp Đề Tài</th><th>Trách Nhiệm Tham Gia Trong Đề Tài</th></tr>
    <?php 
    $vtro = new VaiTro();
    $sql = '';
    $sql .= ' and d.ND_ID = '.$row['ND_ID'];//echo $row['ND_ID'];
    if($bm!='n') $sql .= ' and d.BM_Ma = '.$bm;// 
    if($cdt!='n') $sql .= ' and f.CDT_Ma = "'.$cdt.'"';
    if($nbd!='n') $sql .= ' and NC_NamBD = "'.$nbd.'"';
    if($nkt!='n') $sql .= ' and NC_NamHT = "'.$nkt.'"';    
    
    $g2 = $vtro->dsDongThamGiaNC2($sql,'');
    $cnt = mysql_num_rows($g2); 
    //khoi tao cac bien dem de bat dau tong ket theo cap de tai
    $dtnn = $dtbo = $dtt = 0;
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua 
    
     while($ras = mysql_fetch_array($g2)){  
        $dtnc = new DeTaiNghienCuu();
        $dtnc->setNC_Ma($ras['NC_Ma']);
        $grnc = $dtnc->thongtinDeTaiNghienCuu(); 
        $res  =  mysql_fetch_array($grnc);       
        //xu ly so cap de tai
        if($res['CDT_Ma']== 'CDT01')  $dtnn++;
        else  if($res['CDT_Ma']== 'CDT02')  $dtbo++;  
        else  if($res['CDT_Ma']== 'CDT03')  $dtt++; 
        //in ra ket qua   
        $p = ' class ="line_l" ';
        if($line%2) $p = ' class ="line_c" ';      
         echo '<tr '.$p.' ><td class="center bold">'.$line.'</td><td>'.$res['NC_Ten'].'</td>
         <td class="center">'.$res['NC_NamBD'].'</td><td class="center">'.$res['NC_NamHT'].'</td>
         <td class="center">'.$res['CDT_Ten'].'</td><td >';     
     
              $g_dtg_nc = $vtro->dsDongThamGiaNC3($ras['NC_Ma']);
              $c_dtg =  mysql_num_rows($g_dtg_nc);
              $rs= mysql_fetch_array($g_dtg_nc);//lay chu tri de tai ra truoc
              echo $rs['VT_VaiTro'].' : '.$rs['CB_HoTen'].' - Khoa '.$row['Khoa_Ten']; 
               //$bool = 1; 
              if($c_dtg>1) echo '<pre>Tham Gia: </pre>';
              while($rs= mysql_fetch_array($g_dtg_nc))
              {                       
                //if($bool) $bool= 0; else echo ', ';
                echo '<div class="row">&#09;'.$rs['CB_HoTen'].' - Khoa '.$rs['Khoa_Ten'].'</div>';                                           
              }
                       
     
     echo '</td></tr>'; $line++;
    }}
    else echo '<tr><td colspan="6">Chưa có đề tài nghiên cứu khoa học nào</td></tr>';
    //dong tong cong cac de tai
    echo '<tr><td colspan="6"><div class="row">Tổng cộng có : <span class="bold">'.$cnt.'</span> 
    đề tài nghiên cứu khoa học, trong đó có : <span class="bold">'.$dtnn.'</span> đề tài cấp nhà nước, 
      <span class="bold">'.$dtbo.'</span> đề tài cấp bộ, <span class="bold">'.$dtt.'</span> đề tài trường.  </div></td></tr>';  
    ?>
    </table>
    <div class="row"><h4></h4></div>
    
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