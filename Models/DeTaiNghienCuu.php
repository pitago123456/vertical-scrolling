<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/CapDeTai.php');
    class DeTaiNghienCuu extends CapDeTai{
        private $NC_Ma;
        private $NC_Ten;
        private $NC_NamBatDau;
        private $NC_NamHoanThanh;
                        
        public function setNC_Ma($NC_Ma){
            $this->NC_Ma = $NC_Ma;
        }
        public function getNC_Ma(){
            return $this->NC_Ma;
        }
        public function setNC_Ten($NC_Ten){
            $this->NC_Ten = $NC_Ten;
        }
        public function getNC_Ten(){
            return $this->NC_Ten;
        }        
        public function setNC_NamBatDau($NC_NamBatDau){
            $this->NC_NamBatDau = $NC_NamBatDau;
        }
        public function getNC_NamBatDau(){
            return $this->NC_NamBatDau;
        }
        public function setNC_NamHoanThanh($NC_NamHoanThanh){
            $this->NC_NamHoanThanh = $NC_NamHoanThanh;
        }
        public function getNC_NamHoanThanh(){
            return $this->NC_NamHoanThanh;
        }
       
        
        
        public function themDeTaiNghienCuu(){
            $query = "insert into DeTaiNghienCuu(NC_Ma,CDT_Ma,NC_Ten,NC_NamBD,NC_NamHT) 
            values ('".$this->getNC_Ma()."','".$this->getCDTMa()."','".$this->getNC_Ten()."','".$this->getNC_NamBatDau()."','".$this->getNC_NamHoanThanh()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaDeTaiNghienCuu(){
            $query = "update DeTaiNghienCuu set CDT_Ma='".$this->getCDTMa()."',NC_Ten='".$this->getNC_Ten()."', ";
            $query .= "NC_NamHT='".$this->getNC_NamHoanThanh()."',NC_NamBD= '".$this->getNC_NamBatDau()."' where NC_Ma='".$this->getNC_Ma()."'";
             //echo $this->getQuery();
            $this->setQuery($query);
            //echo $query;
            return $this->executeQuery();
        }
        public function xoaDeTaiNghienCuu(){
            $this->setQuery("delete from DeTaiNghienCuu where  NC_Ma='".$this->getNC_Ma()."'");
            return $this->executeQuery();
        }
        public function thongtinDeTaiNghienCuu(){
            $query = "select b.CDT_Ma as CDT_Ma,b.CDT_Ten as CDT_Ten,NC_Ten,NC_NamBD,NC_NamHT from DeTaiNghienCuu a,CapDeTai b
            where  NC_Ma='".$this->getNC_Ma()."' and a.CDT_Ma = b.CDT_Ma";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function thongtinDeTaiNghienCuu2($que,$q2){
            $query = "select b.CDT_Ma as CDT_Ma,CDT_Ten,NC_Ten,NC_NamBD,NC_NamHT,VT_VaiTro,CB_Ho,CB_Ten,
            concat(CB_Ho,' ',CB_Ten) as CB_HoTen,c.ND_ID as ND_ID,e.BM_Ma,BM_Ten,Khoa_Ten
            from DeTaiNghienCuu a,CapDeTai b, VaiTro c,CanBo d,BoMon e,Khoa f
            where  a.NC_Ma=c.NC_Ma and a.CDT_Ma = b.CDT_Ma and c.ND_ID = d.ND_ID and d.BM_Ma = e.BM_Ma and e.ND_ID = f.ND_ID ".$que.' order by c.ND_ID'.$q2;            
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function thongkeDeTai($que){
            $query = 'select nc_namht,cdt_ma,count(cdt_ma) as tong
            from detainghiencuu a, vaitro b,canbo c            
            where a.NC_Ma =b.NC_Ma and b.ND_ID = c.ND_ID and VT_VaiTro = "Chủ Trì" '.$que.'
             group by nc_namht,cdt_ma order by nc_namht DESC,cdt_ma';            
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function thongkeNamDeTai($que){
            $query = 'select distinct(nc_namht)
            from detainghiencuu a, vaitro b,canbo c            
            where a.NC_Ma =b.NC_Ma and b.ND_ID = c.ND_ID and VT_VaiTro = "Chủ Trì" '.$que.'
             group by nc_namht,cdt_ma order by nc_namht DESC,cdt_ma';            
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->fetchAll();
        }
        public function dsDeTaiNghienCuu(){
            $this->setQuery("select * from DeTaiNghienCuu");
            return $this->fetchAll();
        }
        public function addNCMa()
        {
            $this->setQuery("select max(NC_Ma) as ncma from DeTaiNghienCuu");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['ncma'];$h++;
            return $h;
        }
    }
?>