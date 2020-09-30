<?php 


if(isset($_GET['tableBarang'])){
doTableJSON($_GET['tableBarang'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"harga_jual",
"stok",
"terjual",
"satuan",
"kategori_barang",
"lokasi",
"warna",
"ukuran",
"merek",
"expired",
"id_barang",
"stok_minimal"

),"WHERE jenis='produk'");
}
elseif(isset($_GET['tableBarangLimit'])){
doTableJSON($_GET['tableBarangLimit'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"harga_jual",
"stok",
"terjual",
"satuan",
"kategori_barang",
"lokasi",
"warna",
"ukuran",
"merek",
"expired",
"id_barang",
"stok_minimal"

),"WHERE stok<=stok_minimal AND jenis='produk'");
}
elseif(isset($_GET['tableBarangExpired'])){
$date=("Y-m-d");
doTableJSON($_GET['tableBarangExpired'],array(
"id_barang",
"kode_barang",
"nama_barang",
"harga_beli",
"harga_jual",
"stok",
"terjual",
"satuan",
"kategori_barang",
"lokasi",
"warna",
"ukuran",
"merek",
"expired",
"id_barang",
"stok_minimal"

),"WHERE expired!='' AND expiredDate!='' AND expiredDate<='".$date."'  AND jenis='produk'");
}

elseif(isset($_GET['tableSatuan'])){
doTableJSON($_GET['tableSatuan'],array(
"id",
"satuan"
),"ORDER by id ASC");
}

elseif(isset($_GET['tableKategori'])){
doTableJSON($_GET['tableKategori'],array(
"id",
"kategori"
),"ORDER by id ASC");
}



elseif(isset($_GET['satuanBarang'])){

$dolist=doTableArray("satuan",array("satuan"));
echo'<div class="input-group">';
echo '<select name="" id="satuan" name="satuan" class="form-control" onchange="pilihSatuan(event)">';
echo'<option value="">-- Pilih --</option>';
foreach( $dolist as $list){
	if($_GET['satuan']!='' && $list[0]==$_GET['satuan']){
		$selected='selected';
	}else{
		$selected='';
	}
	if($list[0]!=""){
		echo '<option '.$selected.'>'.$list[0].'</option>';
	}
}
echo '</select>
<span class="input-group-btn">
<span class="input-group-btn"><button class="btn btn-default" type="button" title="edit satuan" onclick="showSatuan()"> <i class="fa fa-pencil" aria-hidden="true"></i></button></span>
</div>';
}

elseif(isset($_GET['cekBarang'])){
echo checkData("daftar_barang","WHERE id_barang=".$_GET['cekBarang']);

}

elseif(isset($_GET['kategoriBarang'])){
$dolist=doTableArray("kategori_barang",array("kategori"));
//print_r( doList("kategori_barang",array("kategori")));

echo'<div class="input-group">';
echo '<select id="kategori_barang" name="kategori_barang" class="form-control" onchange="pilihKategori(event)">';
echo'<option value="">-- Pilih --</option>';
foreach( $dolist as $list){
	if($_GET['kategori']!='' && $list[0]==$_GET['kategori']){
		$selected='selected';
	}else{
		$selected='';
	}
	if($list[0]!=""){
		echo '<option '.$selected.'>'.$list[0].'</option>';
	}
}
echo '</select>
<span class="input-group-btn"><button class="btn btn-default" type="button"  title="edit kategori" onclick="showKategori()"> <i class="fa fa-pencil" aria-hidden="true"></i> </button></span>
</div>';

}

elseif(isset($_GET['inputSatuan'])){
$checkKategori=checkData("satuan","WHERE satuan='".$_GET['satuan']."'");

if($checkKategori < 1){
	doInsert("satuan","satuan","'".$_GET['satuan']."'");
}

}

elseif(isset($_GET['inputKategori'])){
$checkKategori=checkData("kategori_barang","WHERE kategori='".$_GET['kategori']."'");

if($checkKategori < 1){
	doInsert("kategori_barang","kategori","'".str_replace(' ','_',$_GET['kategori'])."'");
}

}


elseif(isset($_GET['deleteBarang'])){
doDelete('daftar_barang',"WHERE id_barang=".$_GET['deleteBarang']."");
}


elseif(isset($_GET['deleteSatuan'])){
doDelete('satuan',"WHERE id=".$_GET['deleteSatuan']."");
}


elseif(isset($_GET['deleteKategori'])){
doDelete('kategori_barang',"WHERE id=".$_GET['deleteKategori']."");
}



elseif(isset($_GET['inputBarang'])){
	
$checkBarang=checkData("daftar_barang","WHERE kode_barang='".$_GET['kode_barang']."'");

if($checkBarang >=1){
	echo '1';
}else{
doInsert($_GET['inputBarang'],
"
kode_barang,nama_barang,kategori_barang,satuan,harga_beli,harga_jual,stok,lokasi,warna,ukuran,merek,expired,expiredDate,stok_minimal,jenis
",
"
'".$_GET['kode_barang']."',
'".xString($_GET['nama_barang'])."',
'".$_GET['kategori_barang']."',
'".$_GET['satuan']."',
'".xCurrency($_GET['harga_beli'])."',
'".xCurrency($_GET['harga_jual'])."',
'".$_GET['stok']."',
'".$_GET['lokasi']."',
'".$_GET['warna']."',
'".$_GET['ukuran']."',
'".$_GET['merek']."',
'".$_GET['expired']."',
'".sdate($_GET['expired'])."',
'".$_GET['stok_minimal']."',
'produk'
");

$checkSatuan=checkData("satuan","WHERE satuan='".$_GET['satuan']."'");
$checkKategori=checkData("kategori_barang","WHERE kategori='".$_GET['kategori_barang']."'");

if($checkSatuan < 1){
	doInsert("satuan","satuan","'".$_GET['satuan']."'");
}
if($checkKategori < 1){
	doInsert("kategori_barang","kategori","'".$_GET['kategori_barang']."'");
}
}
}

elseif(isset($_GET['updateBarang'])){
doUpdate($_GET['updateBarang'],
"
kode_barang='".$_GET['kode_barang']."',
nama_barang='".xString($_GET['nama_barang'])."',
kategori_barang='".$_GET['kategori_barang']."',
satuan='".$_GET['satuan']."',
harga_beli='".xCurrency($_GET['harga_beli'])."',
harga_jual='".xCurrency($_GET['harga_jual'])."',
stok='".$_GET['stok']."',
lokasi='".$_GET['lokasi']."',
warna='".$_GET['warna']."',
ukuran='".$_GET['ukuran']."',
merek='".$_GET['merek']."',
stok_minimal='".$_GET['stok_minimal']."',
expired='".$_GET['expired']."',
expiredDate='".sDate($_GET['expired'])."'
",
"WHERE id_barang='".$_GET['id_barang']."'"
);

$checkSatuan=checkData("satuan","WHERE satuan='".$_GET['satuan']."'");
$checkKategori=checkData("kategori_barang","WHERE kategori='".$_GET['kategori_barang']."'");

if($checkSatuan < 1){
	doInsert("satuan","satuan","'".$_GET['satuan']."'");
}
if($checkKategori < 1){
	doInsert("kategori_barang","kategori","'".$_GET['kategori_barang']."'");
}

}

elseif(isset($_GET['lastID'])){
	print_r(lastInsert("daftar_barang","id_barang",""));
}
elseif(isset($_GET['delImg'])){
	unlink('images/barang/'.$_GET['delImg'].'.jpg');
}elseif(isset($_GET['imgUpload'])){
	if(isset($_GET['imgID'])){
		$imgID=$_GET['imgID'];
	}else{
		$imgID='';
	}
	if(file_exists('images/barang/'.$_GET['imgID'].'.jpg')){
		$imgPreview= '<img src="images/barang/'.$_GET['imgID'].'.jpg?t='.rand().'" class="image-preview">';
		$remove='<a href="#" id="delImg" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> hapus</a>';
	}else{
		$imgPreview= 'no image';
		$remove='';
	}
	?>
	
<form id="uploadForm" action="" method="post">
<input  class="form-control" type="text" id="imgID" name="imgID" style="display:none" value="<?php echo $imgID;?>">
<div class="bgColor">
<div id="targetLayer"><?php echo $imgPreview;?></div>
<div id="uploadFormLayer">
<input name="userImage" type="file" class="inputFile" id="userImage"/>
<div id="submitButton"><input type="submit" value="Upload gambar" class="btn btn-primary btn-sm" style="margin-top:3px" /> 
<?php echo $remove;?></div>
<span id="process" ><img src="images/system/ajax-loader.gif" style="width:30px"> process..</span>

<div id="imgdelete"></div>
</div>
</div>
 </form>
 <script>
$(document).ready(function (e) {
	$('#process').hide();

	$( "#delImg" ).click(function () {

var imgID=$("#imgID").val();

$('#imgdelete').load('data.php?delImg='+imgID);
//alert("gambar dihapus");
swal("","Gambar berhasil dihapus").then((value) => {
	$('#loadUploader').load('data.php?imgUpload=img&imgID='+imgID);
	
});


});
	
	$("#uploadForm").on('submit',(function(e) {
		$('#submitButton').hide();
		$('#process').show();
		var imgID=$("#imgID").val();
		var userImage=$("#userImage").val();

 if(imgID=='' || imgID==0){
			swal("","Kode Barang masih kosong!").then((value) => {
				$('#kode_barang').focus();
			});
			return false;
		}
		if(userImage==''){
			swal("","File gambar masih kosong!").then((value) => {
				$('#userImage').focus();
			});
			return false;
		}
		e.preventDefault();
		$.ajax({
        	url: "data.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
			$('#loadUploader').load('data.php?imgUpload=img&imgID='+imgID);

		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>
	<?php
}
if(isset($_POST['imgID']))
{
	$imgID=$_POST['imgID'];
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) 
	{
		$sourcePath = $_FILES['userImage']['tmp_name'];
		$targetPath = "images/barang/".$imgID.'.jpg';
		if(move_uploaded_file($sourcePath,$targetPath)) 
		{
		flush();
		?>
		<img class="image-preview" src="<?php echo $targetPath; ?>?t=<?php echo rand(); ?>" class="upload-preview" />
		<?php
		}
	}
}

?>

