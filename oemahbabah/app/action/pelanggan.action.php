<?php 
if(isset($_GET['tablePelanggan'])){
doTableJSON($_GET['tablePelanggan'],array(
"id",
"nama_pelanggan",
"alamat",
"kota",
"no_hp",
"email"
));
}

elseif(isset($_GET['inputPelanggan'])){
doInsert($_GET['inputPelanggan'],
"
nama_pelanggan,alamat,kota,no_hp,email
",
"
'".xString($_GET['nama_pelanggan'])."',
'".xString($_GET['alamat'])."',
'".$_GET['kota']."',
'".$_GET['no_hp']."',
'".$_GET['email']."'
");


}

elseif(isset($_GET['deletePelanggan'])){
doDelete('pelanggan',"WHERE id=".$_GET['deletePelanggan']."");
}

elseif(isset($_GET['updatePelanggan'])){
doUpdate('pelanggan',
"
nama_pelanggan='".xString($_GET['nama_pelanggan'])."',
alamat='".xString($_GET['alamat'])."',
kota='".$_GET['kota']."',
no_hp='".$_GET['no_hp']."',
email='".$_GET['email']."'
",
"WHERE id='".$_GET['id']."'"
);

}
?>

