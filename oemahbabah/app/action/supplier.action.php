<?php 
if(isset($_GET['tableSupplier'])){
doTableJSON($_GET['tableSupplier'],array(
"id",
"nama_supplier",
"alamat",
"kota",
"no_hp",
"email",
"website"
));
}

elseif(isset($_GET['inputSupplier'])){
doInsert($_GET['inputSupplier'],
"
nama_supplier,alamat,kota,no_hp,email,website
",
"
'".$_GET['nama_supplier']."',
'".$_GET['alamat']."',
'".$_GET['kota']."',
'".$_GET['no_hp']."',
'".$_GET['email']."',
'".$_GET['website']."'
");


}

elseif(isset($_GET['deleteSupplier'])){
doDelete('supplier',"WHERE id=".$_GET['deleteSupplier']."");
}

elseif(isset($_GET['updateSupplier'])){
doUpdate($_GET['updateSupplier'],
"
nama_supplier='".$_GET['nama_supplier']."',
alamat='".$_GET['alamat']."',
kota='".$_GET['kota']."',
no_hp='".$_GET['no_hp']."',
email='".$_GET['email']."',
website='".$_GET['website']."'
",
"WHERE id='".$_GET['id']."'"
);

}
?>

