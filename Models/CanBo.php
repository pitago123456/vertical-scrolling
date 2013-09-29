<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Configs/database.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class CanBo extends NguoiDung{
        private $holot;
        private $ten;
        private $ngaysinh;
        private $phai;
        private $noisinh;
        private $quequan;
        private $dantoc;
        private $chucdanhkh;
        private $chucvu;
        private $diachi;
        private $email;
        private $dtcq;
        private $dtnr;
        private $dtdd;
                
        public function setHoLot($holot){
            $this->holot = $holot;
        }
        public function getHoLot(){
            return $this->holot;
        }
        public function setTen($ten){
            $this->ten = $ten;
        }
        public function getTen(){
            return $this->ten;
        }        
        public function setNgaySinh($ngaysinh){
            $this->ngaysinh = $ngaysinh;
        }
        public function getNgaySinh(){
            return $this->ngaysinh;
        }
        public function setPhai($phai){
            $this->phai = $phai;
        }
        public function getPhai(){
            return $this->phai;
        }
        public function setNoiSinh($noisinh){
            $this->noisinh = $noisinh;
        }
        public function getNoiSinh(){
            return $this->noisinh;
        }
        public function setQueQuan($quequan){
            $this->quequan = $quequan;
        }
        public function getQueQuan(){
            return $this->quequan;
        }
        public function setDanToc($dantoc){
            $this->dantoc = $dantoc;
        }
        public function getDanToc(){
            return $this->dantoc;
        }
         public function setChucDanhKH($chucdanhkh){
            $this->chucdanhkh = $chucdanhkh;
        }
        public function getChucDanhKH(){
            return $this->chucdanhkh;
        }
        public function setChucVu($chucvu){
            $this->chucvu = $chucvu;
        }
        public function getChucVu(){
            return $this->chucvu;
        }
        
        public function setDiaChi($diachi){
            $this->diachi = $diachi;
        }
        public function getDiaChi(){
            return $this->diachi;
        }
        
        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }
        
        public function setDTCQ($dtcq){
            $this->dtcq = $dtcq;
        }
        public function getDTCQ(){
            return $this->dtcq;
        }
        public function setDTNR($dtnr){
            $this->dtnr = $dtnr;
        }
        public function getDTNR(){
            return $this->dtnr;
        }
          public function setDTDD($dtdd){
            $this->dtdd = $dtdd;
        }
        public function getDTDD(){
            return $this->dtdd;
        }
        
        public function themCanBo($mabm){
            $query = "insert into CanBo(ND_ID,BM_Ma,CB_Ho,CB_Ten) 
            values ('".$this->getMaSo()."','".$mabm."','".$this->getHoLot()."','".$this->getTen()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaCanBo(){
            $query = "update CanBo set CB_Ho='".$this->getHoLot()."',CB_Ten='".$this->getTen()."', ";
            $query .= "CB_Phai='".$this->getPhai()."',CB_NgaySinh= '".$this->getNgaySinh()."',CB_NoiSinh='".$this->getNoiSinh().
            "',CB_QueQuan='".$this->getQueQuan()."',CB_DanToc='".$this->getDanToc().
            "',CB_ChucDanhKH='".$this->getChucDanhKH()."',CB_ChucVu='".$this->getChucVu()."',CB_DiaChi='".$this->getDiaChi().
            "',CB_DT_CQ='".$this->getDTCQ()."',CB_DT_NR='".$this->getDTNR()."',CB_DT_DD='".$this->getDTDD()."',CB_Email='".$this->getEmail().
            "' where ND_ID='".$this->getMaSo()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function suaCanBo2(){
            $query = "update CanBo set CB_Ho='".$this->getHoLot()."',CB_Ten='".$this->getTen()."'
             where ND_ID='".$this->getMaSo()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaCanBo(){
            $this->setQuery("delete from CanBo where  ND_ID='".$this->getMaSo()."'");
            return $this->executeQuery();
        }
        public function thongtinCanBo(){
            $query = "select ND_ID, concat(CB_Ho,' ',CB_Ten) as CB_HoTen,CB_Phai,CB_NgaySinh,
            CB_NoiSinh,CB_QueQuan,CB_DanToc,CB_ChucDanhKH,CB_ChucVu,CB_DiaChi,CB_DT_CQ,CB_DT_NR,CB_DT_DD,CB_Email from CanBo";
            $query .= " where  ND_ID='".$this->getMaSo()."'";
            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function thongtinCanBo2($que){
            $query = "select  concat(CB_Ho,' ',CB_Ten) as CB_HoTen from CanBo";
            $query .= " where  ND_ID='".$this->getMaSo()."'".$que;            
            $this->setQuery($query);
            //echo $query;
            return $this->fetchAll();
        }
        public function dsCanBo(){
            $this->setQuery("select * from CanBo");
            return $this->fetchAll();
        }
    }
?>