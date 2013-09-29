<?php

/**
 * @author lioxca
 * @copyright 2012
 */

    include_once($_SERVER['DOCUMENT_ROOT'].'/LLKH/Models/LoaiBangCap.php');
    
    class BangCap extends LoaiBangCap{
        private $stt;
        private $hedaotao;
        private $noidaotao;
        private $nganhhoc;
        private $chuyennganh;
        private $namhoanthanh;
        private $nuocdaotao;
        private $tendetai;
        private $dh;
        private $ths;
        private $ts;
                        
        public function setSTT($stt){
            $this->stt = $stt;
        }
        public function getSTT(){
            return $this->stt;
        }
        public function setHeDaoTao($hedaotao){
            $this->hedaotao = $hedaotao;
        }
        public function getHeDaoTao(){
            return $this->hedaotao;
        }        
        public function setNoiDaoTao($noidaotao){
            $this->noidaotao = $noidaotao;
        }
        public function getNoiDaoTao(){
            return $this->noidaotao;
        }
        public function setNganhHoc($nganhhoc){
            $this->nganhhoc = $nganhhoc;
        }
        public function getNganhHoc(){
            return $this->nganhhoc;
        }
        public function setChuyenNganh($chuyennganh){
            $this->chuyennganh = $chuyennganh;
        }
        public function getChuyenNganh(){
            return $this->chuyennganh;
        }
        public function setNamHoanThanh($namhoanthanh){
            $this->namhoanthanh = $namhoanthanh;
        }
        public function getNamHoanThanh(){
            return $this->namhoanthanh;
        }
        public function setNuocDaoTao($nuocdaotao){
            $this->nuocdaotao = $nuocdaotao;
        }
        public function getNuocDaoTao(){
            return $this->nuocdaotao;
        }
         public function setTenDeTai($tendetai){
            $this->tendetai = $tendetai;
        }
        public function getTenDeTai(){
            return $this->tendetai;
        }
        public function getDH(){
            return $this->dh;
        }public function getTHS(){
            return $this->ths;
        }public function getTS(){
            return $this->ts;
        }
        
        public function themBangCap(){
            $query = "insert into BangCap(ND_ID,LBC_Ma,BC_STT,BC_HeDaoTao,BC_NoiDaoTao,BC_NganhHoc,BC_ChuyenNganh,BC_NamHoanThanh,
             BC_NuocDaoTao,BC_TenDeTai) values ('".$this->getMaSo()."','".$this->getLBCMa()."','".$this->getSTT()."', ";
            $query .= "'".$this->getHeDaoTao()."','".$this->getNoiDaoTao()."','".$this->getNganhHoc()."','".$this->getChuyenNganh()."','".$this->getNamHoanThanh()."','"
            .$this->getNuocDaoTao()."','".$this->getTenDeTai()."')";
            $this->setQuery($query);
            //echo $this->getQuery();
            return $this->executeQuery();
        }
        public function suaBangCap(){
           
            $this->setQuery( "update BangCap set LBC_Ma='".$this->getLBCMa()."',BC_HeDaoTao='".$this->getHeDaoTao()."', BC_NoiDaoTao='".$this->getNoiDaoTao()."',BC_NganhHoc= '".$this->getNganhHoc()."',BC_ChuyenNganh='".$this->getChuyenNganh().
            "',BC_NamHoanThanh='".$this->getNamHoanThanh()."',BC_NuocDaoTao='".$this->getNuocDaoTao().
            "',BC_TenDeTai='".$this->getTenDeTai()."' where ND_ID='".$this->getMaSo()."' and BC_STT = '".$this->getSTT()."'");
             //echo $this->getQuery(); cho nay khong thuc thi dc sau khi lam cau tren
            //$this->setQuery($query);
            return $this->executeQuery();
        }
        public function xoaBangCap(){
            $this->setQuery("delete from BangCap where  ND_ID='".$this->getMaSo()."' and BC_STT = '".$this->getSTT()."'");
            //echo $this->getQuery();
            
            return $this->executeQuery();
        }
        public function thongtinBangCap(){
            $query = "select a.LBC_Ma,LBC_Ten,BC_STT,BC_HeDaoTao,BC_NoiDaoTao,
                      BC_NganhHoc,BC_ChuyenNganh,BC_NamHoanThanh,BC_NuocDaoTao,BC_TenDeTai from LoaiBangCap a,BangCap b
                      where a.LBC_Ma= b.LBC_Ma and ND_ID = '".$this->getMaSo()."'";            
            $this->setQuery($query);
            return $this->fetchAll();
        }
        public function thongtinHocVi($mabm){
            $query = "create temporary table tiensi
   SELECT b.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,c.LBC_Ma as LBC_Ma,LBC_Ten FROM CanBo a, BangCap b,LoaiBangCap c
  where a.ND_ID = b.ND_ID and b.LBC_Ma = c.LBC_Ma and c.LBC_Ma = 'LBC03' and a.BM_Ma = $mabm;";            
            $this->setQuery($query); $this->ts = $this->executeQuery(); 
            $query ="create temporary table thacsi
   SELECT b.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,c.LBC_Ma as LBC_Ma,LBC_Ten FROM CanBo a, BangCap b,LoaiBangCap c
  where a.ND_ID = b.ND_ID and b.LBC_Ma = c.LBC_Ma and c.LBC_Ma = 'LBC02' and a.BM_Ma = $mabm and b.ND_ID not in (select ND_ID from tiensi);";      
            $this->setQuery($query);$this->ths = $this->executeQuery();
            $query ="create temporary table daihoc
   SELECT b.ND_ID as ND_ID,concat(CB_Ho,' ',CB_Ten) as CB_HoTen,c.LBC_Ma as LBC_Ma,LBC_Ten FROM CanBo a, BangCap b,LoaiBangCap c
  where a.ND_ID = b.ND_ID and b.LBC_Ma = c.LBC_Ma and c.LBC_Ma = 'LBC01' and a.BM_Ma = $mabm and b.ND_ID not in (select ND_ID from tiensi) and b.ND_ID not in (select ND_ID from thacsi) ;";
            $this->setQuery($query);$this->dh = $this->executeQuery();
            $this->setQuery('select * from tiensi union (select * from thacsi) union (select * from daihoc);');
            $r =  $this->fetchAll();
            $this->setQuery('DROP TEMPORARY TABLE IF EXISTS tiensi,thacsi,daihoc;');
            $this->executeQuery();//
            return $r;                     
        }
        public function hocvicaonhat($maso){
            $r = '';
            $query = 'select LBC_Ma from BangCap where ND_ID = '.$maso.' order by LBC_Ma DESC limit 1';
            
            $this->setQuery($query);
            $row = mysql_fetch_array($this->fetchAll());
            if($row['LBC_Ma']=='LBC03') $r = 'TS';
            else if($row['LBC_Ma']=='LBC02') $r = 'ThS';
            return $r; 
        
        }        
        public function dsBangCap(){
            $this->setQuery("select * from BangCap");
            return $this->fetchAll();
        }
        public function addSTT()
        {
            $this->setQuery("select max(BC_STT) as stt from BangCap");
            $this->fetchAll();
            $res= mysql_fetch_array($this->fetchAll());
            $h=$res['stt'];$h++;
            return $h;
        }
    }

?>