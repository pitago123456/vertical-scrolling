<?php

/**
 * @author lioxca
 * @copyright 2012
 */

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    
    class LoaiBangCap extends NguoiDung{
        private $LBC_Ma;
        private $LBC_Ten;
                        
        public function setLBCMa($LBC_Ma){
            $this->LBC_Ma = $LBC_Ma;
        }
        public function getLBCMa(){
            return $this->LBC_Ma;
        }
        public function setLBCTen($LBC_Ten){
            $this->LBC_Ten = $LBC_Ten;
        }
        public function getLBCTen(){
            return $this->LBC_Ten;
        }        
        
                
        public function suaLBC(){
            $query = "update LoaiBangCap set LBC_Ten='".$this->getLBCTen()."' where LBC_Ma='".$this->getLBCMa()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        
        public function dsLBC(){
            $this->setQuery("select * from LoaiBangCap");
            return $this->fetchAll();
        }
    }

?>

