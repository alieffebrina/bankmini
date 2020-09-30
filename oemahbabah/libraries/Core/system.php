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



function MacAddr(){
	ob_start(); // Turn on output buffering
	system("ipconfig /all"); //Execute external program to display output
	$mycom=ob_get_contents(); // Capture the output into a variable
	ob_clean(); // Clean (erase) the output buffer
	$findme = "Physical";
	$pmac = strpos($mycom, $findme); // Find the position of Physical text
	$mac=substr($mycom,($pmac+36),17); // Get Physical Address
	return $mac;
}

function HDDSerial(){
	$serial =shell_exec('wmic DISKDRIVE GET SerialNumber 2>&1');
	$serial=str_replace('SerialNumber ','',$serial);
	return $serial;
}

function GetVolumeLabel($drive) {
	if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
	$volname = ' ('.$m[1].')';
	} else {
	$volname = '';
	}
	return $volname;
}

function HDDLabel(){
	$label = str_replace("(","",str_replace(")","",GetVolumeLabel("c")));
	$label= str_rot13(trim($label));
	return $label;
}


function IPServer(){
	$host= gethostname();
	$ip = gethostbyname($host);
	echo $ip;
}
