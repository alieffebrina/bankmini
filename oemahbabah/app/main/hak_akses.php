<?php 
ob_start();
session_start() ;
$username=$_SESSION['user'];
//$levelMaster=levelMaster($username);


?>

<style>
.checkbox-header{
	font-size:20px;
}
.checkbox-sub{
	margin-left:15px;
}
.checkbox-sub2{
	margin-left:30px;
}

</style>
<div class="col-md-10">
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<?php 
$aksesList=doTableArray("akses",array("id","level"));
foreach( $aksesList as $list){
	if($list[0]==1){$active='class="active"';}else{$active='';}
?>
<li <?php echo $active;?>><a href="#tab_<?php echo $list[0];?>" data-toggle="tab" aria-expanded="true"><?php echo ucwords($list[1]);?></a></li>

<?php
}
?>
<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
</ul>
<div class="tab-content">
<?php 
foreach( $aksesList as $list){
 formHakAkses('tab_'.$list[0], $list[1],ucwords($list[1]));
}
?>


</div>
</div>
</div>


