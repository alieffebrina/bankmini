<?php 
if(isset($_GET['barcode'])){
$ids =  explode(',',$_GET['ids']);
?>
<a class="btn btn-primary" onclick="jQuery('#printBarcode').print()" href="#" ><i class="fa fa-print" aria-hidden="true"></i> Cetak Barcode (<?=count($ids);?>)</a><hr>
<div style="overflow-y: auto; height:430px; ">

<div id="printBarcode">

<?php
foreach($ids as $id){

?>

<div style="height:100px;width:220px;margin:5px;border:1px solid #ccc;padding:5px;float:left"><center><span style="font-size:11px"><?= getBarang('nama_barang','WHERE id_barang="'.$id.'"');?></span><br><img  src="page.php?page=barcode&codetype=Code39&size=28&print=true&text=<?=getBarang('kode_barang','WHERE id_barang="'.$id.'"');?>"></div>

<?php
}
?>
</div>
</div>
<?php
}
?>
