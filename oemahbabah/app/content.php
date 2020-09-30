<div class="container-fluid">

  <!-- Example DataTables Card-->
  <div class="card mb-3">
	<div class="card-header">
	  <i class="fa fa-table"></i> Data Penjualan</div>
	<div class="card-body">
	<p>
<a href="#"   class='btn btn-success btn-sm' id='new'><i class='fa fa-pencil-square-o'></i> Tambah</a>
<a href="#"  class="btn btn-warning btn-sm" id="refresh"><i class='fa fa-pencil-square-o'></i> Refresh</a>
</p>

	  <div class="table-responsive">

		<table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th>Name</th>
			  <th>Position</th>
			  <th>Office</th>
			  <th>Age</th>
			  <th>Start date</th>
			  <th>Salary</th>
			</tr>
		  </thead>
		  <tfoot>
			<tr>
			  <th>Name</th>
			  <th>Position</th>
			  <th>Office</th>
			  <th>Age</th>
			  <th>Start date</th>
			  <th>Salary</th>
			</tr>
		  </tfoot>
		</table>
	  </div>
	</div>
  </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
<script src="../assets/js/select2.min.js"></script>
<script src="../assets/js/shortcuts.js"></script>
<script>

shortcut.add("f1",function() {
$('#EditPost').modal('show');
});


	
      $('#selectSatuan').select2();
$(document).ready(function() {
    var table = $('#dataTable').DataTable( {
		
		select: true,
        "ajax": "data.txt",
		
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-success btn-sm' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button class='btn btn-danger btn-sm' id='delete'><i class='fa fa-trash-o'></i></button>"
        } ]
    } );
 
    $('#dataTable tbody').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert( data[0] +"'s salary is: "+ data[ 2 ] );
		
		 $(this).parents('tr').fadeOut(300);
		 //table.ajax.url( 'data.txt' ).load();
    } );
	
	    $('#dataTable tbody').on( 'click', '#edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
			$('#EditPost').modal('show');
			//$('#EditPostLabel').html(data[ 0 ]);
			$('#id_produk').val(data[ 0 ]);

    } );
	
			$( "#submit" ).click(function () {
			var id_produk = filename= document.getElementById("id_produk").value;;
			table.ajax.url( 'data.txt' ).load();
			//if (id_produk == '') {alert('ID Produk harus diisi'); }
			//alert('Data Berhasil Dimasukkan');
			//$('#EditPost').modal('hide');
			$('#ModalSukses').modal('show');
			setTimeout(function() { $('#ModalSukses').modal('hide'); }, 3000);
			

    } );
	$( "#pilihSatuan" ).click(function () {
			var id_produk = filename= document.getElementById("id_produk").value;;
			//if (id_produk == '') {alert('ID Produk harus diisi'); }
			//alert('Data Berhasil Dimasukkan');
			//$('#EditPost').modal('hide');
			$('#ModalSatuan').modal('show');
			

    } );
	
$( "#new" ).click(function () {
$('#ModalSatuan').modal('show');
} );

$( "#refresh" ).click(function () {
table.ajax.url( 'data.txt' ).load();
} );	
	
} );

</script>

<div class="modal fade" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="EditPostLabel">Edit Data</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">

<table class="table table-stripped table-hovered">
<tr><td style="width:150px">ID Produk</td><td style="width:10px">:</td><td><input id="id_produk"  class="form-control" >	</td></tr>
<tr><td>Nama Produk</td><td>:</td><td><input class="form-control" >	</td></tr>
<tr><td>Jumlah </td><td>:</td><td><input class="form-control" >	</td></tr>
<tr><td>Satuan</td><td>:</td><td>
<div class="form-group">
<div class="input-group">
<input style="width:400px" class="form-control" type="text"><span class="input-group-btn">
<button class="btn btn-default" type="button" id="pilihSatuan">Pilih</button></span>
</div>
</div>


</td></tr>
<tr><td>Harga</td><td>:</td><td><input class="form-control" >	</td></tr>
<tr><td>Diskon</td><td>:</td><td><input class="form-control" >	</td></tr>
</table>  

</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" href="#" id="submit">Submit</a>
</div>
</div>
</div>
</div>
