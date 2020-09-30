<?php 
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2018 Djavasoft. (https://djavasoft.com/)
 *
 *
*/


function yHash($x){
	$data=explode('-',$x);
	$salt=$data[0];
	$it=strlen($x);
		if($it<5){
			$iterations=2;
		}elseif($it > 6 && $it < 10){
			$iterations=3;
		}elseif($it > 10){
			$iterations=4;
		}else{
			$iterations=2;
		}
	$hash = crypt($x,$salt);	
		for ($i = 0; $i < $iterations; ++$i)
		{
			$cek[] = crypt($i . $hash . $x,$salt);
		}	
	$pass=implode('',$cek);
	$pass=md5($pass);
	$pass=strtoupper($pass);
	$pass=substr($pass,0,6);
	return $pass;
}

function xHash($n) {
//return (((0x0000FFFF & $n) << 16) + ((0xFFFF0000 & $n) >> 16));
	$x=strtoupper(md5($n));
	return $x;
}

function numHash($n) {
	$x=substr(xHash($n),0,6);
	$x1=substr($x,0,3);
	$x2=substr($x,3,6);
	$x=$x1.'-'.$x2;
	$y=yHash($n);
	$y1=substr($y,0,3);
	$y2=substr($y,3,6);
	$y=$y1.'-'.$y2;
	$z=$x.'-'.$y;
	return $z;
}
