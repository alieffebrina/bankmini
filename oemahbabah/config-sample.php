<?php 
/* APLIKASI DPOS RESTO V3
 *
 * Framework DPOS-PHP 
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal, S.T
 * @copyright	Copyright (c) 2008 Djavasoft. (https://djavasoft.com/)
 *
 *
*/

date_default_timezone_set("Asia/Jakarta");
$CORE_URL			= "http://localhost/dpos-resto3-custom-2.6.12";
$SID				= "1002";
$SNAME				= "DPOS RESTO V3";
$version			= file_get_contents("app/version.txt");
$database_engine	="mysql"; 					//Anda bisa mengganti dengan sqlite atau mysql


/*------------------------------------ DATABASE MYSQL ------------------------------*/

if($database_engine=="mysql"){
	//MENGGUNAKAN MYSQL
	include 			"libraries/Database/mysql.class.php";	//class mysql database
	$db 				= new Database();			// instance database
	$db->dbHost			="localhost";				// database host
	$db->dbUser			="root";					// database username
	$db->dbPass			=""; 						// dabatabse password
	$db->dbName			="db_resto_v3_custom"; 				// database name
	include 			"libraries/Database/mysql.db.php";		// fungsi mysql

/*------------------------------------ DATABASE SQLITE ------------------------------*/

}elseif($database_engine=="sqlite"){
	//MENGGUNAKAN SQLITE3
	$storagelocation 	= __DIR__ ."/"; 						//direktori root
	$db_file 			= $storagelocation."/db/database.db";	//direktori menyimpan file database sqlite
	$db					= new SQLite3($db_file);				// instance database
	include 			"libraries/Database/sqlite.db.php";				// fungsi sqlite
}

/*------------------------------------ LIBRARIES ------------------------------*/

include "libraries/main.php";

$dir="libraries/Core";
$getDir=dirToArray($dir);
foreach($getDir as $d)
{
	include $dir."/".$d;
}

include "libraries/Helper/ox000fx.inc";

/*------------------------------------ APP ------------------------------*/

$APP_DIR= __DIR__."/app";
$ASSETS_DIR= __DIR__."/assets";
?>
