<?php

/**
 * @author lioxca
 * @copyright 2012
 */

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/LoaiNgoaiNgu.php');

    
    class NgoaiNgu extends LoaiNgoaiNgu{
        private $mucdo;
        
                        
        public function setMucDo($mucdo){
            $this->mucdo = $mucdo;
        }
        public function getMucDo(){
            return $this->mucdo;
        }
        
        
        
        public function themNgoaiNgu(){
            $query = "insert into NgoaiNgu(ND_ID,LNN_Ma,NN_MucDo) values ('".$this->getMaSo()."',
            '".$this->getLNNMa()."','".$this->getMucDo()."') ";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaNgoaiNgu(){
            $query = "update NgoaiNgu set NN_MucDo='".$this->getMucDo()."' 
            where ND_ID='".$this->getMaSo()."' and LNN_Ma='".$this->getLNNMa()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaNgoaiNgu(){
            $this->setQuery("delete from NgoaiNgu where ND_ID='".$this->getMaSo()."' and LNN_Ma='".$this->getLNNMa()."'");
            return $this->executeQuery();
        }
        public function thongtinNgoaiNgu(){
            $query = "select ND_ID,a.LNN_Ma as LNN_Ma,LNN_Ten,NN_MucDo from NgoaiNgu a,LoaiNgoaiNgu b";
            $query .= " where a.LNN_Ma=b.LNN_Ma and ND_ID='".$this->getMaSo()."'";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsNgoaiNgu(){
            $this->setQuery("select * from NgoaiNgu");
            return $this->fetchAll();
        }
    }

?>