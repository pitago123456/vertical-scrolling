<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/MucDo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/TenDTG.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
        
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['nxb']))$nxb=trim($_GET['nxb']);       else $nxb = 'n';
    if(isset($_GET['ncb']))$ncb=trim($_GET['ncb']);       else $ncb = 'n';
    if(isset($_GET['tenbk']))$tenbk=trim($_GET['tenbk']); else $tenbk = 'n';
    if(isset($_GET['id'])) $id = $_GET['id'];       else $id = 'n';    
     if(isset($_GET['name'])){
        $holot = trim(substr($_GET['name'],0,strrpos($_GET['name'],' ')));
        $ten = trim(substr($_GET['name'],strrpos($_GET['name'],' ')));   
        $hoten = $_GET['name'];             
        }
    else {$holot='n';$ten = 'n';$hoten = 'n';}
    $que = '';
    //bat dau lay ra cac vi tri,ten cong trinh va ten dong tac gia de xem xet
    $mdo = new MucDo();
    if($tenbk!='n') $que .= ' and SGT_Ten like "%'.$tenbk.'%"';
    if($id!='n') $que .= ' and a.ND_ID = '.$id;
    if($holot!='n' &&$ten != 'n') $que .= ' and(( CB_Ho like "%'.$holot.'%" and CB_Ten like "%'.$ten.'%") 
    or TDTG_Ten like "%'.trim($_GET['name']).'%")';
    if($khoa!='n') $que .= ' and e.ND_ID = '.$khoa;//
    if($bm!='n') $que .= ' and e.BM_Ma = '.$bm;// 
    if($nxb!='n') $que .= ' and SGT_NXB like "%'.$nxb.'%"';
    if($ncb!='n') $que .= ' and SGT_NamXB = "'.$ncb.'"';
    $g = $mdo->dsDongThamGiaBK3($que,'');
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
      $g2 = $mdo->dsDongThamGiaBK3($que,$que2);   //lay ket qua lan 2 khi co limit 
    
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua     
           
    
    
    ?>
    <div class="big-box-res">
    <div class="row"><h4>Kết Quả</h4></div>
    <?php
    //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InTimSach.php?khoa='
    .$khoa.'&bm='.$bm.'&tenbk='.$tenbk.'&nxb='.$nxb.'&ncb='.$ncb.'&id='.$id.'&name='.$hoten.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
        $add = '';
    if($id!='n') $add .= '"'.$id.'",'; else  $add .=  '"",';
    if($holot!='n' &&$ten != 'n') $add .= '"'.$_GET['name'].'",'; else  $add .= '"",';
    if($tenbk!='n') $add .= '"'.$_GET['tenbk'].'",';else  $add .=  '"",';
    if($khoa!='n') $add .= '"'.$khoa.'",';else  $add .= '"",';
    if($bm!='n')   $add .= '"'.$bm.'",'; else  $add .=  '"",';
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
                      echo '<li><a onclick=\'getsach('.$add.'"'.($dislay*($i-1)).'");\'>'.$i.'</a></li>';
                     //echo "<li><a href=\"javascript:getnghiencuu('a','b','c','d','e','a','b','c','d');\">".$i."</a></li>";
    		   }else  echo "<li class='cur'>".$i."</li>";
               
    		}   
            echo "</ul></div>";	
        }
   
        
    ?>
    <table class="ref">
    <tr class="header"><th>STT</th><th>Tên Sách(Giáo Trình)</th><th>Tác Giả</th><th>Nhà Xuất Bản</th><th>Năm Xuất Bản</th></tr>
    
    <?php 
         $stt = $start + 1;
        $line = 1;
        
       while($ras = mysql_fetch_array($g2)){
        $bc = new BangCap();
        $sgt = new SachGiaoTrinh();
        $sgt->setSGT_Ma($ras['SGT_Ma']);
        $grsgt = $sgt->thongtinSachGiaoTrinh(); 
        $res  =  mysql_fetch_array($grsgt);
        $p = ' class ="line_l" ';
        if($line%2) $p = ' class ="line_c" ';    
     echo '<tr '.$p.'><td class="center bold">'.$stt.'</td><td>'.$res['SGT_Ten'].'</td><td>';
     
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
                 echo '<li><a onclick=\'getsach('.$add.'"'.($dislay*($i-1)).'");\'>'.$i.'</a></li>';
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