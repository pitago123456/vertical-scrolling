<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class ViTri extends NguoiDung{
        private $VT_ViTri;
                                
        public function setVT_ViTri($VT_ViTri){
            $this->VT_ViTri = $VT_ViTri;
        }
        public function getVT_ViTri(){
            return $this->VT_ViTri;
        }
                
        public function addViTri($khma){
            $query = "select max(VT_ViTri) as vt from ViTri where KH_Ma='".$khma."'";
            $this->setQuery($query);            
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['vt'];$h++;
            $this->setVT_ViTri($h);
        }
        public function themViTri($id,$khma){
            $query = "insert into ViTri(ND_ID,KH_Ma,VT_ViTri) 
            values ('".$id."','".$khma."','".$this->getVT_ViTri()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }        
        public function xoaViTri($khma){
            $this->setQuery("delete from ViTri where  KH_Ma='".$khma."'");
            return $this->executeQuery();
        }
        public function xoaViTri2($khma,$id){
            $this->setQuery("delete from ViTri where  KH_Ma='".$khma."' and ND_ID='".$id."'");
            return $this->executeQuery();
        }
        public function thongtinViTri(){
            $query = "select KH_Ma,VT_ViTri from ViTri where  ND_ID='".$this->getMaSo()."' order by VT_ViTri DESC";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsDongThamGiaKH($makh){
            $this->setQuery("select a.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,VT_ViTri from ViTri a,CanBo b
            where KH_Ma='".$makh."' and a.ND_ID = b.ND_ID and a.ND_ID != '".$this->getMaSo()."'");
            return $this->fetchAll();
        }
        public function dsDongThamGiaKH2($makh){
            $this->setQuery("select a.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,VT_ViTri from ViTri a,CanBo b
            where KH_Ma='".$makh."' and a.ND_ID = b.ND_ID order by VT_ViTri ");
            return $this->fetchAll();
        }
        public function dsDongThamGiaKH3($que,$q){
            $this->setQuery("select distinct(c.KH_Ma) as KH_Ma 
            from ViTri a,CanBo b,(CongTrinhKhoaHoc c  LEFT OUTER JOIN DongTacGia d   on c.KH_Ma = d.KH_Ma),BoMon e,Khoa f
            where  c.KH_Ma = a.KH_Ma and a.ND_ID = b.ND_ID and b.BM_Ma = e.BM_Ma and e.ND_ID = f.ND_ID
            ".$que.' order by c.KH_NamCongBo DESC,c.KH_Ten '.$q);
           // echo $this->getQuery();
            return $this->fetchAll();
        }
    }
?>