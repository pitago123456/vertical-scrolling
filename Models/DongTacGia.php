<?php
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CongTrinhKhoaHoc.php');
    class DongTacGia extends CongTrinhKhoaHoc{
        private $DTG_STT;
        private $DTG_Ten;
                                
        public function setDTG_STT($DTG_STT){
            $this->DTG_STT = $DTG_STT;
        }
        public function getDTG_STT(){
            return $this->DTG_STT;
        }
        public function setDTG_Ten($DTG_Ten){
            $this->DTG_Ten = $DTG_Ten;
        }
        public function getDTG_Ten(){
            return $this->DTG_Ten;
        }        
        
        public function addDTGSTT()
        {
            $this->setQuery("select max(DTG_STT) as sma from DongTacGia");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['sma'];$h++;
            return $h;
        }
        public function themDongTacGia(){
            $this->setDTG_STT($this->addDTGSTT());
            $query = "insert into DongTacGia(KH_Ma,DTG_STT,DTG_Ten) 
            values ('".$this->getKH_Ma()."','".$this->getDTG_STT()."','".$this->getDTG_Ten()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function xoaDongTacGia($khma){
            $this->setQuery("delete from DongTacGia where KH_Ma='".$khma."'");
            return $this->executeQuery();
        }
        public function xoaDongTacGia2($stt,$khma){
            $this->setQuery("delete from DongTacGia where KH_Ma='".$khma."' and DTG_STT='".$stt."'");
            return $this->executeQuery();
        }
        public function thongtinDongTacGia(){
            $query = "select DTG_STT,DTG_Ten from DongTacGia where  KH_Ma='".$this->getKH_Ma()."' order by DTG_STT";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsDongTacGia(){
            $this->setQuery("select * from DongTacGia");
            return $this->fetchAll();
        }
    }
?>