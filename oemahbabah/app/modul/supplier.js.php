<script>
var ajaxData="data.php?tableSupplier=supplier";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {
$('#selectSatuan').hide();
$('#selectKategori').hide();

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
		scrollY: '42vh',
		scrollCollapse: true,
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
            "defaultContent": "<button <?php displayAkses('supplier_edit',$userlevel);?>  class='btn btn-default btn-xs' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button <?php displayAkses('supplier_hapus',$userlevel);?> class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button>"
        } ,
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
  html: "Anda ingin menghapus data ini? <br> <strong>Nama Supplier </strong>: "+data[ 1 ],
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
	$.get("data.php?deleteSupplier="+data[ 0 ],
	function(data){
	table.ajax.url( ajaxData ).load();
	 $(this).parents('tr').fadeOut(300);

	}
	);
  }
})
	
		 //table.ajax.url( 'data.txt' ).load();
    } );
	
$('#dataTable tbody').on( 'click', '#edit', function () {
var data = table.row( $(this).parents('tr') ).data();
	$('#EditPost').modal('show');
	//$('#EditPostLabel').html(data[ 0 ]);
	$('#id').val(data[ 0 ]);
	$('#nama_supplier').val(data[ 1 ]);
	$('#alamat').val(data[ 2 ]);
	$('#kota').val(data[ 3 ]);
	$('#no_hp').val(data[ 4 ]);
	$('#email').val(data[ 5 ]);
	$('#website').val(data[ 6 ]);
	$('#rekening').val(data[ 7 ]);
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
	$('#nama_supplier').val('');
	$('#alamat').val('');
	$('#kota').val('');
	$('#no_hp').val('');
	$('#email').val('');
	$('#website').val('');
	$('#rekening').val('');

} );

$( "#SaveInput" ).click(function () {
var nama_supplier = $('#nama_supplier').val();
var alamat = $('#alamat').val();
var kota = $('#kota').val();
var no_hp = $('#no_hp').val();
var email = $('#email').val();
var website = $('#website').val();
var rekening = $('#rekening').val();

if(nama_supplier==''){
			swal("","Masukkan Nama Supplier").then((value) => {
			$('#nama_supplier').focus();
		});
		return false;
}
$.get("data.php?inputSupplier=supplier&nama_supplier="+nama_supplier+"&alamat="+alamat+"&kota="+kota+"&no_hp="+no_hp+"&email="+email+"&website="+website+"&rekening="+rekening,
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
var nama_supplier = $('#nama_supplier').val();
var alamat = $('#alamat').val();
var kota = $('#kota').val();
var no_hp = $('#no_hp').val();
var email = $('#email').val();
var website = $('#website').val();
var rekening = $('#rekening').val();


$.get("data.php?updateSupplier=supplier&id="+id+"&nama_supplier="+nama_supplier+"&alamat="+alamat+"&kota="+kota+"&no_hp="+no_hp+"&email="+email+"&website="+website+"&rekening="+rekening,
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