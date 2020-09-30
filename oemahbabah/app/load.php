<?php 
ob_start();
session_start();
$username=$_SESSION['user'];
$userlevel=userLevel($username);
notif();
if(isset($_GET['mode'])){

$mode=$_GET['mode'].'.php';
if(file_exists(__DIR__.'/main/'.$mode)){
	if(file_exists(__DIR__.'/modul/'.$_GET['mode'].'.js.php')){
	include (__DIR__.'/modul/'.$_GET['mode'].'.js.php');
	}
	if(file_exists(__DIR__.'/modul/'.$_GET['mode'].'.modal.php')){
	include (__DIR__.'/modul/'.$_GET['mode'].'.modal.php');
	}
	
include(__DIR__.'/main/'.$mode);

}else{

echo '<div class="col-md-12"><div class="alert alert-danger"><i class="fa fa-warning"></i> File not found ('.__DIR__.'app\main\ '.$mode.')</div></div>';
//echo '<br>'.__DIR__;
//echo '<br>'.$_SERVER['DOCUMENT_ROOT'];
}
//echo $mode;
}elseif(isset($_GET['plugin'])){

$mode=$_GET['plugin'].'.php';
if(file_exists(__DIR__.'/plugins/'.$_GET['plugin'].'/'.$mode)){

	
include(__DIR__.'/plugins/'.$_GET['plugin'].'/'.$mode);

}else{

echo '<div class="col-md-12"><div class="alert alert-danger"><i class="fa fa-warning"></i> File not found ('.__DIR__.'app\main\ '.$mode.')</div></div>';
//echo '<br>'.__DIR__;
//echo '<br>'.$_SERVER['DOCUMENT_ROOT'];
}
//echo $mode;

}
else{
include 'main/dashboard.php';
?>

<script>
</script>
<?php
}
?>
