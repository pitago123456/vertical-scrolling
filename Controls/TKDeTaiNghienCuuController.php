<?php

/**
 * @author lioxca
 * @copyright 2012
 */
    
    $maso = $_SESSION['nmaso'];
    $quyen= $_SESSION['nmaquyen'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
    }
    else 
    {
        if($quyen== 'KH'){include_once('Views/TKDeTaiNghienCuuKH.php');}
        else if($quyen== 'QL'){include_once('Views/TKDeTaiNghienCuuQL.php');}
    }

?>