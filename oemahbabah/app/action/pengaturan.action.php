<?php 
if(isset($_GET['inputPengaturan'])){
doUpdate($_GET['inputPengaturan'],
"
nama_toko='".$_GET['nama_toko']."',
alamat='".$_GET['alamat']."',
no_hp='".$_GET['no_hp']."',
email='".$_GET['email']."',
website='".$_GET['website']."'
"
,"WHERE id='1'");
}

elseif(isset($_GET['submitActivation'])){
doUpdate($_GET['submitActivation'],
"
serial='".trim($_GET['serial'])."',
aktivasi='".trim($_GET['aktivasi'])."'

"
,"WHERE id='1'");
}

elseif(isset($_GET['delBarang'])){	
	if($database_engine=='sqlite'){
	$db->exec("DELETE from daftar_barang");
	$db->query("VACUUM");
	}elseif($database_engine=='mysql'){
	$db->query("TRUNCATE TABLE daftar_barang");
	}
}
elseif(isset($_GET['delTransaksi'])){
	if($database_engine=='sqlite'){
	$db->exec("DELETE from faktur");
	$db->exec("DELETE from return_barang");
	$db->exec("DELETE from kasir_penjualan");
	$db->exec("DELETE from kasir_pembelian");
	$db->exec("DELETE from return_penjualan");
	$db->exec("DELETE from return_pembelian");
	$db->query("VACUUM");
	doUpdate('meja',"faktur=''",""	);	
	}elseif($database_engine=='mysql'){

	$db->query("TRUNCATE TABLE faktur;");
	$db->query("TRUNCATE TABLE return_barang;");
	$db->query("TRUNCATE TABLE kasir_penjualan");
	$db->query("TRUNCATE TABLE kasir_pembelian");
	$db->query("TRUNCATE TABLE return_penjualan");
	$db->query("TRUNCATE TABLE return_pembelian");
	doUpdate('meja',"faktur=''",""	);	
	}
}
elseif(isset($_GET['delSupplier'])){
	if($database_engine=='sqlite'){
	$db->exec("DELETE from supplier");
	$db->query("VACUUM");
	}elseif($database_engine=='mysql')
	{
	$db->query("TRUNCATE TABLE supplier");
	}
}
elseif(isset($_GET['delPelanggan'])){
	if($database_engine=='sqlite'){
	$db->exec("DELETE from pelanggan");
	$db->query("VACUUM");
	}elseif($database_engine=='mysql'){
	$db->query("TRUNCATE TABLE pelanggan");
	}
}
elseif(isset($_GET['resetTerjual'])){
doUpdate('daftar_barang',
"
terjual='0'
");
}
elseif(isset($_GET['resetStok'])){
doUpdate('daftar_barang',
"
stok='0'
");
}

elseif(isset($_GET['inputModul'])){
if($_GET['ongkir']!=1){
$ongkir=0;
}else{
$ongkir=1;

}
if($_GET['pajak']!=1){
$pajak=0;
}else{
$pajak=1;

}

if($_GET['voucher']!=1){
$voucher=0;
}else{
$voucher=1;

}


doUpdate($_GET['inputModul'],
"
ongkir='".$ongkir."',
pajak='".$pajak."',
voucher='".$voucher."'
"
,"WHERE id='1'");
}
elseif(isset($_GET['inputDashboard'])){
if($_GET['total_barang']!=1){		$total_barang=0;	}else{		$total_barang=1;	}
if($_GET['total_pelanggan']!=1){		$total_pelanggan=0;	}else{		$total_pelanggan=1;	}
if($_GET['omset']!=1){		$omset=0;	}else{		$omset=1;	}
if($_GET['laba']!=1){		$laba=0;	}else{		$laba=1;	}
if($_GET['grafik']!=1){		$grafik=0;	}else{		$grafik=1;	}
if($_GET['barang_terlaris']!=1){		$barang_terlaris=0;	}else{		$barang_terlaris=1;	}
if($_GET['barang_expired']!=1){		$barang_expired=0;	}else{		$barang_expired=1;	}
if($_GET['barang_limit']!=1){		$barang_limit=0;	}else{		$barang_limit=1;	}



doUpdate($_GET['inputDashboard'],
"
total_barang='".$total_barang."',
total_pelanggan='".$total_pelanggan."',
omset='".$omset."',
laba='".$laba."',
grafik='".$grafik."',
barang_terlaris='".$barang_terlaris."',
barang_expired='".$barang_expired."',
barang_limit='".$barang_limit."'
"
,"WHERE id='1'");
}

elseif(isset($_GET['delBgImg'])){

unlink('images/background/bg.jpg');
}elseif(isset($_GET['imgBgUpload'])){

if(file_exists('images/background/bg.jpg')){
$imgPreview= '<img style="width:100%" src="images/background/bg.jpg?t='.rand().'" class="image-preview">';
$remove='<a href="#" id="delBgImg" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> hapus</a>';
}else{
$imgPreview= '<div style="width:100%;background:#eee;height:200px"></div>';
$remove='';
}
?>

<form id="uploadForm" action="" method="post">
<div class="bgColor">
<div id="targetLayer"><?php echo $imgPreview;?></div>
<div id="uploadFormLayer">
<input name="bgID" type="text" class="inputFile" id="bgID" value="1" style="display:none"/>
<input name="bgImg" type="file" class="inputFile" id="bgImg"/>
<div id="submitButton"><input type="submit" value="Upload gambar" class="btn btn-primary btn-sm" style="margin-top:3px" /> 
<?php echo $remove;?></div>
<span id="process" ><img src="images/system/ajax-loader.gif" style="width:30px"> process..</span>
<div id="imgdelete"></div>
</div>
</div>
</form>
<script>
$(document).ready(function (e) {
$('#process').hide();
$( "#delBgImg" ).click(function () {
var imgID=$("#imgID").val();

$('#imgdelete').load('data.php?delBgImg='+imgID);
//alert("gambar dihapus");
swal("","Gambar berhasil dihapus").then((value) => {
$('#loadUploader').load('data.php?imgBgUpload=img&bgID=background');
location.reload();


});
});

$("#uploadForm").on('submit',(function(e) {
$('#submitButton').hide();
$('#process').show();
var bgImg=$("#bgImg").val();

if(bgImg==''){
swal("","File gambar masih kosong!").then((value) => {
$('#bgImg').focus();
});
return false;
}
e.preventDefault();
$.ajax({
url: "data.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data)
{
$("#targetLayer").html(data);
$('#loadUploader').load('data.php?imgBgUpload=img&bgID=background');
swal("","Gambar berhasil diupload!").then((value) => {
location.reload();
});

},
error: function() 
{
} 	        
});
}));
});
</script>
<?php }elseif(isset($_GET['UploadDB'])){

?>

<form id="uploadFormRestore" action="" method="post">
<div class="bgColor">
<div id="uploadFormLayer">
<div id="uploadFormLayer">
<input name="getDB" type="text" class="inputFile" id="getDB" value="1" style="display:none"/>
<input name="DBFile" type="file" class="inputFile" id="DBFile"/>
<div id="submitButton"><input type="submit" value="Upload Database" class="btn btn-primary btn-sm" style="margin-top:3px" /> 
</div>
<span id="process2" ><img src="images/system/ajax-loader.gif" style="width:30px"> process..</span></div>
</div>
</form>
<script>
$(document).ready(function (e) {
$("#process2").hide();
$("#uploadFormRestore").on('submit',(function(e) {
$("#process2").show();

var DBFile=$("#DBFile").val();

if(DBFile==''){
swal("","File database masih kosong!").then((value) => {
$('#DBFile').focus();
});
return false;
}
e.preventDefault();
$.ajax({
url: "data.php",
type: "POST",
data:  new FormData(this),
contentType: false,
cache: false,
processData:false,
success: function(data)
{
//$("#targetLayer").html(data);
$('#loadUploaderRestore').load('data.php?UploadDB=restore');
swal("","Database berhasil diupload!").then((value) => {
location.reload();
});

},
error: function() 
{
} 	        
});
}));
});
</script>
<?php 
}
if(isset($_POST['bgID']))
{
	$imgID=$_POST['bgID'];

	if(is_uploaded_file($_FILES['bgImg']['tmp_name'])) 
	{
	$sourcePath = $_FILES['bgImg']['tmp_name'];
	$targetPath = "images/background/bg.jpg";
	//if(file_exists($targetPath)){unlink($targetPath);}
	if(move_uploaded_file($sourcePath,$targetPath)) 
		{
			flush();
			?>
			<img  style="width:100%"  class="image-preview" src="<?php echo $targetPath; ?>?t=<?php echo rand(); ?>" class="upload-preview" />
			<?php
		}
	}
}

if(isset($_POST['getDB']))
{

	if(is_uploaded_file($_FILES['DBFile']['tmp_name'])) 
	{
		$sourcePath = $_FILES['DBFile']['tmp_name'];
		$targetPath = "db/database.db";
		if(move_uploaded_file($sourcePath,$targetPath)) 
		{
			echo'<h4>Database berhasil diperbaharui! Silakan Login Kembali</h4>';
		}
	}
}




 ?>
