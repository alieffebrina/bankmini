<?php 
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2008 Djavasoft. (https://djavasoft.com/)
 *
 *
*/

ob_start();
error_reporting(0);
if(!file_exists('config.php')){
	header('location:page.php?page=setup');
} 
include 'config.php';
$alert='';
if(is_user_login()) {
  header("location:index.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $login=userlogin($_POST['username'], $_POST['password']);
  if($login) {
  header("location:index.php");
  }
  
  else {
	$alert='<div class="alert alert-warning alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-warning"></i> Login Gagal!</h4>
	Username atau Password salah.
	</div>';
  ?>
  <script language="javascript">
var window;
function closeWin() {
    window.close();
}
		
	</script>
  <?php  
  }

}
//$serveruri=str_replace('/login.php','',$_SERVER['REQUEST_URI']);
//echo checkData("user","WHERE username='admin' AND password='".md5('admin123')."'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/AdminLTE.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/_all-skins.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo $CORE_URL;?>/assets/js/sweetalert2.all.js"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
  body {
    background-color: #212B32 !important;
	height:80%;
	
}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#" style="color:#1072fd"><img style="width:48px" src="<?php echo $CORE_URL;?>/images/icons/icon6.png"> LOGIN </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Aplikasi <?php echo $SNAME;?></p>
	<?php echo $alert;?>

    <form action="" method="post">
      <div class="form-group has-feedback">
		<select name="username" class="form-control">
		<?php $dolist=doTableArray("user",array("username"));
		foreach( $dolist as $list){
		echo"<option>".$list[0]."</option>";

		}		
		?>
		</select>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div> 
		<div class="col-xs-4">
        </div>
		<div class="col-xs-4">
          <a href="#" class="btn btn-danger btn-block btn-flat pull-right" onclick="window.close();">Tutup</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo $CORE_URL;?>/assets/plugins/components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $CORE_URL;?>/assets/plugins/components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
