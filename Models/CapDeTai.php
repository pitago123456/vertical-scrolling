<?php

/**
 * @author lioxca
 * @copyright 2012
 */

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    
    class CapDeTai extends NguoiDung{
        private $CDT_Ma;
        private $CDT_Ten;
                        
        public function setCDTMa($CDT_Ma){
            $this->CDT_Ma = $CDT_Ma;
        }
        public function getCDTMa(){
            return $this->CDT_Ma;
        }
        public function setCDTTen($CDT_Ten){
            $this->CDT_Ten = $CDT_Ten;
        }
        public function getCDTTen(){
            return $this->CDT_Ten;
        }        
        
                
        public function suaCDT(){
            $query = "update CapDeTai set CDT_Ten='".$this->getCDTTen()."' where CDT_Ma='".$this->getCDTMa()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        
        public function dsCDT(){
            $this->setQuery("select CDT_Ma,CDT_Ten from CapDeTai");
            return $this->fetchAll();
        }
        public function TenCDT(){
            $this->setQuery("select CDT_Ten from CapDeTai where CDT_Ma='".$this->getCDTMa()."'");
           
            $row = mysql_fetch_array($this->fetchAll());
            return $row['0'];
        }
    }

?>

