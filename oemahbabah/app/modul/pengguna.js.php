<script>
var ajaxData="data.php?tableUser=user";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {

//$('[data-toggle="tooltip"]').tooltip(); 

    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
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
 
    $('#dataTable tbody').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tr') ).data();


		swal({
  title: 'Hapus',
  html: "Anda ingin menghapus data ini? <br> <strong>username </strong>: "+data[ 1 ],
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
	$.get("data.php?deleteUser="+data[ 0 ],
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
	$('#username').val(data[ 1 ]);
	$('#nama').val(data[ 2 ]);
	$('#alamat').val(data[ 3 ]);
	$('#no_hp').val(data[ 4 ]);
	$('#level').val(data[ 5 ]);
	$('#password').val('');
	$('#SaveEdit').show();
	$('#SaveInput').hide();
} );
	
$( "#new" ).click(function () {
	$('#SaveEdit').hide();
	$('#SaveInput').show();
	$('#EditPost').modal('show');
	$('#id').val('');
	$('#username').val('');
	$('#nama').val('');
	$('#alamat').val('');
	$('#no_hp').val('');
	$('#level').val('');
	$('#password').val('');

} );

$( "#SaveInput" ).click(function () {
var username = $('#username').val();
var nama = $('#nama').val();
var alamat = $('#alamat').val();
var no_hp = $('#no_hp').val();
var level = $('#level').val();
var password = $('#password').val();


$.get("data.php?inputUser=user&username="+username+"&level="+level+"&password="+password+"&nama="+nama+"&alamat="+alamat+"&no_hp="+no_hp,
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
var nama = $('#nama').val();
var alamat = $('#alamat').val();
var no_hp = $('#no_hp').val();
var username = $('#username').val();
var level = $('#level').val();
var password = $('#password').val();


$.get("data.php?updateUser=user&id="+id+"&username="+username+"&level="+level+"&password="+password+"&nama="+nama+"&alamat="+alamat+"&no_hp="+no_hp,
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
	
	
} );

</script>