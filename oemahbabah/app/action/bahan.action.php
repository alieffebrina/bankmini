<?php 


if(isset($_GET['tableBahan'])){
doTableJSON($_GET['tableBahan'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"harga_jual",
"stok",
"terjual",
"satuan",
"kategori_barang",
"lokasi",
"warna",
"ukuran",
"merek",
"expired",
"id_barang",
"stok_minimal"

),"WHERE jenis='bahan'");
}
elseif(isset($_GET['tableBahanLimit'])){
doTableJSON($_GET['tableBahanLimit'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"harga_jual",
"stok",
"terjual",
"satuan",
"kategori_barang",
"lokasi",
"warna",
"ukuran",
"merek",
"expired",
"id_barang",
"stok_minimal"

),"WHERE stok<=stok_minimal AND jenis='bahan'");
}
elseif(isset($_GET['tableBahanExpired'])){
$date=("Y-m-d");
doTableJSON($_GET['tableBahanExpired'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"harga_jual",
"stok",
"terjual",
"satuan",
"kategori_barang",
"lokasi",
"warna",
"ukuran",
"merek",
"expired",
"id_barang",
"stok_minimal"

),"WHERE expired!='' AND expiredDate!='' AND expiredDate<='".$date."' AND jenis='bahan'");
}



elseif(isset($_GET['inputBahan'])){
	
$checkBarang=checkData("daftar_barang","WHERE kode_barang='".$_GET['kode_barang']."'");

if($checkBarang >=1){
	echo '1';
}else{
doInsert($_GET['inputBahan'],
"
kode_barang,nama_barang,kategori_barang,satuan,harga_beli,harga_jual,stok,lokasi,warna,ukuran,merek,expired,expiredDate,stok_minimal,jenis
",
"
'".$_GET['kode_barang']."',
'".xString($_GET['nama_barang'])."',
'".$_GET['kategori_barang']."',
'".$_GET['satuan']."',
'".xCurrency($_GET['harga_beli'])."',
'".xCurrency($_GET['harga_jual'])."',
'".$_GET['stok']."',
'".$_GET['lokasi']."',
'".$_GET['warna']."',
'".$_GET['ukuran']."',
'".$_GET['merek']."',
'".$_GET['expired']."',
'".sdate($_GET['expired'])."',
'".$_GET['stok_minimal']."',
'bahan'
");

$checkSatuan=checkData("satuan","WHERE satuan='".$_GET['satuan']."'");
$checkKategori=checkData("kategori_barang","WHERE kategori='".$_GET['kategori_barang']."'");

if($checkSatuan < 1){
	doInsert("satuan","satuan","'".$_GET['satuan']."'");
}
if($checkKategori < 1){
	doInsert("kategori_barang","kategori","'".$_GET['kategori_barang']."'");
}
}
}

elseif(isset($_GET['updateBahan'])){
doUpdate($_GET['updateBahan'],
"
kode_barang='".$_GET['kode_barang']."',
nama_barang='".xString($_GET['nama_barang'])."',
kategori_barang='".$_GET['kategori_barang']."',
satuan='".$_GET['satuan']."',
harga_beli='".xCurrency($_GET['harga_beli'])."',
harga_jual='".xCurrency($_GET['harga_jual'])."',
stok='".$_GET['stok']."',
lokasi='".$_GET['lokasi']."',
warna='".$_GET['warna']."',
ukuran='".$_GET['ukuran']."',
merek='".$_GET['merek']."',
stok_minimal='".$_GET['stok_minimal']."',
expired='".$_GET['expired']."',
expiredDate='".sDate($_GET['expired'])."'
",
"WHERE id_barang='".$_GET['id_barang']."'"
);

$checkSatuan=checkData("satuan","WHERE satuan='".$_GET['satuan']."'");
$checkKategori=checkData("kategori_barang","WHERE kategori='".$_GET['kategori_barang']."'");

if($checkSatuan < 1){
	doInsert("satuan","satuan","'".$_GET['satuan']."'");
}
if($checkKategori < 1){
	doInsert("kategori_barang","kategori","'".$_GET['kategori_barang']."'");
}

}


?>

