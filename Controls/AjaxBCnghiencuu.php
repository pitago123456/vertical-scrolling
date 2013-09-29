 <div class="big-box-res">
    <div class="row"><h4>Kết Quả</h4></div>
<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/VaiTro.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
   
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['cdt']))$cdt=$_GET['cdt'];            else $cdt = 'n';
    if(isset($_GET['nbd']))$nbd=trim($_GET['nbd']);       else $nbd = 'n';
    if(isset($_GET['nkt']))$nkt=trim($_GET['nkt']);       else $nkt = 'n';
    //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InBcNghienCuu.php?khoa='.$khoa.'&bm='.$bm.'&cdt='.$cdt.'&nbd='.$nbd.'&nkt='.$nkt.'">
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
    <tr><th colspan="6" style="background: #C4DADB;"><?php echo $row['Khoa_Ten'];  ?></th></tr>
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
              echo '<pre>'.$rs['VT_VaiTro'].' : '.$rs['CB_HoTen'].' - Khoa '.$row['Khoa_Ten'].'</pre>'; 
               //$bool = 1; 
              if($c_dtg>1) echo '<pre>Tham Gia: </pre>';
              while($rs= mysql_fetch_array($g_dtg_nc))
              {                       
                //if($bool) $bool= 0; else echo ', ';
                echo '<pre>&#09;'.$rs['CB_HoTen'].' - Khoa '.$rs['Khoa_Ten'].'</pre>';                                           
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
	  
    }}
    
    ?>
    </div>