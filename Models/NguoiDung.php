<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/LLKH/Configs/database.php");
   
    class NguoiDung extends database{
        private $maso;
        private $matkhau;
        private $maquyen;

        public function setMaSo($maso){
            $this->maso = $maso;
        }
        public function getMaSo(){
            return $this->maso;
        }
        public function setMatKhau($matkhau){
            $this->matkhau = $matkhau;
        }
        public function getMatKhau(){
            return $this->matkhau;
        }
        public function setMaQuyen($maquyen){
            $this->maquyen = $maquyen;
        }
         public function getMaQuyen(){
            return $this->maquyen;
        }
        public function themNguoiDung(){
            $this->setQuery("insert into NguoiDung(ND_ID,ND_Pass,ND_Quyen) values ('".$this->getMaSo()."','".$this->getMatKhau()."','".$this->getMaQuyen()."')");
            return $this->executeQuery();
        }
        public function suaNguoiDung(){
            $this->setQuery("update NguoiDung set ND_Pass='".$this->getMatKhau()."',ND_Quyen='".$this->getMaQuyen()."' where ND_ID='".$this->getMaSo()."'");
			// echo $this->getQuery();
            return $this->executeQuery();
        }
         public function xoaNguoiDung(){
            $this->setQuery("delete from NguoiDung where ND_ID='".$this->getMaSo()."'");
            return $this->executeQuery();
        }
        public function kiemTra(){
            return $this->isExits("NguoiDung","ND_ID='". $this->maso."' and ND_Pass = '".$this->matkhau."'");
            //$this->getQuery();
        }
        public function ganQuyen(){
            if ($this->kiemTra()!=0){
                while ($rows = mysql_fetch_array($this->getResult())){
                    $this->setMaQuyen($rows['ND_Quyen']);               
               } 
            }
            
        }
        	
   }
       

?>