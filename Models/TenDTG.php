<?php
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/SachGiaoTrinh.php');
    class TenDTG extends SachGiaoTrinh{
        private $TDTG_STT;
        private $TDTG_Ten;
                                
        public function setTDTG_STT($TDTG_STT){
            $this->TDTG_STT = $TDTG_STT;
        }
        public function getTDTG_STT(){
            return $this->TDTG_STT;
        }
        public function setTDTG_Ten($TDTG_Ten){
            $this->TDTG_Ten = $TDTG_Ten;
        }
        public function getTDTG_Ten(){
            return $this->TDTG_Ten;
        }        
        
       public function addTDTGSTT()
        {
            $this->setQuery("select max(TDTG_STT) as sma from TenDTG");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['sma'];$h++;
            return $h;
        }
        public function themTenDTG(){
            $this->setTDTG_STT($this->addTDTGSTT());
            $query = "insert into TenDTG(SGT_Ma,TDTG_STT,TDTG_Ten) 
            values ('".$this->getSGT_Ma()."','".$this->getTDTG_STT()."','".$this->getTDTG_Ten()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }        
        public function xoaTenDTG($sma){
            $this->setQuery("delete from TenDTG where SGT_Ma='".$sma."'");
            return $this->executeQuery();
        }
        public function xoaTenDTG2($stt,$sma){
            $this->setQuery("delete from TenDTG where SGT_Ma='".$sma."' and TDTG_STT='".$stt."'");
            return $this->executeQuery();
        }
        public function thongtinTenDTG(){
            $query = "select TDTG_STT,TDTG_Ten from TenDTG where  SGT_Ma='".$this->getSGT_Ma()."' order by TDTG_STT";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsTenDTG(){
            $this->setQuery("select * from TenDTG");
            return $this->fetchAll();
        }
    }
?>