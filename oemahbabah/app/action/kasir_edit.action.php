<?php 
if(isset($_GET['tableKasirEdit'])){
doTableJSON($_GET['tableKasirEdit'],array(
"id",
"kode_barang",
"nama_barang",
"harga",
"qty",
"total",
"faktur",
"id_barang",
"date"
),"WHERE session='".userID($_SESSION['user'])."' AND faktur='".$_GET['faktur']."'");
}

elseif(isset($_GET['stokCartEdit'])){
$items=doTableArray("daftar_barang",array("stok"),"WHERE id_barang='".$_GET['stokCart']."'");
echo $items[0][0];

}

elseif(isset($_GET['totalSumEdit'])){
$total= sumData($_GET['totalSumEdit'],'total',"WHERE faktur='".$_GET['faktur']."' AND session='".userID($_SESSION['user'])."'");
echo'<div class="input-group" >
<span class="input-group-btn"><button class="btn " type="button" style="font-size:40px;">TOTAL  </button></span>
<input id="totalGrandKasir" style="border:2px solid #ccc;background:#f7f774;width:100%;font-size:45px;text-align:right" readonly value="'.currency($total).'"></div>';

}
elseif(isset($_GET['totalSumBayarEdit'])){
$total= sumData($_GET['totalSumBayarEdit'],'total',"WHERE faktur='".$_GET['faktur']."'");
echo'<input class="form-control"  id="totalBayar"  readonly value="'.$total.'">';
}
elseif(isset($_GET['addCartEdit'])){
	$barang=doTableArray("daftar_barang",array("id_barang","nama_barang","harga_jual","harga_beli"),"where kode_barang='".$_GET['kode_barang']."'");
	$user_id=$_GET['user_id'];
	$id_barang=$barang[0][0];
	$nama_barang=$barang[0][1];
	$harga=$barang[0][2];
	$hpp=$barang[0][3];
	$checkCart=checkData($_GET['addCart'],"WHERE kode_barang='".$_GET['kode_barang']."' AND status=1 AND session='".$user_id."' ");
	$total=$harga*$_GET['qty'];
	$total_hpp=$hpp*$_GET['qty'];
	if($checkCart <1){

		doInsert($_GET['addCartEdit'],
		"
		id_barang,kode_barang,nama_barang,harga,qty,faktur,date,total,status,hpp,total_hpp,session
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
		'2',
		'".$hpp."',
		'".$total_hpp."',
		'".$user_id."'
		");
	}else{
		doUpdate($_GET['addCartEdit'],"qty=qty+".$_GET['qty'].",total=total+".$total."","WHERE kode_barang='".$_GET['kode_barang']."' AND status=2 AND session='".$_GET['user_id']."'");
		doUpdate($_GET['addCartEdit'],"total_hpp=hpp*qty","WHERE kode_barang='".$_GET['kode_barang']."' AND status=2 AND session='".$_GET['user_id']."'");
	}

}
elseif(isset($_GET['inputBayarEdit'])){
	
	if($_GET['tempo']!=''){
	$tempo=$_GET['tempo'];
	$getTempo=explode("/",$tempo);
	$tempo=$getTempo[2]."-".$getTempo[1]."-".$getTempo[0];
	}else{
	$tempo=0;	
	}



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
	$pjk=0;
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
	$totalHPP=totalHPPFaktur($user_id,$faktur);
	$kembali=$dibayar-$grandTotal;
	$pemasukan=$total-$diskon-$voucher+$pajak;
	$labarugi=$pemasukan-$totalHPP;

	$checkFaktur=checkData('faktur',"WHERE faktur='".$faktur."' ");
	$terjual= sumData('kasir_penjualan','qty',"WHERE faktur='".$faktur."' ");
		doUpdate("faktur", //tabel:kasir_penjualan
		"pelanggan_id='".$pelanggan_id."',
		tanggal='".$tanggal."',
		bulan='".$bulan."',
		tahun='".$tahun."',
		date='".$date."',
		total='".$total."',
		pemasukan='".$pemasukan."',
		voucher='".$voucher."',
		diskon=".$diskon.",
		grand_total='".$grandTotal."',
		dibayar='".$dibayar."',
		kembali='".$kembali."',
		status='".$status."',
		hutang='".$hutang."',
		hutang_dibayar='".$hutang_dibayar."',
		hutang_sisa='".$hutang_sisa."',
		tempo='".$tempo."',
		disc='".$disc."',
		pjk='".$pjk."',
		pajak='".$pajak."',
		ongkir='".$ongkir."',
		ekspedisi='".$ekspedisi."',
		total_hpp='".$totalHPP."',
		laba_rugi='".$labarugi."',
		terjual='".$terjual."'",
		"WHERE faktur='".$faktur."'  "
		);

$items=doTableArray("kasir_penjualan",array("qty","id_barang"),"WHERE faktur='".$faktur."' AND session='".$user_id."'");
foreach($items as $row){
doUpdate("daftar_barang", //tabel:kasir_penjualan
"stok=stok-".$row[0].",
terjual=terjual+".$row[0]."
",
"WHERE id_barang='".$row[1]."'"
);
}
}


