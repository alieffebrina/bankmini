<script>
var ajaxData="data.php?tablePelanggan=pelanggan";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {
$("#uploadForm").on('submit',(function(e) {
var fileExcel=$("#fileExcel").val();

if(fileExcel==''){
	swal("","File masih kosong!").then((value) => {
		$('#fileExcel').focus();
	});
	return false;
}
e.preventDefault();
$.ajax({
	url: "import.php",
	type: "POST",
	data:  new FormData(this),
	contentType: false,
	cache: false,
	processData:false,
	success: function(data)
	{
	$("#data").html(data);
	table.ajax.url( ajaxData ).load();

	},
	error: function() 
	{
	} 	        
});
}));
    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },
		select: true,
		dom: 'Bfrtip',		
		responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "ajax": ajaxData ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  <?php displayAkses('pelanggan_edit',$userlevel);?>  class='btn btn-default btn-xs' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button <?php displayAkses('pelanggan_hapus',$userlevel);?> class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button> <button  class='btn btn-default btn-xs' id='cetak'><i class='fa fa-print'></i></button>"
        },
		{
		"targets": [ 0 ],
		"visible": true,
		"searchable": false
		}
		]
    } );
 
    $('#dataTable tbody').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tr') ).data();


		swal({
  title: 'Hapus',
  html: "Anda ingin menghapus data ini? <br> <strong>Nama Pelanggan </strong>: "+data[ 1 ],
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
	$.get("data.php?deletePelanggan="+data[ 0 ],
	function(data){
	table.ajax.url( ajaxData ).load();
	 $(this).parents('tr').fadeOut(300);

	}
	);
  }
})
	
		 //table.ajax.url( 'data.txt' ).load();
    } );

    $('#dataTable tbody').on( 'click', '#cetak', function () {
var data = table.row( $(this).parents('tr') ).data();

window.open("print_label.php?id="+data[0], '_blank');
	
		 //table.ajax.url( 'data.txt' ).load();
    } );
	
$('#dataTable tbody').on( 'click', '#edit', function () {
var data = table.row( $(this).parents('tr') ).data();
	$('#EditPost').modal('show');
	//$('#EditPostLabel').html(data[ 0 ]);
	$('#id').val(data[ 0 ]);
	$('#nama_pelanggan').val(data[ 1 ]);
	$('#alamat').val(data[ 2 ]);
	$('#kota').val(data[ 3 ]);
	$('#no_hp').val(data[ 4 ]);
	$('#email').val(data[ 5 ]);
	$('#SaveEdit').show();
	$('#SaveInput').hide();
} );
	
$( "#new" ).click(function () {
	$('#selectKategori').hide();
	$('#selectSatuan').hide();
	$('#SaveEdit').hide();
	$('#SaveInput').show();
	$('#EditPost').modal('show');
	$('#id').val('');
	$('#nama_pelanggan').val('');
	$('#alamat').val('');
	$('#kota').val('');
	$('#no_hp').val('');
	$('#email').val('');


} );

$( "#SaveInput" ).click(function () {
var nama_pelanggan = $('#nama_pelanggan').val();
var alamat = $('#alamat').val();
var kota = $('#kota').val();
var no_hp = $('#no_hp').val();
var email = $('#email').val();

if(nama_pelanggan==''){
			swal("","Masukkan Nama Pelanggan").then((value) => {
			$('#nama_pelanggan').focus();
		});
		return false;
}
alert(nama_pelanggan);

$.get("data.php?inputPelanggan=pelanggan&nama_pelanggan="+nama_pelanggan+"&alamat="+alamat+"&kota="+kota+"&no_hp="+no_hp+"&email="+email,
function(data){
	table.ajax.url( ajaxData ).load();
	$('#EditPost').modal('hide');
	swal(
{  
	title: 'Sukses!',
	text: 'Data berhasil ditambahkan',
	type: 'success',
	timer: 2000
}
	);
}
);

			
} );
$( "#SaveEdit" ).click(function () {
var id = $('#id').val();
var nama_pelanggan = $('#nama_pelanggan').val();
var alamat = $('#alamat').val();
var kota = $('#kota').val();
var no_hp = $('#no_hp').val();
var email = $('#email').val();
var website = $('#website').val();
var rekening = $('#rekening').val();


$.get("data.php?updatePelanggan=pelanggan&id="+id+"&nama_pelanggan="+nama_pelanggan+"&alamat="+alamat+"&kota="+kota+"&no_hp="+no_hp+"&email="+email,
function(data){
	table.ajax.url( ajaxData ).load();
	//$('#EditPost').modal('hide');
	swal(
{  
	title: 'Sukses!',
	text: 'Data berhasil diperbaharui',
	type: 'success',
	timer: 2000
}
	);
}
);
			
} );

$( "#refresh" ).click(function () {
	table.ajax.url( ajaxData ).load();
} );	
	

$( "#import" ).click(function () {
$('#modalImport').modal('show');
$('#fileExcel').val('');


} );
} );

</script>