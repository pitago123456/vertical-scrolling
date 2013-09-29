<?php

/**
 * @author lioxca
 * @copyright 2012
*/ 
        
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BangCap.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NgoaiNgu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/QuaTrinhCongTac.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/VaiTro.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DeTaiNghienCuu.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/MucDo.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/ViTri.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CongTrinhKhoaHoc.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/DongTacGia.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/TenDTG.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Configs/database.php'); 
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CanBo.php');
    
    if($_GET['gr']=='QL'){     
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];
    else $khoa = 'n';
    if(isset($_GET['bm']))$bm=$_GET['bm'];
    else $bm = 'n';
    if($khoa=='n'&&$bm=='n')$sql = 'select * from CanBo where '; //khong co dk khoa va bo mon
    else if($khoa!='n'&&$bm=='n') $sql = 'select a.ND_ID as ID from CanBo a,BoMon b where b.ND_ID="'.$khoa.'" and a.BM_Ma=b.BM_Ma and ';//co ca 2 dieu kien khoa va bo mon
    else if($khoa!='n'&&$bm!='n') $sql = 'select * from CanBo where BM_Ma="'.$bm.'" and ';//chi co dieu kien khoa    
    
    if(isset($_GET['id'])){
        $maso=$_GET['id'];
        if($khoa!='n'&&$bm=='n') $sql .='a.ND_ID="'.$maso.'"'; 
        else $sql .='ND_ID="'.$maso.'" ';
        }    
    if(isset($_GET['name'])){
        $holot = trim(substr($_GET['name'],0,strrpos($_GET['name'],' ')));
        $ten = trim(substr($_GET['name'],strrpos($_GET['name'],' '))); 
        $sql .='CB_Ho like "'.$holot.'" and CB_Ten like "'.$ten.'"';       
        }
     // echo $sql.$khoa.$bm;
    }// end if get gr = QL
    else if($_GET['gr']=='KH'){
        
    if(isset($_GET['khoa']))$khoa=$_GET['khoa'];
    if(isset($_GET['bm']))$bm=$_GET['bm'];
    if($bm==' ') $sql = 'select a.ND_ID as ID from CanBo a,BoMon b where b.ND_ID="'.$khoa.'" and a.BM_Ma=b.BM_Ma and ';//co ca 2 dieu kien khoa va bo mon
    else $sql = 'select * from CanBo where BM_Ma="'.$bm.'" and ';//chi co dieu kien khoa    
    
    if(isset($_GET['id'])){
        $maso=$_GET['id'];
        if($bm==' ') $sql .='a.ND_ID="'.$maso.'" '; 
        else $sql .='ND_ID="'.$maso.'" ';
        }    
    if(isset($_GET['name'])){
        $holot = trim(substr($_GET['name'],0,strrpos($_GET['name'],' ')));
        $ten = trim(substr($_GET['name'],strrpos($_GET['name'],' '))); 
        $sql .='CB_Ho like "'.$holot.'" and CB_Ten like "'.$ten.'"';       
        }
      
    }
    
    //echo $sql;
    
    $db = new database();
    $db->setQuery($sql);
    
    $cnt = mysql_num_rows($db->fetchAll());
    if($cnt>0){ //neu tìm duoc ket qua thì se tra ve 1 ly lich cua can bo    
    $res = mysql_fetch_array($db->fetchAll());
    if($_GET['gr']=='QL'){    
        if($khoa!='n'&&$bm=='n') $maso = $res['ID'];   
        else  $maso = $res['ND_ID']; 
     }else if($_GET['gr']=='KH'){    
        if($bm==' ') $maso = $res['ID'];   
        else  $maso = $res['ND_ID']; 
     }
    
    $cb = new CanBo();
    $cb->setMaSo($maso);
    $result = $cb->thongtinCanBo();
    $rows = mysql_fetch_array($result);
    
     echo '<div class="right"><a target="_blank" href="Views/InLyLich.php?maso='.$maso.'">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>In kết quả</a></div>';
    ?>
    
    
    <div class="main-content">
       
      <div class="info-edit">
            <div id="lylichsoluoc" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Lý Lịch Sơ Lược</h3>
            
            </div> <!--  END lylichsoluoc -->
             <div class="bgedit" id="peinfo">         
              <img  width="auto" height="auto"  src="./Libraries/picture/<?php echo $maso; ?>.jpg" />     
                <div class="row3">
                      <span class="ccl">Họ Và Tên:</span>
                      <span class="ccr"><?php echo $rows['CB_HoTen'] ; ?></span>
                </div>
                <div class="row3">     
                      <span class="ccl">Giới Tính:</span>
                      <span class="ccr">
                             <?php if($rows['CB_Phai']=='0') echo 'Nam' ; else  echo 'Nữ' ;?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Ngày Sinh:</span>
                      <span class="ccr">
                             <?php echo $rows['CB_NgaySinh'] ; ?></span>
                  </div>
                <div class="row3">     
                      <span class="ccl">Nơi Sinh:</span>
                      <span class="ccr" id="per_city_box">
                        <?php  echo $rows['CB_NoiSinh'];  ?>                    
                       </span>             
                </div>
                <div class="row3">
                      <span class="ccl">Quê Quán:</span>
                      <span class="ccr"> <?php echo $rows['CB_QueQuan'] ; ?> </span>
                  </div>
                <div class="row3">    
                      <span class="ccl">Dân Tộc:</span>
                      <span class="ccr">                     
                                   <?php  echo $rows['CB_DanToc']; ?> 
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Chức Danh Khoa Học:</span>
                      <span class="ccr">                            
                                   <?php if($rows['CB_ChucDanhKH']=='') echo 'Không có';
                                   else echo $rows['CB_ChucDanhKH'];?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Chức Vụ:</span>
                      <span class="ccr">
                            <?php if($rows['CB_ChucVu']=='') echo 'Không có';
                                    else  echo $rows['CB_ChucVu'];  ?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Địa Chỉ Liên Hệ:</span>
                      <span class="ccr">
                        <?php echo $rows['CB_DiaChi'] ; ?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Email:</span>
                      <span class="ccr">
                        <?php echo $rows['CB_Email'] ; ?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Điện Thoại Cơ Quan:</span>
                      <span class="ccr">
                        <?php echo $rows['CB_DT_CQ'] ; ?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Điện Thoại Nhà Riêng:</span>
                      <span class="ccr">
                        <?php echo $rows['CB_DT_NR'] ; ?>
                      </span>
                </div>
                <div class="row3">
                      <span class="ccl">Điện Thoại Di Động:</span>
                      <span class="ccr">
                       <?php echo $rows['CB_DT_DD'] ; ?>
                      </span>
                </div>
               <div class="row"></div>       
            </div><!--  END bgedit peinfo -->
            
            
      </div><!--  END info-edit -->
   <!-------------------------------------------------------------------------------------------------------------->   
      <div class="info-edit">
            <div id="quatrinhdaotao" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Quá Trình Đào Tạo</h3>
            
            </div> <!--  END Qua Trinh Dao Tao -->
             <div class="bgedit" id="inschool">
                    <?php
	                  $sc = new BangCap();
                      $sc->setMaSo($maso);
                      $g_sc = $sc->thongtinBangCap();
                      $cnt_bc = mysql_num_rows($g_sc);
                      if($cnt_bc<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>';
                      while($res= mysql_fetch_array($g_sc))
                      {
                ?>
                <div class="row mini_line"></div> 
                <div class="row">
                      <span class="bcl">Loại Bằng:</span>
                      <span class="bcr">
                             <?php echo $res['LBC_Ten']; ?>
                      </span>
                     <span class="bcl">Hệ Đào Tạo:</span>
                      <span class="bcr">
                            <?php echo $res['BC_HeDaoTao']; ?>
                      </span>
                
                </div>
                <div class="row">
                      <span class="bcl">Nơi Đào Tạo:</span>
                      <span class="bcr">
                        <?php echo $res['BC_NoiDaoTao'] ; ?>
                      </span>                   
                      <span class="bcl">Ngành Học:</span>
                      <span class="bcr">
                        <?php echo $res['BC_NganhHoc'] ; ?>
                      </span>
                      
                </div>
                <div class="row">
                      <span class="bcl">Chuyên Ngành:</span>
                      <span class="bcr">
                        <?php echo $res['BC_ChuyenNganh'] ; ?>
                      </span>                  
                      <span class="bcl">Nước Đào Tạo:</span>
                      <span class="bcr">
                        <?php echo $res['BC_NuocDaoTao'] ; ?>
                      </span>
                      
                </div>
                <div class="row">
                      <span class="bcl">Tên Luận Án:</span>
                      <span class="bcr">
                        <?php echo $res['BC_TenDeTai'] ; ?>
                      </span>                     
                      <span class="bcl">Năm Hoàn Thành:</span>
                      <span class="bcr">
                        <?php echo $res['BC_NamHoanThanh'] ; ?>
                      </span>
                      
                </div>                
                 <?php
	                   
                       
                        }
                ?>                
                <div class="row line"></div>
                <!---------------------------------------------------------------> 
                <div class="mid"> <h3>Ngoại Ngữ</h3> </div>
                <?php
	                  $sc = new NgoaiNgu();
                      $sc->setMaSo($maso);
                      $g_sc = $sc->thongtinNgoaiNgu();
                      $cnt_nn = mysql_num_rows($g_sc);                      
                      if($cnt_nn<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>';
                      while($res= mysql_fetch_array($g_sc))
                      {                                             
                       
                ?>
               <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Loại Ngoại Ngữ:</span>
                      <span class="bcr">
                             <?php echo $res['LNN_Ten'];?>
                      </span>
                      <span class="bcl">Mức Độ Sử Dụng:</span>
                      <span class="bcr">
                             <?php echo $res['NN_MucDo'];  ?> 
                      </span>
                      
                </div>
                
                    
                <?php                   
                       
                        }
                ?>               
                <!--------------------------------------------------------------->
                <div class="row line"></div>                       
            </div><!--  END bgedit inschool -->
            
            
      </div><!--  END info-edit -->
     <!--------------------------------------------------------------------------------------------------------------> 
      <div class="info-edit">
            <div id="congtacchuyenmon" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Quá Trình Công Tác Chuyên Môn</h3>
            
            </div> <!--  END QuaTrinhCongTacChuyenMon -->
            <div class="bgedit" id="inwork">
            <?php
	                  $wo = new QuaTrinhCongTac();
                      $wo->setMaSo($maso);
                      $g_sc = $wo->thongtinQuaTrinhCongTac();
                      $cnt_ct = mysql_num_rows($g_sc);                      
                      if($cnt_ct<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>';
                      while($res= mysql_fetch_array($g_sc))
                      {                             
                ?>
           <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Ngày Bắt Đầu:</span>
                      <span class="bcr">
                             <?php echo $res['CT_TGBatDau'];?></span>
                      <span class="bcl">Ngày Kết Thúc:</span>
                      <span class="bcr">
                            <?php echo $res['CT_TGKetThuc'];?></span>
                      
                </div>
                <div class="row">
                      <span class="bcl">Nơi Công Tác:</span>
                      <span class="bcr">
                             <?php echo $res['CT_NoiCongTac'];  ?>
                      </span>
                
                      <span class="bcl">Công Việc Đảm Nhận:</span>
                      <span class="bcr">
                             <?php echo $res['CT_CongViecDamNhan'];  ?>
                      </span>
                </div>
                
                <?php 
                        }
                ?>                
                <!--------------------------------------------------------------->
                <div class="row line"></div>
                </div><!--  END bgedit congtachuyenmon -->
      </div><!--  END info-edit -->
      <!--------------------------------------------------------------------------------------------------------------> 
      <div class="info-edit">
            <div id="nghiencuukhoahoc" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Quá Trình Nghiên Cứu Khoa Học</h3>
            
            </div> <!--   QuaTrinhNghienCuuKhoaHoc -->
            <div class="bgedit" id="insci">
            <div class="mid"> <h3>Đề Tài Nghiên Cứu Khoa Học</h3> </div>
            
            <?php
	              $vt = new VaiTro();
                  $vt->setMaSo($maso);
                  $g_nc = $vt->thongtinVaiTro();
                  $cnt_vtro = mysql_num_rows($g_nc);
                  if($cnt_vtro<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>'; 
                  while($ras= mysql_fetch_array($g_nc))
                   {
                      $nc = new DeTaiNghienCuu();
                      $nc->setNC_Ma($ras['NC_Ma']);
                      $g_sc = $nc->thongtinDeTaiNghienCuu();
                      $res= mysql_fetch_array($g_sc);
                   ?>
                <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Cấp Đề Tài:</span>
                      <span class="bcr"><?php echo $res['CDT_Ten'];?></span>
                </div>
                <div class="row">
                      <span class="bcl">Tên Đề Tài:</span>
                      <span class="dcr"><?php echo $res['NC_Ten'];  ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Năm Bắt Đầu:</span><span class="bcr"><?php echo $res['NC_NamBD'];?></span>
                      <span class="bcl">Năm Hoàn Thành:</span><span class="bcr"><?php echo $res['NC_NamHT'];?></span>
                </div>
                <div class="row">
                      <span class="bcl">Đồng Tham Gia:</span>
                </div>
                <?php
                      $g_dtg_nc = $vt->dsDongThamGiaNC($ras['NC_Ma']);
                      $c_dtg =  mysql_num_rows($g_dtg_nc);
                      $c = 0;  
                      while($rs= mysql_fetch_array($g_dtg_nc))
                       {
                       ?>
                       <div class="row2">
                       <span class="dcr">Mã số: <?php echo $rs['ND_ID'];?> | Họ Tên: <?php echo $rs['CB_HoTen'];?></span>
                       </div>
                       <?php                     
                       }                
                        }
                ?>                
                <!--------------------------------------------------------------->
                <div class="row line"></div>                      
            <div class="mid"> <h3>Sách Và Giáo Trình Xuất Bản</h3> </div>
            <?php
	              $md = new MucDo();
                  $md->setMaSo($maso);
                  $g_bo = $md->thongtinMucDo();
                  $c_md =  mysql_num_rows($g_bo);
                  if($c_md<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>';  
                  while($ras= mysql_fetch_array($g_bo))
                   {
                      $book = new SachGiaoTrinh();
                      $book->setSGT_Ma($ras['SGT_Ma']);
                      $g_sc = $book->thongtinSachGiaoTrinh();
                      $res= mysql_fetch_array($g_sc);
                   ?>
                <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Tên Sách:</span>
                      <span class="dcr"><?php echo $res['SGT_Ten'];?></span>
                </div>
                <div class="row">
                      <span class="bcl">Nhà Xuất Bản:</span>
                      <span class="bcr"><?php echo $res['SGT_NXB'];  ?></span>
                      <span class="bcl">Năm Xuất Bản:</span><span class="bcr"><?php echo $res['SGT_NamXB'];?></span>
                </div>
                <div class="row">
                      <span class="bcl">Đồng Tác Giả:</span>
                </div>
                      <?php
                      $g_dtg_bk = $md->dsDongThamGiaBK($ras['SGT_Ma']);
                      $c_dtg =  mysql_num_rows($g_dtg_bk);
                      $c = 0;  
                      while($rs= mysql_fetch_array($g_dtg_bk))
                       {
                       ?>
                       <div class="row2">
                       <span class="dcr">Mã số: <?php echo $rs['ND_ID'];?> | Họ Tên: <?php echo $rs['CB_HoTen'];?></span>
                       </div>
                       <?php                     
                       }
                       $dtg = new TenDTG();
                       $dtg->setSGT_Ma($ras['SGT_Ma']);
                       $gdtg2 = $dtg->thongtinTenDTG();
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                        ?>
                        <div class="row2">
                       <span class="dcr">Họ Tên: <?php echo $rs['TDTG_Ten'];?></span>
                        </div>
                       <?php                     
                       }                                            
                        }
                ?>                
                
                <!--------------------------------------------------------------->
                <div class="row line"></div>
                       
            <div class="mid"> <h3>Công Trình Nghiên Cứu Khoa Học</h3> </div>
            <?php
	              $vti = new ViTri();
                  $vti->setMaSo($maso);
                  $g_kh = $vti->thongtinViTri();
                  $c_vt =  mysql_num_rows($g_kh);
                  if($c_vt<=0) echo '<div class="row"><span class="bcr">Chưa có</span></div>'; 
                  while($ras= mysql_fetch_array($g_kh))
                   {
                      $kh = new CongTrinhKhoaHoc();
                      $kh->setKH_Ma($ras['KH_Ma']);
                      $g_sc = $kh->thongtinCongTrinhKhoaHoc();
                      $res= mysql_fetch_array($g_sc);
                   
                ?>
                <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Tên Công Trình:</span><span class="dcr"><?php echo $res['KH_Ten'];  ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Tên Tạp Chí:</span><span class="dcr"><?php echo $res['KH_TenTapChi'];  ?></span>
                </div>
                 <div class="row">
                      <span class="bcl">Số Tạp Chí:</span><span class="bcr"><?php echo $res['KH_SoTapChi'] ; ?></span>
                      <span class="bcl">Trang Số:</span><span class="bcr"><?php echo $res['KH_Trang'] ; ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Nhà Xuất Bản:</span><span class="bcr"><?php echo $res['KH_NXB'] ; ?></span>
                      <span class="bcl">Năm Công Bố:</span><span class="bcr"><?php echo $res['KH_NamCongBo'] ; ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Đồng Tác Giả:</span>
                </div>
                      <?php
                      $g_dtg_kh = $vti->dsDongThamGiaKH($ras['KH_Ma']);
                      $c_dtg =  mysql_num_rows($g_dtg_kh);
                      $c = 0;  
                      while($rs= mysql_fetch_array($g_dtg_kh))
                       {
                       ?>
                       <div class="row2">
                       <span class="dcr">Mã số: <?php echo $rs['ND_ID'];?> | Họ Tên: <?php echo $rs['CB_HoTen'];?></span>
                       </div>
                       <?php                     
                       }
                       $dtg = new DongTacGia();
                       $dtg->setKH_Ma($ras['KH_Ma']);
                       $gdtg2 = $dtg->thongtinDongTacGia();
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                        ?>
                        <div class="row2">
                       <span class="dcr">Họ Tên: <?php echo $rs['DTG_Ten'];?></span>                       
                       </div>
                       <?php                     
                       }
                        
                     }  
                ?>
        </div>
        </div>
        <div class="right">
    <a  title="Tạo bản in lý lịch khoa học" href="javascript:opnwd('<?php
    echo 'Views/InLyLich.php?maso='.$maso; ?>', 535, 1000, 'yes')"><img border="0" src="./Libraries/images/print.gif" align="absmiddle"/>Tạo bản in</a>
    </div></div>
    <?php
	 unset($khoa);  unset($bm); unset($maso); 
    }
    else{echo '<div class="main-content">Không có kết quả nào</div>';}
    ?>