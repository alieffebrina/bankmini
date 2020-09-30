<?php 
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2008 Djavasoft. (https://djavasoft.com/)
 *
 *
*/

include'config.php';
function xdate($date){
	$date=explode('-',$date);	
	$date=$date[2].'-'.$date[1].'-'.$date[0];	
	return $date;
}

	$items=doTableArray("kasir_penjualan",array("kode_barang","nama_barang","harga","qty","total","faktur","meja"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
	$faktur=doTableArray("faktur",array("date","pelanggan_id","total","pemasukan","diskon","voucher","dibayar","kembali","user_id","disc","pajak","pjk"),"where faktur='".$_GET['faktur']."'");
	$date= $faktur[0][0];
	$pelanggan_id= $faktur[0][1];
	$total= $faktur[0][2];
	$pemasukan= $faktur[0][3];
	$diskon= $faktur[0][4];
	$voucher= $faktur[0][5];
	$dibayar= $faktur[0][6];
	$kembali= $faktur[0][7];
	$userName= userName($faktur[0][8]);
	$disc= $faktur[0][9];
	$pajak= $faktur[0][10];
	$pjk= $faktur[0][11];

	/*if(intval($pelanggan_id) !='' || intval($pelanggan_id)!=0){
	$supplier=doTableArray("pelanggan",array("nama_pelanggan"),"where id='".intval($pelanggan_id)."'");
	$nama_pelanggan=$supplier[0][0];
	}else{
	$nama_pelanggan='-';
	}
	*/
	?>
	<html moznomarginboxes="" mozdisallowselectionprint=""><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>	<?php echo getPengaturan('nama_toko');?> - Cetak Nota        </title>
	<style type="text/css">

	@media print {
	@page  { 
	margin: 0mm;
	font-size:8px;
	}
	}

	</style>
	</head>
	<body onload="window.print();" cz-shortcut-listen="true" >
<pre>
<?php 
if($_GET['ukuran']=='58'){?>
<b><?php echo getPengaturan('nama_toko');?></b><br><?php echo getPengaturan('alamat');?> <br>Telp. <?php echo getPengaturan('no_hp');?><br>---------------------------------
DATE	: <?php echo xDate($date);?> <?php echo date("H:i:s");?><br>FAKTUR	: <?php echo $_GET['faktur'];?><br>KASIR	: <?php echo $userName;?><br>MEJA	: <?php echo $items[0][6];?>

<br>---------------------------------<br> Harga	Qty	Total<br>---------------------------------
<?php
$i=1;
foreach($items as $row){
echo ''.$row[1].'<br>';
echo ' '. currency($row[2]).'';
echo ' x ';
echo ''.$row[3].'	';
echo 'Rp.'. currency($row[4]).'<br>';
$i++; 	  
}   
?>
---------------------------------
<?php if(intval($diskon)!=0 OR intval($diskon)!=''){?>Harga	:	Rp.<?php echo currency($total);?><br>Diskon	:	Rp.<?php echo currency($diskon);?>(<?php echo $disc;?>%)<?php } ?><?php if(intval($voucher)!=0 OR intval($voucher)!=''){?><br>Voucher	:	Rp.<?php echo currency($voucher);?><?php } ?><?php if(intval($pjk)!=0 OR intval($pjk)!=''){?><br>Pajak	:	Rp.<?php echo currency($pajak);?>(<?php echo $pjk;?>%)<?php } ?><br>Total	:	Rp.<?php echo currency($pemasukan);?><br>Bayar	:	Rp.<?php echo currency($dibayar);?><br>	-------------------------<br>Kembali	:	Rp.<?php echo currency($kembali);?><br>=================================
	TERIMA KASIH
    ATAS KUNJUNGAN ANDA
<BR>

<?php } elseif($_GET['ukuran']=='80'){ 
/////////////////////////////////////// UKURAN 80MM ////////////////////////////////////////////////////////
?>
<b><?php echo getPengaturan('nama_toko');?></b><br><?php echo getPengaturan('alamat');?> <br>Telp/HP <?php echo getPengaturan('no_hp');?><br>--------------------------------------
DATE	: <?php echo xDate($date);?> <?php echo date("H:i:s");?><br>FAKTUR	: <?php echo $_GET['faktur'];?><br>KASIR	: <?php echo $userName;?><br>MEJA	: <?php echo $items[0][6];?>

<br>--------------------------------------<br> Harga		Qty	Total<br>--------------------------------------
<?php
$i=1;
foreach($items as $row){
echo ''.$row[1].'<br>';
echo ' '. currency($row[2]).'';
echo '		x ';
echo ''.$row[3].'	';
echo 'Rp.'. currency($row[4]).'<br>';
$i++; 	  
}   
?>
--------------------------------------
 <?php if(intval($diskon)!=0 OR intval($diskon)!=''){?>Harga		:	Rp.<?php echo currency($total);?><br> Diskon		:		Rp.<?php echo currency($diskon);?>(<?php echo $disc;?>%)<?php }?><?php if(intval($voucher)!=0 OR intval($voucher)!=''){?><br> Voucher		:		Rp.<?php echo currency($voucher);?><?php } ?><?php if(intval($pjk)!=0 OR intval($pjk)!=''){?><br> Pajak		:	Rp.<?php echo currency($pajak);?>(<?php echo $pjk;?>%)<?php } ?><br> Total		:	Rp.<?php echo currency($pemasukan);?><br> Bayar		:	Rp.<?php echo currency($dibayar);?><br>		----------------------<br> Kembali	:	Rp.<?php echo currency($kembali);?><br>======================================
	   TERIMA KASIH
	ATAS KUNJUNGAN ANDA
<BR>

<?php } ?>
</pre>

	
	</body></html>
