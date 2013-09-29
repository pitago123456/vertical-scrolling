<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
        $maso = $_SESSION['nmaso']; 
        $bm = new BoMon();
        $res=$bm->dsBM($maso);       

?>
<link rel="stylesheet" type="text/css" href="./Libraries/css/bcsach.css" />
<script type="text/javascript" src="Libraries/js/bcsach.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Báo cáo sách và giáo trình</h3>
   
    <div class="box"> 
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
    <span>Năm Xuất Bản: </span><input type="text" placeholder="VD:2012" id="get_ncb"  size="4" maxlength="4" />
    <button onclick="return getsach('<?php echo $maso; ?>',document.getElementById('cbobm').value,
    document.getElementById('get_ncb').value)">Tạo báo cáo</button>
    </div>
    </div>
    <div id="result"></div>
</div>