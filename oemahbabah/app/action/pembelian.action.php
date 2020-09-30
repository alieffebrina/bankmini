<?php 
if(isset($_GET['tableFakturPembelian'])){
doTableJSON($_GET['tableFakturPembelian'],array(
"id",
"date",
"faktur",
"pengeluaran",
"status",
"supplier_id",
"grand_total"
),"WHERE mode='pembelian'");
}
else
if(isset($_GET['bulan']) AND isset($_GET['filterPembelian'])){
doTableJSON($_GET['filterPembelian'],array(
"id",
"date",
"faktur",
"pengeluaran",
"status",
"supplier_id",
"grand_total"
),"WHERE mode='pembelian' AND bulan=".$_GET['bulan']." AND tahun=".$_GET['tahun']."  AND status='tunai'");
}else
if(isset($_GET['startDate']) AND isset($_GET['filterPembelian'])){
	
	if($_GET['status']!=''){
	
	$status="AND status='".$_GET['status']."'";
}else{
	$status='';
}

$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	
	
doTableJSON($_GET['filterPembelian'],array(
"id",
"date",
"faktur",
"pengeluaran",
"status",
"supplier_id",
"grand_total"
),"WHERE mode='pembelian' AND date>='".$startDate."' AND date<='".$endDate."'  ".$status."");
}
else
if(isset($_GET['tablePembelian'])){
doTableJSON($_GET['tablePembelian'],array(
"id",
"kode_barang",
"nama_barang",
"harga",
"qty",
"total",
"faktur",
"id_barang",
"date"
),"WHERE status=1");
}
elseif(isset($_GET['beliBarang'])){
doTableJSON($_GET['beliBarang'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"stok",
"satuan",
"kategori_barang"
));
}
else
if(isset($_GET['dataPembelian'])){
/*	
$data=$db->query("SELECT * FROM kasir_pembelian WHERE status=2 AND faktur='".$_GET['faktur']."'");
$items=array();
	while($col=$data->fetchArray()){
					
		$items[] = array(
		$col['kode_barang'],
		$col['nama_barang'],
		$col['harga'],
		$col['qty'],
		$col['total'],
		$col['faktur']
		);
	}
*/
	
$items=doTableArray("kasir_pembelian",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
$faktur=doTableArray("faktur",array("date","supplier_id","pengeluaran"),"where faktur='".$_GET['faktur']."'");
$date= $faktur[0][0];
$supplier_id= $faktur[0][1];
$pengeluaran= $faktur[0][2];
if(intval($supplier_id) !='' || intval($supplier_id)!=0){
$supplier=doTableArray("supplier",array("nama_supplier","alamat","kota"),"where id='".intval($supplier_id)."'");
if($supplier){$nama_supplier=$supplier[0][0];$alamat=$supplier[0][1];$kota=$supplier[0][2];}else{$nama_supplier='-';$alamat='';$kota='';}
}else{
$nama_supplier='-';
$alamat='';
$kota='';
}

?>
<div style="overflow-y: auto; height:430px; ">
<div id="printArea">
<div class="title" style="margin-bottom:10px;text-align:left">
<b><?php echo getPengaturan('nama_toko');?></b>
<br>
<small><?php echo getPengaturan('alamat');?> Telp/HP <?php echo getPengaturan('no_hp');?></small>
</div>
<table class="table">
<tr>
<td style="width:150px">Tanggal</td><td style="width:30px">:</td><td><?php echo $date;?></td>
<td >Supplier</td><td style="width:30px">:</td><td><?php echo $nama_supplier;?></td>
</tr>
<tr>
<td style="width:150px">Faktur Pembelian</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
<td >Alamat</td><td style="width:30px">:</td><td><?php echo $alamat;?> <?php echo $kota;?></td>
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
  <tr><td colspan=3></td><td colspan=2><b>Total</b></td><td><?php echo currency($pengeluaran);?></td></tr>
  </tbody>
  </table> 
</div>
<input id="fakturBeli" value="<?php echo $_GET['faktur'];?>" hidden >
</div>
<?php
}
elseif(isset($_GET['addCartBeli'])){
	$barang=doTableArray("daftar_barang",array("id_barang","nama_barang","harga_beli"),"where kode_barang='".$_GET['kode_barang']."'");
	$id_barang=$barang[0][0];
	$nama_barang=$barang[0][1];
	$harga=$barang[0][2];
	$checkCart=checkData($_GET['addCartBeli'],"WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 ");
	$total=$harga*$_GET['qty'];
	if($checkCart <1){

		doInsert($_GET['addCartBeli'],
		"
		id_barang,kode_barang,nama_barang,harga,qty,faktur,date,total,status,session
		",
		"
		'".$id_barang."',
		'".$_GET['kode_barang']."',
		'".$nama_barang."',
		'".$harga."',
		'".$_GET['qty']."',
		'".$_GET['faktur']."',
		'".date("Y-m-d")."',
		'".$total."',
		'1',
		'".$_GET['user_id']."'
		");
	}else{
		doUpdate($_GET['addCartBeli'],"qty=qty+".$_GET['qty'].",total=total+".$total."","WHERE kode_barang='".$_GET['kode_barang']."' AND status=1");
	}

}

elseif(isset($_GET['inputPembelian'])){

	if($_GET['tempo']!=''){
	$tempo=$_GET['tempo'];
	$getTempo=explode("/",$tempo);
	$tempo=$getTempo[2]."-".$getTempo[1]."-".$getTempo[0];
	}else{
	$tempo=0;	
	}

	$user_id=$_GET['user_id'];	
	$date=$_GET['date'];
	$getDate=explode("/",$date);
	$tanggal=$getDate[0];
	$bulan=$getDate[1];
	$tahun=$getDate[2];
	$date=$tahun."-".$bulan."-".$tanggal;
	
	$supplier_id=$_GET['supplier_id'];
	$faktur=$_GET['faktur'];

	$total=xCurrency($_GET['total']);

		if($_GET['metode']=='tunai'){
	$status='tunai';
	$hutang=0;
	$hutang_dibayar=0;
	$hutang_sisa=0;
	}else{
	
	$status='kredit';
	$hutang=$total;
	$hutang_dibayar=0;
	$hutang_sisa=$total;
	}
	
		doInsert("faktur",
		"
		faktur,supplier_id,tanggal,bulan,tahun,date,total,
		pengeluaran,pemasukan,voucher,diskon,grand_total,dibayar,kembali,mode,
		keterangan,status,hutang,hutang_dibayar,hutang_sisa,tempo,
		user_id
		",
		"
		'".$faktur."',
		'".$supplier_id."',
		'".$tanggal."',
		'".$bulan."',
		'".$tahun."',
		'".$date."',
		'".$total."',
		'".$total."',
		'0',
		'0',
		'0',
		'".$total."',
		'".$total."',
		'0',
		'pembelian',
		'Pembelian : ".$faktur."',
		'".$status."',
		'".$hutang."',
		'".$hutang_dibayar."',
		'".$hutang_sisa."',
		'".$tempo."',
		'".$user_id."'

		");
$items=doTableArray("kasir_pembelian",array("qty","id_barang"),"WHERE status=1");
	
//		$data=PDO_FetchAll("SELECT * FROM kasir_pembelian WHERE status=1");
		foreach($items as $row){
		//echo $row['id_barang'].'<hr>';
		//update stok & terjual
		doUpdate("daftar_barang", //tabel:kasir_penjualan
		"
		stok=stok+".$row[0]."
		",
		"WHERE id_barang='".$row[1]."'"
		);

		}
		
		doUpdate("kasir_pembelian", //tabel:kasir_penjualan
		"
		date='".$date."',
		faktur='".$faktur."',
		status='2'

		",
		"WHERE status='1'"
		);		

}
else
if(isset($_GET['totalPembelian'])){
$pembelian=sumData('faktur','grand_total',"WHERE mode='pembelian'");
$tunai=sumData('faktur','grand_total',"WHERE mode='pembelian' AND status='tunai'");
$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'");

	?>
	
<table class="table">
<tr>
<td><h3>Total Pembelian </h3></td><td> <h3><?php echo currency($pembelian);?></h3></td>
</tr>

</table>
<?php
}
else
if(isset($_GET['totalPembelianFilter'])){
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	

$pembelian=sumData('faktur','grand_total',"WHERE mode='pembelian'  AND date>='".$startDate."' AND date<='".$endDate."'  ");
$tunai=sumData('faktur','grand_total',"WHERE mode='pembelian' AND status='tunai' AND date>='".$startDate."' AND date<='".$endDate."'  ");
$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'  ");

	?>
	
<table class="table">

<?php if($_GET['status']=='tunai'){?>
<tr>
<td><h3>Pembelian Tunai</h3></td><td> <h3><?php echo currency($tunai);?></td>
</tr>
<?php }elseif($_GET['status']=='kredit'){?>
<tr>
<td><h3>Pembelian Non Tunai</h3></td><td> <h3><?php echo currency($kredit);?></td>
</tr>
<?php }else{?>

<tr>
<td><h3>Total Pembelian </h3></td><td> <h3><?php echo currency($pembelian);?></td>
</tr>
<?php } ?>
</table>
<?php
}
?>



