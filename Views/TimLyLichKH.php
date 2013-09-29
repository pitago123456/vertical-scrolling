<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        include_once('Models/BoMon.php');
        $bm = new BoMon();
        $res=$bm->dsBM($_SESSION['nmaso']);

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
	   $( ".a_getid" ).autocomplete({source: "auto/GetID.php",minLength: 2});
       $( ".a_getname" ).autocomplete({source: "auto/GetNameCB.php",minLength: 2});
              
	});
	</script>
<!---------------------------------het phan auto complete------------------------------------------------------->
<link rel="stylesheet" type="text/css" href="./Libraries/css/timlylich.css" />
<script type="text/javascript" src="Libraries/js/timlylich.js"></script>
<div id="main">
    <div id="big-box-input">
    <h3>Tìm kiếm lý lịch khoa học của cán bộ</h3>
    <div class="box">
    <div class="box-mini"> Bộ Môn:</div>
    
    <div id="cbobomon">   
    <select name="cbobomon" id="cbobm">
                          <option value=" ">Tất cả</option>
                          <?php
	                           while($row=mysql_fetch_array($res))//
                               {
                                echo '<option value="'.$row['BM_Ma'].'">'.$row['BM_Ten'].'</option>';                                
                               }
                            ?>                            
    </select>
    </div> 
    </div>
    <div class="box-input">
    <div class="or">Hoặc</div>
    <div class="combo-input">
     <input type="text" class="a_getid" onmousemove="hint_on()" onmouseout="hint_out()" id="get_id"  placeholder="Nhập mã số" value="" size="10" maxlength="10" />
     <input type="text" class="a_getname" onmousemove="hint_on()" onmouseout="hint_out()" id="get_name"  placeholder="Nhập họ tên" value="" size="30" maxlength="40"  />
     </div>
     <div class="button"><button onclick="return getlylich2(document.getElementById('get_id').value,document.getElementById('get_name').value,'<?php echo $_SESSION['nmaso']; ?>',document.getElementById('cbobm').value)">Tìm</button>
    </div>
    </div>
    <div class="box" id="hint">
    </div>
    </div>
    <div id="result"></div>
</div>