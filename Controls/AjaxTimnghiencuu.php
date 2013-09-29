<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/VaiTro.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
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
      $sql2 = " limit ".$start.",".$dislay." ";
      $g2 = $vtro->dsDongThamGiaNC2($sql,$sql2);   //lay ket qua lan 2 khi co limit 
    
    if($record>0){ //neu tìm duoc ket qua thì se tra ve bang ket qua 
    ?>
    <div class="big-box-res">
    <div class="row"><h4>Kết Quả</h4></div>
    <?php
    //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InTimNghienCuu.php?khoa='
    .$khoa.'&bm='.$bm.'&cdt='.$cdt.'&nbd='.$nbd.'&nkt='.$nkt.'&tennc='.$tennc.'&id='.$id.'&name='.$hoten.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
    $add = '';
    if($id!='n') $add .= '"'.$id.'",'; else  $add .=  '"",';
    if($holot!='n' &&$ten != 'n') $add .= '"'.$_GET['name'].'",'; else  $add .= '"",';
    if($tennc!='n') $add .= '"'.$_GET['tennc'].'",';else  $add .=  '"",';
    if($khoa!='n') $add .= '"'.$khoa.'",';else  $add .= '"",';
    if($bm!='n')   $add .= '"'.$bm.'",'; else  $add .=  '"",';
    if($cdt!='n') $add .= '"'.$cdt.'",';else  $add .=  '"",';
    if($nbd!='n') $add .= '"'.$nbd.'",';else  $add .=  '"",';
    if($nkt!='n') $add .= '"'.$nkt.'",';else  $add .=  '"",';
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
                      echo '<li><a onclick=\'getnghiencuu('.$add.'"'.($dislay*($i-1)).'");\'>'.$i.'</a></li>';
                     //echo "<li><a href=\"javascript:getnghiencuu('a','b','c','d','e','a','b','c','d');\">".$i."</a></li>";
    		   }else  echo "<li class='cur'>".$i."</li>";
               
    		}   
            echo "</ul></div>";	
        }
    ?>
    <table class="ref">
    <tr class="header"><th>STT</th><th>Tên Đề Tài Nghiên Cứu</th><th>Năm Bắt Đầu</th><th>Năm Hoàn Thành</th>
    <th>Cấp Đề Tài</th><th>Trách Nhiệm Tham Gia Trong Đề Tài</th></tr>
      
    <?php 
    $stt = $start + 1;
    $line = 1;
     while($ras = mysql_fetch_array($g2)){  
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
              echo '<pre>'.$rs['VT_VaiTro'].' : '.$rs['CB_HoTen'].' - Khoa '.$rs['Khoa_Ten'].'</pre>'; 
               //$bool = 1; 
              if($c_dtg>1) echo '<pre>Tham Gia: </pre>';
              while($rs= mysql_fetch_array($g_dtg_nc))
              {                       
                //if($bool) $bool= 0; else echo ', ';
                echo '<pre>'.$rs['CB_HoTen'].' - Khoa '.$rs['Khoa_Ten'].'</pre>';                                           
              }
                       
     
     echo '</td></tr>';
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
                 echo '<li><a onclick=\'getnghiencuu('.$add.'"'.($dislay*($i-1)).'");\'>'.$i.'</a></li>';
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
    ?>