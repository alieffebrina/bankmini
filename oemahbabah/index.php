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
session_start() ;
error_reporting(0);


if(!file_exists('config.php')){
	//echo '';
	header('location:page.php?page=setup');

} 


include 'config.php';
include $APP_DIR.'/index.php';

?>

