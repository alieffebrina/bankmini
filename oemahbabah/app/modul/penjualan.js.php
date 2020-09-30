<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>
<style>
.red{
	background:red;
}
</style>
<script>
var ajaxData="data.php?tableFakturPenjualan=faktur";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {
		$("#totalPenjualan").load("data.php?totalPenjualan=faktur");

//$('[data-toggle="tooltip"]').tooltip(); 
    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "No data available in table"
    },
			        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            penjualan = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ formatNumber(penjualan) +''
            );

        },	
		dom: 'Bfrtip',			
		responsive: true,
		"paginate":true,
		"bFilter":true,
		"info":false,
		"bLengthChange": false,
        "ajax": ajaxData ,
		dom: 'Bfrtip',		
		responsive: true,
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
			],
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-default btn-xs' id='viewPenjualan'><i class='fa fa-gear'></i></button> <button  class='btn btn-default btn-xs' id='editPenjualan'><i class='fa fa-pencil'></i></button> <button style='display:none' class='btn btn-default btn-xs' id='hapusPenjualan'><i class='fa fa-trash'></i></button>"
        } ]
    } );
	

	$('#dataTable tbody').on( 'click', '#viewPenjualan', function () {
	var data = table.row( $(this).parents('tr') ).data();
	//alert(data[2]);
	
	var ajaxPenjualan="data.php?tablePenjualan=kasir_penjualan&faktur="+data[2];
	$('#modalPenjualan').modal("show");
	$('#showTablePenjualan').load(ajaxPenjualan);	

} );

	$('#dataTable tbody').on( 'click', '#editPenjualan', function () {
	var data = table.row( $(this).parents('tr') ).data();
	//alert(data[2]);
	$("#loadBody").load("load.php?mode=kasir_edit&faktur="+data[2]);
	} );

	$('#dataTable tbody').on( 'click', '#hapusPenjualan', function () {
	var data = table.row( $(this).parents('tr') ).data();
	var faktur=data[2];

	swal({
	  title: 'Hapus',
	  html: "Anda ingin menghapus data ini? <br> <strong>Faktur</strong>: "+faktur,
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
			$.get("data.php?hapusTransaksi=1&faktur="+faktur,
			function(data){
			table.ajax.url( ajaxData ).load();
			$('#modalPenjualan').modal("hide");
			$("#totalPenjualan").load("data.php?totalPenjualan=faktur");

			}
			);
  }
});
	
	} );
	
$( "#filter1" ).click(function () {
	var startDate=$('#startDate').val();
	var endDate = $('#endDate').val();
	var status=$('#status :selected').val();
	var user_id=$('#user_id :selected').val();
	var pelanggan_id=$('#pelanggan_id :selected').val();
	var lapak_id=$('#lapak_id :selected').val();
//	alert(lapak_id)
var getTitle = $(document).attr('title');
document.title ='Penjualan | <?php echo getPengaturan('nama_toko');?> ('+ startDate.replace("/","-").replace("/","-") +' - ' +endDate.replace("/","-").replace("/","-") +')';
	table.ajax.url( "data.php?filterPenjualan=faktur&startDate="+startDate+"&endDate="+endDate+"&status="+status+"&user_id="+user_id+"&pelanggan_id="+pelanggan_id+"&lapak_id="+lapak_id ).load();
	$("#totalPenjualan").load("data.php?totalPenjualanFilter=faktur&startDate="+startDate+"&endDate="+endDate+"&status="+status+"&user_id="+user_id+"&pelanggan_id="+pelanggan_id+"&lapak_id="+lapak_id);
	//alert(status);
} );
$( "#_editPenjualan" ).click(function () {
	var faktur=$('#faktur').val();
$('#modalPenjualan').modal("hide");

$("#loadBody").load("load.php?mode=kasir_edit&faktur="+faktur);
} );

$( "#hapusTransaksi" ).click(function () {
	var faktur=$('#faktur').val();

	swal({
	  title: 'Hapus',
	  html: "Anda ingin menghapus data ini? <br> <strong>Faktur</strong>: "+faktur,
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
			$.get("data.php?hapusTransaksi=1&faktur="+faktur,
			function(data){
			table.ajax.url( ajaxData ).load();
			$('#modalPenjualan').modal("hide");
			$("#totalPenjualan").load("data.php?totalPenjualan=faktur");

			}
			);
  }
});

} );
	$( "#refresh" ).click(function () {
	var bulan=$('#bulan').val();
	var tahun = $('#tahun').val();
	table.ajax.url( ajaxData ).load();

} );
	
} );

</script>