<?php 
if(isset($_GET['tableLabaRugi'])){
doTableJSON('faktur',array(
"id",
"date",
"faktur",
"mode",
"pemasukan",
"total_hpp",
"laba_rugi",
"grand_total"
),"WHERE status='tunai' AND mode='penjualan'");
}
else
if(isset($_GET['startDate']) AND isset($_GET['filterLabaRugi'])){
	
if($_GET['mode']!=''){
	
	$mode="AND mode='".$_GET['mode']."'";
}else{
	$mode='';
}
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	
	
doTableJSON('faktur',array(
"id",
"date",
"faktur",
"mode",
"pemasukan",
"total_hpp",
"laba_rugi",
"grand_total"
),"WHERE  date>='".$startDate."' AND date<='".$endDate."' $mode AND status='tunai' AND mode='penjualan'");
}

else
if(isset($_GET['totalLabaRugi'])){
$pemasukan=sumData('faktur','pemasukan',"WHERE pemasukan!=0  AND status='tunai' AND mode='penjualan'");
$total_hpp=sumData('faktur','total_hpp',"WHERE pemasukan!=0 AND status='tunai' AND mode='penjualan'");

$labarugi=$pemasukan-$total_hpp;

	?>
	
<table class="table">
<tr>
<td>Penjualan </td><td> <span style="float:right"><?php echo currency($pemasukan);?></span></td>
</tr>
<tr >
<td>HPP</td><td>  <span style="float:right"><?php echo currency($total_hpp);?></span></td>
</tr>
<tr>
<td>Laba Rugi<br></td><td> <span style="float:right"> <?php echo currency($labarugi);?></span></td>
</tr>

</table>
<?php
}else
if(isset($_GET['totalLabaRugiFilter'])){
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	

$pemasukan=sumData('faktur','pemasukan',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai' AND mode='penjualan' ");
$total_hpp=sumData('faktur','total_hpp',"WHERE pemasukan!=0  AND date>='".$startDate."' AND date<='".$endDate."' AND status='tunai' AND mode='penjualan' ");
$labarugi=$pemasukan-$total_hpp;
	?>
	
<table class="table">
<tr>
<td>Penjualan </td><td> <span style="float:right"><?php echo currency($pemasukan);?></span></td>
</tr>
<tr >
<td>HPP</td><td>  <span style="float:right"><?php echo currency($total_hpp);?></span></td>
</tr>
<tr>
<td>Laba Rugi<br></td><td> <span style="float:right"> <?php echo currency($labarugi);?></span></td>
</tr>

</table>

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
}

?>

