<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class QuanLyKhoaHoc extends NguoiDung{
        private $QL_Ten;
        
        public function setTenQuanLy($QL_Ten){
            $this->QL_Ten = $QL_Ten;
        }
        public function getTenQuanLy(){
            return $this->QL_Ten;
        }        
                
        public function themQuanLy(){
            $query = "insert into QuanLyKhoaHoc(ND_ID,QL_HoTen) 
            values ('".$this->getMaSo()."','".$this->getTenQuanLy()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaQuanLy(){
            $query = "update QuanLyKhoaHoc set QL_HoTen='".$this->getTenQuanLy()."' where ND_ID='".$this->getMaSo()."'";
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaQuanLy(){
            $this->setQuery("delete from QuanLyKhoaHoc where  ND_ID='".$this->getMaSo()."'");
            return $this->executeQuery();
        }
        public function thongtinQuanLy(){
            $query = "select ND_ID,QL_HoTen from QuanLyKhoaHoc";
            $query .= " where  ND_ID='".$this->getMaSo()."'";
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsQuanLy(){
            $this->setQuery("select * from QuanLyKhoaHoc");
            return $this->fetchAll();
        }
    }
?>