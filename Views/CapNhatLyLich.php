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
    
    
    
    $nmaso=$_SESSION['nmaso'];
    $cb = new CanBo();
    $cb->setMaSo($_SESSION['nmaso']);
    $result = $cb->thongtinCanBo();
    $rows = mysql_fetch_array($result);
    $db = new database();
    $db->setQuery('select Tinh from DanhMuc');
    $dm = $db->fetchAll();
    $db->setQuery('select DT from DanhMuc');
    $dm2 = $db->fetchAll();

?>
<!---------------------------------phan upload hinh------------------------------------------------------->
<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.min.js"></script>
<link  rel="stylesheet" href="uploadify/uploadify.css" type="text/css"/>
<script type="text/javascript">

				$(function() {

				$('#custom_file_upload').uploadify({

  'uploader'       : './uploadify/uploadify.swf',

  'script'         : './uploadify/uploadify.php?idd=<?php echo $nmaso; ?>',

  'cancelImg'      : './uploadify/cancel.png',

  'folder'         : './Libraries/picture',
  'multi'          : false,

  'auto'           : true,

  'fileExt'        : '*.*',//*.jpeg;*.jpg;*.gif;*.png

  'fileDesc'       : 'Image Files (.JPEG,.JPG, .GIF, .PNG)',

  'queueID'        : 'custom-queue',

  'queueSizeLimit' : 3,

  'simUploadLimit' : 3,

  'sizeLimit'   : 902400,

  'removeCompleted': false,

  'onSelectOnce'   : function(event,data) {

      $('#status-message').text(data.filesSelected + ' tệp uploaded do hình quá lớn.');

    },

  'onAllComplete'  : function(event,data) {

      $('#status-message').text(data.filesUploaded + ' tệp uploaded, ' + data.errors + ' lỗi.');
      window.location.reload();
      

    }

});				});

</script>
<!--------------------------------- het phan upload hinh------------------------------------------------------->
<link rel="stylesheet" type="text/css" href="./Libraries/css/capnhatlylich.css" />
<script type="text/javascript" src="Libraries/js/capnhatlylich.js"></script>
<script type="text/javascript">

$(document).ready(function() {
            
            //xu ly mac dinh cuon form
            $('div.bgedit').hide();
            state=document.getElementById('state').value;
            if(state==1) nav_llsl();
            else if(state==2) nav_qtdt();
            else if(state==3) nav_ctcm();
            else if(state==4) nav_nckh();
            
            
//---------------Xu ly cuon form len xuong--------------------------------------------
            //ly lich so luoc dc click
            $('div#lylichsoluoc').click(function() {
                if($('div#quatrinhdaotao').hasClass('editif-highline'))
                {
                    $('div#inschool').hide('fast');
                    $('div#quatrinhdaotao').removeClass('editif-highline');
                }
                if($('div#congtacchuyenmon').hasClass('editif-highline'))
                {
                    $('div#inwork').hide('fast');
                    $('div#congtacchuyenmon').removeClass('editif-highline');
                }
                if($('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {
                    $('div#insci').hide('fast');
                    $('div#nghiencuukhoahoc').removeClass('editif-highline');
                }  
                $('div.bgedit#peinfo').slideToggle('slow');
                $(this).toggleClass("editif-highline"); 
                });
            // qua trinh dao tao dc click
            $('div#quatrinhdaotao').click(function() {
                if($('div#lylichsoluoc').hasClass('editif-highline'))
                {
                    $('div#peinfo').hide('fast');
                    $('div#lylichsoluoc').removeClass('editif-highline');
                }
                if($('div#congtacchuyenmon').hasClass('editif-highline'))
                {
                    $('div#inwork').hide('fast');
                    $('div#congtacchuyenmon').removeClass('editif-highline');
                }
                if($('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {
                    $('div#insci').hide('fast');
                    $('div#nghiencuukhoahoc').removeClass('editif-highline');
                }   
                $('div.bgedit#inschool').slideToggle('slow');
                $(this).toggleClass("editif-highline"); 
                });
            //qua trinh cong tac chuyen mon dc click
                $('div#congtacchuyenmon').click(function() {
                if($('div#lylichsoluoc').hasClass('editif-highline'))
                {
                    $('div#peinfo').hide('fast');
                    $('div#lylichsoluoc').removeClass('editif-highline');
                }
                if($('div#quatrinhdaotao').hasClass('editif-highline'))
                {
                    $('div#inschool').hide('fast');
                    $('div#quatrinhdaotao').removeClass('editif-highline');
                }
                if($('div#nghiencuukhoahoc').hasClass('editif-highline'))
                {
                    $('div#insci').hide('fast');
                    $('div#nghiencuukhoahoc').removeClass('editif-highline');
                }   
                $('div.bgedit#inwork').slideToggle('slow');
                $(this).toggleClass("editif-highline"); 
                });
                //qua trinh nghien cuu khoa hoc dc click
                $('div#nghiencuukhoahoc').click(function() {
                if($('div#lylichsoluoc').hasClass('editif-highline'))
                {
                    $('div#peinfo').hide('fast');
                    $('div#lylichsoluoc').removeClass('editif-highline');
                }
                if($('div#quatrinhdaotao').hasClass('editif-highline'))
                {
                    $('div#inschool').hide('fast');
                    $('div#quatrinhdaotao').removeClass('editif-highline');
                }
                if($('div#congtacchuyenmon').hasClass('editif-highline'))
                {
                    $('div#inwork').hide('fast');
                    $('div#congtacchuyenmon').removeClass('editif-highline');
                } 
                $('div.bgedit#insci').slideToggle('slow');
                $(this).toggleClass("editif-highline"); 
                });
                
            });
//-----------------------Xu ly chon ngay thang-------------------------------------------------
$(function() {
	$('.popupDatepicker').datepick({dateFormat: 'dd-mm-yyyy'});
     function showDate(date) {	alert('The date chosen is ' + date);    }
    
    });

</script>
<!---------------------------------phan auto complete------------------------------------------------------->
<link rel="stylesheet" href="./Libraries/css/jquery.ui.all.css"/>	
	<script src="./Libraries/js/jquery.ui.core.js"></script>
	<script src="./Libraries/js/jquery.ui.widget.js"></script>
	<script src="./Libraries/js/jquery.ui.position.js"></script>
	<script src="./Libraries/js/jquery.ui.autocomplete.js"></script>
	<style>
	.ui-autocomplete-loading { background: white url('./Libraries/images/ui-anim_basic_16x16.gif') right center no-repeat; }
	</style>
	<script>
	$(function() {
	   $( ".a_porn" ).autocomplete({source: "auto/Tinh.php",minLength: 2}); 
       $( ".a_add" ).autocomplete({source: "auto/DiaChi.php",minLength: 2});
       $( ".a_nganhhoc" ).autocomplete({source: "auto/NganhHoc.php",minLength: 2}); 
       $( ".a_chuyennganh" ).autocomplete({source: "auto/ChuyenNganh.php",minLength: 2});
       $( ".a_nuocdaotao" ).autocomplete({source: "auto/NuocDaoTao.php",minLength: 2});
       $( ".a_noicongtac" ).autocomplete({source: "auto/NoiCongTac.php",minLength: 2});
       $( ".a_congviecdn" ).autocomplete({source: "auto/CongViecDamNhan.php",minLength: 2});
       $( ".a_ncten" ).autocomplete({source: "auto/TenNghienCuu.php",minLength: 2});
       $( ".a_sgtsach" ).autocomplete({source: "auto/TenSach.php",minLength: 2}); 
       $( ".a_sgtnxb" ).autocomplete({source: "auto/NXBSach.php",minLength: 2}); 
       $( ".a_khten" ).autocomplete({source: "auto/TenKhoaHoc.php",minLength: 2}); 
       $( ".a_khttchi" ).autocomplete({source: "auto/TenTapChi.php",minLength: 2}); 
       $( ".a_khnxb" ).autocomplete({source: "auto/NXBKhoaHoc.php",minLength: 2});
       $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 2});
       $( ".a_getname" ).autocomplete({source: "auto/GetName.php",minLength: 2});
       $( ".a_getname2" ).autocomplete({source: "auto/GetName2.php",minLength: 2});
        
	});
	</script>
<!---------------------------------het phan auto complete------------------------------------------------------->
      <input type="hidden" name="state" id="state" value="1" />
      <div class="right">
      <a title="Download thời khóa biểu" target="_blank" href="Views/InLyLich_w.php"> 
					<img border="0" src="./Libraries/images/down.gif" align="middle"> Download lý lịch</a>
    <?php
	 echo '<a target="_blank" href="Views/InLyLich.php">
    <img border="0" src="Libraries/images/print.gif" align="absmiddle"/>Tạo bản in</a></div>';
    ?>
    
      <div  class="avatar">      
		<img title="Nhấp chọn phía dưới để upload hình đại diện,chỉ chấp nhận cỡ hình 4x6"
              width="100%" height="100%"  src="./Libraries/picture/<?php echo $nmaso; ?>.jpg" />
       <div id="status-message"></div>
      <input id="custom_file_upload" type="file" name="Filedata" /> 
      </div> 
      
    <div class="main-content">
       
      <div class="info-edit">
            <div id="lylichsoluoc" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Lý Lịch Sơ Lược</h3>
            
            </div> <!--  END lylichsoluoc -->
             <div class="bgedit" id="peinfo">
            <form method="post" id="editinfoForm" name="editinfoForm">
                   <input type="hidden" name="code" value="1" />
                   
                <div class="row">
                      <span class="bcl">Họ Và Tên:</span>
                      <span class="bcr"><input type="text" required="" value="<?php echo $rows['CB_HoTen'] ; ?>"
                      size="40" maxlength="40" name="per_name"/></span>
                </div>
                <div class="row">
                      <span class="bcl">Giới Tính:</span>
                      <span class="bcr">
                             <select id="per_gender" name="per_gender">
                                   <option value="0" <?php if($rows['CB_Phai']=='0') echo ' selected="true"' ; ?> >Nam</option>
                                   <option value="1" <?php if($rows['CB_Phai']=='1') echo ' selected="true"' ; ?> >Nữ</option>
                             </select>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Ngày Sinh:</span>
                      <span class="bcr">
                             <input name="per_birth" required="" value="<?php echo $rows['CB_NgaySinh'] ; ?>" type="text" class="popupDatepicker" size="12" maxlength="12"  readonly="true" />
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Nơi Sinh:</span>
                      <span class="bcr" id="per_city_box">
                      <select id="per_city" name="per_city" class="select required">
                                   <?php
                                        while($fdm = mysql_fetch_array($dm))
                                        {
                                            if($rows['CB_NoiSinh']==$fdm['Tinh'])
                                            echo '<option value="'.$fdm['Tinh'].'" selected="selected">'.$fdm['Tinh'].'</option>';
                                            else echo '<option value="'.$fdm['Tinh'].'">'.$fdm['Tinh'].'</option>';
                                        }
                                    ?> 
                        </select>
                       </span>             
                </div>
                <div class="row">
                      <span class="bcl">Quê Quán:</span>
                      <span class="bcr">
                        <input type="text" name="per_born" class="a_porn" required="" value="<?php echo $rows['CB_QueQuan'] ; ?>" size="20" maxlength="40"   class="input"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Dân Tộc:</span>
                      <span class="bcr">
                             <select id="per_DT" name="per_DT" class="select">
                                   <?php
                                        while($fdm2 = mysql_fetch_array($dm2))
                                        {
                                            if($fdm2['DT']!=''){
                                            if($rows['CB_DanToc']==$fdm2['DT'])
                                            echo '<option value="'.$fdm2['DT'].'" selected="selected">'.$fdm2['DT'].'</option>';
                                            else echo '<option value="'.$fdm2['DT'].'">'.$fdm2['DT'].'</option>';
                                            }
                                        }
                                    ?> 
                             </select>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Chức Danh Khoa Học:</span>
                      <span class="bcr">
                             <select id="per_CD" name="per_CD" class="select">
                                   <option value="">----</option>
                                   <option value="Giáo Sư"<?php if($rows['CB_ChucDanhKH']=='Giáo Sư') echo' selected="true"';  ?> >Giáo Sư </option>
                                   <option value="Phó Giáo Sư"<?php if($rows['CB_ChucDanhKH']=='Phó Giáo Sư') echo' selected="true"';  ?> >Phó Giáo Sư</option>
                             </select>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Chức Vụ:</span>
                      <span class="bcr">
                            <select id="per_CV" name="per_CV" class="select">
                                   <option value="">----</option>
                                   <option value="Trưởng Khoa"<?php if($rows['CB_ChucVu']=='Trưởng Khoa') echo' selected="true"';  ?> >Trưởng Khoa </option>
                                   <option value="Phó Trưởng Khoa" <?php if($rows['CB_ChucVu']=='Phó Trưởng Khoa') echo' selected="true"';  ?>>Phó Khoa</option>
                                   <option value="Trưởng Bộ Môn" <?php if($rows['CB_ChucVu']=='Trưởng Bộ Môn') echo' selected="true"';  ?>>Trưởng Bộ Môn </option>
                                   <option value="Phó Trưởng Bộ Môn"<?php if($rows['CB_ChucVu']=='Phó Trưởng Bộ Môn') echo' selected="true"';  ?> >Phó Trưởng Bộ Môn</option>
                             </select>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Địa Chỉ Liên Hệ:</span>
                      <span class="bcr">
                        <input type="text" name="per_Add" class="a_add" required="" value="<?php echo $rows['CB_DiaChi'] ; ?>" size="80" maxlength="100"   class="input"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Email:</span>
                      <span class="bcr">
                        <input type="text" name="per_Email" required="" value="<?php echo $rows['CB_Email'] ; ?>" size="40" maxlength="40"  class="input"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Điện Thoại Cơ Quan:</span>
                      <span class="bcr">
                        <input type="text"  name="per_DTCQ" required="" value="<?php echo $rows['CB_DT_CQ'] ; ?>" size="20" maxlength="40"  class="input"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Điện Thoại Nhà Riêng:</span>
                      <span class="bcr">
                        <input type="text"  name="per_DTNR" value="<?php echo $rows['CB_DT_NR'] ; ?>" size="20" maxlength="40"  class="input"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Điện Thoại Di Động:</span>
                      <span class="bcr">
                        <input type="text" name="per_DTDD" value="<?php echo $rows['CB_DT_DD'] ; ?>" size="20" maxlength="40"   class="input"/>
                      </span>
                </div>
                <div class="row">
                    <span class="bcl"></span>
                    <span class="bcr">  
                    <input type="submit" value="Lưu Lại"   name="per_save" id="per_save" onclick="return check_llsl();"/>
                    </span>
                </div>
                
            </form>        
            </div><!--  END bgedit peinfo -->
            
            
      </div><!--  END info-edit -->
   <!-------------------------------------------------------------------------------------------------------------->   
      <div class="info-edit">
            <div id="quatrinhdaotao" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Quá Trình Đào Tạo</h3>
            
            </div> <!--  END Qua Trinh Dao Tao -->
             <div class="bgedit" id="inschool">
            <form method="post" id="editschoolForm" name="editschoolForm">
                   <input type="hidden" name="code" value="2" />
                   <input type="hidden" name="cnt_bc" id="cnt_bc" value="1" />
                   <div class="mid"> <h3>Bằng Cấp</h3> </div>
                <?php
	                  $sc = new BangCap();
                      $sc->setMaSo($nmaso);
                      $g_sc = $sc->thongtinBangCap();
                      $cnt_bc = mysql_num_rows($g_sc);
                      echo '<script type="text/javascript">document.getElementById("cnt_bc").value='.$cnt_bc.';</script>';
                      $s = 0;
                      while($res= mysql_fetch_array($g_sc))
                      {
                       $s++; 
                       if($s<=$cnt_bc) 
                       {
                        
                       
                ?>
                <div id="bc<?php echo $s;?>">
                <input type="hidden" name="stt_bc<?php echo $s;?>" id="stt_bc<?php echo $s;?>" value="<?php echo $res['BC_STT'];?>" />
                <div class="row mini_line"></div> 
                <div class="row">
                      <span class="bcl">Loại Bằng:</span>
                      <span class="bcr">
                             <select id="BC_LB" name="BC_LB<?php echo $s;?>" class="select">
                                   <option value="LBC01"<?php if($res['LBC_Ma']=='LBC01') echo' selected="true"';  ?> >Đại Học </option>
                                   <option value="LBC02"<?php if($res['LBC_Ma']=='LBC02') echo' selected="true"';  ?> >Thạc Sĩ</option>
                                   <option value="LBC03"<?php if($res['LBC_Ma']=='LBC03') echo' selected="true"';  ?> >Tiến Sĩ</option>
                             </select>
                      </span>
                     </div>
                     <div class="row">
                      <span class="bcl">Hệ Đào Tạo:</span>
                      <span class="bcr">
                             <select id="BC_HDT" name="BC_HDT<?php echo $s;?>" class="select">
                                   <option value="Chính Quy"<?php if($res['BC_HeDaoTao']=='Chính Quy') echo' selected="true"';  ?> >Chính Quy </option>
                                   <option value="Không Chính Quy"<?php if($res['BC_HeDaoTao']=='Không Chính Quy') echo' selected="true"';  ?> >Không Chính Quy</option>
                                   <option value="Từ Xa"<?php if($res['BC_HeDaoTao']=='Từ Xa') echo' selected="true"';  ?> >Từ Xa</option>
                             </select>
                      </span>
                
                </div>
                <div class="row">
                      <span class="bcl">Nơi Đào Tạo:</span>
                      <span class="bcr">
                        <input type="text" name="BC_NDT<?php echo $s;?>" id="BC_NDT<?php echo $s;?>" value="<?php echo $res['BC_NoiDaoTao'] ; ?>" size="60" maxlength="60"   class="input"/>
                      </span>
                 </div>
                <div class="row">   
                      <span class="bcl">Ngành Học:</span>
                      <span class="bcr">
                        <input type="text" class="a_nganhhoc" name="BC_NH<?php echo $s;?>" id="BC_NH<?php echo $s;?>" value="<?php echo $res['BC_NganhHoc'] ; ?>" size="60" maxlength="60" />
                      </span>
                      
                </div>
                <div class="row">
                      <span class="bcl">Chuyên Ngành:</span>
                      <span class="bcr">
                        <input type="text" class="a_chuyennganh" name="BC_CN<?php echo $s;?>" id="BC_CN<?php echo $s;?>" value="<?php echo $res['BC_ChuyenNganh'] ; ?>" size="60" maxlength="60" />
                      </span>
                  </div>
                <div class="row">    
                      <span class="bcl">Nước Đào Tạo:</span>
                      <span class="bcr">
                        <input type="text" name="BC_NcDT<?php echo $s;?>" id="BC_NcDT<?php echo $s;?>" value="<?php echo $res['BC_NuocDaoTao'] ; ?>" size="30" maxlength="40"  />
                      </span>
                      
                </div>
                <div class="row">
                      <span class="bcl">Tên Luận Án:</span>
                      <span class="bcr">
                        <input type="text" name="BC_TDT<?php echo $s;?>" id="BC_TDT<?php echo $s;?>" value="<?php echo $res['BC_TenDeTai'] ; ?>" size="60"  />
                      </span>
                   </div>
                <div class="row">   
                      <span class="bcl">Năm Hoàn Thành:</span>
                      <span class="bcr">
                        <input type="text" name="BC_NHT<?php echo $s;?>" id="BC_NHT<?php echo $s;?>" value="<?php echo $res['BC_NamHoanThanh'] ; ?>" size="4" maxlength="4" />
                      </span>
                      
                </div>
                <div class="btn_remove"><button onclick="return remove_bc(<?php echo $s;?>);">Xóa Bằng Này</button></div>
                </div>
                <?php
	                   }
                       
                        }
                ?>
                <div id="if_add_bc"></div><!--Danh cho viec add them khi bam them bang khac-->
                <div class="btn_add">
                      
                    <button  onclick="return add_bc()" >Thêm Bằng Khác</button>
                    
                </div>
                <div class="row line"></div>
                <!---------------------------------------------------------------> 
                <div class="mid"> <h3>Ngoại Ngữ</h3> </div>
                <input type="hidden" name="cnt_nn" id="cnt_nn" value="1" />
                
                <?php
	                  $sc = new NgoaiNgu();
                      $sc->setMaSo($nmaso);
                      $g_sc = $sc->thongtinNgoaiNgu();
                      $cnt_nn = mysql_num_rows($g_sc);
                      
                      echo '<script type="text/javascript">document.getElementById("cnt_nn").value='.$cnt_nn.';</script>';
                      $s = 0;
                      while($res= mysql_fetch_array($g_sc))
                      {
                       $s++; 
                       if($s<=$cnt_nn) 
                       {
                        
                            $dm3 = new LoaiNgoaiNgu();
                            $glnn = $dm3->dsLNN();
                            
                        
                       
                ?>
               <div id="nn<?php echo $s;?>"> 
               <input type="hidden" name="stt_nn<?php echo $s;?>" id="stt_nn<?php echo $s;?>" value="<?php echo $res['LNN_Ma'];?>" />
               <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Loại Ngoại Ngữ:</span>
                      <span class="bcr">
                             <select id="NN_kind<?php echo $s;?>" name="NN_kind<?php echo $s;?>" >
                                   <?php
	                                   while($gnn = mysql_fetch_array($glnn))
                                       {
                                         echo '<option value="'.$gnn['0'].'"';
                                         if($res['LNN_Ma']==$gnn['0']) echo' selected="true"'; 
                                         echo '>'.$gnn['1'].'</option>';
                                       }
                                    ?>                                   
                             </select>
                      </span>                      
                </div><div class="row">
                      <span class="bcl">Mức Độ Sử Dụng:</span>
                      <span class="bcr">
                             <select id="NN_MD<?php echo $s;?>" name="NN_MD<?php echo $s;?>" class="select">
                                   <option value="A"<?php if($res['NN_MucDo']=='A') echo' selected="true"';  ?> >A </option>
                                   <option value="B"<?php if($res['NN_MucDo']=='B') echo' selected="true"';  ?> >B</option>
                                   <option value="C"<?php if($res['NN_MucDo']=='C') echo' selected="true"';  ?> >C</option>
                                   <option value="D"<?php if($res['NN_MucDo']=='D') echo' selected="true"';  ?> >D</option>
                             </select>
                      </span>
                      
                      </div>
                
                    <div class="btn_remove"><button onclick="return remove_nn(<?php echo $s;?>);">Xóa Bằng Này</button></div>
                </div>
                <?php
	                   }
                       
                        }
                ?>
                <div id="if_add_nn"></div><!--Danh cho viec add them khi bam them bang khac-->
                <div class="btn_add">                  
                <button  onclick="return add_nn()" >Thêm Bằng Khác</button>
                </div>
                <!--------------------------------------------------------------->
                <div class="row line">
                
                </div>
                <div class=" mid">
                      
                    <input type="submit" value="Lưu Lại"   name="sch_save" id="sch_save" onclick="return check_qtdt();"/>
                    
                </div>
            </form>        
            </div><!--  END bgedit inschool -->
            
            
      </div><!--  END info-edit -->
     <!--------------------------------------------------------------------------------------------------------------> 
      <div class="info-edit">
            <div id="congtacchuyenmon" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Quá Trình Công Tác Chuyên Môn</h3>
            
            </div> <!--  END QuaTrinhCongTacChuyenMon -->
            <div class="bgedit" id="inwork">
            <form method="post" id="editworkForm" name="editworkForm">
                   <input type="hidden" name="code" value="3" />
                   <input type="hidden" name="cnt_ct" id="cnt_ct" value="0" />
                  <?php
	                  $wo = new QuaTrinhCongTac();
                      $wo->setMaSo($nmaso);
                      $g_sc = $wo->thongtinQuaTrinhCongTac();
                      $cnt_ct = mysql_num_rows($g_sc);                      
                      echo '<script type="text/javascript">document.getElementById("cnt_ct").value='.$cnt_ct.';</script>';
                      $s = 0;
                      while($res= mysql_fetch_array($g_sc))
                      {
                       $s++; 
                       if($s<=$cnt_ct) 
                       {
                        
                       
                ?>
            <div id="ct<?php echo $s;?>"> 
               <input type="hidden" name="stt_ct<?php echo $s;?>" id="stt_ct<?php echo $s;?>" value="<?php echo $res['CT_STT'];?>" />
            <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Ngày Bắt Đầu:</span>
                      <span class="bcr">
                             <input name="w_nbd<?php echo $s;?>" id="w_nbd<?php echo $s;?>" value="<?php echo $res['CT_TGBatDau'];?>" type="text" class="popupDatepicker" size="12" maxlength="12" readonly="true"  />
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Ngày Kết Thúc:</span>
                      <span class="bcr">
                             <input name="w_nkt<?php echo $s;?>" id="w_nkt<?php echo $s;?>" type="text" value="<?php echo $res['CT_TGKetThuc'];?>" class="popupDatepicker" size="12" maxlength="12" readonly="true"  />
                      </span>
                      
                </div>
                <div class="row">
                      <span class="bcl">Nơi Công Tác:</span>
                      <span class="bcr">
                             <textarea class="a_noicongtac" name="w_nct<?php echo $s;?>" id="w_nct<?php echo $s;?>"  cols="85" rows="1" ><?php echo $res['CT_NoiCongTac'];  ?></textarea>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Công Việc Đảm Nhận:</span>
                      <span class="bcr">
                             <textarea class="a_congviecdn" name="w_cvdn<?php echo $s;?>" id="w_cvdn<?php echo $s;?>"  cols="85" rows="1" ><?php echo $res['CT_CongViecDamNhan'];  ?></textarea>
                      </span>
                </div>
                <div class="btn_remove"><button onclick="return remove_ct(<?php echo $s;?>);">Xóa Quá Trình Này</button></div>
            </div>
                <?php
	                   }
                       
                        }
                ?>
                <div id="if_add_ct"></div><!--Danh cho viec add them khi bam them bang khac-->
                <div class="row">
                <button  onclick="return add_ct()" >Thêm quá trình Khác</button>
                    
                </div>
                <!--------------------------------------------------------------->
                <div class="row line"></div>
                <div class=" mid">
                      
                    <input type="submit" value="Lưu Lại"   name="wor_save" onclick="return check_ctcm();"  />
                    
                </div>
                        </form>
                        
                </div><!--  END bgedit congtachuyenmon -->
            
            
      </div><!--  END info-edit -->
      <!--------------------------------------------------------------------------------------------------------------> 
      <div class="info-edit">
            <div id="nghiencuukhoahoc" class="box-title" style="cursor: pointer">
            <h3 class=""> ▼ Quá Trình Nghiên Cứu Khoa Học</h3>
            
            </div> <!--   QuaTrinhNghienCuuKhoaHoc -->
            <div class="bgedit" id="insci">
            <form method="post" id="editsciForm" name="editsciForm">
                   <input type="hidden" name="code" value="4" />
                   <input type="hidden" name="cnt_nc" id="cnt_nc" value="0" />
            <div class="mid"> <h3>Đề Tài Nghiên Cứu Khoa Học</h3> </div>
            
            <?php
	              $vt = new VaiTro();
                  $vt->setMaSo($nmaso);
                  $g_nc = $vt->thongtinVaiTro();
                  $s = 0;
                   
                  while($ras= mysql_fetch_array($g_nc))
                   {
                      $nc = new DeTaiNghienCuu();
                      $nc->setNC_Ma($ras['NC_Ma']);
                      $g_sc = $nc->thongtinDeTaiNghienCuu();
                      $res= mysql_fetch_array($g_sc);
                      if($ras['VT_VaiTro']=='Chủ Trì')
                      {
                        $s++;
                ?>
            <div id="nc<?php echo $s;?>"> 
               <input type="hidden" name="stt_nc<?php echo $s;?>" id="stt_nc<?php echo $s;?>" value="<?php echo $ras['NC_Ma'];?>" />            
            <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Cấp Đề Tài:</span>
                      <span class="bcr">
                             <select id="CDT_Ma<?php echo $s;?>" name="CDT_Ma<?php echo $s;?>">
                                   <option value="CDT01"<?php if($res['CDT_Ma']=='CDT01') echo' selected="true"';  ?> >Nhà Nước </option>
                                   <option value="CDT02"<?php if($res['CDT_Ma']=='CDT02') echo' selected="true"';  ?> >Bộ</option>
                                   <option value="CDT03"<?php if($res['CDT_Ma']=='CDT03') echo' selected="true"';  ?> >Trường</option>
                             </select>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Tên Đề Tài:</span>
                      <span class="bcr">
                             <textarea class="a_ncten" name="NC_Ten<?php echo $s;?>" id="NC_Ten<?php echo $s;?>" required=""  cols="80" rows="2" ><?php echo $res['NC_Ten'];  ?></textarea>
                      </span>
                </div>
                 <div class="row">
                      <span class="bcl">Năm Bắt Đầu:</span>
                      <span class="bcr">
                             <input name="NC_NamBD<?php echo $s;?>" id="NC_NamBD<?php echo $s;?>" value="<?php echo $res['NC_NamBD'];?>" required="" type="text" size="4" maxlength="4"   />
                      </span>
                     </div>
                 <div class="row">
                      <span class="bcl">Năm Hoàn Thành:</span>
                      <span class="bcr">
                             <input name="NC_NamHT<?php echo $s;?>" id="NC_NamHT<?php echo $s;?>" value="<?php echo $res['NC_NamHT'];?>" type="text" required=""  size="4" maxlength="4"   />
                      </span>                      
                </div>
                <div class="row">
                      <span class="bcl">Đồng Tham Gia:</span>
                      <input type="hidden" name="1cnt_dtg<?php echo $s;?>" id="1cnt_dtg<?php echo $s;?>"  value="0" />
                </div>
                      <?php
                      $g_dtg_nc = $vt->dsDongThamGiaNC($ras['NC_Ma']);
                      $c_dtg =  mysql_num_rows($g_dtg_nc);
                      $c = 0;  
                      while($rs= mysql_fetch_array($g_dtg_nc))
                       {
                         $c++;
                       ?>
                       <div class="row2" id="1DTG<?php echo $s.$c.$rs['ND_ID'];?>">
                       <span class="ccr">Mã số: <?php echo $rs['ND_ID'];?> |</span>
                       <span class="ccr">Họ Tên: <?php echo $rs['CB_HoTen'];?></span>
                       <span class="ccr"><button onclick="return rem1dtg(<?php echo "'".$s.$c."','".$rs['ND_ID']."'";?>);">Xóa</button></span>
                       </div>
                       <?php                     
                       }
                       echo '<script type="text/javascript">document.getElementById("1cnt_dtg'.$s.'").value='.$c.';</script>';
                        ?>
                        <div id="setname<?php echo $s;?>">
                        </div>
                        <div class="row2">
                      <span class="bcr">
                        <input type="text" class="a_getid" onmousemove="sci_DTG_on(<?php echo $s;?>)" onmouseout="sci_DTG_out(<?php echo $s;?>)" name="NC_GN" id="1get_name<?php echo $s;?>" placeholder="Nhập mã số" value="" size="10" maxlength="10" />
                      </span>
                      <span class="bcr">
                        <button onclick="return getname(document.getElementById('1get_name<?php echo $s;?>').value,<?php echo $s;?>)">Thêm</button>
                      </span>
                    </div>
                <div class="sci_hint" id="sci_hint_DTG<?php echo $s;?>"></div>
                <div class="btn_remove"><button onclick="return remove_nc(<?php echo $s;?>);">Xóa Đề Tài Này</button></div>
                </div>
                <?php
	                 }else if($ras['VT_VaiTro']=='Tham Gia')
                     {
                ?>
                <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Cấp Đề Tài:</span>
                      <span class="dcr"><?php echo $res['CDT_Ten'];?></span>
                </div>
                <div class="row">
                      <span class="bcl">Tên Đề Tài:</span>
                      <span class="dcr"><?php echo $res['NC_Ten'];  ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Năm Bắt Đầu:</span><span class="dcr"><?php echo $res['NC_NamBD'];?></span>
                 </div>
                <div class="row"> 
                      <span class="bcl">Năm Hoàn Thành:</span><span class="dcr"><?php echo $res['NC_NamHT'];?></span>
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
                        ?>
                
                <?php   
                     } 
                     echo '<script type="text/javascript">document.getElementById("cnt_nc").value='.$s.';</script>';                     
                                              
                        }
                ?>
                <div id="if_add_nc"></div><!--Danh cho viec add them khi bam them 1 dong khac-->
                <div class="row">
                <button  onclick="return add_nc();" >Thêm Đề Tài Khác</button>
                    
                </div>
                <!--------------------------------------------------------------->
                <div class="row line"></div>
                       <input type="hidden" name="cnt_book" id="cnt_book" value="0" />
            <div class="mid"> <h3>Sách Và Giáo Trình Xuất Bản</h3> </div>
            <?php
	              $md = new MucDo();
                  $md->setMaSo($nmaso);
                  $g_bo = $md->thongtinMucDo();
                  //$c_vt =  mysql_num_rows($g_nc);
                  $s = 0; 
                  while($ras= mysql_fetch_array($g_bo))
                   {
                      $book = new SachGiaoTrinh();
                      $book->setSGT_Ma($ras['SGT_Ma']);
                      $g_sc = $book->thongtinSachGiaoTrinh();
                      $res= mysql_fetch_array($g_sc);
                      if($ras['MD_MucDo']=='1')
                      {
                        $s++;
                ?>
            <div id="bk<?php echo $s;?>"> 
            <input type="hidden" name="stt_bk<?php echo $s;?>" id="stt_bk<?php echo $s;?>" value="<?php echo $ras['SGT_Ma'];?>" />
            <div class="row mini_line"></div>
                 <div class="row">
                      <span class="bcl">Tên Sách:</span>
                      <span class="bcr">
                             <textarea class="a_sgtsach" name="SGT_Ten<?php echo $s;?>" id="SGT_Ten<?php echo $s;?>"  cols="82" rows="2" ><?php echo $res['SGT_Ten'];  ?></textarea>
                      </span>
                </div>
                 <div class="row">
                      <span class="bcl">Nhà Xuất Bản:</span>
                      <span class="bcr">
                        <input type="text" class="a_sgtnxb" name="SGT_NXB<?php echo $s;?>" id="SGT_NXB<?php echo $s;?>" value="<?php echo $res['SGT_NXB'] ; ?>" size="80" maxlength="80"  />
                      </span>
                     </div>
                 <div class="row">
                      <span class="bcl">Năm Xuất Bản:</span>
                      <span class="bcr">
                        <input type="text" name="SGT_NamXB<?php echo $s;?>" id="SGT_NamXB<?php echo $s;?>" value="<?php echo $res['SGT_NamXB'] ; ?>" size="4" maxlength="4"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Đồng Tác Giả:</span>
                      <input type="hidden" name="2cnt_dtg<?php echo $s;?>" id="2cnt_dtg<?php echo $s;?>"  value="0" />
                      <input type="hidden" name="22cnt_dtg<?php echo $s;?>" id="22cnt_dtg<?php echo $s;?>"  value="0" />
                </div>
                      <?php
                      $g_dtg_bk = $md->dsDongThamGiaBK($ras['SGT_Ma']);
                      $c_dtg =  mysql_num_rows($g_dtg_bk);
                      $c = 0;  
                      while($rs= mysql_fetch_array($g_dtg_bk))
                       {
                            $c++;
                       ?>
                       <div class="row2" id="2DTG<?php echo $s.$c.$rs['ND_ID'];?>">
                       <span class="ccr">Mã số: <?php echo $rs['ND_ID'];?> |</span>
                       <span class="ccr">Họ Tên: <?php echo $rs['CB_HoTen'];?></span>
                       <span class="ccr"><button onclick="return rem2dtg(<?php echo "'".$s.$c."','".$rs['ND_ID']."'";?>);">Xóa</button></span>
                       </div>
                       <?php                     
                       }
                       echo '<script type="text/javascript">document.getElementById("2cnt_dtg'.$s.'").value='.$c.';</script>'; 
                       $dtg = new TenDTG();
                       $dtg->setSGT_Ma($ras['SGT_Ma']);
                       $gdtg2 = $dtg->thongtinTenDTG();
                       $c = 0;
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                            $c++;
                        ?>
                        <div class="row2" id="22DTG<?php echo $s.$c.$rs['TDTG_STT'];?>">
                       <span class="ccr">Họ Tên: <?php echo $rs['TDTG_Ten'];?></span>
                       <span class="ccr"><button onclick="return rem22dtg(<?php echo "'".$s.$c."','".$rs['TDTG_STT']."'";?>);">Xóa</button></span>
                       </div>
                       <?php                     
                       }
                       echo '<script type="text/javascript">document.getElementById("22cnt_dtg'.$s.'").value='.$c.';</script>';
                       ?>
                       <div id="2setname<?php echo $s;?>"></div>
                       <div class="row2">
                      <span class="bcr">
                        <input type="text" class="a_getid" onmousemove="sci_DTG2_on(<?php echo $s;?>)" onmouseout="sci_DTG2_out(<?php echo $s;?>)" id="2get_name<?php echo $s;?>" name="BK_TDT<?php echo $s;?>" placeholder="Nhập mã số" value="" size="10" maxlength="10" />
                        <input type="text" class="a_getname" onmousemove="sci_DTG2_on(<?php echo $s;?>)" onmouseout="sci_DTG2_out(<?php echo $s;?>)" id="22get_name<?php echo $s;?>" name="BK2_TDT<?php echo $s;?>" placeholder="Nhập họ tên" value="" size="30" maxlength="40"  />
                      </span>
                      <span class="bcr">
                        <button onclick="return getname2(document.getElementById('2get_name<?php echo $s;?>').value,document.getElementById('22get_name<?php echo $s;?>').value,<?php echo $s;?>)">Thêm</button>
                      </span>
                                            
                </div>
                <div class="sci_hint" id="sci_hint_DTG2<?php echo $s;?>"></div>
                <div class="btn_remove"><button onclick="return remove_bk(<?php echo $s;?>);">Xóa Cuốn sách Này</button></div>
                </div>
                <?php
	                 }else 
                     {
                ?>
                <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Tên Sách:</span>
                      <span class="dcr"><?php echo $res['SGT_Ten'];?></span>
                </div>
                <div class="row">
                      <span class="bcl">Nhà Xuất Bản:</span>
                      <span class="dcr"><?php echo $res['SGT_NXB'];  ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Năm Xuất Bản:</span><span class="dcr"><?php echo $res['SGT_NamXB'];?></span>
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
                        ?>
                <?php   
                     }  
                        echo '<script type="text/javascript">document.getElementById("cnt_book").value='.$s.';</script>';                     
                                              
                        }
                ?>
                <div id="if_add_bk"></div><!--Danh cho viec add them khi bam them 1 dong khac-->
                <div class="row">
                <button  onclick="return add_bk()" >Thêm Sách Khác</button>
                    
                </div>
                
                <!--------------------------------------------------------------->
                <div class="row line"></div>
                       <input type="hidden" name="cnt_kh" id="cnt_kh" value="0" />
            <div class="mid"> <h3>Công Trình Nghiên Cứu Khoa Học</h3> </div>
            <?php
	              $vti = new ViTri();
                  $vti->setMaSo($nmaso);
                  $g_kh = $vti->thongtinViTri();
                  //$c_vt =  mysql_num_rows($g_nc);
                   $s = 0;
                  while($ras= mysql_fetch_array($g_kh))
                   {
                      $kh = new CongTrinhKhoaHoc();
                      $kh->setKH_Ma($ras['KH_Ma']);
                      $g_sc = $kh->thongtinCongTrinhKhoaHoc();
                      $res= mysql_fetch_array($g_sc);
                      if($ras['VT_ViTri']=='1')
                      {
                        $s++;
                ?>
            <div id="kh<?php echo $s;?>"> 
            <input type="hidden" name="stt_kh<?php echo $s;?>" id="stt_kh<?php echo $s;?>" value="<?php echo $ras['KH_Ma'];?>" />
            <div class="row mini_line"></div>
                 <div class="row">
                      <span class="bcl">Tên Công Trình:</span>
                      <span class="bcr">
                             <textarea class="a_khten" name="KH_Ten<?php echo $s;?>" id="KH_Ten<?php echo $s;?>"  cols="82" rows="2" ><?php echo $res['KH_Ten'];  ?></textarea>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Tên Tạp Chí:</span>
                      <span class="bcr">
                             <textarea class="a_khttchi" name="KH_TenTapChi<?php echo $s;?>" id="KH_TenTapChi<?php echo $s;?>" cols="82" rows="1" ><?php echo $res['KH_TenTapChi'];  ?></textarea>
                      </span>
                </div>
                 <div class="row">
                      <span class="bcl">Số Tạp Chí:</span>
                      <span class="bcr">
                        <input type="text" name="KH_SoTapChi<?php echo $s;?>" id="KH_SoTapChi<?php echo $s;?>" value="<?php echo $res['KH_SoTapChi'] ; ?>" size="10" maxlength="10"  />
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Trang Số:</span>
                      <span class="bcr">
                        <input type="text" name="KH_Trang<?php echo $s;?>" id="KH_Trang<?php echo $s;?>" value="<?php echo $res['KH_Trang'] ; ?>"  size="10" maxlength="10"/>
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Nhà Xuất Bản:</span>
                      <span class="bcr">
                        <input type="text" class="a_khnxb" name="KH_NXB<?php echo $s;?>" id="KH_NXB<?php echo $s;?>" value="<?php echo $res['KH_NXB'] ; ?>" size="80" maxlength="80"  />
                      </span>
                </div>
                <div class="row">
                      <span class="bcl">Năm Công Bố:</span>
                      <span class="bcr">
                        <input type="text"  name="KH_NamCongBo<?php echo $s;?>" id="KH_NamCongBo<?php echo $s;?>" value="<?php echo $res['KH_NamCongBo'] ; ?>" size="4" maxlength="4"/>
                      </span>
                 </div>
                <div class="row">
                      <span class="bcl">Đồng Tác Giả:</span>
                      <input type="hidden" name="3cnt_dtg<?php echo $s;?>" id="3cnt_dtg<?php echo $s;?>"  value="0" />
                      <input type="hidden" name="33cnt_dtg<?php echo $s;?>" id="33cnt_dtg<?php echo $s;?>"  value="0" />
                </div>
                      <?php
                      $g_dtg_kh = $vti->dsDongThamGiaKH($ras['KH_Ma']);
                      $c_dtg =  mysql_num_rows($g_dtg_kh);
                      $c = 0;  
                      while($rs= mysql_fetch_array($g_dtg_kh))
                       {
                        $c++;
                       ?>
                       <div class="row2" id="3DTG<?php echo $s.$c.$rs['ND_ID'];?>">
                       <span class="ccr">Mã số: <?php echo $rs['ND_ID'];?> |</span>
                       <span class="ccr">Họ Tên: <?php echo $rs['CB_HoTen'];?></span>
                       <span class="ccr"><button onclick="return rem3dtg(<?php echo "'".$s.$c."','".$rs['ND_ID']."'";?>);">Xóa</button></span>
                       </div>
                       <?php                     
                       }
                       echo '<script type="text/javascript">document.getElementById("3cnt_dtg'.$s.'").value='.$c.';</script>';
                       $dtg = new DongTacGia();
                       $dtg->setKH_Ma($ras['KH_Ma']);
                       $gdtg2 = $dtg->thongtinDongTacGia();
                       $c = 0;
                       while($rs= mysql_fetch_array($gdtg2))
                       {
                        $c++;
                        ?>
                        <div class="row2" id="33DTG<?php echo $s.$c.$rs['DTG_STT'];?>">
                       <span class="ccr">Họ Tên: <?php echo $rs['DTG_Ten'];?></span>
                       <span class="ccr"><button onclick="return rem33dtg(<?php echo "'".$s.$c."','".$rs['DTG_STT']."'";?>);">Xóa</button></span>
                       </div>
                       <?php                     
                       }
                       echo '<script type="text/javascript">document.getElementById("33cnt_dtg'.$s.'").value='.$c.';</script>';
                       ?>
                       <div id="3setname<?php echo $s;?>"></div>
                      <div class="row2">
                      <span class="bcr">
                        <input type="text" class="a_getid" onmousemove="sci_DTG3_on(<?php echo $s;?>)" onmouseout="sci_DTG3_out(<?php echo $s;?>)" id="3get_name<?php echo $s;?>" name="KH_DTG<?php echo $s;?>" placeholder="Nhập mã số" value="" size="10" maxlength="10" />
                        <input type="text" class="a_getname2" onmousemove="sci_DTG3_on(<?php echo $s;?>)" onmouseout="sci_DTG3_out(<?php echo $s;?>)" id="33get_name<?php echo $s;?>" name="KH_2DTG<?php echo $s;?>" placeholder="Nhập họ tên" value="" size="30" maxlength="40"  />
                      </span>
                      <span class="bcr">
                        <button onclick="return getname3(document.getElementById('3get_name<?php echo $s;?>').value,document.getElementById('33get_name<?php echo $s;?>').value,<?php echo $s;?>)">Thêm</button>
                      </span>     
                </div>
                <div class="sci_hint" id="sci_hint_DTG3<?php echo $s;?>"></div>
                <div class="btn_remove"><button onclick="return remove_kh(<?php echo $s;?>);">Xóa Công Trình Này</button></div>
                </div>
                <?php
	                 }else 
                     {
                ?>
                <div class="row mini_line"></div>
                <div class="row">
                      <span class="bcl">Tên Công Trình:</span><span class="dcr"><?php echo $res['KH_Ten'];  ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Tên Tạp Chí:</span><span class="dcr"><?php echo $res['KH_TenTapChi'];  ?></span>
                </div>
                 <div class="row">
                      <span class="bcl">Số Tạp Chí:</span><span class="dcr"><?php echo $res['KH_SoTapChi'] ; ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Trang Số:</span><span class="dcr"><?php echo $res['KH_Trang'] ; ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Nhà Xuất Bản:</span><span class="dcr"><?php echo $res['KH_NXB'] ; ?></span>
                </div>
                <div class="row">
                      <span class="bcl">Năm Công Bố:</span><span class="dcr"><?php echo $res['KH_NamCongBo'] ; ?></span>
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
                       ?>
                <?php   
                     }  
                     echo '<script type="text/javascript">document.getElementById("cnt_kh").value='.$s.';</script>';                    
                                              
                        }
                ?>
                <div id="if_add_kh"></div><!--Danh cho viec add them khi bam them 1 dong khac-->
                <div class="row">
                <button  onclick="return add_kh()" >Thêm Công Trình Khác</button>
                    
                </div>
                <!--------------------------------------------------------------->
                <div class="row line"></div>
                <div class=" mid">
                      
                    <input type="submit" value="Lưu Lại"   name="sci_save" onclick="return check_nckh();" />
                    
                </div>
                        </form>
                        
                </div><!--  END bgedit peinfo -->
            
            
      </div><!--  END info-edit -->
       <!-------------------------------------------------------------------------------------------------------------->
    </div> <!--  END main-content -->
    <div class="right">
    <a title="Download thời khóa biểu" target="_blank" href="Views/InLyLich_w.php"> 
					<img border="0" src="./Libraries/images/down.gif" align="middle"> Download lý lịch</a>
    <a  title="Tạo bản in lý lịch khoa học" href="javascript:opnwd('<?php
    echo 'Views/InLyLich.php'; ?>', 535, 1000, 'yes')"><img border="0" src="./Libraries/images/print.gif" align="absmiddle"/>Tạo bản in</a>
    </div>
   