<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class VaiTro extends NguoiDung{
        private $VT_VaiTro;
                                
        public function setVT_VaiTro($VT_VaiTro){
            $this->VT_VaiTro = $VT_VaiTro;
        }
        public function getVT_VaiTro(){
            return $this->VT_VaiTro;
        }
        
        
        
        public function themVaiTro($id,$manc){
            $query = "insert into VaiTro(NC_Ma,ND_ID,VT_VaiTro) 
            values ('".$manc."','".$id."','".$this->getVT_VaiTro()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function xoaVaiTro($manc){
            $this->setQuery("delete from VaiTro where  NC_Ma='".$manc."'");
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function xoaVaiTro2($id,$manc){
            $this->setQuery("delete from VaiTro where NC_Ma='".$manc."' and ND_ID='".$id."'");
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function thongtinVaiTro(){
            $query = "select NC_Ma,VT_VaiTro from VaiTro where  ND_ID='".$this->getMaSo()."' order by VT_VaiTro DESC";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsDongThamGiaNC($manc){
            $this->setQuery("select a.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,VT_VaiTro from VaiTro a,CanBo b
            where a.ND_ID = b.ND_ID and a.ND_ID != '".$this->getMaSo()."' and NC_Ma='".$manc."' order by VT_VaiTro");
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function dsDongThamGiaNC2($que,$q){
            $this->setQuery("select distinct(c.NC_Ma) as NC_Ma 
            from VaiTro a,CanBo b,DeTaiNghienCuu c,BoMon d, Khoa e,CapDeTai f
            where a.ND_ID = b.ND_ID and a.NC_Ma = c.NC_Ma and b.BM_Ma = d.BM_Ma and d.ND_ID = e.ND_ID and f.CDT_Ma = c.CDT_Ma
            ".$que.' order by c.NC_NamHT DESC,c.NC_NamBD DESC,c.NC_Ten '.$q);
           
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function dsDongThamGiaNC3($manc){
            $this->setQuery("select a.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,VT_VaiTro,Khoa_Ten 
            from VaiTro a,CanBo b,BoMon c,Khoa d
            where a.ND_ID = b.ND_ID and b.BM_Ma = c.BM_Ma and c.ND_ID = d.ND_ID and NC_Ma='".$manc."' order by VT_VaiTro");
            //echo $this->getQuery();
            return $this->fetchAll();
        }
    }
?>