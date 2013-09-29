<div class="big-box-res">
    <div class="row"><h4>Kết Quả</h4></div>
<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
        
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/ViTri.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CongTrinhKhoaHoc.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DongTacGia.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
    
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['ncb']))$ncb=trim($_GET['ncb']);       else $ncb = 'n'; 
    //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InBcCongTrinh.php?khoa='.$khoa.'&bm='.$bm.'&ncb='.$ncb.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>'; 
    $que = '';
    //bat dau lay ra danh sach cac khoa dua theo du lieu nhap ban dau
    $dskhoa = new Khoa();    
    if($khoa!='n') $que = ' where ND_ID = '.$khoa;
    $g = $dskhoa->dsKhoa2($que);
    while($row = mysql_fetch_array($g))//tuong ung voi moi khoa tim dc thi tra ra ket qua tuong ung 
    { 
    ?>
        
    <table class="ref">
    <tr><th colspan="8" style="background: #C4DADB;"><?php echo $row['Khoa_Ten'];  ?></th></tr>
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
	  
     }   
    }
    ?>
 </div>