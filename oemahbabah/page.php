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
session_start();
error_reporting(0);
//notif();
if(isset($_GET['page']))
{
	$page=$_GET['page'].'.php';
	if(file_exists(__DIR__.'/app/page/'.$page))
	{
		include(__DIR__.'/app/page/'.$page);
	}
	else
	{
		echo '<div class="col-md-12"><div class="alert alert-danger"><i class="fa fa-warning"></i> File not found ('.__DIR__.'/app/page/'.$page.')</div></div>';
	}
}
else
{

}
?>
