<?php
/*----------------------- READ TABLE ----------------*/

if(isset($_GET['stokOpname'])){
doTableJSON($_GET['stokOpname'],array(
'id',
'id_barang',
'kode_barang',
'nama_barang',
'harga_beli',
'stok_komputer',
'stok_nyata',
'selisih',
'total_selisih',
'date',
'keterangan'
));
}
/*----------------------- CREATE / INPUT ----------------*/
elseif(isset($_GET['saveInputstokOpname'])){
$selisih=$_GET["stok_nyata"]-$_GET["stok_komputer"];
$harga_beli=xCurrency($_GET["harga_beli"]);
$total_selisih=$selisih*$harga_beli;
doInsert($_GET['saveInputstokOpname'],
"
id_barang,
kode_barang,
nama_barang,
harga_beli,
stok_komputer,
stok_nyata,
selisih,
total_selisih,
date,
keterangan
",
"
'".$_GET["id_barang"]."',
'".$_GET["kode_barang"]."',
'".$_GET["nama_barang"]."',
'".$harga_beli."',
'".$_GET["stok_komputer"]."',
'".$_GET["stok_nyata"]."',
'".$selisih."',
'".$total_selisih."',
'".date('Y-m-d')."',
'".$_GET["keterangan"]."'
");

doUpdate('daftar_barang',
"stok='".$_GET["stok_nyata"]."'
","WHERE id_barang=".$_GET['id_barang']."");

}

/*----------------------- DELETE ----------------*/

elseif(isset($_GET['deletestokOpname'])){
doDelete('stok_opname',"WHERE id=".$_GET['deletestokOpname']."");
}

/*----------------------- UPDATE ----------------*/

elseif(isset($_GET['saveEditstokOpname'])){
$selisih=$_GET["stok_nyata"]-$_GET["stok_komputer"];
$harga_beli=xCurrency($_GET["harga_beli"]);
$total_selisih=$selisih*$harga_beli;

doUpdate($_GET['saveEditstokOpname'],
"
id_barang='".$_GET["id_barang"]."',
kode_barang='".$_GET["kode_barang"]."',
nama_barang='".$_GET["nama_barang"]."',
harga_beli='".$harga_beli."',
stok_komputer='".$_GET["stok_komputer"]."',
stok_nyata='".$_GET["stok_nyata"]."',
selisih='".$selisih."',
total_selisih='".$total_selisih."',
keterangan='".$_GET["keterangan"]."'
","WHERE id=".$_GET['saveEdit']."");

doUpdate('daftar_barang',
"stok='".$_GET["stok_nyata"]."'
","WHERE id_barang=".$_GET['id_barang']."");

}
?>
