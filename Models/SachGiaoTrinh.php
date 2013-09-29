<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Configs/database.php');
    class SachGiaoTrinh extends database{
        private $SGT_Ma;
        private $SGT_Ten;
        private $SGT_NXB;
        private $SGT_NamXB;
                        
        public function setSGT_Ma($SGT_Ma){
            $this->SGT_Ma = $SGT_Ma;
        }
        public function getSGT_Ma(){
            return $this->SGT_Ma;
        }
        public function setSGT_Ten($SGT_Ten){
            $this->SGT_Ten = $SGT_Ten;
        }
        public function getSGT_Ten(){
            return $this->SGT_Ten;
        }        
        public function setSGT_NXB($SGT_NXB){
            $this->SGT_NXB = $SGT_NXB;
        }
        public function getSGT_NXB(){
            return $this->SGT_NXB;
        }
        public function setSGT_NamXB($SGT_NamXB){
            $this->SGT_NamXB = $SGT_NamXB;
        }
        public function getSGT_NamXB(){
            return $this->SGT_NamXB;
        }
        
        
        public function themSachGiaoTrinh(){
            $query = "insert into SachGiaoTrinh(SGT_Ma,SGT_Ten,SGT_NamXB,SGT_NXB) 
            values ('".$this->getSGT_Ma()."','".$this->getSGT_Ten()."','".$this->getSGT_NamXB()."','".$this->getSGT_NXB()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaSachGiaoTrinh(){
            $query = "update SachGiaoTrinh set SGT_Ten='".$this->getSGT_Ten()."',SGT_NamXB='".$this->getSGT_NamXB()."',
            SGT_NXB= '".$this->getSGT_NXB()."' where SGT_Ma ='".$this->getSGT_Ma()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaSachGiaoTrinh(){
            $this->setQuery("delete from SachGiaoTrinh where SGT_Ma ='".$this->getSGT_Ma()."'");
            return $this->executeQuery();
        }
        public function thongtinSachGiaoTrinh(){
            $query = "select SGT_Ten,SGT_NXB,SGT_NamXB from SachGiaoTrinh where  SGT_Ma='".$this->getSGT_Ma()."'";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function thongkeSachGiaoTrinh($que){
            $query = 'select SGT_NamXB,count(a.SGT_Ma) as Tong from sachgiaotrinh a,mucdo b,canbo c
            where a.SGT_Ma = b.SGT_Ma and b.ND_ID = c.ND_ID and MD_MucDo = 1 '.$que.'
            group by a.SGT_NamXB order by SGT_NamXB DESC';            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsDongThamGiaBK(){
            $this->setQuery("select * from SachGiaoTrinh");
            return $this->fetchAll();
        }
        public function addSGTMa()
        {
            $this->setQuery("select max(SGT_Ma) as sma from SachGiaoTrinh");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['sma'];$h++;
            return $h;
        }
    }
?>