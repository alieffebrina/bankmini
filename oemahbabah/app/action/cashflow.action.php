<?php 
if(isset($_GET['tableCashflow'])){
doTableJSON('faktur',array(
"id",
"date",
"faktur",
"mode",
"pemasukan",
"pengeluaran",
"ongkir",
"pajak",
"keterangan",
"total",
"grand_total"
),"WHERE status='tunai'");
}
else
if(isset($_GET['startDate']) AND isset($_GET['filterCashflow'])){
	
if($_GET['mode']!=''){
	
	$mode="AND mode='".$_GET['mode']."'";
}else{
	$mode='';
}
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	
//$startDate='2018-01-01';	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	
//$startDate='2018-01-01';	
	
doTableJSON($_GET['filterCashflow'],array(
"id",
"date",
"faktur",
"mode",
"pemasukan",
"pengeluaran",
"ongkir",
"pajak",
"keterangan",
"total",
"grand_total"
),"WHERE  date>='".$startDate."' AND date<='".$endDate."' $mode AND status='tunai' ");
}


else
if(isset($_GET['tableCashflowDetail'])){
$faktur=doTableArray("faktur",array("date","pelanggan_id","supplier_id","pemasukan","pengeluaran","diskon","voucher","dibayar","kembali"),"where faktur='".$_GET['faktur']."'");

if($_GET['pemasukan']!=0){
$items=doTableArray("kasir_penjualan",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
$pelanggan_id= $faktur[0][1];
if(intval($pelanggan_id) !='' || intval($pelanggan_id)!=0){
$pelanggan=doTableArray("pelanggan",array("nama_pelanggan"),"where id='".intval($pelanggan_id)."'");
$nama_pelanggan=$pelanggan[0][0];
if($pelanggan){$nama_pelanggan=$pelanggan[0][0];}else{$nama_pelanggan='-';}

}else{
$nama_pelanggan='-';

}


}else{
$items=doTableArray("kasir_pembelian",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
$supplier_id= $faktur[0][2];
if(intval($supplier_id) !='' || intval($supplier_id)!=0){
$supplier=doTableArray("supplier",array("nama_supplier"),"where id='".intval($supplier_id)."'");
if($supplier){$nama_supplier=$supplier[0][0];}else{$nama_supplier='-';}
}else{
$nama_supplier='-';

}

}
$date= $faktur[0][0];


$pemasukan= $faktur[0][3];
$pengeluaran= $faktur[0][4];
$diskon= $faktur[0][5];
$voucher= $faktur[0][6];
$dibayar= $faktur[0][7];
$kembali= $faktur[0][8];


?>
<div style="overflow-y: auto; height:430px; ">
<div id="printArea">
<center>
<b><?php echo getPengaturan('nama_toko');?></b>
<p><?php echo getPengaturan('alamat');?> telp/no HP : <?php echo getPengaturan('no_hp');?></p>
</center>
<table class="table">
<tr>
<td style="width:100px">Tanggal</td><td style="width:30px">:</td><td><?php echo $date;?></td>
<?php if($_GET['pemasukan']!=0){?>
<td style="width:100px">Pelanggan</td><td style="width:30px">:</td><td><?php echo $nama_pelanggan;?></td>
<?php }else{ ?>
<td style="width:100px">Supplier</td><td style="width:30px">:</td><td><?php echo $nama_supplier;?></td>

<?php } ?>
</tr>
<tr>
<td>Faktur</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
<td colspan=3></td>
</tr>
</table>

<table class="table " id="dataPenjualan" cellspacing="0">
  <thead>
	<tr>
	  <th style="width:50px">No</th>
	  <th>Kode</th>
	  <th>Nama Barang</th>
	  <th>Harga</th>
	  <th>Qty</th>
	  <th >Total</th>
	</tr>
  </thead>
  <tbody >
  <?php
  $i=1;
	foreach($items as $row){
	  echo '<tr>';
	  echo '<td>'.$i.'</td>';
	  echo '<td>'.$row[0].'</td>';
	  echo '<td>'.$row[1].'</td>';
	  echo '<td>'. currency($row[2]).'</td>';
	  echo '<td>'.$row[3].'</td>';
	  echo '<td>'. currency($row[4]).'</td>';
	  echo '</tr>';
	  $i++; 	  
  }   
  ?>
<?php if($_GET['pemasukan']!=0){?>
<?php if($voucher != 0 || $voucher!=''){?>  <tr><td colspan=4>Voucher</td><td>:</td><td><?php echo currency(intval($voucher));?></td></tr><?php } ?>
<?php if($diskon != 0 || $diskon!=''){?>  <tr><td colspan=4>Diskon</td><td>:</td><td><?php echo currency(intval($diskon));?></td></tr><?php } ?>
	<tr><td colspan=4>Total</td><td>:</td><td><?php echo currency($pemasukan);?></td></tr>
	<tr><td colspan=4>Dibayar</td><td>:</td><td><?php echo  currency(intval ($dibayar));?></td></tr>
	<tr><td colspan=4>Kembali</td><td>:</td><td><?php echo  currency(intval ($kembali));?></td></tr>
<?php }else{ ?>
  <tr><td colspan=4>Total</td><td>:</td><td><?php echo currency($pengeluaran);?></td></tr>

<?php } ?>

  </tbody>
  </table> 
</div>
</div>
<?php
}else
if(isset($_GET['totalCashflow'])){
$pemasukan=sumData('faktur','pemasukan',"WHERE pemasukan!=0  AND status='tunai'");
$pengeluaran=sumData('faktur','pengeluaran',"WHERE pengeluaran!=0 AND status='tunai'");
$ongkir=sumData('faktur','ongkir',"WHERE pemasukan!=0 AND status='tunai'");
$pajak=sumData('faktur','pajak',"WHERE pemasukan!=0 AND status='tunai'");
$saldo=$pemasukan-$pengeluaran;

	?>
	
<table class="table">
<tr>
<td>Pendapatan </td><td> <span style="float:right"><?php echo currency($pemasukan);?></span></td>
</tr>
<tr >
<td>Pengeluaran</td><td>  <span style="float:right"><?php echo currency($pengeluaran);?></span></td>
</tr>
<tr>
<td>Saldo<br></td><td> <span style="float:right"> <?php echo currency($saldo);?></span></td>
</tr>

</table>
<?php
}else
if(isset($_GET['totalCashflowFilter'])){
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	

$pemasukan=sumData('faktur','pemasukan',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$pengeluaran=sumData('faktur','pengeluaran',"WHERE pengeluaran!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$ongkir=sumData('faktur','ongkir',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$pajak=sumData('faktur','pajak',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai'  ");
$saldo=$pemasukan-$pengeluaran;
	?>
	
<table class="table">
<tr>
<td>Pemasukan </td><td> <span style="float:right"><?php echo currency($pemasukan);?></span></td>
</tr>
<tr >
<td>Pengeluaran </td><td>  <span style="float:right"><?php echo currency($pengeluaran);?></span></td>
</tr>
<tr>
<td>Saldo<br></td><td> <span style="float:right"> <?php echo currency($saldo);?></span></td>
</tr>

<?php
}else
	if(isset($_GET['inputCashflow'])){
		
$date=$_GET['date'];
$getDate=explode("/",$date);
$tanggal=$getDate[0];
$bulan=$getDate[1];
$tahun=$getDate[2];
$date=$tahun."-".$bulan."-".$tanggal;
$user_id=$_GET['user_id'];

	
$faktur=$_GET['faktur'];
$keterangan=$_GET['keterangan'];
if($_GET['tipe']=='pemasukan'){
	$total=xCurrency($_GET['pemasukan']);
	$pemasukan=xCurrency($_GET['pemasukan']);
	$pengeluaran=0;
	$mode=$_GET['jenis_pemasukan'];
}if($_GET['tipe']=='pengeluaran'){
	$total=xCurrency($_GET['pengeluaran']);
	$pengeluaran=xCurrency($_GET['pengeluaran']);
	$pemasukan=0;
	$mode=$_GET['jenis_pengeluaran'];

}
$checkFaktur=checkData('faktur',"WHERE faktur='".$faktur."' ");
if($checkFaktur <1 )
{
		doInsert("faktur",
		"
		faktur,pelanggan_id,tanggal,bulan,tahun,date,total,
		pemasukan,pengeluaran,voucher,diskon,grand_total,dibayar,kembali,
		mode,keterangan,status,hutang,hutang_dibayar,hutang_sisa,tempo,
		user_id,disc,pjk,pajak,ongkir,ekspedisi
		",
		"
		'".$faktur."',
		'',
		'".$tanggal."',
		'".$bulan."',
		'".$tahun."',
		'".$date."',
		'".$total."',
		'".$pemasukan."', 
		'".$pengeluaran."', 
		'0',
		'0',
		'".$total."',
		'".$total."',
		'0',
		'".$mode."',
		'".$keterangan."',
		'tunai',
		'0',
		'0',
		'0',
		'0',
		'".$user_id."',
		'0',
		'0',
		'0',
		'0',
		'0'
		");

		$items=doTableArray("kasir_penjualan",array("qty","id_barang"),"WHERE status=1");
		foreach($items as $row){
			doUpdate("daftar_barang", //tabel:kasir_penjualan
			"stok=stok-".$row[0].",
			terjual=terjual+".$row[0]."
			",
			"WHERE id_barang='".$row[1]."'"
			);
		}
		
		doUpdate("kasir_penjualan", //tabel:kasir_penjualan
		"
		date='".$date."',
		faktur='".$faktur."',
		status='2'

		",
		"WHERE status='1'"
		);
		
}
		
		
	}
elseif(isset($_GET['deleteCashflow'])){
doDelete('kasir_penjualan',"WHERE faktur='".$_GET['Cashfaktur']."'");
doDelete('kasir_pembelian',"WHERE faktur='".$_GET['Cashfaktur']."'");
doDelete('faktur',"WHERE id=".$_GET['deleteCashflow']."");
doDelete('return_barang',"WHERE faktur='".$_GET['Cashfaktur']."'");
doDelete('return_penjualan',"WHERE faktur='".$_GET['Cashfaktur']."'");
doDelete('return_pembelian',"WHERE faktur='".$_GET['Cashfaktur']."'");
}

?>

