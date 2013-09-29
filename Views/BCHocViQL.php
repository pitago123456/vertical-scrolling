<?php

/**
 * @author lioxca
 * @copyright 2012
 */
        include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
        $khoa = new Khoa();
        $res=$khoa->dsKhoa();        

?>

<link rel="stylesheet" type="text/css" href="./Libraries/css/bchocvi.css" />
<script type="text/javascript" src="Libraries/js/bchocvi.js"></script>
<div id="main">
    <div id="big-box-input">
        <h3>Báo cáo Học Vị Cao Nhất</h3>
     <div class="box">
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
    <button onclick="return gethocvi(document.getElementById('cbokhoa').value,document.getElementById('cbobm').value)">Tạo báo cáo</button>
    </div>
    </div>
    <div id="result"></div>
</div>