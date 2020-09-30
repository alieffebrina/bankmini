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

function dirToArray($dir) {
	$result = array(); 
	$cdir = scandir($dir); 
	foreach ($cdir as $key => $value) 
	{ 
		if (!in_array($value,array(".",".."))) 
	{ 
	if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
	{ 
		$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
	} 
	else 
	{ 
		$result[] = $value; 
	} 
	} 
	} 
	return $result; 
}

function SID(){
global $SID;
return $SID;
}
function SNAME(){
global $SNAME;
return $SNAME;
}
function version(){
global $version;
return $version;
}
function phoneCenter(){
echo '+6285 235 964 310';
}
function emailCenter(){
echo 'contact.djavasoft@gmail.com';
}



?>
