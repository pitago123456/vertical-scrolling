<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Configs/database.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/Khoa.php');
   
    class BoMon extends Khoa {
        private $BM_Ma;
        private $BM_Ten;
                
        public function setMaBM($BM_Ma){
            $this->BM_Ma = $BM_Ma;
        }
        public function getMaBM(){
            return $this->BM_Ma;
        }
        public function setTenBM($BM_Ten){
            $this->BM_Ten = $BM_Ten;
        }
        public function getTenBM(){
            return $this->BM_Ten;
        }        
                
        public function themBM(){
            $query = "insert into BoMon(BM_Ma,ND_ID,BM_Ten) 
            values ('".$this->getMaBM()."','".$this->getMaSo()."','".$this->getTenBM()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaBM(){
            $query = "update BoMon set BM_Ten='".$this->getTenBM()."' where BM_Ma='".$this->getMaBM()."'";
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaBM(){
            $this->setQuery("delete from BoMon where  BM_Ma='".$this->getMaBM()."'");
            return $this->executeQuery();
        }
        public function thongtinBM(){
            $query = "select BM_Ma,ND_ID,BM_Ten from BoMon";
            $query .= " where  BM_Ma='".$this->getMaBM()."'";
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsBM($khoa){
            $this->setQuery("select BM_Ma,BM_Ten from BoMon where  ND_ID='".$khoa."'");
            return $this->fetchAll();
        }
        public function dsBM2($khoa,$q){
            $this->setQuery("select BM_Ma,BM_Ten from BoMon where  ND_ID='".$khoa."' ".$q);
            //echo $this->getQuery();
            return $this->fetchAll();
        }
    }
?>