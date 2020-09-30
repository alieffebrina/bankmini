<script>
$(document).ready(function() {
	$( ".pesanMeja" ).click(function () {
    $(this).attr('id');
	$("#modalDapur").modal("show");
	$("#dataPrint").load("data.php?loadDapur=menu&faktur="+$(this).attr('id'));
	});
}); 
</script>
<div class="col-md-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Meja Pesanan</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<div style="overflow-y: auto; height:450px; ">
<?php
/*
for($i=1;$i<41;$i++){	
	echo'INSERT INTO "meja" ("meja","faktur") VALUES ("'.$i.'","");<br> ';
}
*/

$dolist=doTableArray("meja",array("meja","faktur"),"where faktur!=''");
foreach( $dolist as $meja){
if($meja[1]!=''){
$btn='primary';
}else{
$btn='warning';
}
if($meja[0]<=getPengaturan("meja") AND $meja[0]<=100){
echo'<input type="submit" id="'.$meja[0].'|'.$meja[1].'" class="pesanMeja btn btn-'.$btn.' btn-lg" style="margin:5px;font-size:30px;width:90px" value="'.$meja[0].'"> ';
}
}	



?>
</div>
</div>
</div>
</div>


<!--- PRINT -->
<div class="modal " id="modalDapur" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary">
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-address-card-o " aria-hidden="true"></i> Transaksi</h5>
</div>
<div class="modal-body">
<div style="overflow-y: auto; height:350px; ">
<div id="dataPrint"></div>
</div>



</div>
<div class="modal-footer">
<a class="btn btn-primary" onclick="jQuery('#printArea').print()" href="#" id="printPenjualan"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>

</div>
</div>
</div>
