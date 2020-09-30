<?php 
if(isset($_GET['fakturRtnPembelian'])){
doTableJSON($_GET['fakturRtnPembelian'],array(
"id",
"date",
"faktur",
"faktur_pembelian",
"supplier_id",
"return_total",
"return_dibayar",
"return_sisa"
),"WHERE mode='return pembelian'");
}
else
	
if(isset($_GET['startDate']) AND isset($_GET['filterRtnPembelian'])){
	

$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	
	
doTableJSON($_GET['filterRtnPembelian'],array(
"id",
"date",
"faktur",
"faktur_pembelian",
"supplier_id",
"return_total",
"return_dibayar",
"return_sisa"
),"WHERE mode='return pembelian' AND date>='".$startDate."' AND date<='".$endDate."' ");
}
else
if(isset($_GET['totalRtnPembelian'])){
$rtnPembelian=sumData('faktur','grand_total',"WHERE mode='return pembelian'");

?>	
<table class="table">
<tr>
<td><h3>Total Return Pembelian </h3></td><td> <h3><?php echo currency($rtnPembelian);?></h3></td>
</tr>
</table>
<?php
}
else
if(isset($_GET['totalRtnPembelianFilter'])){
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	

$rtnPembelian=sumData('faktur','grand_total',"WHERE mode='return pembelian'  AND date>='".$startDate."' AND date<='".$endDate."'  ");

	?>
	
<table class="table">
<tr>
<td><h3>Total Return Pembelian </h3></td><td> <h3><?php echo currency($rtnPembelian);?></h3></td>
</tr>

</table>
<?php
}

elseif(isset($_GET['tableFakturBarang'])){
	if(isset($_GET['fakturPembelian'])){
		$faktur=$_GET['fakturPembelian'];
	}else{
		$faktur=1;
	}
doTableJSON($_GET['tableFakturBarang'],array(
"id",
"faktur",
"date",
"kode_barang",
"nama_barang",
"harga",
"qty",
"total"
),"WHERE status=2 AND faktur='".$faktur."'");
}
elseif(isset($_GET['tableRtnPembelian'])){
doTableJSON($_GET['tableRtnPembelian'],array(
"id",
"kode_barang",
"nama_barang",
"harga",
"qty",
"total"
),"WHERE status=1");
}elseif(isset($_GET['addCartRtnBeli'])){
	$barang=doTableArray("daftar_barang",array("id_barang","nama_barang","harga_beli"),"where kode_barang='".$_GET['kode_barang']."'");
	$id_barang=$barang[0][0];
	$nama_barang=$barang[0][1];
	$harga=$barang[0][2];
	$checkCart=checkData($_GET['addCartRtnBeli'],"WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 ");
	$total=$harga*$_GET['qty'];
	if($checkCart <1){

		doInsert($_GET['addCartRtnBeli'],
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
		doUpdate($_GET['addCartRtnBeli'],"qty=qty+".$_GET['qty'].",total=total+".$total."","WHERE kode_barang='".$_GET['kode_barang']."' AND status=1");
	}

}
elseif(isset($_GET['inputRtnPembelian'])){



	$user_id=$_GET['user_id'];	
	$date=$_GET['date'];
	$getDate=explode("/",$date);
	$tanggal=$getDate[0];
	$bulan=$getDate[1];
	$tahun=$getDate[2];
	$date=$tahun."-".$bulan."-".$tanggal;
	$faktur=$_GET['faktur'];
	$faktur_pembelian=$_GET['fakturPembelian'];

	$total=xCurrency($_GET['total']);
	
		doInsert("faktur",
		"
		faktur,supplier_id,tanggal,bulan,tahun,date,total,
		pengeluaran,pemasukan,voucher,diskon,grand_total,dibayar,kembali,mode,
		keterangan,status,hutang,hutang_dibayar,hutang_sisa,tempo,
		user_id
		",
		"
		'".$faktur."',
		'0',
		'".$tanggal."',
		'".$bulan."',
		'".$tahun."',
		'".$date."',
		'".$total."',
		'',
		'".$total."',
		'0',
		'0',
		'".$total."',
		'".$total."',
		'0',
		'return pembelian',
		'Return Pembelian : ".$faktur_pembelian."',
		'tunai',
		'0',
		'0',
		'0',
		'0',
		'".$user_id."'
		");
		
		doInsert("return_barang",
		"
		faktur,supplier_id,tanggal,bulan,tahun,date,total,
		return_pembelian,return_penjualan,dibayar,mode,
		keterangan,status,return_total,return_dibayar,return_sisa,
		user_id,faktur_pembelian
		",
		"
		'".$faktur."',
		'".getFakturSupplier($faktur_pembelian)."',
		'".$tanggal."',
		'".$bulan."',
		'".$tahun."',
		'".$date."',
		'".$total."',
		'".$total."',
		'0',
		'".$total."',
		'return pembelian',
		'Return Pembelian : ".$faktur_pembelian."',
		'tunai',
		'".$total."',
		'".$total."',
		'0',
		'".$user_id."',
		'".$faktur_pembelian."'
		");
		
		$items=doTableArray("return_pembelian",array("qty","id_barang"),"WHERE status=1");
		foreach($items as $row){
			
		doUpdate("daftar_barang", //tabel:kasir_penjualan
		"stok=stok-".$row[0]."
		",
		"WHERE id_barang='".$row[1]."'"
		);
		doUpdate("kasir_pembelian", //tabel:kasir_penjualan
		"qty=qty-".$row[0].", total=total*(qty-".$row[0].")
		",
		"WHERE id_barang='".$row[1]."' AND faktur='".$faktur_pembelian."'"
		);
		
		}		
		doUpdate("return_pembelian", //tabel:kasir_penjualan
		"
		date='".$date."',
		faktur='".$faktur."',
		status='2'

		",
		"WHERE status='1'"
		);	


}
else
if(isset($_GET['dataRtnPembelian'])){
	
$items=doTableArray("return_pembelian",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
$faktur=doTableArray("return_barang",array("date","supplier_id","return_pembelian"),"where faktur='".$_GET['faktur']."'");
$date= $faktur[0][0];
$supplier_id= $faktur[0][1];
$return= $faktur[0][2];
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
<td style="width:150px">No Return Pembelian</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
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
  <tr><td colspan=3></td><td colspan=2><b>Total</b></td><td><?php echo currency($return);?></td></tr>
  </tbody>
  </table> 
<input id="fakturRtnBeli" value="<?php echo $_GET['faktur'];?>" hidden >
</div>
</div>
<?php
}