<?php 
if(isset($_GET['tableKasir'])){
doTableJSON($_GET['tableKasir'],array(
"id",
"kode_barang",
"nama_barang",
"harga",
"qty",
"total",
"faktur",
"id_barang",
"date"
),"WHERE status=1 AND session='".userID($_SESSION['user'])."' AND meja='".$_GET['meja']."'");
}

elseif(isset($_GET['stokCart'])){
$items=doTableArray("daftar_barang",array("stok"),"WHERE id_barang='".$_GET['stokCart']."'");
echo $items[0][0];

}

elseif(isset($_GET['kasirBarang'])){
doTableJSON($_GET['kasirBarang'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_jual",
"stok",
"satuan",
"kategori_barang",
"stok_minimal"
),"WHERE jenis='produk'");
}

elseif(isset($_GET['totalSum'])){
if(isset($_GET['meja'])){$meja="AND meja='".$_GET['meja']."'";}else{$meja='';}
$total= sumData($_GET['totalSum'],'total',"WHERE status=1 AND session='".userID($_SESSION['user'])."' ".$meja."");
echo'<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" style="font-size:20px;">TOTAL  </button></span>
<input id="totalGrandKasir" style="border:2px solid #ccc;background:#f7f774;width:100%;font-size:25px;text-align:right" readonly value="'.currency($total).'"></div>';

}
elseif(isset($_GET['totalSumBayar'])){
if(isset($_GET['meja'])){$meja="AND meja='".$_GET['meja']."'";}else{$meja='';}

$total= sumData($_GET['totalSumBayar'],'total',"WHERE status=1 AND session='".userID($_SESSION['user'])."' ".$meja."");
echo'<input class="form-control"  id="totalBayar"  readonly value="'.$total.'">';
}
elseif(isset($_GET['hitungKembali'])){
$total=xCurrency($_GET['total']);


$voucher=xCurrency($_GET['voucher']);
$diskon=xCurrency($_GET['diskon']);
$diskon=round(($diskon/100) * $total);
if($diskon==0 OR $diskon==""){
	if($voucher!=0 OR $voucher!=''){
		$total=$total-$voucher;
	}else{
		$total=$total;
	}
}else{
$total=$total-$diskon;
}

if($_GET['ongkir']!=0 OR $_GET['ongkir']!=""){
	
$ongkir=xCurrency($_GET['ongkir']);
$total=$total+$ongkir;
}
if($_GET['pajak']!=0 OR $_GET['pajak']!=""){
	
$pajak=xCurrency($_GET['pajak']);
$pajak=round(($pajak/100) * $total);
$total=$total+$pajak;
}

$dibayar=xCurrency($_GET['bayar']);
$kembali=$dibayar-$total;
//echo "<b>Rp. ".currency($kembali)."</b>";

if($kembali>=0){
	echo "<b>Rp. ".currency($kembali)."</b><input id='bayarKurang' style='display:none' value='0'>";
}else{
	echo "<b>Rp. ".currency($kembali)." <br><input id='bayarKurang' style='display:none' value='1'><span style='color:red' > PEMBAYARAN BELUM CUKUP!</span></b>";
}

}
elseif(isset($_GET['hitungTotal'])){
$total=xCurrency($_GET['total']);
$voucher=xCurrency($_GET['voucher']);
$diskon=xCurrency($_GET['diskon']);
$diskon=round(($diskon/100) * $total);
if($diskon==0 OR $diskon==""){
	if($voucher!=0 OR $voucher!=''){
		$total=$total-$voucher;
	}else{
		$total=$total;
	}
}else{
$total=$total-$diskon;
}
if($_GET['ongkir']!=0 OR$_GET['ongkir']!=""){

$ongkir=xCurrency($_GET['ongkir']);
$total=$total+$ongkir;
}
if($_GET['pajak']!=0 OR$_GET['pajak']!=""){

$pajak=xCurrency($_GET['pajak']);
$pajak=round(($pajak/100) * $total);
$total=$total+$pajak;
}
echo '<b>Rp.'.currency($total).'</b>';
}
elseif(isset($_GET['kembaliNol'])){
	echo "<b>Rp.0</b>";
}


elseif(isset($_GET['addCart'])){
	if(isset($_GET['status'])){$status=$_GET['status'];}else{$status=1;}
	$barang=doTableArray("daftar_barang",array("id_barang","nama_barang","harga_jual","harga_beli"),"where kode_barang='".$_GET['kode_barang']."'");
	$faktur=$_GET['faktur'];
	$meja=explode('.',$faktur);
	$meja=$_GET['noMeja'];
	$user_id=$_GET['user_id'];
	$id_barang=$barang[0][0];
	$nama_barang=$barang[0][1];
	$harga=$barang[0][2];
	$hpp=$barang[0][3];
	$checkCart=checkData($_GET['addCart'],"WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 AND session='".$user_id."' AND meja=".$meja."");
	$total=$harga*$_GET['qty'];
	$total_hpp=$hpp*$_GET['qty'];
	if($checkCart <1){

		doInsert($_GET['addCart'],
		"
		id_barang,kode_barang,nama_barang,harga,qty,faktur,date,total,status,hpp,total_hpp,session,meja
		",
		"
		'".$id_barang."',
		'".$_GET['kode_barang']."',
		'".$nama_barang."',
		'".$harga."',
		'".$_GET['qty']."',
		'".$faktur."',
		'".date("Y-m-d")."',
		'".$total."',
		'".$status."',
		'".$hpp."',
		'".$total_hpp."',
		'".$user_id."',
		'".$meja."'
		
		");
	}else{
		doUpdate($_GET['addCart'],"qty=qty+".$_GET['qty'].",total=total+".$total."","WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 AND session='".$_GET['user_id']."'  AND meja='".$meja."'");
		doUpdate($_GET['addCart'],"total_hpp=hpp*qty","WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 AND session='".$_GET['user_id']."' AND meja='".$meja."'");
	}

}
elseif(isset($_GET['delCart'])){
doDelete($_GET['tableCart'],"WHERE id=".$_GET['delCart']."");
}

elseif(isset($_GET['updateSupplier'])){
doUpdate($_GET['updateSupplier'],
"
nama_supplier='".$_GET['nama_supplier']."',
alamat='".$_GET['alamat']."',
kota='".$_GET['kota']."',
no_hp='".$_GET['no_hp']."',
email='".xCurrency($_GET['email'])."',
website='".xCurrency($_GET['website'])."',
rekening='".$_GET['rekening']."'
",
"WHERE id='".$_GET['id']."'"
);
}

elseif(isset($_GET['updateCart'])){
$qty=$_GET['qty'];
$harga=xCurrency($_GET['harga']);
$total=$harga*$qty;
doUpdate($_GET['updateCart'], //tabel:kasir_penjualan
"
qty='".$_GET['qty']."',
total='".$total."',
total_hpp=hpp*".$qty."
",
"WHERE id='".$_GET['id']."'"
);

}
elseif(isset($_GET['plusCart'])){
$qty=$_GET['plusCart']+1;
$harga=xCurrency($_GET['harga']);
$total=$harga*$qty;
doUpdate($_GET['modeCart'], //tabel:kasir_penjualan
"qty='".$qty."',
total='".$total."'
",
"WHERE id='".$_GET['id']."'"
);

doUpdate($_GET['modeCart'], //tabel:kasir_penjualan
"total_hpp=hpp*qty","WHERE id='".$_GET['id']."'"
);
}
elseif(isset($_GET['minusCart'])){
$qty=$_GET['minusCart']-1;
$harga=xCurrency($_GET['harga']);
$total=$harga*$qty;
doUpdate($_GET['modeCart'], //tabel:kasir_penjualan
"
qty='".$qty."',
total='".$total."'
",
"WHERE id='".$_GET['id']."'"
);
doUpdate($_GET['modeCart'], //tabel:kasir_penjualan
"total_hpp=hpp*qty","WHERE id='".$_GET['id']."'"
);
}

elseif(isset($_GET['inputBayar'])){
	
	if($_GET['tempo']!=''){
	$tempo=$_GET['tempo'];
	$getTempo=explode("/",$tempo);
	$tempo=$getTempo[2]."-".$getTempo[1]."-".$getTempo[0];
	}else{
	$tempo=0;	
	}


	$meja=$_GET['meja'];

	$ekspedisi=$_GET['ekspedisi'];
	$user_id=$_GET['user_id'];
	$date=$_GET['date'];
	$getDate=explode("/",$date);
	$tanggal=$getDate[0];
	$bulan=$getDate[1];
	$tahun=$getDate[2];
	$date=$tahun."-".$bulan."-".$tanggal;
	
	$pelanggan_id=$_GET['pelanggan_id'];
	$faktur=$_GET['faktur'];
	//$meja=explode('.',$faktur);
	//$meja=$meja[3];
	$voucher=xCurrency($_GET['voucher']);

	$total=xCurrency($_GET['total']);



	$disc=xCurrency($_GET['diskon']);
	$diskon=xCurrency($_GET['diskon']);
	$dibayar=xCurrency($_GET['dibayar']);
	
	$diskon=round(($diskon/100) * $total);
	if($diskon==0 OR $diskon==""){
		if($voucher!=0 OR $voucher!=''){
			$grandTotal=$total-$voucher;
		}else{
			$grandTotal=$total;
		}
	}else{
		$grandTotal=$total-$diskon;
	}

	if($_GET['ongkir']!=0 OR $_GET['ongkir']!=""){
	$ongkir=xCurrency($_GET['ongkir']);
	$grandTotal=$grandTotal+$ongkir;
	}else{
	$ongkir=0;

	}

	if($_GET['pajak']!=0 OR $_GET['pajak']!=""){
	$pjk=xCurrency($_GET['pajak']);
	$pajak=xCurrency($_GET['pajak']);
	$pajak=round(($pajak/100) * $grandTotal);
	$grandTotal=$grandTotal+$pajak;
	}else{
	$pajak=0;
	}
	
	if($_GET['metode']=='tunai'){
	$status='tunai';
	$hutang=0;
	$hutang_dibayar=0;
	$hutang_sisa=0;
	}else{
	
	$status='kredit';
	$hutang=$grandTotal;
	$hutang_dibayar=0;
	$hutang_sisa=$grandTotal;
	}
	$totalHPP=totalHPP($user_id);
	$kembali=$dibayar-$grandTotal;
	$pemasukan=$total-$diskon-$voucher+$pajak;
	$labarugi=$pemasukan-$totalHPP;

	$terjual= sumData('kasir_penjualan','qty',"WHERE status=1 AND session='".$user_id."'");

	$checkFaktur=checkData('faktur',"WHERE faktur='".$faktur."' ");
if($checkFaktur <1 )
{
		doInsert("faktur",
		"
		faktur,pelanggan_id,tanggal,bulan,tahun,date,total,
		pemasukan,pengeluaran,voucher,diskon,grand_total,dibayar,kembali,
		mode,keterangan,status,hutang,hutang_dibayar,hutang_sisa,tempo,
		user_id,disc,pjk,pajak,ongkir,ekspedisi,total_hpp,laba_rugi,terjual
		",
		"
		'".$faktur."',
		'".$pelanggan_id."',
		'".$tanggal."',
		'".$bulan."',
		'".$tahun."',
		'".$date."',
		'".$total."',
		'".$pemasukan."',
		'0',
		'".$voucher."',
		'".$diskon."',
		'".$grandTotal."',
		'".$dibayar."',
		'".$kembali."',
		'penjualan',
		'Penjualan : ".$faktur."',
		'".$status."',
		'".$hutang."',
		'".$hutang_dibayar."',
		'".$hutang_sisa."',
		'".$tempo."',
		'".$user_id."',
		'".$disc."',
		'".$pjk."',
		'".$pajak."',
		'".$ongkir."',
		'".$ekspedisi."',
		'".$totalHPP."',
		'".$labarugi."',
		'".$terjual."'
		");

		$items=doTableArray("kasir_penjualan",array("qty","id_barang"),"WHERE status=1 AND session='".$user_id."'");
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
		"WHERE status='1' AND session='".$_GET['user_id']."' AND faktur='".$faktur."'"
		);
//ENDIF FAKTUR		
}else{

/*	$items=doTableArray("kasir_penjualan",array("qty","id_barang"),"WHERE faktur='".$faktur."' AND session='".$user_id."'");
foreach($items as $row){
doUpdate("daftar_barang", //tabel:kasir_penjualan
"stok=stok-".$row[0].",
terjual=terjual+".$row[0]."
",
"WHERE id_barang='".$row[1]."'"
);
}
*/
} 
			
doUpdate('meja',
"
faktur=''
",
"WHERE meja='".$meja."'"
);

}elseif(isset($_GET['printKasir'])){
$items=doTableArray("kasir_penjualan",array("kode_barang","nama_barang","harga","qty","total","faktur","meja"),"WHERE status=2 AND faktur='".$_GET['faktur']."'");
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
<div >
<div id="printArea">
<table class="table">
<tr>
<td style="width:100px">Tanggal</td><td style="width:30px">:</td><td><?php echo $date;?></td>
<td style="width:100px">Pelanggan</td><td style="width:30px">:</td><td><?php echo $nama_pelanggan;?></td>
</tr>
<tr>
<td>Faktur</td><td>:</td><td><?php echo $_GET['faktur'];?></td>
<td>Meja</td><td>:</td><td><?php echo $items[0][6];?></td>
</tr>
</table>

<table class="table " id="dataPenjualan" cellspacing="0">
  <thead>
	<tr>
	  <th>Nama Barang</th>
	  <th>Harga</th>
	  <th>Qty</th>
	  <th>Total</th>
	</tr>
  </thead>
  <tbody >
  <?php
  $i=1;
	foreach($items as $row){
	  echo '<tr>';
	  echo '<td>'.$row[1].'</td>';
	  echo '<td>'. currency($row[2]).'</td>';
	  echo '<td>'.$row[3].'</td>';
	  echo '<td>'. currency($row[4]).'</td>';
	  echo '</tr>';
	  $i++; 	  
  }   
  ?>
  
<?php if($voucher != 0 || intval($voucher)!=''){?>  <tr><td colspan=2>Voucher</td><td>:</td><td><?php echo currency(intval($voucher));?></td></tr><?php } ?>
<?php if($diskon != 0 || intval($diskon)!=''){?>  <tr><td colspan=2>Diskon</td><td>:</td><td><?php echo currency(intval($diskon));?></td></tr><?php } ?>
<?php if($ongkir != 0 || intval($ongkir)!=''){?>  <tr><td colspan=2>Ongkir</td><td>:</td><td><?php echo currency(intval($ongkir));?></td></tr><?php } ?>
<?php if($pajak != 0 || intval($pajak)!=''){?>  <tr><td colspan=2>Pajak</td><td>:</td><td><?php echo currency(intval($pajak));?></td></tr><?php } ?>
<tr><td colspan=2>Total</td><td>:</td><td><?php echo currency($pemasukan);?></td></tr>
<tr><td colspan=2>Dibayar</td><td>:</td><td><?php echo  currency(intval ($dibayar));?></td></tr>
<tr><td colspan=2>Kembali</td><td>:</td><td><?php echo  currency(intval ($kembali));?></td></tr>
  </tbody>
  </table> 
</div>
</div>
<?php

}elseif(isset($_GET['loadFaktur'])){
	?>
<div class="input-group" style="margin-top:5px;width:100%">
<span class="input-group-btn"><button class="btn " type="button" >Faktur  &nbsp;&nbsp;</button></span>
<input  class="form-control" type="text" id="faktur" value="<?php echo getFakturID('',$_GET['type']);?>">
</div>
<?php
	
}elseif(isset($_GET['loadDate'])){
	?>
<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" >Tanggal  </button></span>
<input  class="form-control" type="text" id="date" value="<?php echo date("d/m/Y");?>">
</div>
<?php
	
}elseif(isset($_GET['jumlahMeja'])){
doUpdate('pengaturan',
"
meja='".$_GET['jumlahMeja']."'
",
"WHERE id=1"
);	

}

elseif(isset($_GET['batalMeja'])){
doUpdate('meja',
"
faktur=''
",
"WHERE meja='".$_GET['batalMeja']."'"
);	
doDelete("kasir_penjualan","WHERE meja='".$_GET['batalMeja']."' AND status=1");

}elseif(isset($_GET['pindahMejaBaru'])){
	
	$faktur=$_GET['faktur'];
	$faktur=explode('.',$faktur);
	$faktur=$faktur[0].'.'.$faktur[1].'.'.$faktur[2];
	$fakturBaru=$faktur.'.'.$_GET['pindahMejaBaru'];
	
//KOSONGKAN FAKTUR DI MEJA LAMA
doUpdate('meja',
"
faktur=''
",
"WHERE meja='".$_GET['noMeja']."'"
);	


// UPDATE FAKTUR BARU DI MEJA
doUpdate('meja',
"
faktur='".$fakturBaru."'
",
"WHERE meja='".$_GET['pindahMejaBaru']."'"
);	

//UPDATE MEJA BARU
doUpdate('kasir_penjualan',
"
meja='".$_GET['pindahMejaBaru']."',
faktur='".$fakturBaru."'

",
"WHERE meja='".$_GET['noMeja']."'  AND status=1"
);	



// UPDATE FAKTUR BARU DI KASIR
/*
doUpdate('kasir_penjualan',
"
faktur='".$fakturBaru."'
",
"WHERE meja='".$_GET['pindahMejaBaru']."'"
);	
*/


//echo $_GET['faktur'];
}
elseif(isset($_POST['addCart'])){


	if(isset($_POST['status'])){$status=$_POST['status'];}else{$status=1;}
	$barang=doTableArray("daftar_barang",array("id_barang","nama_barang","harga_jual","harga_beli"),"where kode_barang='".$_POST['kode_barang']."'");
	$user_id=$_POST['user_id'];
	$noMeja=$_POST['noMeja'];
	$id_barang=$barang[0][0];
	$nama_barang=$barang[0][1];
	$harga=$barang[0][2];
	$hpp=$barang[0][3];
//	echo $harga;

	$checkCart=checkData($_POST['addCart'],"WHERE kode_barang='".$_POST['kode_barang']."' AND status=1 AND session='".$user_id."'  AND meja='".$noMeja."'");
	$total=$harga*$_POST['qty'];
	$total_hpp=$hpp*$_POST['qty'];

	if($checkCart <1){

		doInsert('kasir_penjualan',
		"
		id_barang,kode_barang,nama_barang,harga,qty,faktur,date,total,status,hpp,total_hpp,session,meja
		",
		"
		'".$id_barang."',
		'".$_POST['kode_barang']."',
		'".$nama_barang."',
		'".$harga."',
		'".$_POST['qty']."',
		'".$_POST['faktur']."',
		'".date("Y-m-d")."',
		'".$total."',
		'".$status."',
		'".$hpp."',
		'".$total_hpp."',
		'".$user_id."',
		'".$noMeja."'
		");
	}else{
		doUpdate($_POST['addCart'],"qty=qty+".$_POST['qty'].",total=total+".$total."","WHERE kode_barang='".$_POST['kode_barang']."' AND status=1 AND session='".$_POST['user_id']."'  AND meja='".$noMeja."' ");
		doUpdate($_POST['addCart'],"total_hpp=hpp*qty","WHERE kode_barang='".$_POST['kode_barang']."' AND status=1 AND session='".$_POST['user_id']."'   AND meja='".$noMeja."' ");
	}
//echo $_POST['kode_barang'];
}
?>

