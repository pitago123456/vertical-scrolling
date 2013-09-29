<?php

/**
 * @author lioxca
 * @copyright 2012
 */

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    
    class LoaiNgoaiNgu extends NguoiDung{
        private $LNN_Ma;
        private $LNN_Ten;
                        
        public function setLNNMa($LNN_Ma){
            $this->LNN_Ma = $LNN_Ma;
        }
        public function getLNNMa(){
            return $this->LNN_Ma;
        }
        public function setLNNTen($LNN_Ten){
            $this->LNN_Ten = $LNN_Ten;
        }
        public function getLNNTen(){
            return $this->LNN_Ten;
        }        
        
                
        public function suaLNN(){
            $query = "update LoaiNgoaiNgu set LNN_Ten='".$this->getLNNTen()."' where LNN_Ma='".$this->getLNNMa()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        
        public function dsLNN(){
            $this->setQuery("select * from LoaiNgoaiNgu");
            return $this->fetchAll();
        }
    }

?>

