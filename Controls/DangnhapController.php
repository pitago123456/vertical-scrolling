<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CanBo.php');
    
   
    if (isset($_POST['txtmaso']) && isset($_POST['txtmatkhau'])){
        $user = new NguoiDung();
        $user->setMaSo(trim($_POST['txtmaso']));
        $user->setMatKhau(trim($_POST['txtmatkhau']));
        if ($user->kiemTra()!=0){
            while ($rows = mysql_fetch_array($user->getResult())){
                $user->setMaQuyen($rows['ND_QUYEN']);
               
            }
            
            $nmaso = $_SESSION['nmaso'] =  $user->getMaSo();
            //session_register("nmaso");
            //$maso = $_POST['txtmaso'];
            $nmaquyen = $_SESSION['nmaquyen']= $user->getMaQuyen();
			 
            //session_register("nmaquyen");
			if ($nmaquyen=='KH'){
				$sql = "select Khoa_Ten as HOTEN from NguoiDung a,Khoa b";
            	$sql .= " where a.ND_ID = b.ND_ID and a.ND_ID = '".$nmaso."'";
			}
            else if ($nmaquyen=='QL'){
				$sql = "select QL_HoTen as HOTEN from NguoiDung a,QuanLyKhoaHoc b";
            	$sql .= " where a.ND_ID = b.ND_ID and a.ND_ID = '".$nmaso."'";
    			}
    			else{
                    if ($nmaquyen=='CB'){
    				$sql = "select concat(CB_Ho,' ',CB_Ten) as HOTEN from NguoiDung a,CanBo b";
                	$sql .= " where a.ND_ID = b.ND_ID and a.ND_ID = '".$nmaso."'";
        			}
                	}
            //echo $sql;
            if($nmaquyen!='AD'){
            $user->setQuery($sql);
            $rows = mysql_fetch_array($user->fetchAll());
            $nten = $rows['HOTEN'];               
            } else $nten = 'Admin';           
            $_SESSION['nten'] = $nten;
            
            if($nmaquyen == 'CB')
                echo "<script language=javascript> window.location = 'index.php?option=capnhatlylich'; </script>";
            else if($nmaquyen == 'AD')
                    echo "<script language=javascript> window.location = 'index.php?option=admin'; </script>";
                else if($nmaquyen == 'KH')
                    echo "<script language=javascript> window.location = 'index.php?option=khoa'; </script>";
                    else if($nmaquyen == 'QL')
                    echo "<script language=javascript> window.location = 'index.php?option=quanlykhoahoc'; </script>";
                    else echo "<script language=javascript> window.location = 'index.php'; </script>";
            
        }
        else{
            echo "<script language=javascript> alert('Tên đăng nhập hoặc mật khẩu không đúng.');window.location = 'index.php'; </script>";  
        }
            
    } else include("Views/Dangnhap.php");
    
   
?>
