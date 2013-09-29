<div class="big-box-res">
<div class="row"><h4>Kết Quả</h4></div>  
<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
    
  
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
        
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    if(isset($_GET['ncb']))$ncb=trim($_GET['ncb']);       else $ncb = 'n';
     //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InTKSach.php?khoa='.$khoa.'&bm='.$bm.'&ncb='.$ncb.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
    //bat dau lay ra danh sach cac khoa dua theo du lieu nhap ban dau
    $que = '';
    $dskhoa = new Khoa();    
    if($khoa!='n') $que = ' where ND_ID = '.$khoa;
    $g = $dskhoa->dsKhoa2($que);
    while($row = mysql_fetch_array($g))//tuong ung voi moi khoa tim dc thi tra ra ket qua tuong ung 
    {
    $line = 1;
    ?>
    <table class="ref">
    <tr><th colspan="3" style="background: #C4DADB;"><?php echo $row['Khoa_Ten'];  ?></th></tr>
    <tr class="header"><th>Bộ Môn</th><th>Năm</th><th>Số Lượng</th></tr>
    <?php 
    if($bm!='n') $que2 = ' and BM_Ma = '.$bm;  else $que2 = '';
    $bomon = new BoMon();
    $g2 = $bomon->dsBM2($row['ND_ID'],$que2);//lay danh sach cac bo mon truc thuoc khoa
    while($row2 = mysql_fetch_array($g2))//tuong ung voi moi bo mon thi lay ra danh sach hoc vi tuong ung
    {
    $sql =  ' and BM_Ma = '.$row2['BM_Ma'];
    if($ncb!='n') $sql .= ' and SGT_NAMXB = "'.$ncb.'"';
        
     $sgt = new SachGiaoTrinh();
     //khoi tao cac bien de lay so nam 
     $g3 = $sgt->thongkeSachGiaoTrinh($sql);
     $sonam = mysql_num_rows($g3);
     $count = $sonam + 1;
     echo '<tr class ="line_l center bold"><th rowspan="'.$count.'">'.$row2['BM_Ten'].'</th>'; 
     if($sonam>0){//neu co ton tai it nhat 1 sach giao trinh thuoc bo mon do
      $line = 2; $st = 0;
     while($row3 = mysql_fetch_array($g3)){
       $p = ' class ="line_l center bold" ';
       if($line%2) $p = ' class ="line_c center bold" '; 
       if($st!=0) echo '<tr'.$p.'>';
       echo '<td>'.$row3['SGT_NamXB'].'</td><td>'.$row3['Tong'].'</td></tr>';
      //cong lai cac bien de tiep tuc
      $line++; $st += $row3['Tong']; 
     }     
     echo '<tr class="center bold" style="background:#99DDCC;"><td colspan="2">Tổng Cộng: '.$st.' Cuốn Sách và Giáo Trình.</td></tr>';
    }
    else echo '<td colspan="2">Không có cuốn sách hoặc giáo trình nào</td></tr>';
    }
    
    ?>
    </table>    
    <div class="row" ><h4></h4></div>
    
    <?php
	  
    
    
    }}
    ?>
    </div>