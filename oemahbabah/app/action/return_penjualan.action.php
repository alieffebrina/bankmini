<?php 
if(isset($_GET['fakturRtnPenjualan'])){
doTableJSON($_GET['fakturRtnPenjualan'],array(
"id",
"date",
"faktur",
"faktur_penjualan",
"pelanggan_id",
"return_total",
"return_dibayar",
"return_sisa"
),"WHERE mode='return penjualan'");
}
else
	
if(isset($_GET['startDate']) AND isset($_GET['filterRtnPenjualan'])){
	

$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	
	
doTableJSON($_GET['filterRtnPenjualan'],array(
"id",
"date",
"faktur",
"faktur_penjualan",
"pelanggan_id",
"return_total",
"return_dibayar",
"return_sisa"
),"WHERE mode='return penjualan' AND date>='".$startDate."' AND date<='".$endDate."' ");
}
else
if(isset($_GET['totalRtnPenjualan'])){
$rtnPenjualan=sumData('faktur','grand_total',"WHERE mode='return penjualan'");

?>	
<table class="table">
<tr>
<td><h3>Total Return Penjualan </h3></td><td> <h3><?php echo currency($rtnPenjualan);?></h3></td>
</tr>
</table>
<?php
}
else
if(isset($_GET['totalRtnPenjualanFilter'])){
$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	

$rtnPenjualan=sumData('faktur','grand_total',"WHERE mode='return penjualan'  AND date>='".$startDate."' AND date<='".$endDate."'  ");

	?>
	
<table class="table">
<tr>
<td><h3>Total Return Penjualan </h3></td><td> <h3><?php echo currency($rtnPenjualan);?></h3></td>
</tr>

</table>
<?php
}


elseif(isset($_GET['tableFakturBarangJual'])){
	if(isset($_GET['fakturPenjualan'])){
		$faktur=$_GET['fakturPenjualan'];
	}else{
		$faktur=1;
	}
doTableJSON($_GET['tableFakturBarangJual'],array(
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
elseif(isset($_GET['tableRtnPenjualan'])){
doTableJSON($_GET['tableRtnPenjualan'],array(
"id",
"kode_barang",
"nama_barang",
"harga",
"qty",
"total"
),"WHERE status=1");
}elseif(isset($_GET['addCartRtnJual'])){
	$barang=doTableArray("daftar_barang",array("id_barang","nama_barang","harga_jual"),"where kode_barang='".$_GET['kode_barang']."'");
	$id_barang=$barang[0][0];
	$nama_barang=$barang[0][1];
	$harga=$barang[0][2];
	$checkCart=checkData($_GET['addCartRtnJual'],"WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 ");
	$total=$harga*$_GET['qty'];
	if($checkCart <1){

		doInsert($_GET['addCartRtnJual'],
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
		doUpdate($_GET['addCartRtnJual'],"qty=qty+".$_GET['qty'].",total=total+".$total."","WHERE kode_barang='".$_GET['kode_barang']."' AND status=1");
	}

}
elseif(isset($_GET['inputRtnPenjualan'])){



	$user_id=$_GET['user_id'];	
	$date=$_GET['date'];
	$getDate=explode("/",$date);
	$tanggal=$getDate[0];
	$bulan=$getDate[1];
	$tahun=$getDate[2];
	$date=$tahun."-".$bulan."-".$tanggal;
	$faktur=$_GET['faktur'];
	$faktur_penjualan=$_GET['fakturPenjualan'];

	$total=xCurrency($_GET['total']);
	
		doInsert("faktur",
		"
		faktur,pelanggan_id,tanggal,bulan,tahun,date,total,
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
		'".$total."',
		'',
		'0',
		'0',
		'".$total."',
		'".$total."',
		'0',
		'return penjualan',
		'Return Penjualan : ".$faktur_penjualan."',
		'tunai',
		'0',
		'0',
		'0',
		'0',
		'".$user_id."'
		");
		
		doInsert("return_barang",
		"
		faktur,pelanggan_id,tanggal,bulan,tahun,date,total,
		return_penjualan,return_pembelian,dibayar,mode,
		keterangan,status,return_total,return_dibayar,return_sisa,
		user_id,faktur_penjualan
		",
		"
		'".$faktur."',
		'".getFakturPelanggan($faktur_penjualan)."',
		'".$tanggal."',
		'".$bulan."',
		'".$tahun."',
		'".$date."',
		'".$total."',
		'".$total."',
		'0',
		'".$total."',
		'return penjualan',
		'Return Penjualan : ".$faktur_penjualan."',
		'tunai',
		'".$total."',
		'".$total."',
		'0',
		'".$user_id."',
		'".$faktur_penjualan."'
		");
		
		$items=doTableArray("return_penjualan",array("qty","id_barang"),"WHERE status=1");
		foreach($items as $row){
			
		doUpdate("daftar_barang", //tabel:kasir_penjualan
		"stok=stok+".$row[0]."
		",
		"WHERE id_barang='".$row[1]."'"
		);
		doUpdate("kasir_penjualan", //tabel:kasir_penjualan
		"qty=qty-".$row[0].", total=total*(qty-".$row[0].")
		",
		"WHERE id_barang='".$row[1]."' AND faktur='".$faktur_penjualan."'"
		);
		
		}		
		doUpdate("return_penjualan", //tabel:kasir_penjualan
		"
		date='".$date."',
		faktur='".$faktur."',
		status='2'

		",
		"WHERE status='1'"
		);	


}else
if(isset($_GET['dataRtnPenjualan'])){
	
$items=doTableArray("return_penjualan",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
$faktur=doTableArray("return_barang",array("date","pelanggan_id","return_penjualan"),"where faktur='".$_GET['faktur']."'");
$date= $faktur[0][0];
$pelanggan_id= $faktur[0][1];
$return= $faktur[0][2];

if(intval($pelanggan_id) !='' || intval($pelanggan_id)!=0){
$pelanggan=doTableArray("pelanggan",array("nama_pelanggan","alamat","kota"),"where id='".intval($pelanggan_id)."'");
if($pelanggan){$nama_pelanggan=$pelanggan[0][0];$alamat=$pelanggan[0][1];$kota=$pelanggan[0][2];}else{$nama_pelanggan='-';$alamat='';$kota='';}
}else{
$nama_pelanggan='-';
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
<td >Pelanggan</td><td style="width:30px">:</td><td><?php echo $nama_pelanggan;?></td>
</tr>
<tr>
<td style="width:150px">No Return Penjualan</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
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
  <tr><td colspan=3></td><td colspan=2><b>Total</b></td><td> : <?php echo currency($return);?></td></tr>
  </tbody>
  </table> 
<input id="fakturRtnJual" value="<?php echo $_GET['faktur'];?>" hidden >
</div>
</div>
<?php
}