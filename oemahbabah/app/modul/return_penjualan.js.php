<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>

<script>
var ajaxFakturBarang="data.php?tableFakturBarangJual=kasir_penjualan";
var ajaxRtnPenjualan="data.php?tableRtnPenjualan=return_penjualan";
var ajaxSupplier="data.php?tableSupplier=supplier";
var ajaxData="data.php?fakturRtnPenjualan=return_barang";
var ajaxFakturPenjualan="data.php?tableFakturPenjualan=faktur";


$(document).ready(function() {
//$('[data-toggle="tooltip"]').tooltip(); 
 $("#showTempo").hide();
var faktur = $('#faktur').val();
$('#loadFaktur').load("data.php?loadFaktur=1&type=PB");
$('#loadDate').load("data.php?loadDate=1");
$("#totalRtnPenjualan").load("data.php?totalRtnPenjualan=faktur");


$( "#totalSum" ).load( "data.php?totalSum=return_penjualan" );
$( "#totalSumBayar" ).load( "data.php?totalSumBayar=return_penjualan" );


	var tableFakturPenjualan = $('#tableFakturPenjualan').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    }, 
		select: true,
		keys: true,
		"pageLength": 5,
		"lengthMenu": [ 5,10, 25, 50 ],
		"bFilter":true,
		"paginate":true,
		"bLengthChange": false,
		"info":false,
		"length":false,
        "ajax": ajaxFakturPenjualan ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<a href='#' class='btn btn-warning btn-sm' id='addFakturBarang' title='pilih faktur'><i class='fa fa-check-square-o'></i> pilih</a>"
        } ]
    } );

	$('#tableFakturPenjualan tbody').on( 'click', '#addFakturBarang', function () {
	var data = tableFakturPenjualan.row( $(this).parents('tr') ).data();
	tableFakturBarang.ajax.url( "data.php?tableFakturBarangJual=kasir_penjualan&fakturPenjualan="+data[2] ).load();
	
	$('#fakturPenjualan').val(data[2]);
	$('#doFaktur').modal('hide');
} );

	var tableFakturBarang = $('#tableFakturBarang').DataTable( {
    "language": {
      "emptyTable": "<span style='background:#F6F677;width:100%;height:30px;padding:5px'>&lt;  No data available in table &gt;</span>"
    }, 
		select: true,
		keys: true,
		"pageLength": 500,
		"lengthMenu": [ 5,10, 25, 50 ],
		"bFilter":false,
		"paginate":false,
		"bLengthChange": false,
		"info":false,
		"length":false,
        "ajax": ajaxFakturBarang ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [		
		{
			"targets": [ -1 ],    
			"data": null,
			"render": function ( data, type, row ) {
				if(data[6]==0){
					btn_pilih="<button href='#' class='btn btn-default btn-sm' id='addBarang' disabled><i class='fa fa-check-square-o'></i> pilih</button>";
				}else{
					btn_pilih="<button href='#' class='btn btn-warning btn-sm' id='addBarang'><i class='fa fa-check-square-o'></i> pilih</button>";
				}
			return btn_pilih;
			},
		},
		{
		"targets": [ 0 ,1,2],
		"visible": false,
		"searchable": false
		} ]
    } );


	$('#tableFakturBarang tbody').on( 'click', '#addBarang', function () {
	var data = tableFakturBarang.row( $(this).parents('tr') ).data();
		$('#idPenjualan').val(data[ 0 ]);
		$('#kodeBarang').val(data[ 3 ]);
		$('#namaBarang').val(data[ 4 ]);
		$('#qtyBarang').val(data[ 6 ]);
		$('#doBarang').modal('hide');
		$('#qty').focus();
		$('#qty').select();

		
	} );
	
    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },
		select: true,
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
            RtnPenjualan = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+ formatNumber(RtnPenjualan) +''
            );

        },
		select: true,
		dom: 'Bfrtip',		
		scrollY: '50vh',
		scrollCollapse: true,
		select: true,		
		responsive: true,
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
			],
		"paginate":true,
		"bFilter":true,
		"info":false,
		"bLengthChange": false,
        "ajax": ajaxData ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-default btn-xs' id='viewPenjualan'><i class='fa fa-gear'></i></button>"
        } ]
    } );
	
    var tableRtnPenjualan = $('#tableRtnPenjualan').DataTable( {
    "language": {
      "emptyTable": "<span style='background:#F6F677;width:100%;height:30px;padding:5px'>&lt;  No data available in table &gt;</span>"
    },

		"pageLength": 5000,
		"paginate":false,
		"bFilter":false,
		"info":false,
		"bLengthChange": false,
        "ajax": ajaxRtnPenjualan ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button>"
			},
		{
		"targets": [ 0 ],
		"visible": false,
		"searchable": false
		} ]
    } );

	$('#tablePenjualan tbody').on( 'click', '#edit', function () {
	var data = tablePenjualan.row( $(this).parents('tr') ).data();
		$('#EditCart').modal('show');
		//$('#EditPostLabel').html(data[ 0 ]);
		$('#idCart').val(data[ 0 ]);
		$('#kode_barang').val(data[ 1 ]);
		$('#nama_barang').val(data[ 2 ]);
		$('#hargaCart').val(data[ 3 ]);
		$('#qtyCart').val(data[ 4 ]);
		$('#subTotal').val(data[ 5 ]);
		$('#stokCart').load( "data.php?stokCart="+data[7] );

} );




$( "#SaveCart" ).click(function () {
var id = $('#idCart').val();
var qty = $('#qtyCart').val();
var harga = $('#hargaCart').val();
//alert(harga);

$.get("data.php?updateCart=kasir_penjualan&id="+id+"&qty="+qty+"&harga="+harga,
function(data){
	tablePenjualan.ajax.url( ajaxPenjualan ).load();
	$('#EditCart').modal('hide');
	$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan" );
}
);		
} );

    $('#tableRtnPenjualan tbody').on( 'click', '#delete', function () {
	var data = tableRtnPenjualan.row( $(this).parents('tr') ).data();
	$.get("data.php?delCart="+data[ 0 ]+"&tableCart=return_penjualan",
	function(data){
	tableRtnPenjualan.ajax.url( ajaxRtnPenjualan ).load();
	$(this).parents('tr').fadeOut(300);
	$( "#totalSum" ).load( "data.php?totalSum=return_penjualan" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=return_penjualan" );
	}
	);
    } );
	
	$('#dataTable tbody').on( 'click', '#viewPenjualan', function () {
	var data = table.row( $(this).parents('tr') ).data();
	//alert(data[2]);	
	var ajaxPenjualan="data.php?dataRtnPenjualan=return_penjualan&faktur="+data[2];
	$('#modalRtnPenjualan').modal("show");
	$('#showTableRtnPenjualan').load(ajaxPenjualan);

	} );

$( "#filter1" ).click(function () {
	var startDate=$('#startDate').val();
	var endDate = $('#endDate').val();
var getTitle = $(document).attr('title');
document.title ='Return Penjualan | <?php echo getPengaturan('nama_toko');?> ('+ startDate.replace("/","-").replace("/","-") +' - ' +endDate.replace("/","-").replace("/","-") +')';
	table.ajax.url( "data.php?filterRtnPenjualan=return_barang&startDate="+startDate+"&endDate="+endDate ).load();
	$("#totalRtnPenjualan").load("data.php?totalRtnPenjualanFilter=return&startDate="+startDate+"&endDate="+endDate);
	//alert(status);
} );


	$( "#refresh" ).click(function () {
	var bulan=$('#bulan').val();
	var tahun = $('#tahun').val();
	table.ajax.url( ajaxData ).load();

} );

	$( "#new" ).click(function () {
	$('#modalReturnJual').modal('show');
		$('#idBarang').val('');
		$('#kodeBarang').val('');
		$('#namaBarang').val('');
		$('#hargaJual').val('');
		$('#fakturPenjualan').val('');
		$('#fakturPenjualan').focus();
		$('#qty').val(1);
		$('#idSupplier').val('');
		$('#loadFaktur').load("data.php?loadFaktur=1&type=RJ");
		$('#loadDate').load("data.php?loadDate=1");
		$( "#totalSum" ).load( "data.php?totalSum=return_penjualan" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=return_penjualan" );
		tableFakturBarang.ajax.url( ajaxFakturBarang ).load();

} );

	
	$( "#showFaktur" ).click(function () {
	$('#doFaktur').modal('show');
	tableFakturPenjualan.ajax.url( ajaxFakturPenjualan ).load();
} );



$( "#addCart" ).click(function () {
var id_barang = $('#idBarang').val();
var kode_barang = $('#kodeBarang').val();
var nama_barang = $('#namaBarang').val();
var qtyBarang = $('#qtyBarang').val();
var harga = $('#hargaJual').val();
var faktur = $('#faktur').val();
var qty = $('#qty').val();
var user_id = $('#user_id').val();

if(kode_barang=='' || kode_barang==0){
	swal("","Tambahkan Kode Barang").then((value) => {
		$('#kodeBarang').focus();
	});
	return false;
}	

if(qty=='' || qty<1){
swal("","Jumlah barang minimal 1").then((value) => {
		$('#qty').val('1');
		$('#qty').focus();
	});
	return false;
}	
if(qty>qtyBarang){
swal("","Jumlah barang terlalu banyak (max "+qtyBarang+")").then((value) => {
		$('#qty').focus();
	});
	return false;
}	
$.get("data.php?addCartRtnJual=return_penjualan&id_barang="+id_barang+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&harga="+harga+"&qty="+qty+"&faktur="+faktur+"&user_id="+user_id,
function(data){
	tableRtnPenjualan.ajax.url( ajaxRtnPenjualan ).load();
	$( "#totalSum" ).load( "data.php?totalSum=return_penjualan" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=return_penjualan" );
	$('#idBarang').val('');
	$('#kodeBarang').val('');
	$('#namaBarang').val('');
	$('#hargaJual').val('');
	$('#qty').val(1);
}
);			
} );

$( "#inputRtnPenjualan" ).click(function () {
var faktur = $('#faktur').val();
var fakturPenjualan = $('#fakturPenjualan').val();
var date = $('#date').val();
var user_id = $('#user_id').val();
var total = $('#totalBayar').val();
		
$.get("data.php?inputRtnPenjualan=bayar&faktur="+faktur+"&fakturPenjualan="+fakturPenjualan+"&date="+date+"&total="+total+"&metode=tunai&user_id="+user_id,
function(data){
	table.ajax.url( ajaxData ).load();
	tableRtnPenjualan.ajax.url( ajaxRtnPenjualan).load();
$("#totalRtnPenjualan").load("data.php?totalRtnPenjualan=faktur");

	$('#modalReturnJual').modal('hide');
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


$( "#hapusTransaksi" ).click(function () {
	var faktur=$('#fakturRtnJual').val();

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
			$('#modalRtnPenjualan').modal("hide");
			$("#totalRtnPenjualan").load("data.php?totalRtnPenjualan=faktur");

			}
			);
  }
});

} );
} );
$('#formKasir input').on('change', function() {
	var metode=$('input[name=metode]:checked', '#formKasir').val();
   //alert($('input[name=metode]:checked', '#formKasir').val()); 
   if(metode == 'kredit'){
	   $("#showTempo").show();
		$("#num2").prop('disabled', true);	   
   }else{
	    $("#showTempo").hide();
		$('#tempo').val('');
		$("#num2").prop('disabled', false);	   

   }   
   
});

</script>