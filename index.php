<?php
/**
 * @author lioxca
 * @copyright 2012
 */
    session_start();
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script type="text/javascript" src="Libraries/js/jquery.min.js"></script>
<script type="text/javascript" src="Libraries/js/jquery.datepick.js"></script>
<script type="text/javascript" src="Libraries/js/jquery.highlight-3.yui.js"></script>
<link href="Libraries/css/jquery.datepick.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
function thoat() {
        if (confirm('Bạn có chắc chắn muốn thoát không ?' )){
            window.location = 'index.php?option=thoat';
            //return;
        }
}


</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
 <title>Quản Lý Lý Lịch Khoa Học </title> 
		<div id="header">
			<?php
                include_once("header.php");
            ?>
		</div><!-- End header-->
        <div id="Container" class="MainContent">
       <?php
               

        if(isset($_GET['option']))  $option = $_GET['option']; else $option = 'null';
        if (isset($_SESSION['nmaso']))
        {
        $maquyen = $_SESSION['nmaquyen'];
                    
        
        if ($option == "doimatkhau"){
                          include("Controls/DoimatkhauController.php");
                      }
        else if ($option == "thoat"){
                          include("Controls/ThoatController.php");
                      }                      
        else if ($option == "capnhatlylich"){
                          include("Controls/CapnhatlylichController.php");
                      }
        else if ($option == "admin"){
                          include("Controls/AdminController.php");
                      }        
        else if ($option == "khoa"){
                          include("Controls/KhoaController.php");
                      }
        else if ($option == "quanlykhoahoc"){
                          include("Controls/QuanlykhoahocController.php");
                      }
        else if ($option == "timlylich"){
                          include("Controls/TimlylichController.php");
                      }
        else if ($option == "timnghiencuu"){
                          include("Controls/TimnghiencuuController.php");
                      }
        else if ($option == "timsach"){
                          include("Controls/TimsachController.php");
                      }
        else if ($option == "timcongtrinh"){
                          include("Controls/TimcongtrinhController.php");
                      }
        else if ($option == "tkhocvicaonhat"){
                          include("Controls/TKHocViCaoNhatController.php");
                      }
        else if ($option == "tkdetainghiencuu"){
                          include("Controls/TKDeTaiNghienCuuController.php");
                      }                      
        else if ($option == "tksachgiaotrinh"){
                          include("Controls/TKSachGiaoTrinhController.php");
                      } 
        else if ($option == "tkcongtrinh"){
                          include("Controls/TKCongTrinhController.php");
                      }
        else if ($option == "bchocvicaonhat"){
                          include("Controls/BCHocViCaoNhatController.php");
                      }
        else if ($option == "bcdetainghiencuu"){
                          include("Controls/BCDeTaiNghienCuuController.php");
                      }                      
        else if ($option == "bcsachgiaotrinh"){
                          include("Controls/BCSachGiaoTrinhController.php");
                      } 
        else if ($option == "bccongtrinh"){
                          include("Controls/BCCongTrinhController.php");
                      } 
        else if ($option == "capnhatkhoa"){
                        include("Controls/CapnhatkhoaController.php");
                    }
        else if ($option == "capnhatbomon"){
                        include("Controls/CapnhatbomonController.php");
                    }
        else if ($option == "capnhatcanbo"){
                        include("Controls/CapNhatCanBoController.php");
                    }
        else if ($option == "capnhatquanlykh"){
                        include("Controls/CapNhatQuanLyKhoaHocController.php");
                    } 
        else if ($option == "null"){
                 if($maquyen == 'AD' || $maquyen == 'QL' || $maquyen == 'KH')   include('Views/ThongTinCaNhan.php');
                 else if($maquyen == 'CB')   include("Controls/CapnhatlylichController.php");
                    } 
         else  include("Views/NotFound.php");
                                
 
        }//het phan xet neu ton tai ma so
        else{
                //if (empty($_GET['option'])){
//                        include("Views/Dangnhap.php");
//                }                
//                else {
                    //if ($option == "dangnhap"){
                        include("Controls/DangnhapController.php");
                    //}
                //} 
                    
            
        }
        
        ?>
		 </div><!-- End Main--> 
		 
   
 
  