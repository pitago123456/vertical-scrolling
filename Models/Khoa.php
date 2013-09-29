<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class Khoa extends NguoiDung{
        private $Khoa_Ten;
        
        public function setTenKhoa($Khoa_Ten){
            $this->Khoa_Ten = $Khoa_Ten;
        }
        public function getTenKhoa(){
            return $this->Khoa_Ten;
        }        
                
        public function themKhoa(){
            $query = "insert into Khoa(ND_ID,Khoa_Ten) 
            values ('".$this->getMaSo()."','".$this->getTenKhoa()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaKhoa(){
            $query = "update Khoa set Khoa_Ten='".$this->getTenKhoa()."' where ND_ID='".$this->getMaSo()."'";
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaKhoa(){
            $this->setQuery("delete from Khoa where  ND_ID='".$this->getMaSo()."'");
            return $this->executeQuery();
        }
        public function thongtinKhoa(){
            $query = "select ND_ID,Khoa_Ten from Khoa";
            $query .= " where  ND_ID='".$this->getMaSo()."'";
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function tenKhoa(){
            $query = "select Khoa_Ten from Khoa";
            $query .= " where  ND_ID='".$this->getMaSo()."'";
            $this->setQuery($query);
            $row = mysql_fetch_array($this->fetchAll());
            return $row['0'];
        }
        public function dsKhoa(){
            $this->setQuery("select ND_ID,Khoa_Ten from Khoa");
            return $this->fetchAll();
        }
        public function dsKhoa2($que){
            $this->setQuery("select ND_ID,Khoa_Ten from Khoa ".$que);
            return $this->fetchAll();
        }
    }
?>