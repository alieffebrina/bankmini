<?php 
ob_start();
$serveruri=str_replace('/setup.php','',$_SERVER['REQUEST_URI']);
$CORE_URL			= $serveruri;
$SNAME				= "DPOS TOKO PRO";
$version			= file_get_contents('app/version.txt');
$sqlite_location 	= __DIR__ . 'db/database.db';

if($_SERVER["REQUEST_METHOD"] == "POST") {
$setting='config.php';
$myfile=fopen($setting,'w') or die('gagal insert username');
$txt='<?php 
date_default_timezone_set("Asia/Jakarta");
$CORE_URL			= "'.$_POST['url'].'";
$SID				= "1002";
$SNAME				= "'.$SNAME.'";
$version			= file_get_contents("app/version.txt");
$database_engine	="'.$_POST['database'].'"; 					//Anda bisa mengganti dengan sqlite atau mysql


/*------------------------------------DATABSE MYSQL ------------------------------*/
if($database_engine=="mysql"){
	//MENGGUNAKAN MYSQL
	include 			"library/mysql.class.php";	//class mysql database
	$db 				= new Database();			// instance database
	$db->dbHost			="'.$_POST['host'].'";				// database host
	$db->dbUser			="'.$_POST['user'].'";					// database username
	$db->dbPass			="'.$_POST['pass'].'"; 						// dabatabse password
	$db->dbName			="'.$_POST['nama'].'"; 				// database name
	include 			"library/mysql.db.php";		// fungsi mysql

/*------------------------------------DATABSE SQLITE ------------------------------*/

}elseif($database_engine=="sqlite"){
	//MENGGUNAKAN SQLITE3
	$storagelocation 	= __DIR__ ."/"; 						//direktori root
	$db_file 			= $storagelocation."/'.$_POST['lokasi_sqlite'].'";	//direktori menyimpan file database sqlite
	$db					= new SQLite3($db_file);				// instance database
	include 			"library/sqlite.db.php";				// fungsi sqlite
}
include "library/lib.php";
include "library/ox000fx.inc";

$APP_DIR= __DIR__."/app";
$ASSETS_DIR= __DIR__."/assets";
?>
';

fwrite($myfile,$txt);
fclose($myfile);

$sql = file_get_contents('db/dpos_db_kosong.sql');
if($_POST['database']=='mysql'){
$mysqli = new mysqli($_POST['host'], $_POST['user'], $_POST['pass'], $_POST['nama']);
if (mysqli_connect_errno()) { /* check connection */
    printf('Connect failed: %s\n', mysqli_connect_error());
    exit();
}
/* execute multi query */
if ($mysqli->multi_query($sql)) {
$alert='<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i> Instalasi Berhasil !</h4><a href="login.php">Silakan Login</a>	</div>';
	} else {
$alert='<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i> Gagal menginstall database!	</div>';}

}else{
	
}
}else{
	$alert="";
}
//$serveruri=str_replace('/login.php','',$_SERVER['REQUEST_URI']);
//echo checkData("user","WHERE username='admin' AND password='".md5('admin123')."'");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>INSTALASI DPOS</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/AdminLTE.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/_all-skins.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo $CORE_URL;?>/assets/js/sweetalert2.all.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
body {
background-color: #212C32 !important;
height:80%;

}
.has-feedback .form-control {
    padding-right: 0px !important;
}
.login-box, .register-box {
    width: 400px;
    margin: 7% auto;
	margin-top:10px;
}
.dev{
	color:#FFF;
	margin-top:5px
}

</style>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/jquery.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/bootstrap.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/adminlte.min.js"></script>
<script>
function dlSql(){
     window.location = "db/db_kasir.sql";
}

$(document).ready(function() {
$("#mysql_setup").hide();	 
$("#sqlite_setup").hide();	 

$('#database').change(function(){
if($('#database').val() == 'mysql') {
$("#mysql_setup").show();	 
$("#sqlite_setup").hide();	 
} else {
$("#mysql_setup").hide();	 
$("#sqlite_setup").show();		 
} 
});
});
</script>
</head>
<body >
<form action="" method="POST">
<div class="login-box">
<div class="login-logo">
<a href="#" style="color:#1072fd">Instalasi</a>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
<p class="login-box-msg">Setup Aplikasi <b><?php echo $SNAME?> versi <?php echo $version?></b></p>
	<?php echo $alert;?>

<form action="login.php" method="post">
<div class="form-group has-feedback">
<div class="input-group" >
<span class="input-group-btn"><button class="btn btn-primary btn-flat" type="button" style="width:100px">Database </button></span>
<select name="database" id="database" class="form-control">
<option readonly>Pilih Database</option>
<option>sqlite</option>
<option>mysql</option>
</select>
</div>
<div id="mysql_setup">
<div class="input-group" style="margin-top:3px">
<span class="input-group-btn"><button class="btn btn-flat" type="button" style="width:100px">Host </button></span>
<input type="text" class="form-control" placeholder="Nama Database" name="host" value="localhost">

</div>
<div class="input-group" style="margin-top:3px">
<span class="input-group-btn"><button class="btn btn-flat" type="button" style="width:100px">Nama DB </button></span>
<input type="text" class="form-control" placeholder="Nama Database" name="nama" value="">

</div>
<div class="input-group" style="margin-top:3px">
<span class="input-group-btn"><button class="btn btn-flat" type="button" style="width:100px">User DB </button></span>
<input type="text" class="form-control" placeholder="User Database" name="user" value="root">

</div>
<div class="input-group" style="margin-top:3px">
<span class="input-group-btn"><button class="btn btn-flat" type="button" style="width:100px">Pass DB </button></span>
<input type="text" class="form-control" placeholder="Password Database" name="pass" value="">

</div>
<br>
</div>

<div id="sqlite_setup">
<div class="input-group" style="margin-top:3px">
<span class="input-group-btn"><button class="btn btn-flat" type="button" style="width:100px">Lokasi</button></span>
<input type="text" class="form-control" placeholder="database" name="lokasi_sqlite" value="\db\database.db">

</div>
<br>
<a href="db/database.db">Download contoh database SQLite </a>

</div>

</div>
<div class="form-group has-feedback" style="display:block">
<div class="input-group" >
<span class="input-group-btn"><button class="btn btn-primary btn-flat" type="button" style="width:100px">Lokasi/URL </button></span>
<input type="text" class="form-control" placeholder="Lokasi" name="url" value="http://<?php echo $_SERVER['SERVER_NAME'].$serveruri;?>">
</div>      
</div>
<div class="form-group has-feedback">
<input disabled  type="checkbox" value="1" name="setuju" checked> Saya setuju dengan <a target="_BLANK" href="readme.php">ketentuan dan lisensi</a> yang berlaku     
</div>
<div class="row">
<!-- /.col -->
<div class="col-xs-4">
<input type="submit" class="btn btn-danger btn-block btn-flat pull-right" value="Setup" >

</div> 
<div class="col-xs-4">

</div>
<div class="col-xs-4">

</div>
<!-- /.col -->
</div>
</form>
<!-- /.social-auth-links -->
</div>
<!-- /.login-box-body -->
	<center><a href="login.php" class="btn btn-default btn-block btn-flat pull-right" ><i class="fa fa-fw fa-caret-square-o-left  "></i> Login</a>
	<br>
	<br>
	<img src="images/system/logo-djavasoft.png" style="width:100px">
</center></div>
<!-- /.login-box -->
</form>


</body>
</html>
