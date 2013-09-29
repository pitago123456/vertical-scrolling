<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Configs/database.php');
    class CongTrinhKhoaHoc extends database{
        private $KH_Ma;
        private $KH_Ten;
        private $KH_NamCongBo;
        private $KH_TenTapChi;
        private $KH_SoTapChi;
        private $KH_Trang;
        private $KH_NXB;

                
        public function setKH_Ma($KH_Ma){
            $this->KH_Ma = $KH_Ma;
        }
        public function getKH_Ma(){
            return $this->KH_Ma;
        }
        public function setKH_Ten($KH_Ten){
            $this->KH_Ten = $KH_Ten;
        }
        public function getKH_Ten(){
            return $this->KH_Ten;
        }        
        public function setKH_NamCongBo($KH_NamCongBo){
            $this->KH_NamCongBo = $KH_NamCongBo;
        }
        public function getKH_NamCongBo(){
            return $this->KH_NamCongBo;
        }
        public function setKH_TenTapChi($KH_TenTapChi){
            $this->KH_TenTapChi = $KH_TenTapChi;
        }
        public function getKH_TenTapChi(){
            return $this->KH_TenTapChi;
        }
        public function setKH_SoTapChi($KH_SoTapChi){
            $this->KH_SoTapChi = $KH_SoTapChi;
        }
        public function getKH_SoTapChi(){
            return $this->KH_SoTapChi;
        }
        public function setKH_Trang($KH_Trang){
            $this->KH_Trang = $KH_Trang;
        }
        public function getKH_Trang(){
            return $this->KH_Trang;
        }
        public function setKH_NXB($KH_NXB){
            $this->KH_NXB = $KH_NXB;
        }
        public function getKH_NXB(){
            return $this->KH_NXB;
        }
        
        
        public function themCongTrinhKhoaHoc(){
            $query = 'insert into CongTrinhKhoaHoc(KH_Ma,KH_Ten,KH_TenTapChi,KH_NamCongBo,KH_SoTapChi,KH_Trang,KH_NXB) 
            values ("'.$this->getKH_Ma().'","'.$this->getKH_Ten().'","'.$this->getKH_TenTapChi().'","'.$this->getKH_NamCongBo().'","'.
            $this->getKH_SoTapChi().'","'.$this->getKH_Trang().'","'.$this->getKH_NXB().'")';
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaCongTrinhKhoaHoc(){
            $query = 'update CongTrinhKhoaHoc set KH_Ten="'.$this->getKH_Ten().'",KH_TenTapChi="'.$this->getKH_TenTapChi().'",
            KH_NamCongBo= "'.$this->getKH_NamCongBo().'",KH_SoTapChi="'.$this->getKH_SoTapChi().'",
            KH_Trang="'.$this->getKH_Trang().'",KH_NXB="'.$this->getKH_NXB().'" where  KH_Ma="'.$this->getKH_Ma().'"';
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaCongTrinhKhoaHoc(){
            $this->setQuery("delete from CongTrinhKhoaHoc where  KH_Ma='".$this->getKH_Ma()."'");
            return $this->executeQuery();
        }
        public function thongtinCongTrinhKhoaHoc(){
            $query = "select KH_Ten,KH_NamCongBo,KH_TenTapChi,KH_SoTapChi,KH_Trang,KH_NXB from CongTrinhKhoaHoc where  KH_Ma ='".$this->getKH_Ma()."'";
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function thongkeCongTrinhKhoaHoc($que){
            $query = 'select KH_NamCongBo,count(a.KH_Ma) as Tong from congtrinhkhoahoc a,vitri b,canbo c
            where a.KH_Ma = b.KH_Ma and b.ND_ID = c.ND_ID and VT_ViTri = 1 '.$que.'
            group by KH_NamCongBo order by KH_NamCongBo DESC';
            $this->setQuery($query);
            return $this->fetchAll();
        }         
        public function dsCongTrinhKhoaHoc(){
            $this->setQuery("select * from CongTrinhKhoaHoc");
            return $this->fetchAll();
        }
        public function addKHMa()
        {
            $this->setQuery("select max(KH_Ma) as khma from CongTrinhKhoaHoc");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['khma'];$h++;
            return $h;
        }
    }
?>