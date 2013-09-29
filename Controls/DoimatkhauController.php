<?php
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $nd = new NguoiDung();
        $nd->setMaQuyen($_SESSION['nmaquyen']);
        $nd->setMaSo($_SESSION['nmaso']);
        //sua tai day: them vao
        $nd->setMatKhau(md5(trim($_POST['txtmatkhauht'])));
        //echo $nd->getMatKhau().' and '.$nd->kiemTra();
        
        if($nd->kiemTra())
        {
            $matkhaumoi = md5(trim($_POST['txtmatkhaumoi1']));
            $nd->setMatKhau($matkhaumoi);
            $nd->suaNguoiDung();
            echo "<script language=javascript> alert('Đổi thành công!'); </script>";
            include_once("Controls/ThoatController.php");
        }
        
        //het phan sua
               
        else{
             echo "<script language=javascript> alert('Mật khẩu hiện tại không đúng!'); </script>";
            include_once('Views/Doimatkhau.php');
        }
    }                                
    else include_once('Views/Doimatkhau.php');
?>
