<?php

/**
 * @author lioxca
 * @copyright 2012
 * 
 */
    if(isset($_GET['option'])) {
    $cur = ' class="current" ';
    $option = $_GET['option'];
    if ($option == "capnhatlylich")  $cnll = $cur;
    if ($option == "admin" || $option == "quanlykhoahoc" || $option == "khoa")  $ttcn = $cur;
    if ($option == "timlylich"|| $option == "timnghiencuu"|| $option == "timsach"||
        $option == "timcongtrinh")  $tk = $cur; 
    if ($option == "tkhocvicaonhat"|| $option == "tkdetainghiencuu"||
         $option == "tksachgiaotrinh"|| $option == "tkcongtrinh")  $tke = $cur;                    
    if ($option == "bchocvicaonhat"|| $option == "bcdetainghiencuu"||
         $option == "bcsachgiaotrinh"|| $option == "bccongtrinh")  $bc = $cur;                  
    if ($option == "capnhatkhoa"|| $option == "capnhatbomon")  $cndm = $cur;
    if ($option == "capnhatcanbo")  $cnnd = $cur;                  
    
    }
?>
<!-- START OPTIMIZE -->
    <!-- Common CSS -->
		<link rel="stylesheet" type="text/css" href="./Libraries/css/global.css"/>
		<link rel="stylesheet" type="text/css" href="./Libraries/css/master.css"/>
   <!--  END. Common CSS -->
    <!-- IE Exception -->
        <!--[if IE 6]>			
			<style type="text/css">
li{ behavior: url(whateverhover.htc)};
</style>
        <![endif]--> 
		
    <!-- END. IE Exception -->
   
<!-- END. OPTIMIZE -->

<div id="img-top"> 
	<div id="Container">
		<div id="LogoCTU" title="Đại Học Cần Thơ"></div>
        <div id="banner-f">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="1400" height="110">
  <param name="movie" value="Libraries/images/banner5.swf" />
  <param name="quality" value="high" />
  <param name="allowScriptAccess" value="always" />
  <param name="wmode" value="transparent"/>
     <embed src="Libraries/images/banner5.swf"
      quality="high"
      type="application/x-shockwave-flash"
      WMODE="transparent"
      width="1400"
      height="110"
      pluginspage="http://www.macromedia.com/go/getflashplayer"
      allowScriptAccess="always" />
</object></div>
    <!--  END <div id="slogan"><h1 title="Quản Lý Lý Lịch Khoa Học"></h1></div>-->
         
         <div id="info_per" >
             <div class="row_head"> 
             <?php
	           if (isset($_SESSION['nmaso']))
        {
            echo '<a href="index.php?option=doimatkhau">Đổi mật khẩu</a> |
                <a href="javascript:thoat();">Thoát</a>';
        
            echo '    
                          
             </div>
              <div class="row_head"> <span id="">Xin Chào ';  
                            
                
                
                                echo $_SESSION['nten'];
                                echo "(".$_SESSION['nmaso'].")</span>" ;
        } 
              ?>
                       
               </div>         

           </div>
	<!------------------------------------------------------------>
<div id="menu" class="menu">
		
		<ul>
        <?php
	       if(isset($_SESSION['nmaquyen'])){
           if($_SESSION['nmaquyen']=='CB'){
        ?>
			<li <?php //if(isset($cnll)) echo $cnll; ?> ><a href="index.php?option=capnhatlylich"> Cập Nhật Lý Lịch</a>
				<ul>
					<li><a href="javascript:nav_llsl();">Lý Lịch Sơ Lược</a></li>
					<li><a href="javascript:nav_qtdt();">Quá Trình Đào Tạo </a></li>
                    <li><a href="javascript:nav_ctcm();">Quá Trình Công Tác Chuyên Môn</a></li>
					<li><a href="javascript:nav_nckh();">Quá Trình Nghiên Cứu Khoa Học </a></li>
				</ul>	
			</li>
            <?php
	       }
                if($_SESSION['nmaquyen']=='KH' || $_SESSION['nmaquyen']=='QL'){
           
            ?>
            <li <?php if(isset($ttcn)) echo $ttcn; ?> ><a href="index.php?option=quanlykhoahoc">Thông Tin Cá Nhân</a></li>
			<li<?php if(isset($tk)) echo $tk; ?>><a>Tìm Kiếm</a>
				<ul>
					<li><a href="index.php?option=timlylich">Lý Lịch Khoa Học Cán Bộ</a></li>
					<li><a href="index.php?option=timnghiencuu">Đề Tài Nghiên Cứu Khoa Học</a></li>
                    <li><a href="index.php?option=timsach">Sách và Giáo Trình</a></li>
					<li><a href="index.php?option=timcongtrinh">Công Trình Nghiên Cứu Khoa Học</a></li>
					
				</ul>	
			</li>
			<li<?php if(isset($tke)) echo $tke; ?>><a>Thống Kê</a>
				<ul>
					<li><a href="index.php?option=tkhocvicaonhat">Học Vị Cao Nhất</a></li>
					<li><a href="index.php?option=tkdetainghiencuu">Đề Tài Nghiên Cứu Khoa Học</a></li>
                    <li><a href="index.php?option=tksachgiaotrinh">Sách và Giáo Trình</a></li>
					<li><a href="index.php?option=tkcongtrinh">Công Trình Nghiên Cứu Khoa Học</a></li>
				</ul>	
			</li>
  	         <li<?php if(isset($bc)) echo $bc; ?>><a>Báo Cáo</a>
				<ul>
					<li><a href="index.php?option=bchocvicaonhat">Học Vị Cao Nhất</a></li>
					<li><a href="index.php?option=bcdetainghiencuu">Đề Tài Nghiên Cứu Khoa Học</a></li>
                    <li><a href="index.php?option=bcsachgiaotrinh">Sách và Giáo Trình</a></li>
					<li><a href="index.php?option=bccongtrinh">Công Trình Nghiên Cứu Khoa Học</a></li>
				</ul>	
			</li>
            
            <?php
	       }
                if($_SESSION['nmaquyen']=='AD'){
           
            ?>
            <li<?php if(isset($ttcn)) echo $ttcn; ?>><a href="index.php?option=admin">Thông Tin Cá Nhân</a></li>
            <li <?php if(isset($cndm)) echo $cndm; ?>><a>Cập Nhật Danh Mục</a>
            <ul>
					<li><a href="index.php?option=capnhatkhoa">Khoa</a></li>
					<li><a href="index.php?option=capnhatbomon">Bộ Môn</a></li>
				</ul>
            </li>
            <li <?php if(isset($cnnd)) echo $cnnd; ?>><a>Cập Nhật Người Dùng</a>
                 <ul>
					<li><a href="index.php?option=capnhatcanbo">Cán Bộ</a></li>
					<li><a href="index.php?option=capnhatquanlykh">Quản Lý Khoa Học</a></li>
					
				</ul>
				
			</li>
            <?php
	       }  }       
            ?>
		</ul>		
	</div><!--End #menu-->	
    </div>	<!--End #Container-->
 </div> <!--End #img-top-->