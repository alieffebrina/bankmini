<?php 

class License { 

        /** 
         * Max length of the license. Must be divisible by 5. 
         * @var int 
         */ 
        private $_licenseLength = 10; 

        public function __construct() { } 

        /** 
         * Generates a license key. 
         * 
         * @return string 
         */ 
        public function generateLicense() { 

                $license = ''; 
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
                $charlen = strlen($chars); 

                if ($this->_licenseLength % 5 != 0) 
                        $this->_licenseLength = 25; 

                for ($i = 0; $i < $this->_licenseLength; $i++) { 
                        $key = mt_rand(0, $charlen); 

                        if ($key > 0) 
                                $key--; 

                        $license .= $chars[$key]; 
                } 
                $license = chunk_split($license, 5, '-'); 
                $license = substr($license, 0, -1); 

                return $license; 
        } 
}

$licenseClass = new License(); 

$date = new DateTime('2000-01-01');
//echo  $date->format('d-m-Y');
echo phpinfo();
?>
