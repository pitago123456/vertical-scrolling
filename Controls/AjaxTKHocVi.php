<div class="big-box-res">
<div class="row"><h4>Kết Quả</h4></div> 
<?php

/**
 * @author lioxca
 * @copyright 2012
 */        
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');      
    
    if($_GET['gr']=='QL' || $_GET['gr']=='KH'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];         else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];               else $bm = 'n';
    //dua ra 1 button dung de in ra ket qua bao cao
    echo '<div class="right"><a target="_blank" href="Views/InTKHocVi.php?khoa='.$khoa.'&bm='.$bm.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
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
    <tr><th colspan="5" style="background: #C4DADB;"><?php echo $row['Khoa_Ten'];  ?></th></tr>
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
     <td >Tổng cộng: <span class="bold">'.$sbm.'</span> cán bộ. </td></tr>';
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
    <div class="row"  ><h4></h4></div>
    
    
    <?php  
    
    }}
    ?>
</div>