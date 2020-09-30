<?php 
if(isset($_GET['loadDapur'])){
$faktur=explode('|',$_GET['faktur']);
$_GET['faktur']=$faktur[1];
$meja=$faktur[0];


$items=doTableArray("kasir_penjualan",array("kode_barang","nama_barang","harga","qty","total","faktur","meja"),"WHERE status=1 AND faktur='".$_GET['faktur']."'");
$faktur=doTableArray("faktur",array("date","pelanggan_id","pemasukan","diskon","voucher","dibayar","kembali","ongkir","pajak","meja"),"where faktur='".$_GET['faktur']."'");
$date= $faktur[0][0];
$pelanggan_id= $faktur[0][1];
$pemasukan= $faktur[0][2];
$diskon= $faktur[0][3];
$voucher= $faktur[0][4];
$dibayar= $faktur[0][5];
$kembali= $faktur[0][6];
$ongkir= $faktur[0][7];
$pajak= $faktur[0][8];
$meja= $items[0][6];
if(intval($pelanggan_id) !='' || intval($pelanggan_id)!=0){
$supplier=doTableArray("pelanggan",array("nama_pelanggan"),"where id='".intval($pelanggan_id)."'");
$nama_pelanggan=$supplier[0][0];
}else{
$nama_pelanggan='-';
}


?>
	<style type="text/css">

	@media print {
	@page  { 
	margin: 0mm;
	font-size:8px!important;
	}
	}

	</style>
<div style="overflow-y: auto; height:430px; ">
<div id="printArea">
<table class="table">
<tr>
<td>Faktur</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
</tr>
<tr>
<td>Meja</td><td>:</td><td><?php echo $meja;?></td>
</tr>
</table>

<table class="table " id="dataPenjualan" cellspacing="0">
  <thead>
	<tr>
	  <th>Nama Barang</th>
	  <th>Qty</th>
	</tr>
  </thead>
  <tbody >
  <?php
  $i=1;
	foreach($items as $row){
	  echo '<tr>';
	  echo '<td>'.$row[1].'</td>';
	  echo '<td>'.$row[3].'</td>';
	  echo '</tr>';
	  $i++; 	  
  }   
  ?>
  </tbody>
  </table> 
  <hr>

</div>
</div>
<?php

}