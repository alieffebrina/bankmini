<?php
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2018 Djavasoft. (https://djavasoft.com/)
 *
 *
*/



function getFakturSupplier($faktur){
	$modul=doTableArray("faktur",array('supplier_id'),"where faktur='".$faktur."'");
	$modul=$modul[0][0];
	return $modul;
}
function getFakturPelanggan($faktur){
	$modul=doTableArray("faktur",array('pelanggan_id'),"where faktur='".$faktur."'");
	$modul=$modul[0][0];
	return $modul;
}

function getPengaturan($col){
	$setting=doTableArray("pengaturan",array($col),"where id='1'");
	$setting=$setting[0][0];
	return $setting;
}
function getDashboard($col){
	$dashboard=doTableArray("dashboard",array($col),"where id='1'");
	$dashboard=$dashboard[0][0];
	return $dashboard;
}

function getBarang($col,$arg=''){
	$barang=doTableArray("daftar_barang",array($col),$arg);
	$barang=$barang[0][0];
	return $barang;
}
function getPelanggan($col,$arg=''){
	$pelanggan=doTableArray("pelanggan",array($col),$arg);
	$pelanggan=$pelanggan[0][0];
	return $pelanggan;
}
function getSupplier($col,$arg=''){
	$supplier=doTableArray("supplier",array($col),$arg);
	$supplier=$supplier[0][0];
	return $supplier;
}
function getFaktur($col,$arg=''){
	$faktur=doTableArray("faktur",array($col),$arg);
	$faktur=$faktur[0][0];
	return $faktur;
}

function userLevel($username){
	$faktur=doTableArray("user",array('level'),"where username='".$username."'");
	$faktur=$faktur[0][0];
	return $faktur;
}

function userID($username){
	$faktur=doTableArray("user",array('id'),"where username='".$username."'");
	$faktur=$faktur[0][0];
	return $faktur;
}

function userName($id){
	$faktur=doTableArray("user",array('username'),"where id='".$id."'");
	$faktur=$faktur[0][0];
	return $faktur;
}

function getJual($mode,$tanggal,$bulan,$tahun){
	$total= sumData('faktur','total',"WHERE mode='$mode' AND  tanggal='$tanggal' AND bulan ='$bulan' AND tahun='$tahun' AND status='tunai'");
	return $total;
}

function getBeli($mode,$tanggal,$bulan,$tahun){
	$total= sumData('faktur','total',"WHERE mode='$mode' AND  tanggal='$tanggal' AND bulan ='$bulan' AND tahun='$tahun' AND status='tunai'");
	return $total;
}

function getTerjual($tanggal,$bulan,$tahun){
	if(	$tanggal!=''){
	$tanggal="AND tanggal='$tanggal'";
	}else{
	$tanggal='';

	}

	$total= sumData('faktur','terjual',"WHERE mode='penjualan'  $tanggal AND bulan ='$bulan' AND tahun='$tahun' AND status='tunai'");
	return $total;
}

function getOmset($tanggal,$bulan,$tahun){
	if(	$tanggal!=''){
	$tanggal="AND tanggal='$tanggal'";
	}else{
	$tanggal='';

	}

	$total= sumData('faktur','pemasukan',"WHERE mode='penjualan'  $tanggal AND bulan ='$bulan' AND tahun='$tahun' AND status='tunai'");
	return $total;
}

function getHPP($tanggal,$bulan,$tahun){
	if(	$tanggal!=''){
	$tanggal="AND tanggal='$tanggal'";
	}else{
	$tanggal='';

	}
	$total= sumData('faktur','total_hpp',"WHERE mode='penjualan'   $tanggal AND bulan ='$bulan' AND tahun='$tahun' AND status='tunai'");
	return $total;
}

function getModul($col){
	$modul=doTableArray("modul",array($col),"where id='1'");
	$modul=$modul[0][0];
	return $modul;
}
function getAkses($col,$level){
	$modul=doTableArray("akses",array($col),"where level='".$level."'");
	$modul=$modul[0][0];
	return $modul;
}

function setModul($type){
	if(getModul($type)==1){echo 'checked';}
}
function setAkses($type,$level){
	if(getAkses($type,$level)==1){echo 'checked';}else{}

}
function displayAkses($type,$level){
	if(getAkses($type,$level)==1){echo '';}else{
	echo " style='display:none' ";
}
}
function setDashboard($type){
	if(getDashboard($type)==1){echo 'checked';}else{}

}
function displayDashboard($type){
	if(getDashboard($type)==1){echo '';}else{
	echo " style='display:none' ";
	}
}
function getUserLogin(){
	return $_SESSION['user'];

}

function totalHPP($session){
	$hpp =	sumData('kasir_penjualan','total_hpp',"WHERE status = 1 AND session='".$session."'");
	return $hpp;
}

function totalHPPFaktur($session,$faktur){
	$hpp =	sumData('kasir_penjualan','total_hpp',"WHERE faktur = '".$faktur."' AND session='".$session."'");
	return $hpp;
}

function getNamaPelanggan($id){

	if($id!=0 || $id!=NULL || $id!=''  ){
	if( checkData('pelanggan',"WHERE id=".$id."")>=1 ){
	$data=getPelanggan('nama_pelanggan',"WHERE id=".$id);
	}else{
	$data='';
	}

	}else{
	$data='';
	}

	return $data;
}
function getNamaSupplier($id){

	if($id!=0 || $id!=NULL || $id!=''  ){
	if( checkData('supplier',"WHERE id=".$id."")>=1 ){
	$data=getSupplier('nama_supplier',"WHERE id=".$id);
	}else{
	$data='';
	}
	}else{
	$data='';
	}

	return $data;
}



?>
