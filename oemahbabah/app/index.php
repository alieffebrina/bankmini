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



if(!get_session()) {
header("location:page.php?page=login");
}
if (isset($_GET['page']) AND $_GET['page'] == 'logout')
{
user_logout();
header("location:page.php?page=login");
}
?>
<?php include'top.php';?>
<?php include 'navigation.php';?>
<?php include 'body.php';?>
<?php include 'footer.php';?>
