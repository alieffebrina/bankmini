<?php 
$userLogin=$_SESSION['user'];
?><!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title><?=$SNAME;?> | <?php echo getPengaturan('nama_toko');?></title>
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/AdminLTE.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/_all-skins.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/ionicons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $CORE_URL;?>/assets/plugins/components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $CORE_URL;?>/assets/css/datatables.css" rel="stylesheet" type="text/css">

<link href="<?php echo $CORE_URL;?>/assets/plugins/components/morris.js/morris.css" rel="stylesheet">
<script src="<?php echo $CORE_URL;?>/assets/js/shortcuts.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/js/sweetalert2.all.js"></script>
<link href="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css">

<style>
.main-sidebar{
    //background-image: url("<?php echo $CORE_URL;?>/images/system/sidebar-bg1.jpg?t=<?php echo rand(); ?>");
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	background-attachment: fixed;
	background-color:# !important;
	}
	
.skin-blue .main-header .navbar {
    _background-color: #3c8dbc;
    background: linear-gradient(to top, #0066ff 6%, #0099ff 100%);
}
.skin-blue .main-header .logo {
    _background-color: #367fa9;
    background: linear-gradient(to top, #0066ff 6%, #0066ff 100%);
    color: #fff;
    border-bottom: 0 solid transparent;
}
.content-wrapper {
    background-image: url("<?php echo $CORE_URL;?>/images/background/bg.jpg?t=<?php echo rand(); ?>");
    background-color: #eee;
	height: 100%; 
	/* Center and scale the image nicely */
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
	background-attachment: fixed;
	
}


.modal-kasir {
	width:450px!important

}
.modal-header-success {
    color:#fff;
    background-color: #5cb85c;

}.modal-header-primary {
    color:#fff;
    background-color: #0C69D7;

}
button{
	cursor : pointer
	
}
.modal-content{
	//min-height:600px;
}
.nav-item :hover{
	background:#40474f;
}
.datepicker{
	z-index:10000;
}
table,tr,td{
	font-size:13px
}
.small-box h3 {
    font-size: 22px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}
</style>
<script>
$('.content-wrapper').css('background', 'rgba(128, 128, 128, 0.2)');
</script>
</head>
<body class="hold-transition skin-green fixed sidebar-mini " onload="startbody()">
<div class="wrapper">
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo" >
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa  fa-windows"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa  fa-windows"></i> DPOS RESTO</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>


      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

		<li >
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-user"></i> User : <?php echo $userLogin;?></a>
		</a>
		</li>
		<li>
		<a href="index.php?page=logout" > <i class="fa fa-sign-out"></i>Keluar</a>
		</li>
        </ul>
      </div>
    </nav>

  </header>
