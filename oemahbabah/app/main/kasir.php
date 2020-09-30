<?php
if(!isset($_GET['meja'])){

?>


<div class="col-md-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Pesan Meja</h3>
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

$dolist=doTableArray("meja",array("meja","faktur"));
foreach( $dolist as $meja){
if($meja[1]!=''){
$btn='primary';
}else{
$btn='warning';
}
if($meja[0]<=getPengaturan("meja") AND $meja[0]<=100){
echo'<input type="submit" id="pesanMeja" class="pesanMeja btn btn-'.$btn.' btn-lg" style="margin:5px;font-size:30px;width:90px" value="'.$meja[0].'"> ';
}
}	



?>
</div>
<div style="width:400px;margin-top:5px">
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Atur Jumlah Meja  (Max. 100)</button></span>
<input class="form-control" type="text" id="jumlahMeja"  title="jumlah meja" value="<?php echo getPengaturan("meja");?>"><span class="input-group-btn">
<button class="btn " type="button"  id="submitMeja" title=""><i class="fa  fa-check" aria-hidden="true"  ></i> Submit</button>
</span>
</div>
</div>

</div>
</div>
</div>
<?php }else{
$getFaktur=getFakturID('','PJ').'.'.$_GET['meja'];
$fakturMeja=getMeja("faktur","WHERE meja='".$_GET['meja']."'");
if($fakturMeja==''){
doUpdate('meja',
"
faktur='".$getFaktur."'
",
"WHERE meja='".$_GET['meja']."'"
);
$faktur=$getFaktur;
}else{
$faktur=$fakturMeja;

}
?>
<style>
.nama_barang{
font-size:12px!important;
position: absolute;
top: 3%;
left:3px;
right:3px;
text-align:center;
opacity: 0.5;
padding:3px;
font-weight:normal;
height:93%;
}

.nama_barang_bawah{
font-size:11px!important;
text-align:center;
background:#000;
opacity: 0.5;
padding:3px;
font-weight:normal;
height:50px;
color:white!important;
}

.name{
	color:white;
}
.nama_barang:hover{
font-size:13px!important;
position: absolute;
top: 3%;
left:3px;
right:3px;
text-align:center;
background:#000;
opacity: 0.9;
padding:3px;
font-weight:bold;
height:93%;
}
.products{
	cursor:pointer
}
.products_image{
	height:125px;width:100%;;
}
.addProduct:hover{
	opacity: 0.7;

}

#grid-mode{
display:none;}

</style>

<script>
function playAddCart () {
    document.getElementById('playAddCart').play();
}
function playTrash() {
    document.getElementById('playTrash').play();
}
</script>
<style>
#tableBarang_filter{display:none !important}
</style>

<audio id="playAddCart" src="<?php echo $CORE_URL;?>/app/sound/addcart.mp3"></audio>
<audio id="playTrash" src="<?php echo $CORE_URL;?>/app/sound/trash.mp3"></audio>

<div class="col-md-7">
<div class="box box-solid">
<div class="box-body" id="grid-mode">
<div class="row" >

<div class="col-md-6 col-xs-6">
<div class="input-group">
<div class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
</div><input type="text" id="searchProduct" class="form-control" placeholder="Cari Produk">
</div>			  
</div>
<div class="col-md-4  col-xs-6">
<div class="btn-group">
<button type="button" id="all" class="btn btn-default group" >Semua</button>
<button type="button" class="btn btn-default" >Kategori</button>
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<span class="caret"></span>
<span class="sr-only">Toggle Dropdown</span>
</button>
<ul class="dropdown-menu" role="menu">
<?php 
$categories=doTableArray("kategori_barang",array("kategori","WHERE kategori!='bahan'"));
foreach( $categories as $cat){		
echo ' <li id="'.$cat[0].'" class="group"><a href="#">'.$cat[0].'</a></li>';
}
?>
</ul>
</div>
</div>
</div>
<hr>
<div class="col-md-12"  style="overflow-y: auto; height:400px; "  >
<div class="row" id="parent">
<?php 
$categories=doTableArray("kategori_barang",array("kategori"));
foreach( $categories as $cat){		
?>
<?php $dolist=doTableArray("daftar_barang",array("nama_barang","harga_jual","kode_barang","stok"),"WHERE kategori_barang='".$cat[0]."' AND kategori_barang!='bahan' AND jenis!='bahan'");
foreach( $dolist as $list){	
?>
<div class="col-md-3 col-sm-6 col-xs-6 boxs <?php echo $cat[0];?>"  onclick="playAddCart()">
<div class="small-box bg-blue products addProduct" id="<?php echo $list[2];?>" stok="<?php echo $list[3];?>">
<?php if(file_exists('images/barang/'.$list[2].'.jpg')){?>
<img src="<?php echo 'images/barang/'.$list[2].'.jpg?_'.rand();?>"  class="products_image">
<?php }else{?>
<img src="images/system/noimage2.jpg"  class="products_image" alt="<?php echo $list[0];?>">

<?php } ?>

<p class="nama_barang_bawah " >
<span class="name"><?php echo $list[0];?></span>
<br>
<span class="kode" style="display:none">[<?php echo $list[2];?>]</span>
Rp. <?php echo currency($list[1]);?> | stok : <?php echo $list[3];?>
</p>
<div class="overlay overlay-<?php echo $list[2];?>" style="display:none">
<i style="color:white" class="fa fa-check"></i>
</div>
</div>
</div>
<?php } ?>
<?php } ?>

</div>
</div>	
</div>
<div class="box-body">
<div id="list-mode">
<div class="row" >
<div class="col-md-6" style="display:">
<form id="addCartForm"  action="" method="post" style="display:">
<div class="input-group" style="display:">
<span class="input-group-btn"><button style="background:white;border: 1px solid #ccc" class="btn " type="button" ><i class="fa  fa-barcode"></i> </button></span>
<input class="form-control" type="text" id="kodeBarang" autofocus  title="kode barang" name="kode_barang" autocomplete=OFF placeholder="Kode Produk">
<span class="input-group-btn" style="display:none">
<button class="btn " type="button"  id="showBarang" title="cari barang atau tekan F1"><i class="fa  fa-search" aria-hidden="true"  ></i> [F1]</button>
</span>
</div>

<span style="display:none">
<input type="hidden" name="addCart" value="kasir_penjualan" >
<input type="hidden" name="user_id" value="<?php echo userID($_SESSION['user']);?>" placeholder="user_id">
<input type="hidden" name="faktur" value="<?php echo $faktur;?>"  placeholder="faktur">

<input style="display:none;margin-top:5px" class="form-control" type="text" id="idBarang">
<input style="display:block;margin-top:5px" class="form-control" type="text" id="namaBarang" readonly placeholder="Nama Barang">
<input style="display:block;margin-top:5px" class="form-control" type="text" id="hargaJual" readonly placeholder="Harga">
<input style="display:block;margin-top:5px;display:none" class="form-control" type="text" id="stokBarang" readonly placeholder="Stok">
<div class="input-group" style="margin-top:5px">
<span class="input-group-btn"><button class="btn " type="button" style="width:111px">Jumlah  </button></span>
<input style="text-align:center" id="qty" name="qty" type="number" value="1" class="form-control "  title="jumlah barang" > 
<span class="input-group-btn">
<input type="submit" value="Tambah" class="btn btn-primary"  style="display:none" /> 
<span class="input-group-btn"><button class="btn btn-warning" type="button"  id="addCart"><i class="fa  fa-check-square-o" aria-hidden="true"></i> Tambah</button></span>
</span>
</span>
</div>
<input class="form-control" type="text" name="noMeja" value="<?php echo $_GET['meja'];?>" readonly>

</form>
</div>

<div class="col-md-6" style="display:">
<div class="input-group" style="display:">
<span class="input-group-btn"><button style="background:white;border: 1px solid #ccc" class="btn " type="button" ><i class="fa  fa-search"></i> </button></span>
<input class="form-control" type="text" id="cariBarang" autofocus  title="Cari Barang" name="kode_barang" autocomplete=OFF placeholder="">
<span class="input-group-btn" style="display:none">
<button class="btn " type="button"  id="showBarang" title="cari barang atau tekan F1"><i class="fa  fa-search" aria-hidden="true"  ></i> [F1]</button>
</span>
</div>
</div>

</div>
<div class="table-responsive" >
	<table class="table table-bordered table-hover " id="tableBarang" width="100%" cellspacing="0">
	  <thead>
		<tr>
		  <th style="width:50px">ID</th>
		  <th>Kode</th>
		  <th>Nama Produk</th>
		  <th>Harga Jual</th>
		  <th>Stok</th>
		  <th style="width:20px">#</th>
		</tr>
	  </thead>
	</table>
  </div>	
</div>	
	  
<a href="#" class="btn btn-default btn-sm" id="back" style="margin-top:10px;"><i class='fa fa-caret-left'></i> Kembali </a>
<a href="#" class="btn btn-default btn-sm " id="batalMeja" style="margin-top:10px;"><i class="fa fa-window-close"></i>  Batal Pesan </a>

<a href="#" class="btn btn-flat btn-default btn-sm pull-right " id="grid" style="margin-top:10px;"><i class="fa  fa-th-large"></i> Grid </a> 
<a href="#" class="btn btn-flat  btn-default btn-sm pull-right active" id="list" style="margin-top:10px;"><i class="fa fa-th-list"></i> List </a>

</div>
</div>

</div>
<div class="col-md-5">
<div class="box box-solid">
<div class="box-body">
	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:20px">ID</th>
			  <th>Kode</th>
			  <th>Nama</th>
			  <th>Harga </th>
			  <th style="width:80px">Qty</th>
			  <th>Sub</th>
			  <th style="width:30px"></th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
	<div class="box-body">
<div style="display:block;margin-top:5px">
<span id="totalSum"></span>
<span id="totalSumBayar" style="display:none"></span>
</div>
<div style="display:none;margin-top:5px">
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" style="padding-right:50px">Faktur </button></span>
<input class="form-control" type="text" id="faktur" value="<?php echo $faktur;?>" readonly>
</div>
</div>

<div style="display:block;margin-top:5px;margin-bottom:5px">
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Nomor Meja  </button></span>
<input class="form-control" type="text" id="noMeja" value="<?php echo $_GET['meja'];?>" readonly>
<span class="input-group-btn"><button class="btn btn-default" type="button"  id="pindahMeja"><i class="fa  fa-exchange" aria-hidden="true"></i> Pindah Meja</button></span>
</div>
<div id="tMeja" style="margin-top:5px">
<div class="input-group" >
<select class="form-control" name="newMeja" id="newMeja">
<?php
$dolist=doTableArray("meja",array("meja","faktur"));
foreach( $dolist as $meja){
if($meja[1]!=''){
$readonly='disabled style="color:red"';
}else{
$readonly='';
}
echo'<option value="'.$meja[0].'" '.$readonly.'>MEJA '.$meja[0].'</option>';

}	
?>
</select>
<span class="input-group-btn"><button class="btn btn-warning" type="button"  id="pindahMejaBaru"><i class="fa  fa-exchange" aria-hidden="true"></i> Pindah Meja</button></span>
</div>
</div>
</div>

<p class="pull-right">
<a href="#" class='btn btn-primary' id='bayarKasir' style="margin-top:10px;width:100%"><i class='fa fa-print'></i> Bayar </a>
</p>
</div>
  </div>
</div>
<?php } ?>
