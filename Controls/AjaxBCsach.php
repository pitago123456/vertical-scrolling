<div class="big-box-res">
<div class="row"><h4>Kết Quả</h4></div>  
<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/MucDo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/TenDTG.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
        
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['ncb']))$ncb=trim($_GET['ncb']);       else $ncb = 'n';
     //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InBcSach.php?khoa='.$khoa.'&bm='.$bm.'&ncb='.$ncb.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
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
    <tr><th colspan="5" style="background: #C4DADB;"><?php echo $row['Khoa_Ten'];  ?></th></tr>
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
	  
    
    
    }}
    ?>
    </div>