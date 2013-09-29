<?php
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
    
   
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
//---------------------code 1-----------------------------------------------------------------    
    if($_POST['code']== 1 ){

    $maso = $_SESSION['nmaso'];
    $holot = trim(substr($_POST['per_name'],0,strrpos($_POST['per_name'],' ')));
    $ten = trim(substr($_POST['per_name'],strrpos($_POST['per_name'],' ')));
    $phai = $_POST['per_gender'];
    $ngaysinh = $_POST['per_birth'];
    $noisinh= trim($_POST['per_city']);
    $quequan =trim($_POST['per_born']);
    $dantoc = trim($_POST['per_DT']);
    $chucdanh = $_POST['per_CD'];
    $chucvu = $_POST['per_CV'];
    $diachi = trim($_POST['per_Add']);
    $email = trim($_POST['per_Email']);
    $DTCQ = trim($_POST['per_DTCQ']);
    $DTNR = trim($_POST['per_DTNR']);
    $DTDD = trim($_POST['per_DTDD']);
    
    $nd = new NguoiDung();
    $cb = new CanBo();
    
    $nd->setMaSo($maso);    
    $cb->setMaSo($maso);
    $cb->setHoLot($holot);
    $cb->setTen($ten);
    $cb->setNgaySinh($ngaysinh);
    //echo $cb->getNgaySinh();
    $cb->setPhai($phai);
    $cb->setNoiSinh($noisinh);
    $cb->setQueQuan($quequan);
    $cb->setDanToc($dantoc);
    $cb->setChucDanhKH($chucdanh);
    $cb->setChucVu($chucvu);
    $cb->setEmail($email);
    $cb->setDiaChi($diachi);
    $cb->setDTCQ($DTCQ);
    $cb->setDTNR($DTNR);
    $cb->setDTDD($DTDD);
    
        
            if ($nd->isExits("NguoiDung","ND_ID='".$nd->getMaSo()."'") <= 0){
				 echo "<script language=javascript> alert('Không tồn tại cán bộ này!'); </script>";
				 require('Views/CapNhatLyLich.php');
			}
			else $cb->suaCanBo();
			echo "<script language=javascript> alert('Đã sửa thành công Lý lịch sơ lược!'); </script>";
			require('Views/CapNhatLyLich.php'); 
            echo "<script language=javascript> document.getElementById('state').value=2; </script>"; 
  		 		
//---------------------code 2-----------------------------------------------------------------	       
    }else if($_POST['code']== 2 )//form qua trinh dao tao submit
    {
    $maso = $_SESSION['nmaso'];
    $cnt_bc = $_POST['cnt_bc'];
    for($a=1;$a<=$cnt_bc;$a++)
    {
    
    if(isset($_POST['stt_bc'.$a])) $sttbc = $_POST['stt_bc'.$a];
    if(isset($_POST['rem_bc'.$a])) $rembc = $_POST['rem_bc'.$a];
    if(isset($_POST['an_bc'.$a])) $anbc = $_POST['an_bc'.$a];
    $bc = new BangCap();
    $bc->setMaSo($maso);
    if(isset($_POST['stt_bc'.$a])|| isset($_POST['an_bc'.$a]))
    {
           
    $loaibang = $_POST['BC_LB'.$a];
    $hedaotao = $_POST['BC_HDT'.$a];
    $noidaotao= trim($_POST['BC_NDT'.$a]);
    $nganhhoc =trim($_POST['BC_NH'.$a]);
    $chuyennganh = trim($_POST['BC_CN'.$a]);
    $nuocdaotao = trim($_POST['BC_NcDT'.$a]);
    $tendetai = trim($_POST['BC_TDT'.$a]);
    $namhoanthanh = trim($_POST['BC_NHT'.$a]);
    
    $bc->setLBCMa($loaibang);
    $bc->setHeDaoTao($hedaotao);
    $bc->setNoiDaoTao($noidaotao);
    $bc->setNganhHoc($nganhhoc);
    $bc->setChuyenNganh($chuyennganh);
    $bc->setNuocDaoTao($nuocdaotao);
    $bc->setTenDeTai($tendetai);
    $bc->setNamHoanThanh($namhoanthanh);
    }//end isset  
    $nd = new NguoiDung();
    $nd->setMaSo($maso);
    if ($nd->isExits("NguoiDung","ND_ID='".$nd->getMaSo()."'") <= 0){
		 echo "<script language=javascript> alert('Không tồn tại cán bộ này!'); </script>";
		 require('Views/CapNhatLyLich.php');
    }
    else{
        if(isset($sttbc)){//update
  			 $bc->setSTT($sttbc);
 			 $bc->suaBangCap(); 
               unset($sttbc);
 			   $i = 1;
  			}
         else if(isset($rembc)){ //xoa 
                $bc->setSTT($rembc);
                $bc->xoaBangCap();
                unset($rembc);
 			    $i = 2;
  			}
         else if(isset($anbc)){// them moi
                $bc->setSTT($bc->addSTT());
               	$bc->themBangCap();
                unset($anbc); 
  				$i = 3;  				    
                }				
		  }  
          
      
      }//end for
  	  /** * --------------------Ngoai Ngu--------------------------------------------- */
     $cnt_nn = $_POST['cnt_nn'];
    for($b=1;$b<=$cnt_nn;$b++)
    {
    
    if(isset($_POST['stt_nn'.$b])) $sttnn = $_POST['stt_nn'.$b];
    if(isset($_POST['rem_nn'.$b])) $remnn = $_POST['rem_nn'.$b];
    if(isset($_POST['an_nn'.$b])) $annn = $_POST['an_nn'.$b];
    $nn = new NgoaiNgu();
    $nn->setMaSo($maso);
    if(isset($_POST['stt_nn'.$b])|| isset($_POST['an_nn'.$b]))
    {
           
    $loainn = $_POST['NN_kind'.$b];
    $mucdo = $_POST['NN_MD'.$b];
       
    $nn->setLNNMa($loainn);
    $nn->setMucDo($mucdo);
    
    }else if(isset($_POST['rem_nn'.$b]))$nn->setLNNMa($_POST['rem_nn'.$b]); //end isset 
    
       if(isset($sttnn)){ //update
  			
               $nn->suaNgoaiNgu(); 
               unset($sttnn);
 			
  			}
         else if(isset($remnn)){ //xoa 
  				$nn->xoaNgoaiNgu();
                unset($remnn);
 						
  			}
         else if(isset($annn)){// them moi
                if ($nn->isExits("NgoaiNgu","ND_ID='".$nn->getMaSo()."' and LNN_Ma='".$nn->getLNNMa()."'") <= 0){ 
                $nn->themNgoaiNgu();
                unset($annn); 
  				
  				  }    
                }				
		    
          
      
      }//end for cua ngoai ngu   	
        
        echo "<script language=javascript> alert('Ðã cập nhật thành công Quá trình Đào Tạo!'); </script>";
		require('Views/CapNhatLyLich.php');
         echo "<script language=javascript> document.getElementById('state').value=3; </script>";   
      }//end post code 2
//---------------------code 3-----------------------------------------------------------------
    else if($_POST['code']== 3 )//form qua trinh cong tac chuyen mon submit
    {
    $maso = $_SESSION['nmaso'];
    $cnt_ct = $_POST['cnt_ct'];
    for($c=1;$c<=$cnt_ct;$c++)
    {
    
    if(isset($_POST['stt_ct'.$c])) $sttct = $_POST['stt_ct'.$c];
    if(isset($_POST['rem_ct'.$c])) $remct = $_POST['rem_ct'.$c];
    if(isset($_POST['an_ct'.$c])) $anct = $_POST['an_ct'.$c];
    $ct = new QuaTrinhCongTac();
    $ct->setMaSo($maso);
    if(isset($_POST['stt_ct'.$c])|| isset($_POST['an_ct'.$c]))
    {
           
    $ngaybd = $_POST['w_nbd'.$c];
    $ngaykt = $_POST['w_nkt'.$c];
    $noicongtac= trim($_POST['w_nct'.$c]);
    $cvdamnhan =trim($_POST['w_cvdn'.$c]);
        
    $ct->setTGBatDau($ngaybd);
    $ct->setTGKetThuc($ngaykt);
    $ct->setNoiCongTac($noicongtac);
    $ct->setCVDamNhan($cvdamnhan);
    }//end isset  
    $nd = new NguoiDung();
    $nd->setMaSo($maso);
    if ($nd->isExits("NguoiDung","ND_ID='".$nd->getMaSo()."'") <= 0){
		 echo "<script language=javascript> alert('Không tồn tại cán bộ này!'); </script>";
		 require('Views/CapNhatLyLich.php');
    }
    else{
        if(isset($sttct)){//update
  			 $ct->setCTSTT($sttct);
 			 $ct->suaQuaTrinhCongTac(); 
               unset($sttct);
 			   $i = 1;
  			}
         else if(isset($remct)){ //xoa 
                $ct->setCTSTT($remct);
                $ct->xoaQuaTrinhCongTac();
                unset($remct);
 			    $i = 2;
  			}
         else if(isset($anct)){// them moi
                $ct->setCTSTT($ct->addCTSTT());
               	$ct->themQuaTrinhCongTac();
                unset($anct); 
  				$i = 3;  				    
                }				
		  }  
          
      
      }//end for
  	  
        
     echo "<script language=javascript> alert('Ðã cập nhật thành công Quá trình Công Tác Chuyên Môn!'); </script>";
     require('Views/CapNhatLyLich.php'); 
      echo "<script language=javascript> document.getElementById('state').value=4; </script>";  
      }//end post code 3
     else if($_POST['code']== 4 )//form qua trinh nghien cuu khoa hoc submit
    {
    $maso = $_SESSION['nmaso'];
    //phan de tai nghien cuu
    $cnt_nc = $_POST['cnt_nc'];
    for($a=1;$a<=$cnt_nc;$a++)
    {
    
    if(isset($_POST['stt_nc'.$a])) $sttnc = $_POST['stt_nc'.$a];
    if(isset($_POST['rem_nc'.$a])) $remnc = $_POST['rem_nc'.$a];
    if(isset($_POST['an_nc'.$a])) $annc = $_POST['an_nc'.$a];
    $nc = new DeTaiNghienCuu();
    $vtro = new VaiTro();
    //$nc->setMaSo($maso);
    if(isset($_POST['stt_nc'.$a])|| isset($_POST['an_nc'.$a]))
    {
    $capdetai = trim($_POST['CDT_Ma'.$a]);
    $tendetai = trim($_POST['NC_Ten'.$a]);
    $nambatdau = trim($_POST['NC_NamBD'.$a]);
    $namhoanthanh =trim($_POST['NC_NamHT'.$a]);
        
    $nc->setCDTMa($capdetai);
    $nc->setNC_Ten($tendetai);
    $nc->setNC_NamBatDau($nambatdau);
    $nc->setNC_NamHoanThanh($namhoanthanh);
    
    
    }//end isset  
    $nd = new NguoiDung();
    $nd->setMaSo($maso);
    if ($nd->isExits("NguoiDung","ND_ID='".$nd->getMaSo()."'") <= 0){
		 echo "<script language=javascript> alert('Không tồn tại cán bộ này!'); </script>";
		 require('Views/CapNhatLyLich.php');
    }
    else{
        if(isset($sttnc)){//update
  			 $nc->setNC_Ma($sttnc);
 			 $nc->suaDeTaiNghienCuu();
              //lay so luong dong tac gia
                    $cnt_1dtg = trim($_POST['1cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_1dtg;$b++)
                        {
                          if(isset($_POST['rem_1dtg'.$a.$b]))
                          {
                            $dtg = $_POST['rem_1dtg'.$a.$b];
                            $vtro->xoaVaiTro2($dtg,$sttnc);
                          } 
                          else if(isset($_POST['1andtg'.$a.$b])) 
                          {
                            $dtg = $_POST['1andtg'.$a.$b];
                            $vtro->setVT_VaiTro('Tham Gia');
                            $vtro->themVaiTro($dtg,$sttnc);
                          } 
                        } 
               unset($sttnc);
 			   $i = 1;
  			}
         else if(isset($remnc)){ //xoa 
                $vtro->xoaVaiTro($remnc); 
                $nc->setNC_Ma($remnc);
                $nc->xoaDeTaiNghienCuu();
                
                unset($remnc);
 			    $i = 2;
  			}
         else if(isset($annc)){// them moi
             $anew = $nc->addNCMa();
             $nc->setNC_Ma($anew);
 			 $nc->themDeTaiNghienCuu();
             $vtro->setVT_VaiTro('Chủ Trì');
             $vtro->themVaiTro($maso,$anew);
              //lay so luong dong tac gia
                    $cnt_1dtg = trim($_POST['1cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_1dtg;$b++)
                        {
                          if(isset($_POST['1andtg'.$a.$b])) 
                          {
                            $dtg = $_POST['1andtg'.$a.$b];
                            $vtro->setVT_VaiTro('Tham Gia');
                            $vtro->themVaiTro($dtg,$anew);
                          } 
                        } 
                unset($anbc); 
  				$i = 3;  				    
                }				
		  }  
          
      
      }//end for de tai nghien cuu
      
      //phan sach giao trinh
    $cnt_bk = $_POST['cnt_book'];
    for($a=1;$a<=$cnt_bk;$a++)
    {
    
    if(isset($_POST['stt_bk'.$a])) $sttbk = $_POST['stt_bk'.$a];
    if(isset($_POST['rem_bk'.$a])) $rembk = $_POST['rem_bk'.$a];
    if(isset($_POST['an_bk'.$a])) $anbk = $_POST['an_bk'.$a];
    $bk = new SachGiaoTrinh();
    $mdo = new MucDo();
    $tdtg = new TenDTG();
    //$bk->setMaSo($maso);
    if(isset($_POST['stt_bk'.$a])|| isset($_POST['an_bk'.$a]))
    {
    $tensach = trim($_POST['SGT_Ten'.$a]);
    $nhaxuatban = trim($_POST['SGT_NXB'.$a]);
    $namxb = trim($_POST['SGT_NamXB'.$a]);    
        
    $bk->setSGT_Ten($tensach);
    $bk->setSGT_NXB($nhaxuatban);
    $bk->setSGT_NamXB($namxb);
     
    }//end isset  
    $nd = new NguoiDung();
    $nd->setMaSo($maso);
    if ($nd->isExits("NguoiDung","ND_ID='".$nd->getMaSo()."'") <= 0){
		 echo "<script language=javascript> alert('Không tồn tại cán bộ này!'); </script>";
		 require('Views/CapNhatLyLich.php');
    }
    else{
        if(isset($sttbk)){//update
  			 $bk->setSGT_Ma($sttbk);
 			 $bk->suaSachGiaoTrinh();
              //lay so luong dong tac gia
                    $cnt_2dtg = trim($_POST['2cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_2dtg;$b++)
                        {
                          if(isset($_POST['rem_2dtg'.$a.$b]))
                          {
                            $dtg = $_POST['rem_2dtg'.$a.$b];
                            $mdo->xoaMucDo2($sttbk,$dtg);
                          } 
                          else if(isset($_POST['2andtg'.$a.$b])) 
                          {
                            $dtg = $_POST['2andtg'.$a.$b];
                            $mdo->addMucDo($sttbk);
                            $mdo->themMucDo($dtg,$sttbk);
                          } 
                        }
               //update so luong ten dong tac gia khong co trong truong
                    $cnt_22dtg = trim($_POST['22cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_22dtg;$b++)
                        {
                          if(isset($_POST['rem_22dtg'.$a.$b]))
                          {
                            $stt_dtg = $_POST['rem_22dtg'.$a.$b];
                            $tdtg->xoaTenDTG2($stt_dtg,$sttbk);
                          } 
                          else if(isset($_POST['22andtg'.$a.$b])) 
                          {
                            $ten_dtg = $_POST['22andtg'.$a.$b];
                            $tdtg->setSGT_Ma($sttbk);
                            $tdtg->setTDTG_Ten($ten_dtg);
                            $tdtg->themTenDTG();                            
                          } 
                        }  
               unset($sttbk);
 			   $i = 1;
  			}
         else if(isset($rembk)){ //xoa 
                $mdo->xoaMucDo($rembk);
                $tdtg->xoaTenDTG($rembk); 
                $bk->setSGT_Ma($rembk);
                $bk->xoaSachGiaoTrinh();                
                unset($rembk);
 			    $i = 2;
  			}
         else if(isset($anbk)){// them moi
             $anew = $bk->addSGTMa();
             $bk->setSGT_Ma($anew);
 			 $bk->themSachGiaoTrinh();
             $mdo->setMD_MucDo('1');
             $mdo->themMucDo($maso,$anew);
              //them moi so luong dong tac gia
                    $cnt_2dtg = trim($_POST['2cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_2dtg;$b++)
                        {
                          if(isset($_POST['2andtg'.$a.$b])) 
                          {
                            $id_dtg = $_POST['2andtg'.$a.$b];
                            $mdo->addMucDo($anew);
                            $mdo->themMucDo($id_dtg,$anew);
                          } 
                        }
                //them moi so luong dong tac gia khong o trong truong
                    $cnt_22dtg = trim($_POST['22cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_22dtg;$b++)
                        {
                          if(isset($_POST['22andtg'.$a.$b])) 
                          {
                            $ten_dtg = $_POST['22andtg'.$a.$b];
                            $tdtg->setSGT_Ma($anew);
                            $tdtg->setTDTG_Ten($ten_dtg);
                            $tdtg->themTenDTG();                            
                          } 
                        }   
                unset($anbk); 
  				$i = 3;  				    
                }				
		  }  
          
      
      }//end for sach giao trinh
      //phan cong trinh nghien cuu khoa hoc
    $cnt_kh = $_POST['cnt_kh'];
    for($a=1;$a<=$cnt_kh;$a++)
    {
    
    if(isset($_POST['stt_kh'.$a])) $sttkh = $_POST['stt_kh'.$a];
    if(isset($_POST['rem_kh'.$a])) $remkh = $_POST['rem_kh'.$a];
    if(isset($_POST['an_kh'.$a])) $ankh = $_POST['an_kh'.$a];
    $kh = new CongTrinhKhoaHoc();
    $vtri = new ViTri();
    $tdtg = new DongTacGia();
    //$kh->setMaSo($maso);
    if(isset($_POST['stt_kh'.$a])|| isset($_POST['an_kh'.$a]))
    {
    $ten = trim($_POST['KH_Ten'.$a]);
    $namcb = trim($_POST['KH_NamCongBo'.$a]);
    $tentc = trim($_POST['KH_TenTapChi'.$a]); 
    $sotc = trim($_POST['KH_SoTapChi'.$a]);
    $trang = trim($_POST['KH_Trang'.$a]);
    $nxb = trim($_POST['KH_NXB'.$a]);   
        
    $kh->setKH_Ten($ten);
    $kh->setKH_NamCongBo($namcb);
    $kh->setKH_TenTapChi($tentc);
    $kh->setKH_SoTapChi($sotc);
    $kh->setKH_Trang($trang);
    $kh->setKH_NXB($nxb);
     
    }//end isset  
    $nd = new NguoiDung();
    $nd->setMaSo($maso);
    if ($nd->isExits("NguoiDung","ND_ID='".$nd->getMaSo()."'") <= 0){
		 echo "<script language=javascript> alert('Không tồn tại cán bộ này!'); </script>";
		 require('Views/CapNhatLyLich.php');
    }
    else{
        $i = 0;
        // echo "<script language=javascript> alert('Cập nhật thất bại Quá trình Nghiên Cứu Khoa Học!'); </script>";
		
        if(isset($sttkh)){//update
  			 $kh->setKH_Ma($sttkh);
 			 $kh->suaCongTrinhKhoaHoc();
              //lay so luong dong tac gia
                    $cnt_3dtg = trim($_POST['3cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_3dtg;$b++)
                        {
                          if(isset($_POST['rem_3dtg'.$a.$b]))
                          {
                            $dtg = $_POST['rem_3dtg'.$a.$b];
                            $vtri->xoaViTri2($sttkh,$dtg);
                          } 
                          else if(isset($_POST['3andtg'.$a.$b])) 
                          {
                            $dtg = $_POST['3andtg'.$a.$b];
                            $vtri->addViTri($sttkh);
                            $vtri->themViTri($dtg,$sttkh);
                          } 
                        }
               //update so luong ten dong tac gia khong co trong truong
                    $cnt_33dtg = trim($_POST['33cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_33dtg;$b++)
                        {
                          if(isset($_POST['rem_33dtg'.$a.$b]))
                          {
                            $stt_dtg = $_POST['rem_33dtg'.$a.$b];
                            $tdtg->xoaDongTacGia2($stt_dtg,$sttkh);
                          } 
                          else if(isset($_POST['33andtg'.$a.$b])) 
                          {
                            $ten_dtg = $_POST['33andtg'.$a.$b];
                            $tdtg->setKH_Ma($sttkh);
                            $tdtg->setDTG_Ten($ten_dtg);
                            $tdtg->themDongTacGia();                            
                          } 
                        }  
               unset($sttkh);
 			   $i = 1;
  			}
         else if(isset($remkh)){ //xoa 
                $vtri->xoaViTri($remkh);
                $tdtg->xoaDongTacGia($remkh); 
                $kh->setKH_Ma($remkh);
                $kh->xoaCongTrinhKhoaHoc();                
                unset($remkh);
 			    $i = 2;
  			}
         else if(isset($ankh)){// them moi
             $anew = $kh->addKHMa();
             $kh->setKH_Ma($anew);
 			 $kh->themCongTrinhKhoaHoc();
             $vtri->setVT_ViTri('1');
             $vtri->themViTri($maso,$anew);
              //them moi so luong dong tac gia
                    $cnt_3dtg = trim($_POST['3cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_3dtg;$b++)
                        {
                          if(isset($_POST['3andtg'.$a.$b])) 
                          {
                            $id_dtg = $_POST['3andtg'.$a.$b];
                            $vtri->addViTri($anew);
                            $vtri->themViTri($id_dtg,$anew);
                          } 
                        }
                //them moi so luong dong tac gia khong o trong truong
                    $cnt_33dtg = trim($_POST['33cnt_dtg'.$a]);
                    for($b=1;$b<=$cnt_33dtg;$b++)
                        {
                          if(isset($_POST['33andtg'.$a.$b])) 
                          {
                            $ten_dtg = $_POST['33andtg'.$a.$b];
                            $tdtg->setKH_Ma($anew);
                            $tdtg->setDTG_Ten($ten_dtg);
                            $tdtg->themDongTacGia();                            
                          } 
                        }   
                unset($ankh); 
  				$i = 3;  				    
                }				
		  }  
          
      
      }//end for cong  trinh nghien cuu khoa hoc
  	  	
       if($i>0) {
        echo "<script language=javascript> alert('Ðã cập nhật thành công Quá trình Nghiên Cứu Khoa Học!'); </script>";
		require('Views/CapNhatLyLich.php');
         echo "<script language=javascript> document.getElementById('state').value=4; </script>";   
      }else {
        echo "<script language=javascript> alert('Cập nhật thất bại Quá trình Nghiên Cứu Khoa Học!'); </script>";
		require('Views/CapNhatLyLich.php');
         echo "<script language=javascript> document.getElementById('state').value=4; </script>"; 
      }
      
      }//end post code 4       
            
        
  }                  
                              
  else include_once('Views/CapNhatLyLich.php');
  
?>