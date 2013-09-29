<?php

/**
 * @author lioxca
 * @copyright 2012
 */     $maso = $_SESSION['nmaso'];   
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CapDeTai.php');
        $bm = new BoMon();
        $res=$bm->dsBM($maso);
        $capdt = new CapDeTai();
        $ras = $capdt->dsCDT();

?>
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
	   $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 1});
       $( ".a_getname" ).autocomplete({source: "auto/GetNameCB.php",minLength: 1});
       $( ".a_ncten" ).autocomplete({source: "auto/TenNghienCuu.php",minLength: 1});
              
	});
	</script>
<!---------------------------------het phan auto complete------------------------------------------------------->
<link rel="stylesheet" type="text/css" href="./Libraries/css/timnghiencuu.css" />
<script type="text/javascript" src="Libraries/js/timnghiencuu.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Tìm kiếm đề tài nghiên cứu khoa học</h3>
    <div class="box">
    <span>Mã số cán bộ: </span>
    <input type="text" class="a_getid"  id="get_id"  placeholder="Nhập mã số cán bộ" value="" size="10" maxlength="10" />
    </div>
    <div class="box">
    <span>Họ Tên cán bộ: </span>
    <input type="text" class="a_getname"  id="get_name"  placeholder="Nhập họ tên cán bộ" value="" size="30" maxlength="40"  />
    <button onclick="return getnghiencuu(document.getElementById('get_id').value,document.getElementById('get_name').value,
    document.getElementById('get_nc').value,'<?php echo $maso; ?>',document.getElementById('cbobm').value,
    document.getElementById('cbocdt').value,document.getElementById('get_nbd').value,document.getElementById('get_nkt').value,'0')">Tìm</button>
    </div>
    <div class="box">
    <span>Tên đề tài nghiên cứu: </span>
    <textarea placeholder="Nhập tên đề tài nghiên cứu khoa học" class="a_ncten" id="get_nc" cols="100" rows="2" ></textarea>
    </div>
    <h4>Tùy chọn nâng cao</h4>
     <div class="box2">    
    <span>Bộ Môn:</span>
    <div id="cbobomon">   
    <select name="cbobomon" id="cbobm">
                          <option value="">Tất cả</option> 
                          <?php
	                           while($row=mysql_fetch_array($res))//
                               {
                                echo '<option value="'.$row['BM_Ma'].'">'.$row['BM_Ten'].'</option>';                                
                               }
                            ?>                         
    </select>
    <span>Cấp đề tài:</span>
        <div id="cbocapdetai">   
        <select name="cbocapdetai" id="cbocdt">
                              <option value="">Tất cả</option>
                              <?php
	                           while($raw=mysql_fetch_array($ras))//
                               {
                                echo '<option value="'.$raw['CDT_Ma'].'">'.$raw['CDT_Ten'].'</option>';                                
                               }
                            ?>                            
        </select>
        </div> 
    </div> 
    </div>
    <div class="box2">
    
    <span>Năm Bắt Đầu: </span><input type="text"  id="get_nbd"  size="4" maxlength="4" />
    <span>Năm Kết Thúc: </span><input type="text"  id="get_nkt"  size="4" maxlength="4" />
    </div>
    </div>
    <div id="result"></div>
</div>