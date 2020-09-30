<?php
function License(){
$xdata=file_get_contents('library/win32.dll');
//if(numHash(hexdec(HDDLabel()))==getPengaturan('aktivasi')){
if(trim($xdata)==getPengaturan('aktivasi') || 
(HDDLabel()!='' AND numHash(hexdec(HDDLabel()))==getPengaturan('aktivasi')) ||
(trim(getPengaturan('serial'))!='' AND numHash(getPengaturan('serial'))==trim(getPengaturan('aktivasi')))
){
?>
<div class="col-lg-12">
<div class="row">
<div class="col-md-12">
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
<h4><i class="icon fa fa-check-square-o"></i>APLIKASI SUDAH AKTIF</h4>
<div class="row">
<div class="col-md-6">
<b>KODE SERIAL : <?php echo getPengaturan('serial');?></b><br>
Hubungi tim developer kami jika ada masalah.<br>
Kontak : <?php echo emailCenter();?><br>
WA : <?php echo phoneCenter();?><br>
Untuk melihat update software terbaru : <a href="http://djavasoft.com/update" target="_BLANK">http://djavasoft.com/update</a>
</div>

</div>
</div>
</div>
</div>
</div>
<?php
}else{
?>
<script>
$( "#submitActivation" ).click(function () {
var aktivasi = $('#aktivasi').val();
var serial = $('#serial').val();
var no_hp = $('#no_hp').val();

if(aktivasi=='' || aktivasi==0){
    swal("","Masukkan Kode Aktivasi").then((value) => {
        $('#aktivasi').focus();
    });
    return false;
}
    $.get("data.php?submitActivation=pengaturan&aktivasi="+aktivasi+"&serial="+serial+"&no_hp="+no_hp,
    function(data){
            swal("","Kode Aktivasi Berhasil dimasukkan. Silakan login kembali.").then((value) => {
        $('#aktivasi').focus();
    });
        }
        );
});
</script>
<div class="col-lg-12">
<div class="row">
<div class="col-md-12">
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
<h4><i class="icon fa fa-plug"></i>Aktivasi Software</h4>
<div class="row">
<div class="col-md-4">
Masukkan Kode Aktivasi <br>
<div class="input-group " style="margin-top:5px">
<span class="input-group-btn">
<button class="btn btn-default" type="button" >KODE SERIAL &nbsp;</button></span>
<input  class="form-control"  type="text" name="serial" id="serial" value="<?php if(trim(getPengaturan('serial'))!=''){echo trim(getPengaturan('serial'));}else{echo HDDLabel().'-'.SID();}?>" placeholder="KODE SERIAL" readonly />
</div>

<div class="input-group " style="margin-top:5px;display:none">
<span class="input-group-btn">
<button class="btn btn-default" type="button" >NOMOR HP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></span>
<input  class="form-control"  type="text" name="no_hp" id="no_hp" value="" placeholder="No HP"  />
</div>

<div class="input-group " style="margin-top:5px">
<input  class="form-control"  type="text" name="aktivasi" id="aktivasi" value="" placeholder="Kode Aktivasi"  />
<span class="input-group-btn">
<button class="btn btn-primary btn-flat" type="button" id="submitActivation">Aktivasi</button></span>
</div>
</div>
<div class="col-md-6">
Untuk melakukan aktivasi kirim kode serial melalui SMS/WA.<br>
Selanjutnya masukkan Kode Aktivasi yang kami berikan untuk mengaktifkan lisensi.<br>
Kontak : <?php echo emailCenter();?><br>
WA : <?php echo phoneCenter();?><br>
Untuk melihat update software terbaru : <a href="http://djavasoft.com/update" target="_BLANK">http://djavasoft.com/update</a>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
function notif()
{
$xdata=file_get_contents('library/win32.dll');

$xdata=file_get_contents('library/win32.dll');
//if(numHash(hexdec(HDDLabel()))==getPengaturan('aktivasi')){
if(trim($xdata)==getPengaturan('aktivasi') || 
(HDDLabel()!='' AND numHash(hexdec(HDDLabel()))==getPengaturan('aktivasi')) ||
(trim(getPengaturan('serial'))!='' AND numHash(getPengaturan('serial'))==trim(getPengaturan('aktivasi')))
){
}else{
?>
<div class="col-lg-12" style="display:none">
<div class="row">
<div class="col-md-12">
<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
<h4><i class="icon fa fa-warning"></i>Aplikasi BELUM diaktifkan</h4>
Aplikasi ini belum diaktifkan. Transaksi hanya dibatasi maksimal sampai 20 tansaksi. Lakukan aktivasi lisensi agar aplikasi ini dapat digunakan dengan baik.
</div>
</div>
</div>
</div>
<?php
}
}
function xAktivasi()
{
$xdata=file_get_contents('library/win32.dll');
if(trim($xdata)==getPengaturan('aktivasi') || 
numHash(hexdec(HDDLabel()))==getPengaturan('aktivasi') ||
(trim(getPengaturan('serial'))!='' AND numHash(getPengaturan('serial'))==trim(getPengaturan('aktivasi')))
){echo 'style=""';}
else{
echo 'style="color:orange"';
}
}
function xKasir()
{
$xdata=file_get_contents('library/win32.dll');
if(trim($xdata)==getPengaturan('aktivasi') || 
numHash(hexdec(HDDLabel()))==getPengaturan('aktivasi') ||
(trim(getPengaturan('serial'))!='' AND numHash(getPengaturan('serial'))==trim(getPengaturan('aktivasi')))
){echo '';}
else{
if(checkData('faktur') <= 20){}else{
echo '
$("#bayarKasir").hide();
	swal("","Anda belum melakukan Aktivasi").then((value) => {
		$( "#loadBody" ).load( "load.php?mode=aktivasi" );
	});
';
}
}
}
?>
