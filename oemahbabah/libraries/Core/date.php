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



function bulan($bln){
	
	if($bln==1){return 'januari';}else
	if($bln==2){return 'februari';}else
	if($bln==3){return 'maret';}else
	if($bln==4){return 'april';}else
	if($bln==5){return 'mei';}else
	if($bln==6){return 'juni';}else
	if($bln==7){return 'juli';}else
	if($bln==8){return 'agustus';}else
	if($bln==9){return 'september';}else
	if($bln==10){return 'oktober';}else
	if($bln==11){return 'nopember';}else
	if($bln==12){return 'desember';}
}
function bln($bln){
	
	if($bln==1){return 'jan';}else
	if($bln==2){return 'feb';}else
	if($bln==3){return 'mar';}else
	if($bln==4){return 'apr';}else
	if($bln==5){return 'mei';}else
	if($bln==6){return 'jun';}else
	if($bln==7){return 'jul';}else
	if($bln==8){return 'ags';}else
	if($bln==9){return 'sep';}else
	if($bln==10){return 'okt';}else
	if($bln==11){return 'nop';}else
	if($bln==12){return 'des';}
}

function sDate($date){

/* 

Mengubah format dd/mm/YY menjadi YY-mm-dd
Contoh : 05/12/2018 Menjadi 2018-12-05

*/	
	$date=explode('/',$date);	
	$date=$date[2].'-'.$date[1].'-'.$date[0];	
	return $date;
}

function oDate($date){
/* 

Mengubah format dd/mm/YY menjadi YY-mm-dd
Contoh : 05/12/2018 Menjadi 2018-12-05

*/
	$date=explode('/',$date);	
	$date=$date[2].'-'.$date[1].'-'.$date[0];	
	return $date;
}

function tDate($date){
/* 

Mengubah format dd/mm/YY menjadi dd-mm-YY
Contoh : 05/12/2018 Menjadi 05-12-2018

*/	
	$date=explode('/',$date);	
	$date=$date[0].'-'.$date[1].'-'.$date[2];	
	return $date;
}

function nDate($date){
/* 

Mengubah format dd-mm-YY menjadi YY-mm-dd
Contoh : 05-12-2018 Menjadi 2018-12-05

*/	
	$date=explode('-',$date);	
	$date=$date[2].'-'.$date[1].'-'.$date[0];	
	return $date;
}

