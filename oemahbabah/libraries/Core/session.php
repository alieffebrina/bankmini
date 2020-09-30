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



function userlogin($user, $pass) {
$usr=checkData("user","WHERE username='".$user."' AND password='".md5($pass)."'");

if ($usr >= 1) {

$_SESSION['login'] = TRUE;
//$_SESSION['id'] = $user_data['id'];
$_SESSION['user'] = $user;
//$_SESSION['username'] = $username;
return TRUE;
}
else {
return FALSE;
}
}

function get_session() {
session_start();

if(isset($_SESSION['login'])){
return $_SESSION['login'];
}
}
function is_user_login() {
session_start();
if(isset($_SESSION['login'])){
return $_SESSION['login'];
}
}

// Logout 
function user_logout() {
$_SESSION['login'] = FALSE;
session_destroy();
}