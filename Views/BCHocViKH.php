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

<link rel="stylesheet" type="text/css" href="./Libraries/css/bchocvi.css" />
<script type="text/javascript" src="Libraries/js/bchocvi.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Báo cáo Học Vị Cao Nhất</h3>
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
    <button onclick="return gethocvi('<?php echo $maso; ?>',document.getElementById('cbobm').value)">Tạo báo cáo</button>
    </div>
    </div>
    <div id="result"></div>
</div>