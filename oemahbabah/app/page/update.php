<?php 
error_reporting(0);
ob_start();
$serveruri=str_replace('/page.php?page=update','',$_SERVER['REQUEST_URI']);
$CORE_URL			= $serveruri;
include 'config.php';


if($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_FILES["zip_file"]["name"]) AND $_FILES["zip_file"]["name"]!=='') {
upload_zip(__DIR__,"zip_file","");
header('location:page.php?page=update&mode=1');
}

$alert='<div class="callout callout-success">
<h4>Sukses!</h4>

<p>Berhasil Upload Paket</p>
</div>';
}else{
$alert="";
}

if($_GET['mode']==1){
$alert='<div class="callout callout-success">
<h4>Sukses!</h4>

<p>Berhasil Upload Paket</p>
</div>';
}
//$serveruri=str_replace('/login.php','',$_SERVER['REQUEST_URI']);
//echo checkData("user","WHERE username='admin' AND password='".md5('admin123')."'");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>UPDATE MANAGER</title>
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

</head>
<body >
<form action="update.php" method="post" ENCTYPE='MULTIPART/FORM-DATA'>
<input type="hidden" name="update" value="1">
<div class="login-box">
<div class="login-logo">
<a href="#" style="color:#1072fd">UPDATE MANAGER</a>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
<p class="login-box-msg" style="display:">Versi Saat Ini <b><?php echo $SNAME?> versi <?php echo $version?></b></p>
<?php echo $alert;?>

<div class="form-group has-feedback" style="display:block">
<div class="input-group" >
<span class="input-group-btn"><button class="btn btn-primary btn-flat" type="button" style="width:120px">Upload Paket </button></span>
<input type="file" class="form-control" placeholder="File" name="zip_file" value="">
</div>      
</div>
<div class="form-group has-feedback">
<input disabled  type="checkbox" value="1" name="setuju" checked> Saya setuju dengan <a target="_BLANK" href="readme.php">ketentuan dan lisensi</a> yang berlaku     
</div>
<div class="row">
<!-- /.col -->
<div class="col-xs-4">
<input type="submit" class="btn btn-danger btn-block btn-flat pull-right" value="Update" >

</div> 
<div class="col-xs-4">

</div>
<div class="col-xs-4">

</div>
<!-- /.col -->
</div>
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
