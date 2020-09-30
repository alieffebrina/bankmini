<script>

$(document).ready(function() {
$('#loadUploader').load('data.php?imgBgUpload=img');
$('#loadUploaderRestore').load('data.php?UploadDB=restore');

	
$( "#SaveInput" ).click(function () {
var nama_toko = $('#nama_toko').val();
var alamat = $('#alamat').val();
var no_hp = $('#no_hp').val();
var email = $('#email').val();
var website = $('#website').val();

$.get("data.php?inputPengaturan=pengaturan&nama_toko="+nama_toko+"&alamat="+alamat+"&no_hp="+no_hp+"&email="+email+"&website="+website,
function(data){

	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil diupdate',
		type: 'success',
		timer: 2000
	}
	);
}
);
	
} );

$( "#SaveModul" ).click(function () {
	var voucher=$('input[name=voucher]:checked', '#formModul').val();
	var pajak=$('input[name=pajak]:checked', '#formModul').val();
	var ongkir=$('input[name=ongkir]:checked', '#formModul').val();
$.get("data.php?inputModul=modul&voucher="+voucher+
"&pajak="+pajak+
"&ongkir="+ongkir,
function(data){

	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil diupdate',
		type: 'success',
		timer: 2000
	}
	);
}
);
	
} );

$( "#saveDashboard" ).click(function () {
	var total_barang=$('input[name=total_barang]:checked', '#formDashboard').val();
	var total_pelanggan=$('input[name=total_pelanggan]:checked', '#formDashboard').val();
	var omset=$('input[name=omset]:checked', '#formDashboard').val();
	var laba=$('input[name=laba]:checked', '#formDashboard').val();
	var grafik=$('input[name=grafik]:checked', '#formDashboard').val();
	var barang_terlaris=$('input[name=barang_terlaris]:checked', '#formDashboard').val();
	var barang_limit=$('input[name=barang_limit]:checked', '#formDashboard').val();
	var barang_expired=$('input[name=barang_expired]:checked', '#formDashboard').val();
$.get("data.php?inputDashboard=dashboard&total_barang="+total_barang+
"&total_pelanggan="+total_pelanggan+
"&laba="+laba+
"&grafik="+grafik+
"&barang_terlaris="+barang_terlaris+
"&barang_expired="+barang_expired+
"&barang_limit="+barang_limit+
"&omset="+omset,
function(data){

	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil diupdate',
		type: 'success',
		timer: 2000
	}
	);
}
);
	
} );

$( "#delTransaksi" ).click(function () {
$.get("data.php?delTransaksi=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
});
});
$( "#delBarang" ).click(function () {
$.get("data.php?delBarang=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
});
});
$( "#delPelanggan" ).click(function () {
$.get("data.php?delPelanggan=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
});
});
$( "#delSupplier" ).click(function () {
$.get("data.php?delSupplier=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
});
});
$( "#resetTerjual" ).click(function () {
$.get("data.php?resetTerjual=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
});
});
$( "#resetStok" ).click(function () {
$.get("data.php?resetStok=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
});
});

} );

</script>