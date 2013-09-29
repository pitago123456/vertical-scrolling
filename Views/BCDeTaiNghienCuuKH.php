<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/BoMon.php');
        $maso = $_SESSION['nmaso']; 
        $bm = new BoMon();
        $res=$bm->dsBM($maso);
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CapDeTai.php');
        $capdt = new CapDeTai();
        $ras = $capdt->dsCDT();

?>
<link rel="stylesheet" type="text/css" href="./Libraries/css/bcnghiencuu.css" />
<script type="text/javascript" src="Libraries/js/bcnghiencuu.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Báo cáo đề tài nghiên cứu khoa học</h3>
       
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
    <button onclick="return getnghiencuu('<?php echo $maso; ?>',document.getElementById('cbobm').value,
    document.getElementById('cbocdt').value,document.getElementById('get_nbd').value,document.getElementById('get_nkt').value)">Tạo báo cáo</button>
     
    </div>
    <div class="box">
    <span>Năm Bắt Đầu: </span><input type="text"  id="get_nbd"  size="4" maxlength="4" />
    <span>Năm Kết Thúc: </span><input type="text"  id="get_nkt"  size="4" maxlength="4" />
    </div>
    </div>
    <div id="result"></div>
</div>