<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
        
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/ViTri.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CongTrinhKhoaHoc.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DongTacGia.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
    
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['tchi']))$tchi=$_GET['tchi'];            else $tchi = 'n';
    if(isset($_GET['nxb']))$nxb=trim($_GET['nxb']);       else $nxb = 'n';
    if(isset($_GET['ncb']))$ncb=trim($_GET['ncb']);       else $ncb = 'n';
    if(isset($_GET['tenct']))$tenct=trim($_GET['tenct']); else $tenct = 'n';
    if(isset($_GET['id'])) $id = $_GET['id'];       else $id = 'n';    
    if(isset($_GET['name'])){
        $holot = trim(substr($_GET['name'],0,strrpos($_GET['name'],' ')));
        $ten = trim(substr($_GET['name'],strrpos($_GET['name'],' ')));   
        $hoten = $_GET['name'];             
        }
    else {$holot='n';$ten = 'n';$hoten = 'n';}
    $que = '';
    //bat dau lay ra cac vi tri,ten cong trinh va ten dong tac gia de xem xet
    $vtri = new ViTri();
    if($tenct!='n') $que .= ' and KH_Ten like "%'.$tenct.'%"';
    if($id!='n') $que .= ' and a.ND_ID = '.$id;
    if($holot!='n' &&$ten != 'n') $que .= ' and(( CB_Ho like "%'.$holot.'%" and CB_Ten like "%'.$ten.'%") 
    or DTG_Ten like "%'.trim($_GET['name']).'%")';
    if($khoa!='n') $que .= ' and e.ND_ID = '.$khoa;//
    if($bm!='n') $que .= ' and e.BM_Ma = '.$bm;// 
    if($tchi!='n') $que .= ' and KH_TenTapChi like "%'.$tchi.'%"';
    if($nxb!='n') $que .= ' and KH_NXB like "%'.$nxb.'%"';
    if($ncb!='n') $que .= ' and KH_NamCongBo = "'.$ncb.'"';
    $g = $vtri->dsDongThamGiaKH3($que,'');
    $cnt = mysql_num_rows($g); 
    $record = $cnt;  
    
    //phan trang
    $dislay =5;
 	
	if($record > $dislay)
	{
		$page = ceil($record/$dislay);
		
	}else $page = 1;
  
      //lay gia tri start o URL
      $start = (isset($_GET['start']) && (int)$_GET['start']>0) ? $_GET['start'] : 0;
      //lay gioi han: bat dau tu mau tin thu 'start' cua ket qua voi 'dislay' dong
      $que2 = " limit ".$start.",".$dislay." ";
      $g2 = $vtri->dsDongThamGiaKH3($que,$que2);   //lay ket qua lan 2 khi co limit 
    
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua     
           
    
    
    ?>
    <div class="big-box-res">
    <div class="row"><h4>Kết Quả</h4></div>
    <?php
    //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InTimCongTrinh.php?khoa='
    .$khoa.'&bm='.$bm.'&tchi='.$tchi.'&nxb='.$nxb.'&ncb='.$ncb.'&tenct='.$tenct.'&id='.$id.'&name='.$hoten.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
     
    $add = '';
    if($id!='n') $add .= '"'.$id.'",'; else  $add .=  '"",';
    if($holot!='n' &&$ten != 'n') $add .= '"'.$_GET['name'].'",'; else  $add .= '"",';
    if($tenct!='n') $add .= '"'.$_GET['tenct'].'",';else  $add .=  '"",';
    if($khoa!='n') $add .= '"'.$khoa.'",';else  $add .= '"",';
    if($bm!='n')   $add .= '"'.$bm.'",'; else  $add .=  '"",';
    if($tchi!='n') $add .= '"'.$tchi.'",';else  $add .=  '"",';
    if($nxb!='n') $add .= '"'.$nxb.'",';else  $add .=  '"",';
    if($ncb!='n') $add .= '"'.$ncb.'",';else  $add .=  '"",';
	if($page > 1)
       {
    		$next = $start + $dislay;
    		$prev = $start - $dislay;
    		$current = ($start/$dislay) +1;
            echo "<div class = 'box' style='text-align: center;'><ul class='nav'>";
       		for($i=1;$i<=$page;$i++)
    		{
    		   if($current != $i)
    		   {
    		   		 //echo "<li><a javascript:return test(".$add.($dislay*($i-1)).")>".$i."</a></li>";
                      echo '<li><a onclick=\'getcongtrinh('.$add.'"'.($dislay*($i-1)).'");\'>'.$i.'</a></li>';
                     //echo "<li><a href=\"javascript:getnghiencuu('a','b','c','d','e','a','b','c','d');\">".$i."</a></li>";
    		   }else  echo "<li class='cur'>".$i."</li>";
               
    		}   
            echo "</ul></div>";	
        }
   
        
    ?>
    <table class="ref">
    <tr class="header"><th>STT</th><th>Tên Công Trình Nghiên Cứu</th><th>Tác Giả</th><th>Tên Tạp Chí</th>
    <th>Nhà Xuất Bản</th><th>Số Tạp Chí</th><th>Trang</th><th>Năm Công Bố</th></tr>
    
    <?php 
        $stt = $start + 1;
        $line = 1;
       while($ras = mysql_fetch_array($g2)){  
        $ctkh = new CongTrinhKhoaHoc();
        $bc = new BangCap();
        $ctkh->setKH_Ma($ras['KH_Ma']);
        $grkh = $ctkh->thongtinCongTrinhKhoaHoc(); 
        $res  =  mysql_fetch_array($grkh);
        $p = ' class ="line_l" ';
        if($line%2) $p = ' class ="line_c" ';  
     echo '<tr'.$p.'><td class="center bold">'.$stt.'</td><td>'.$res['KH_Ten'].'</td><td>';
     
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
     $stt++;$line ++;
    }
    ?>
    </table>
    
    <?php
	//phan hien thi cac so next va prev
	  
	
	//lay cac tieu chi search de dieu huong phan trang
	
    
         	
   if($page > 1)
   {
		$next = $start + $dislay;
		$prev = $start - $dislay;
		$current = ($start/$dislay) +1;
        echo "<div class = 'box' style='text-align: center;'><ul class='nav'>";
   		for($i=1;$i<=$page;$i++)
		{
		   if($current != $i)
		   {
		   		 //echo "<li><a javascript:return test(".$add.($dislay*($i-1)).")>".$i."</a></li>";
                 echo '<li><a onclick=\'getcongtrinh('.$add.'"'.($dislay*($i-1)).'");\'>'.$i.'</a></li>';
                 //echo "<li><a href=\"javascript:getnghiencuu('a','b','c','d','e','a','b','c','d');\">".$i."</a></li>";
		   }else  echo "<li class='cur'>".$i."</li>";
           
		}   
        echo "</ul></div>";	
    }
     
    ?>
    
    
    
    
    
    
    
    <div class="row" ><h4></h4></div></div>
    
    <?php
	  
    }
    else{echo '<div class="big-box-res">Không có kết quả nào</div>';}
    }
    ?>