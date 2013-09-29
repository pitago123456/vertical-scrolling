<?php

/**
 * @author lioxca
 * @copyright 2012
 */
    include_once('Models/CanBo.php');
    include_once('Models/NguoiDung.php');
    include_once('Models/BangCap.php');
    include_once('Models/NgoaiNgu.php');
    include_once('Models/QuaTrinhCongTac.php');
    include_once('Models/VaiTro.php');
    include_once('Models/DeTaiNghienCuu.php');
    include_once('Models/MucDo.php');
    include_once('Models/SachGiaoTrinh.php');
    include_once('Models/ViTri.php');
    include_once('Models/CongTrinhKhoaHoc.php');
    include_once('Models/DongTacGia.php');
    include_once('Models/TenDTG.php');
    $maso = $_SESSION['nmaso'];
    $quyen= $_SESSION['nmaquyen'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
    }
    else 
    {
        if($quyen== 'KH'){include_once('Views/TimNghienCuuKH.php');}
        else if($quyen== 'QL'){include_once('Views/TimNghienCuuQL.php');}
    }

?>