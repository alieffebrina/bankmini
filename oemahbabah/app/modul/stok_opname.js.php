<?php echo'';?>
<script>
$(document).ready(function() {
var ajaxData="data.php?stokOpname=stok_opname";
var ajaxBarang="data.php?beliBarang=daftar_barang";

$( "#showBarang" ).click(function () {
$('#doBarang').modal('show');
tableBarang.ajax.url( ajaxBarang ).load();
} );


var tableBarang = $('#tableBarang').DataTable( {
"language": {
  "emptyTable": "&lt;  No data available in table &gt;"
},
	select: true,
	keys: true,
	"pageLength": 8,
	"lengthMenu": [ 5,10, 25, 50 ],
	"paginate":true,
	"bLengthChange": false,
	"info":false,
	"length":false,
	"ajax": ajaxBarang ,
	"order": [[ 0, "desc" ]],
	"columnDefs": [ {
		"targets": -1,
		"data": null,
		"defaultContent": "<a href='#' class='btn btn-warning btn-sm' id='addBarang'><i class='fa fa-check-square-o'></i> pilih</a>"
	} ]
} );

	$('#tableBarang tbody').on( 'click', '#addBarang', function () {
	var data = tableBarang.row( $(this).parents('tr') ).data();
		$('#id_barang').val(data[ 0 ]);
		$('#kode_barang').val(data[ 1 ]);
		$('#nama_barang').val(data[ 2 ]);
		$('#harga_beli').val(data[ 3 ]);
		$('#stok_komputer').val(data[ 4 ]);
		$('#keterangan').val(data[ 5 ]);
		$('#doBarang').modal('hide');
		
	} );
	
var stokOpname= $('#stokOpname').DataTable( {
"language": {
"emptyTable": "<  No data available in table >"
},
"paginate":true,
"bFilter":true,
"info":false,
"bLengthChange": false,
"ajax": ajaxData ,
"order": [[ 0, "desc" ]],
"columnDefs": [ {
"targets": -1,
"data": null,
"defaultContent": "<button  class='btn btn-default btn-xs' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button>"
} ,
{
"targets": [ 0 ],
"visible": false,
"searchable": false
}
]
} );



<!--- NEW --->

$( '#new' ).click(function () {
$('#SaveEdit').hide();
$('#SaveInput').show();
$('#EditPost').modal('show');
$('#id').val(''); 
$('#id_barang').val(''); 
$('#kode_barang').val(''); 
$('#nama_barang').val(''); 
$('#harga_beli').val(''); 
$('#stok_komputer').val(''); 
$('#stok_nyata').val(''); 
$('#selisih').val(''); 
$('#total_selisih').val(''); 
$('#keterangan').val(''); 
$('#date').val(''); 
});

<!--- EDIT --->

$('#stokOpname tbody').on( 'click', '#edit', function () {
var data = stokOpname.row( $(this).parents('tr') ).data();
$('#EditPost').modal('show');
$('#SaveEdit').show();
$('#SaveInput').hide();
$('#id').val(data[ 0 ]); 
$('#id_barang').val(data[ 1 ]); 
$('#kode_barang').val(data[ 2 ]); 
$('#nama_barang').val(data[ 3 ]); 
$('#harga_beli').val(data[ 4 ]); 
$('#stok_komputer').val(data[ 5 ]); 
$('#stok_nyata').val(data[ 6 ]); 
$('#selisih').val(data[ 7 ]); 
$('#total_selisih').val(data[ 8 ]); 
$('#keterangan').val(data[ 10 ]); 
$('#date').val(data[ 9 ]); 
});

<!---- DELETE -->

$('#stokOpname tbody').on( 'click', '#delete', function () {
var data = stokOpname.row( $(this).parents('tr') ).data();
swal({
  title: 'Hapus',
  html: 'Anda ingin menghapus data ini? ',
  type: 'warning',
  
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Hapus!'
}).then((result) => {
  if (result.value) {
    swal({  
	title: 'Hapus',
	text: 'Data berhasil dihapus',
	type: 'success',
	timer: 2000
}
    );
	$.get('data.php?deletestokOpname='+data[ 0 ],
	function(data){
	stokOpname.ajax.url( ajaxData ).load();
	 $(this).parents('tr').fadeOut(300);

	}
	);
  }
})
} );

<!--- SAVE INPUT --->

$( '#SaveInput' ).click(function () {
var id = $('#id').val(); 
var id_barang = $('#id_barang').val(); 
var kode_barang = $('#kode_barang').val(); 
var nama_barang = $('#nama_barang').val(); 
var harga_beli = $('#harga_beli').val(); 
var stok_komputer = $('#stok_komputer').val(); 
var stok_nyata = $('#stok_nyata').val(); 
var selisih = $('#selisih').val(); 
var total_selisih = $('#total_selisih').val(); 
var keterangan = $('#keterangan').val(); 
var date = $('#date').val(); 
$.get('data.php?saveInputstokOpname=stok_opname&id='+id+'&id_barang='+id_barang+'&kode_barang='+kode_barang+'&nama_barang='+nama_barang+'&harga_beli='+harga_beli+'&stok_komputer='+stok_komputer+'&stok_nyata='+stok_nyata+'&selisih='+selisih+'&total_selisih='+total_selisih+'&keterangan='+keterangan+'&saveInput=1',
function(data){
	stokOpname.ajax.url( ajaxData ).load();
	$('#EditPost').modal('hide');
	swal({  
	title: 'Sukses!',
	text: 'Data berhasil ditambahkan',
	type: 'success',
	timer: 2000
});
});			
});


<!--- SAVE EDIT --->

$( '#SaveEdit' ).click(function () {
var id = $('#id').val(); 
var id_barang = $('#id_barang').val(); 
var kode_barang = $('#kode_barang').val(); 
var nama_barang = $('#nama_barang').val(); 
var harga_beli = $('#harga_beli').val(); 
var stok_komputer = $('#stok_komputer').val(); 
var stok_nyata = $('#stok_nyata').val(); 
var selisih = $('#selisih').val(); 
var total_selisih = $('#total_selisih').val(); 
var keterangan = $('#keterangan').val(); 
var date = $('#date').val(); 
$.get('data.php?saveEditstokOpname=stok_opname&id='+id+'&id_barang='+id_barang+'&kode_barang='+kode_barang+'&nama_barang='+nama_barang+'&harga_beli='+harga_beli+'&stok_komputer='+stok_komputer+'&stok_nyata='+stok_nyata+'&selisih='+selisih+'&total_selisih='+total_selisih+'&keterangan='+keterangan+'&saveEdit='+id,
function(data){
	stokOpname.ajax.url( ajaxData ).load();
	$('#EditPost').modal('hide');
	swal({  
	title: 'Sukses!',
	text: 'Data berhasil diupdate',
	type: 'success',
	timer: 2000
});
});			
});

$( "#refresh" ).click(function () {
	stokOpname.ajax.url( ajaxData ).load();
} );	
});
</script>