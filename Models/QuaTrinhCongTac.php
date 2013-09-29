<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class QuaTrinhCongTac extends NguoiDung{
        private $ct_stt;
        private $tgbatdau;
        private $tgketthuc;
        private $congviecdamnhan;
        private $noicongtac;
                        
        public function setCTSTT($ct_stt){
            $this->ct_stt = $ct_stt;
        }
        public function getCTSTT(){
            return $this->ct_stt;
        }
        public function setTGBatDau($tgbatdau){
            $this->tgbatdau = $tgbatdau;
        }
        public function getTGBatDau(){
            return $this->tgbatdau;
        }        
        public function setTGKetThuc($tgketthuc){
            $this->tgketthuc = $tgketthuc;
        }
        public function getTGKetThuc(){
            return $this->tgketthuc;
        }
        public function setCVDamNhan($congviecdamnhan){
            $this->congviecdamnhan = $congviecdamnhan;
        }
        public function getCVDamNhan(){
            return $this->congviecdamnhan;
        }
        public function setNoiCongTac($noicongtac){
            $this->noicongtac = $noicongtac;
        }
        public function getNoiCongTac(){
            return $this->noicongtac;
        }
        
        
        public function themQuaTrinhCongTac(){
            $query = "insert into QuaTrinhCongTac(ND_ID,CT_STT,CT_TGBatDau,CT_TGKetThuc,CT_NoiCongTac,CT_CongViecDamNhan) 
            values ('".$this->getMaSo()."','".$this->getCTSTT()."','".$this->getTGBatDau()."','".$this->getTGKetThuc()."',
            '".$this->getNoiCongTac()."','".$this->getCVDamNhan()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaQuaTrinhCongTac(){
            $query = "update QuaTrinhCongTac set CT_TGBatDau='".$this->getTGBatDau()."',CT_TGKetThuc= '".$this->getTGKetThuc()."'
            ,CT_NoiCongTac='".$this->getNoiCongTac()."',CT_CongViecDamNhan='".$this->getCVDamNhan()."'
             where ND_ID='".$this->getMaSo()."'and CT_STT = '".$this->getCTSTT()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaQuaTrinhCongTac(){
            $this->setQuery("delete from QuaTrinhCongTac where  ND_ID='".$this->getMaSo()."' and CT_STT = '".$this->getCTSTT()."'");
            return $this->executeQuery();
        }
        public function thongtinQuaTrinhCongTac(){
            $query = "select ND_ID,CT_STT,CT_TGBatDau,CT_TGKetThuc,CT_NoiCongTac,CT_CongViecDamNhan from QuaTrinhCongTac";
            $query .= " where  ND_ID='".$this->getMaSo()."'";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsQuaTrinhCongTac(){
            $this->setQuery("select * from QuaTrinhCongTac");
            return $this->fetchAll();
        }
        public function addCTSTT()
        {
            $this->setQuery("select max(CT_STT) as stt from QuaTrinhCongTac");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['stt'];$h++;
            return $h;
        }
    }
?>