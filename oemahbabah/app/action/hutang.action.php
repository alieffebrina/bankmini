<?php 
if(isset($_GET['tableFakturHutang'])){

if(isset($_GET['lunas'])){
	$lunas="AND hutang_sisa=0";
}elseif(isset($_GET['belum_lunas'])){
	$lunas="AND hutang_sisa>0";
}elseif(isset($_GET['belum_dibayar'])){
	$lunas="AND hutang_dibayar=0";
}else{
	$lunas="";
}

doTableJSON($_GET['tableFakturHutang'],array(
"id",
"date",
"faktur",
"hutang",
"hutang_dibayar",
"hutang_sisa",
"tempo",
"supplier_id",
"total",
"grand_total"
),
"WHERE mode='pembelian' AND status='kredit' ".$lunas."");
}
else
if(isset($_GET['startDate']) AND isset($_GET['filterHutang'])){
	
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
	
doTableJSON($_GET['filterHutang'],array(
"id",
"date",
"faktur",
"hutang",
"hutang_dibayar",
"hutang_sisa",
"tempo",
"supplier_id",
"total",
"grand_total"
),"WHERE mode='pembelian' AND date>='".$startDate."' AND date<='".$endDate."'   ".$status." ".$user_id." ".$pelanggan_id." ");
}

else
if(isset($_GET['tableHutang'])){
	
$items=doTableArray("kasir_pembelian",array("kode_barang","nama_barang","harga","qty","total","faktur"),"WHERE faktur='".$_GET['faktur']."' AND status=2");
$faktur=doTableArray("faktur",array("date","supplier_id","pengeluaran","diskon","voucher","hutang","hutang_dibayar","hutang_sisa","tempo"),"where faktur='".$_GET['faktur']."' AND status='kredit'");
$date= $faktur[0][0];
$date = new DateTime($date);
$date = $date->format('d-m-Y');
$tempo= $faktur[0][8];
$tempo = new DateTime($tempo);
$tempo = $tempo->format('d-m-Y');
$supplier_id= $faktur[0][1];
$pengeluaran= $faktur[0][2];
$diskon= $faktur[0][3];
$voucher= $faktur[0][4];
$hutang= $faktur[0][5];
$hutang_dibayar= $faktur[0][6];
$hutang_sisa= $faktur[0][7];
if(intval($supplier_id) !='' || intval($supplier_id)!=0){
$supplier=doTableArray("supplier",array("nama_supplier"),"where id='".intval($supplier_id)."'");
if($supplier){$nama_supplier=$supplier[0][0];}else{$nama_supplier='-';}
}else{
$nama_supplier='-';
}

if($hutang == $hutang_dibayar){
	$lunas='<input id="lunas" type="button" class="btn btn-success btn-xs" value="Lunas">';
}else{
	$lunas='<input id="lunas"  type="button" class="btn btn-warning btn-xs" value="Belum Lunas">';
}
?>
<script>
$(document).ready(function() {
	var lunas = $('#lunas').val();
	
	if(lunas =='Lunas'){
		$("#bayarHutang").prop('disabled', true);
		
	}else{
		$("#bayarHutang").prop('disabled', false);

	}
	});	
</script>
<input id="getFaktur" style="display:none" value="<?php echo $_GET['faktur'];?>">
<div style="overflow-y: auto; height:430px; ">
<div id="printArea">
<div class="title" style="margin-bottom:10px;text-align:left">
<b><?php echo getPengaturan('nama_toko');?></b>
<br>
<small><?php echo getPengaturan('alamat');?> Telp/HP <?php echo getPengaturan('no_hp');?></small>
</div>
<table class="table">
<tr>
<td style="width:200px">Tanggal</td><td style="width:30px">:</td><td><?php echo $date;?></td>
<td style="width:200px">Supplier</td><td style="width:30px">:</td><td><?php echo $nama_supplier;?></td>
</tr>
<tr>
<td>Faktur Hutang</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
<td>Status</td><td>:</td><td><?php echo $lunas;?></td>
</tr>
<tr>
<td>Jatuh Tempo</td><td>:</td><td><?php echo $tempo;?></td>
<td></td><td></td><td></td>
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
	  <th style="width:200px" >Total</th>
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
  <tr><td colspan=3></td><td colspan=2><b>Total Hutang</b></td><td> <input class="form-control"  value="<?php echo  currency(intval ($hutang));?>"readonly></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Hutang Terbayar</b></td><td> <input class="form-control"  value="<?php echo  currency(intval ($hutang_dibayar));?>" readonly></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Sisa Hutang</b></td><td><input class="form-control"  value="<?php echo  currency(intval($hutang_sisa));?>"readonly></td></tr>
  </tbody>
  </table> 
<input id="faktur" value="<?php echo $_GET['faktur'];?>" hidden >
</div>
</div>
<?php
}
else
if(isset($_GET['bayarHutang'])){
$faktur=doTableArray("faktur",array("date","supplier_id","pengeluaran","diskon","voucher","hutang","hutang_dibayar","hutang_sisa","tempo"),"where faktur='".$_GET['faktur']."' AND status='kredit'");
$date= $faktur[0][0];
$date = new DateTime($date);
$date = $date->format('d-m-Y');
$tempo= $faktur[0][8];
$tempo = new DateTime($tempo);
$tempo = $tempo->format('d-m-Y');
$supplier_id= $faktur[0][1];
$pengeluaran= $faktur[0][2];
$diskon= $faktur[0][3];
$voucher= $faktur[0][4];
$hutang= $faktur[0][5];
$hutang_dibayar= $faktur[0][6];
$hutang_sisa= $faktur[0][7];
if(intval($supplier_id) !='' || intval($supplier_id)!=0){
$supplier=doTableArray("supplier",array("nama_supplier"),"where id='".intval($supplier_id)."'");
if($supplier){$nama_supplier=$supplier[0][0];}else{$nama_supplier='-';}
}else{
$nama_supplier='-';
}

$BH=explode('.',$_GET['faktur']);
$BH=$BH[2];
?>
	

<div style="width:500px">
<table class="table">
<input  style="display:none" class="form-control" type="text" id="user_id" value="<?php echo userID($_SESSION['user']);?>">
<input style="display:none" class="form-control" id="hutang_sisa_hide" value="<?php echo  intval ($hutang_sisa);?>"readonly>
  <tr><td colspan=3></td><td colspan=2><b>Faktur Pembayaran</b></td><td> <input  class="form-control" type="text" id="fakturHutang" value="<?php echo getFakturID('KSR-'.userID($_SESSION['user']),"BH").'-'.$BH;?>"></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Faktur Hutang</b></td><td> <input  class="form-control" type="text" id="fakturPembelian" value="<?php echo $_GET['faktur'];?>">
 </td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Total Hutang</b></td><td> <input class="form-control" id="hutang" value="<?php echo  intval ($hutang);?>"readonly></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Hutang Terbayar</b></td><td> <input class="form-control" id="hutang_dibayar" value="<?php echo  intval ($hutang_dibayar);?>" readonly></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Sisa Hutang</b></td><td><input class="form-control" id="hutang_sisa" value="<?php echo  intval ($hutang_sisa);?>"readonly></td></tr>
  <tr><td colspan=3></td><td colspan=2><b>Pembayaran Tunai</b></td><td>  <input class="form-control" id="bayarTunai"  onkeyup="formatValue(this)"></td></tr>
 </table>
</div>
<?php
}

elseif(isset($_GET['inputHutang'])){
	
$fakturPembelian=$_GET['fakturPembelian'];
$fakturHutang=$_GET['fakturHutang'];
$hutang=$_GET['hutang'];
//$hutang_dibayar=$_GET['hutang_dibayar'];
$hutang_sisa=$_GET['hutang_sisa'];
$bayarTunai=$_GET['bayarTunai'];
$hutang_dibayar=$bayarTunai;

$user_id=$_GET['user_id'];

		doInsert("faktur",
		"
		faktur,pelanggan_id,tanggal,bulan,tahun,date,total,
		pemasukan,pengeluaran,voucher,diskon,grand_total,dibayar,kembali,
		mode,keterangan,status,hutang,hutang_dibayar,hutang_sisa,tempo,
		user_id,disc,pjk,pajak
		",
		"
		'".$fakturHutang."',
		'',
		'".date('d')."',
		'".date('m')."',
		'".date('Y')."',
		'".date('Y-m-d')."',
		'".$bayarTunai."',
		'0',
		'".$bayarTunai."',
		'0',
		'0',
		'".$hutang."',
		'".$bayarTunai."',
		'0',
		'bayar hutang',
		'Bayar Hutang : ".$fakturPembelian."',
		'tunai',
		'".$hutang."',
		'".$bayarTunai."',
		'".$hutang_sisa."',
		'0',
		'".$user_id."',
		'0',
		'0',
		'0'
		");

doUpdate("faktur",
"
hutang_dibayar=hutang_dibayar+'".$bayarTunai."',
hutang_sisa='".$hutang_sisa."'

",
"WHERE faktur='".$fakturPembelian."'"
);


}
else
if(isset($_GET['totalHutang'])){

$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'");

	?>
	
<table class="table">
<tr>
<td><h3>Total Hutang</h3></td><td>  <h3><?php echo currency($kredit);?></h3></td>
</tr>
</table>
<?php
}
else
if(isset($_GET['totalHutangFilter'])){

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

$kredit=sumData('faktur','grand_total',"WHERE  mode='pembelian' AND status='kredit'  AND date>='".$startDate."' AND date<='".$endDate."' ".$status." ".$user_id." ".$pelanggan_id." ");

	?>
	
<table class="table">
<tr>
<td><h3>Total Hutang</h3></td><td> <h3><?php echo currency($kredit);?></h3></td>
</tr>
</table>
<?php
}
?>

