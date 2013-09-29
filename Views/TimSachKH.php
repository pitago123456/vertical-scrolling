<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        $maso = $_SESSION['nmaso'];   
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
        $bm = new BoMon();
        $res=$bm->dsBM($maso);      

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
       $( ".a_sgtsach" ).autocomplete({source: "auto/TenSach.php",minLength: 1}); 
       $( ".a_sgtnxb" ).autocomplete({source: "auto/NXBSach.php",minLength: 1}); 
              
	});
	</script>
<!---------------------------------het phan auto complete------------------------------------------------------->
<link rel="stylesheet" type="text/css" href="./Libraries/css/timsach.css" />
<script type="text/javascript" src="Libraries/js/timsach.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Tìm kiếm sách và giáo trình</h3>
    <div class="box">
    <span>Mã số cán bộ: </span>
    <input type="text" class="a_getid"  id="get_id"  placeholder="Nhập mã số cán bộ" value="" size="10" maxlength="10" />
    </div>
    <div class="box">
    <span>Họ Tên cán bộ: </span>
    <input type="text" class="a_getname"  id="get_name"  placeholder="Nhập họ tên cán bộ" value="" size="30" maxlength="40"  />
    <button onclick="return getsach(document.getElementById('get_id').value,document.getElementById('get_name').value,
    document.getElementById('get_bk').value,'<?php echo $maso; ?>',document.getElementById('cbobm').value,
    document.getElementById('get_nxb').value,document.getElementById('get_ncb').value,'0')">Tìm</button>
    </div>
    <div class="box">
    <span>Tên Sách: </span>
    <textarea placeholder="Nhập tên sách hoặc giáo trình" class="a_sgtsach" id="get_bk" cols="100" rows="2" ></textarea>
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
    </div> 
    </div>     
     <div class="box3">
    <span>Nhà Xuất Bản: </span><textarea placeholder="Nhập tên nhà xuất bản của sách hoặc giáo trình" class="a_sgtnxb" id="get_nxb" cols="100" rows="1" ></textarea>
    <span>Năm Xuất Bản: </span><input type="text" placeholder="VD:2012" id="get_ncb"  size="4" maxlength="4" />
    </div>
    </div>
    <div id="result"></div>
</div>