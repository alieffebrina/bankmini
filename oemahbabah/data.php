<?php 
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal, S.T
 * @copyright	Copyright (c) 2018 Djavasoft. (https://djavasoft.com/)
 *
 *
*/

ob_start();
error_reporting(0);
session_start() ;
include'config.php';
$dir='app/action';
$getDir=dirToArray($dir);
foreach($getDir as $d)
{
	include $dir.'/'.$d;
}
?>

