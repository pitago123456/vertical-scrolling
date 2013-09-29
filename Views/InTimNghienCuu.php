<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/VaiTro.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    
    
    if(isset($_SESSION['nmaquyen'])) {
    $quyen = $_SESSION['nmaquyen'];
    $maso = $_SESSION['nmaso'];
    $zten = $_SESSION['nten'];
    if($quyen=='QL' || $quyen=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['cdt']))$cdt=$_GET['cdt'];            else $cdt = 'n';
    if(isset($_GET['nbd']))$nbd=trim($_GET['nbd']);       else $nbd = 'n';
    if(isset($_GET['nkt']))$nkt=trim($_GET['nkt']);       else $nkt = 'n';
    if(isset($_GET['tennc']))$tennc=trim($_GET['tennc']); else $tennc = 'n';
    if(isset($_GET['id'])) $id = $_GET['id'];       else $id = 'n';
    
    if(isset($_GET['name'])){
        $holot = trim(substr($_GET['name'],0,strrpos($_GET['name'],' ')));
        $ten = trim(substr($_GET['name'],strrpos($_GET['name'],' ')));   
        $hoten = $_GET['name'];             
        }
    else {$holot='n';$ten = 'n';$hoten = 'n';}
    
    //echo trim($_GET['nbd']).trim($_GET['nkt']);
    //bat dau ghep cac dieu kien de  lay ket qua
    $vtro = new VaiTro();
    $sql = '';
    if($khoa!='n') $sql .= ' and d.ND_ID = '.$khoa;//
    if($bm!='n') $sql .= ' and d.BM_Ma = '.$bm;// 
    if($cdt!='n') $sql .= ' and f.CDT_Ma = "'.$cdt.'"';
    if($nbd!='n') $sql .= ' and NC_NamBD = "'.$nbd.'"';
    if($nkt!='n') $sql .= ' and NC_NamHT = "'.$nkt.'"';
    if($tennc!='n') $sql .= ' and NC_Ten like "%'.$tennc.'%"';
    if($id!='n') $sql .= ' and b.ND_ID = '.$id;
    if($holot!='n' &&$ten != 'n') $sql .= ' and CB_Ho like "%'.$holot.'%" and CB_Ten like "%'.$ten.'%"';      
    
     // echo $sql.$khoa.$bm;
    }// end if     
    
    //echo $sql;
    
    $g = $vtro->dsDongThamGiaNC2($sql,'');
    $cnt = mysql_num_rows($g);    
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua 
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
<div class="right">
<button id="del"  style="float: right;" onclick="document.getElementById('del').style.display = 'none'; print();">
<img border="0" src="../Libraries/images/print.gif" align="absmiddle"/>In Trang Này</button> </div>
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
<div class="title">KẾT QUẢ TÌM KIẾM ĐỀ TÀI NGHIÊN CỨU KHOA HỌC</div>
      <div class="big-box-res">    
    <table class="ref">
    <tr class="header"><th>STT</th><th>Tên Đề Tài Nghiên Cứu</th><th>Năm Bắt Đầu</th><th>Năm Hoàn Thành</th>
    <th>Cấp Đề Tài</th><th>Trách Nhiệm Tham Gia Trong Đề Tài</th></tr>
    
    <?php 
    $stt =  1;
    $line = 1;
     while($ras = mysql_fetch_array($g)){  
        $dtnc = new DeTaiNghienCuu();
        $dtnc->setNC_Ma($ras['NC_Ma']);
        $grnc = $dtnc->thongtinDeTaiNghienCuu(); 
        $res  =  mysql_fetch_array($grnc);       
        $p = ' class ="line_l" ';
        if($line%2) $p = ' class ="line_c" ';      
     echo '<tr '.$p.' ><td class="center bold">'.$stt.'</td><td>'.$res['NC_Ten'].'</td>
     <td class="center">'.$res['NC_NamBD'].'</td><td class="center">'.$res['NC_NamHT'].'</td>
     <td class="center">'.$res['CDT_Ten'].'</td><td >';    
     
              $g_dtg_nc = $vtro->dsDongThamGiaNC3($ras['NC_Ma']);
              $c_dtg =  mysql_num_rows($g_dtg_nc);
              $rs= mysql_fetch_array($g_dtg_nc);//lay chu tri de tai ra truoc
              echo '<div class="row">'.$rs['VT_VaiTro'].' : '.$rs['CB_HoTen'].' - Khoa '.$rs['Khoa_Ten'].'</div>'; 
               //$bool = 1; 
              if($c_dtg>1) echo '<pre>Tham Gia: </pre>';
              while($rs= mysql_fetch_array($g_dtg_nc))
              {                       
                //if($bool) $bool= 0; else echo ', ';
                echo '<div class="row">'.$rs['CB_HoTen'].' - Khoa '.$rs['Khoa_Ten'].'</div>';                                           
              }
                       
     
     echo '</td></tr>';
     $stt++;$line ++;
    }
    ?>
    </table>
    
    <div class="row" ><h4></h4></div></div>
    
    <?php
	  
    }
    else{echo '<div class="big-box-res">Không có kết quả nào</div>';}}
    ?>
    <div class="box">
    <span class="s_right">Người Lập Báo Cáo</span>
    </div><div class="box">
    <span class="s_right" style="margin-top:100px;"><?php echo $zten;  ?></span>
    </div>
</html>