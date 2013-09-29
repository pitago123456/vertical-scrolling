<?php
	//lay ngay thang hien tai
    $now = getdate();
    $e_now = 'Cần Thơ, ngày '.$now['mday'].' tháng '.$now['mon'].' năm '.$now['year'].'.';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<link href="../Libraries/css/inbchocvi.css" rel="stylesheet" type="text/css"/>
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
<div class="title">THỐNG KÊ HỌC VỊ CAO NHẤT</div>
<div class="big-box-res">
<?php

/**
 * @author lioxca
 * @copyright 2012
*/         
    session_start();
    if(isset($_SESSION['nmaquyen'])) {
    $quyen = $_SESSION['nmaquyen'];
    $maso = $_SESSION['nmaso'];
    $ten = $_SESSION['nten'];
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');      
    
    if($quyen=='QL' || $quyen=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    $que = '';
    //bat dau lay ra danh sach cac khoa dua theo du lieu nhap ban dau
    $dskhoa = new Khoa();    
    if($khoa!='n') $que = ' where ND_ID = '.$khoa;
    $g = $dskhoa->dsKhoa2($que);
    
    while($row = mysql_fetch_array($g))//tuong ung voi moi khoa tim dc thi tra ra ket qua tuong ung 
    {
     
     $line = 1;//to mau khac nhau giua cac dong
    ?>
    <table class="ref">
    <tr><th colspan="5" ><?php echo $row['Khoa_Ten'];  ?></th></tr>
    <tr class="header"><th>Bộ Môn</th><th>Đại Học</th><th>Thạc Sĩ</th><th>Tiến Sĩ</th><th>Tổng Số CB</th></tr>
    
    <?php 
     
     if($bm!='n') $que2 = ' and BM_Ma = '.$bm;  else $que2 = '';
     $bomon = new BoMon();
     $g2 = $bomon->dsBM2($row['ND_ID'],$que2);//lay danh sach cac bo mon truc thuoc khoa
     //khoi tao cac bien de dem hoc vi tuong ung
     $ct_hv = mysql_numrows($g2);
     for($i=0;$i<$ct_hv;$i++) 
     {
        $dh[$i] = 0; $ths[$i]= 0; $ts[$i] = 0;
     }
     $grow = 0;
     $w_g = 2;
     while($row2 = mysql_fetch_array($g2))//tuong ung voi moi bo mon thi lay ra danh sach hoc vi tuong ung
    {     
     
     $bc = new BangCap();
     $g3 = $bc->thongtinHocVi($row2['BM_Ma']);//
     $cnt = mysql_num_rows($g3);     
     if($cnt>0){
      //luu lai thong tin so luong hoc vi cua tung bo mon
      $dh[$grow] = $bc->getDH();
      $ths[$grow] = $bc->getTHS();
      $ts[$grow] = $bc->getTS();
      $sbm =   $dh[$grow] +  $ths[$grow]   +$ts[$grow]; 
      //phan mau cho tung dong
      $line = ' class ="line_l" ';
      if($w_g%2)  $line = ' class ="line_c" '; 
     //lay ra dong tung bo mon 
     echo '<tr '.$line.'><th >'.$row2['BM_Ten'].'</th>';
     //thong tin tong cong cua tung bo mon
     echo '<td class="bold center">'.$dh[$grow].'</td><td class="bold center">'.$ths[$grow].'</td><td class="bold center"> '.$ts[$grow].'</td>
     <td >Tổng cộng: <span class="bold">'.$sbm.'</span> cán bộ.      </td></tr>';
      $grow++;$w_g++;
     }else {
        echo '<tr><th style="background: white;">'.$row2['BM_Ten'].'</th><td colspan="5">Chưa có cán bộ</td></tr>';
     }
      
    }
    //lay lai danh sach khoa de dua ra thong ke
    $g2 = $bomon->dsBM2($row['ND_ID'],$que2);//lay danh sach cac bo mon truc thuoc khoa
     //khoi tao cac bien de dem hoc vi tuong ung
     $ct_hv = mysql_numrows($g2);
     echo '<tr class="line_l"><td colspan="6">';
     $i =  $scb = $sdh = $sths = $sts = 0; //khoi tao cac bien can thiet de dua ra tong ket
     while($row2 = mysql_fetch_array($g2))//tuong ung voi moi bo mon thi in ra so luong hoc vi tuong ung
    {
        $sum = $dh[$i] + $ths[$i] + $ts[$i]; 
        $scb += $sum;
        $sdh += $dh[$i];
        $sths += $ths[$i];
        $sts += $ts[$i];        
        $i++;
     }
      echo '<div class="row">Tổng cộng có : <span class="bold">'.$scb.'</span> cán bộ, trong đó có : 
      <span class="bold">'.$sdh.'</span> Đại Học,<span class="bold">'.$sths.'</span> Thạc Sĩ,
       <span class="bold">'.$sts.'</span> Tiến Sĩ.  </div></td></tr>';  
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