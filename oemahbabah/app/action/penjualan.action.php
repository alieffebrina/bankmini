<?php 
if(isset($_GET['tableFakturPenjualan'])){
doTableJSON($_GET['tableFakturPenjualan'],array(
"id",
"date",
"faktur",
"pemasukan",
"status",
"pelanggan_id",
"user_id",
"total",
"grand_total"
),
"WHERE mode='penjualan'");
}
else
	
if(isset($_GET['startDate']) AND isset($_GET['filterPenjualan'])){
	
if($_GET['status']!=''){	
	$status="AND status='".$_GET['status']."'";
}else{	$status='';}
if($_GET['user_id']!=''){	
	$user_id="AND user_id='".$_GET['user_id']."'";
}else{	$user_id='';}
if($_GET['pelanggan_id']!=''){	
	$pelanggan_id="AND pelanggan_id='".$_GET['pelanggan_id']."'";
}else{	$pelanggan_id='';}


$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	
	
doTableJSON($_GET['filterPenjualan'],array(
"id",
"date",
"faktur",
"pemasukan",
"status",
"pelanggan_id",
"user_id",
"total",
"grand_total"
),"WHERE mode='penjualan' AND date>='".$startDate."' AND date<='".$endDate."'  ".$status." ".$user_id." ".$pelanggan_id."");
}

else
if(isset($_GET['tablePenjualan'])){
	
$items=doTableArray("kasir_penjualan",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
$faktur=doTableArray("faktur",array("date","pelanggan_id","pemasukan","diskon","voucher","dibayar","kembali"),"where faktur='".$_GET['faktur']."'");
$date= $faktur[0][0];
$pelanggan_id= $faktur[0][1];
$pemasukan= $faktur[0][2];
$diskon= $faktur[0][3];
$voucher= $faktur[0][4];
$dibayar= $faktur[0][5];
$kembali= $faktur[0][6];
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
<td style="width:150px">Faktur Penjualan</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
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
<?php if($voucher != 0 || $voucher!=''){?>  <tr><td colspan=3></td><td colspan=2><b>Voucher</td><td> : <?php echo currency(intval($voucher));?></td></tr><?php } ?>
<?php if($diskon != 0 || $diskon!=''){?>  <tr><td colspan=3></td><td colspan=2><b>Diskon</td><td> : <?php echo currency(intval($diskon));?></td></tr><?php } ?>
  <tr><td colspan=3></td><td colspan=2><b>Total</b></td><td> : <?php echo currency($pemasukan);?></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Dibayar</b></td><td> : <?php echo  currency(intval ($dibayar));?></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Kembali</b></td><td> : <?php echo  currency(intval ($kembali));?></td></tr>
  </tbody>
  </table> 
</div>
<input id="faktur" value="<?php echo $_GET['faktur'];?>" hidden >
</div>
<?php
}else
if(isset($_GET['totalPenjualan'])){
$penjualan=sumData('faktur','grand_total',"WHERE mode='penjualan'");
$tunai=sumData('faktur','grand_total',"WHERE mode='penjualan' AND status='tunai'");
$kredit=sumData('faktur','grand_total',"WHERE  mode='penjualan' AND status='kredit'");

	?>
	
<table class="table">
<tr>
<td><h3>Total Penjualan </h3></td><td> <h3><?php echo currency($penjualan);?></h3></td>
</tr>

</table>
<?php
}
else
if(isset($_GET['totalPenjualanFilter'])){

if($_GET['status']!=''){	
	$status="AND status='".$_GET['status']."'";
}else{	$status='';}
if($_GET['user_id']!=''){	
	$user_id="AND user_id='".$_GET['user_id']."'";
}else{	$user_id='';}
if($_GET['pelanggan_id']!=''){	
	$pelanggan_id="AND pelanggan_id='".$_GET['pelanggan_id']."'";
}else{	$pelanggan_id='';}

$startDate=explode('/',$_GET['startDate']);	
$startDate=$startDate[2].'-'.$startDate[1].'-'.$startDate[0];	

$endDate=explode('/',$_GET['endDate']);	
$endDate=$endDate[2].'-'.$endDate[1].'-'.$endDate[0];	

$penjualan=sumData('faktur','grand_total',"WHERE mode='penjualan'  AND date>='".$startDate."' AND date<='".$endDate."' $status $user_id $pelanggan_id  ");
$tunai=sumData('faktur','grand_total',"WHERE mode='penjualan' AND status='tunai' AND date>='".$startDate."' AND date<='".$endDate."'  $status $user_id $pelanggan_id  ");
$kredit=sumData('faktur','grand_total',"WHERE  mode='penjualan' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."'  $status $user_id $pelanggan_id  ");

	?>
	
<table class="table">

<?php if($_GET['status']=='tunai'){?>
<tr>
<td><h3>Penjualan Tunai</h3></td><td> <h3><?php echo currency($tunai);?></h3></td>
</tr>
<?php }elseif($_GET['status']=='kredit'){?>
<tr>
<td><h3>Penjualan Non Tunai</h3></td><td> <h3><?php echo currency($kredit);?></h3></td>
</tr>
<?php }else{?>

<tr>
<td><h3>Total Penjualan </h3></td><td> <h3><?php echo currency($penjualan);?></h3></td>
</tr>
<?php } ?>
</table>
<?php
}
elseif(isset($_GET['hapusTransaksi'])){
doDelete('kasir_penjualan',"WHERE faktur='".$_GET['faktur']."'");
doDelete('kasir_pembelian',"WHERE faktur='".$_GET['faktur']."'");
doDelete('faktur',"WHERE faktur='".$_GET['faktur']."'");
doDelete('return_barang',"WHERE faktur='".$_GET['faktur']."'");
doDelete('return_penjualan',"WHERE faktur='".$_GET['faktur']."'");
doDelete('return_pembelian',"WHERE faktur='".$_GET['faktur']."'");
}
?>

