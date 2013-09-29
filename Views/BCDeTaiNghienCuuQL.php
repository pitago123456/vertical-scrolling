<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CapDeTai.php');
        $khoa = new Khoa();
        $res=$khoa->dsKhoa();
        $capdt = new CapDeTai();
        $ras = $capdt->dsCDT();

?>
<link rel="stylesheet" type="text/css" href="./Libraries/css/bcnghiencuu.css" />
<script type="text/javascript" src="Libraries/js/bcnghiencuu.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Báo cáo đề tài nghiên cứu khoa học</h3>
       
    <div class="box2">
    <span>Khoa:</span>    
    <select name="cbokhoa" id="cbokhoa" onchange="return find_bm();">
                          <option value="">Tất cả</option>
                          <?php
	                           while($row=mysql_fetch_array($res))//
                               {
                                echo '<option value="'.$row['ND_ID'].'">'.$row['Khoa_Ten'].'</option>';                                
                               }
                            ?>                          
    </select>    
    <span>Bộ Môn:</span>
    <div id="cbobomon">   
    <select name="cbobomon" id="cbobm">
                          <option value="">Tất cả</option>                          
    </select>
    </div>
    <button onclick="return getnghiencuu(document.getElementById('cbokhoa').value,document.getElementById('cbobm').value,
    document.getElementById('cbocdt').value,document.getElementById('get_nbd').value,document.getElementById('get_nkt').value)">Tạo báo cáo</button>
     
    </div>
    <div class="box3">
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
    <span>Năm Bắt Đầu: </span><input type="text"  id="get_nbd"  size="4" maxlength="4" />
    <span>Năm Kết Thúc: </span><input type="text"  id="get_nkt"  size="4" maxlength="4" />
    </div>
    </div>
    <div id="result"></div>
</div>