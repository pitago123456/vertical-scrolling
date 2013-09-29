<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/NguoiDung.php');
    class MucDo extends NguoiDung{
        private $MD_MucDo;
                                
        public function setMD_MucDo($MD_MucDo){
            $this->MD_MucDo = $MD_MucDo;
        }
        public function getMD_MucDo(){
            return $this->MD_MucDo;
        }
                
        public function addMucDo($sgtma){
            $query = "select max(MD_MucDo) as md from MucDo where SGT_Ma='".$sgtma."'";
            $this->setQuery($query);            
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['md'];$h++;
            $this->setMD_MucDo($h);
        }
        public function themMucDo($id,$sgtma){
            $query = "insert into MucDo(ND_ID,SGT_Ma,MD_MucDo) 
            values ('".$id."','".$sgtma."','".$this->getMD_MucDo()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }        
        public function xoaMucDo($sgtma){
            $this->setQuery("delete from MucDo where  SGT_Ma='".$sgtma."'");
            return $this->executeQuery();
        }
        public function xoaMucDo2($sgtma,$id){
            $this->setQuery("delete from MucDo where  SGT_Ma='".$sgtma."'  and ND_ID='".$id."'");
            return $this->executeQuery();
        }
        public function thongtinMucDo(){
            $query = "select SGT_Ma,MD_MucDo from MucDo where  ND_ID='".$this->getMaSo()."' order by MD_MucDo DESC";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function dsDongThamGiaBK($sgtma){
            $this->setQuery("select a.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,MD_MucDo from MucDo a,CanBo b
            where SGT_Ma='".$sgtma."'and  a.ND_ID = b.ND_ID and a.ND_ID != '".$this->getMaSo()."'order by MD_MucDo");
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function dsDongThamGiaBK2($sgtma){
            $this->setQuery("select a.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,MD_MucDo from MucDo a,CanBo b
            where SGT_Ma='".$sgtma."'and  a.ND_ID = b.ND_ID order by MD_MucDo");
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function dsDongThamGiaBK3($que,$q){
            $this->setQuery("select distinct(c.SGT_Ma) as SGT_Ma 
            from MucDo a,CanBo b,(SachGiaoTrinh c LEFT OUTER JOIN TenDTG d on c.SGT_Ma = d.SGT_Ma),BoMon e,Khoa f
            where  c.SGT_Ma = a.SGT_Ma and a.ND_ID = b.ND_ID and b.BM_Ma = e.BM_Ma and e.ND_ID = f.ND_ID
            ".$que.' order by c.SGT_NamXB DESC,c.SGT_Ten '.$q);
            //echo $this->getQuery();
            return $this->fetchAll();
        }
    }
?>