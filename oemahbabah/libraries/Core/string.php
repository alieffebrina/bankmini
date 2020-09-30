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



function xString($text){
	global $database_engine;
	if($database_engine=='sqlite'){
		$text= SQLite3::escapeString($text);
	}else
	{
		$text=addslashes($text);
	}

	return $text;
}

function xCurrency($num){
	$num=str_replace(",","",$num);
	$num=str_replace(".","",$num);
	return $num;

}
function rupiah($nom)
{
	$rupiah = number_format(intval($nom),0,",",".");
	$rupiah = "Rp.".$rupiah." ";
	return $rupiah;
}
function currency($nom)
{
	$rupiah = number_format(intval($nom),0,".",",");
	$rupiah = "".$rupiah." ";
	return $rupiah;
}
function angka($nom)
{
	$rupiah = number_format(intval($nom),0,",",".");
	$rupiah = "".$rupiah." ";
	return $rupiah;
}
