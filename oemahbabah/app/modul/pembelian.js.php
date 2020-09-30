<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>

<script>
var ajaxBarang="data.php?beliBarang=daftar_barang";
var ajaxPembelian="data.php?tablePembelian=kasir_pembelian";
var ajaxSupplier="data.php?tableSupplier=supplier";
var ajaxData="data.php?tableFakturPembelian=faktur";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {
//$('[data-toggle="tooltip"]').tooltip(); 
 $("#showTempo").hide();
var faktur = $('#faktur').val();
$('#loadFaktur').load("data.php?loadFaktur=1&type=PB");
$('#loadDate').load("data.php?loadDate=1");
$("#totalPembelian").load("data.php?totalPembelian=faktur");


$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );
	
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
	var tableSupplier = $('#tableSupplier').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },

		keys: true,
		"pageLength": 6,
		"lengthMenu": [ 5,10, 25, 50 ],
		"paginate":true,
		"bLengthChange": false,
		"info":false,
		"length":false,
        "ajax": ajaxSupplier ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<a href='#' class='btn btn-warning btn-sm' id='addSupplier'><i class='fa fa-check-square-o'></i> pilih</a>"
        },
		{
		"targets": [ 0,3 ],
		"visible": false,
		"searchable": false
		} ]
    } );

	$('#tableBarang tbody').on( 'click', '#addBarang', function () {
	var data = tableBarang.row( $(this).parents('tr') ).data();
		$('#idBarang').val(data[ 0 ]);
		$('#kodeBarang').val(data[ 1 ]);
		$('#namaBarang').val(data[ 2 ]);
		$('#hargaJual').val(data[ 3 ]);
		$('#doBarang').modal('hide');
		$('#addCart').focus();
		
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
            pembelian = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ formatNumber(pembelian) +''
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
            "defaultContent": "<button  class='btn btn-default btn-xs' id='viewPembelian'><i class='fa fa-gear'></i></button>"
        } ]
    } );
	
    var tablePembelian = $('#tablePembelian').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },
		scrollY:'35vh',
		"scrollX": true,
		"pageLength": 5000,
		"paginate":false,
		"bFilter":false,
		"info":false,
		"bLengthChange": false,
        "ajax": ajaxPembelian ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-default btn-xs' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button>"
			},
		{
		"targets": [4 ],
		"render": function ( data, type, row ) {
                    return '<button id="minus" class="btn btn-xs btn-default"><i class="fa fa-minus"></i></button><span style="width:30px;padding:5px"> ' + data +' </span><button id="plus" class="btn btn-xs btn-default"><i class="fa fa-plus"></i></button>';
                },
		},
		{
		"targets": [ 0 ],
		"visible": false,
		"searchable": false
		} ]
    } );

	$('#tablePembelian tbody').on( 'click', '#edit', function () {
	var data = tablePembelian.row( $(this).parents('tr') ).data();
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

	$('#tablePembelian tbody').on( 'click', '#plus', function () {
	var data = tablePembelian.row( $(this).parents('tr') ).data();
	$.get("data.php?plusCart="+data[4]+'&id='+data[0]+'&harga='+data[3]+"&modeCart=kasir_pembelian",
	function(data){
		tablePembelian.ajax.url( ajaxPembelian ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );
		}
		);

} );
	$('#tablePembelian tbody').on( 'click', '#minus', function () {
	var data = tablePembelian.row( $(this).parents('tr') ).data();
if(data[4]<=1){
	swal("","Jumlah barang minimum").then((value) => {
	});
	return false;
}

	$.get("data.php?minusCart="+data[4]+'&id='+data[0]+'&harga='+data[3]+"&modeCart=kasir_pembelian",
	function(data){
		tablePembelian.ajax.url( ajaxPembelian ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );

		}
		);


} );

$( "#SaveCart" ).click(function () {
var id = $('#idCart').val();
var qty = $('#qtyCart').val();
var harga = $('#hargaCart').val();
//alert(harga);

$.get("data.php?updateCart=kasir_pembelian&id="+id+"&qty="+qty+"&harga="+harga,
function(data){
	tablePembelian.ajax.url( ajaxPembelian ).load();
	$('#EditCart').modal('hide');
	$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );
}
);		
} );

    $('#tablePembelian tbody').on( 'click', '#delete', function () {
	var data = tablePembelian.row( $(this).parents('tr') ).data();
	$.get("data.php?delCart="+data[ 0 ]+"&tableCart=kasir_pembelian",
	function(data){
	tablePembelian.ajax.url( ajaxPembelian ).load();
	$(this).parents('tr').fadeOut(300);
	$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );
	}
	);
    } );
	
	$('#dataTable tbody').on( 'click', '#viewPembelian', function () {
	var data = table.row( $(this).parents('tr') ).data();
	//alert(data[2]);	
	var ajaxPembelian="data.php?dataPembelian=kasir_pembelian&faktur="+data[2];
	$('#modalPembelian').modal("show");
	$('#showTablePembelian').load(ajaxPembelian);

	} );

$( "#filter1" ).click(function () {
	var startDate=$('#startDate').val();
	var endDate = $('#endDate').val();
	var status=$('#status :selected').val();
var getTitle = $(document).attr('title');
document.title ='Pembelian | <?php echo getPengaturan('nama_toko');?> ('+ startDate.replace("/","-").replace("/","-") +' - ' +endDate.replace("/","-").replace("/","-") +')';
	table.ajax.url( "data.php?filterPembelian=faktur&startDate="+startDate+"&endDate="+endDate+"&status="+status ).load();
	$("#totalPembelian").load("data.php?totalPembelianFilter=faktur&startDate="+startDate+"&endDate="+endDate+"&status="+status);
	//alert(status);
} );

	$( "#filter2" ).click(function () {
	var bulan=$('#bulan').val();
	var tahun = $('#tahun').val();
	table.ajax.url( "data.php?filterPembelian=faktur&bulan="+bulan+"&tahun="+tahun ).load();

} );
	$( "#refresh" ).click(function () {
	var bulan=$('#bulan').val();
	var tahun = $('#tahun').val();
	table.ajax.url( ajaxData ).load();

} );
$( "#hapusTransaksi" ).click(function () {
	var faktur=$('#fakturBeli').val();

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
			$('#modalPembelian').modal("hide");
			$("#totalPembelian").load("data.php?totalPembelian=faktur");

			}
			);
  }
});
});
	$( "#new" ).click(function () {
	$('#modalPengadaanStok').modal('show');
		$('#idBarang').val('');
		$('#kodeBarang').val('');
		$('#namaBarang').val('');
		$('#hargaJual').val('');
		$('#faktur').val('');
		$('#qty').val(1);
		$('#idSupplier').val('');
		$('#loadFaktur').load("data.php?loadFaktur=1&type=PB");
		$('#loadDate').load("data.php?loadDate=1");
		$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );
		$('#tempo').val('');
		$('#namaSupplier').val('');
		tablePembelian.ajax.url( ajaxPembelian ).load();

} );

	
	$( "#showBarang" ).click(function () {
	$('#doBarang').modal('show');
	tableBarang.ajax.url( ajaxBarang ).load();
} );

	$( "#showSupplier" ).click(function () {
	$('#doSupplier').modal('show');
	tableSupplier.ajax.url( ajaxSupplier ).load();
} );

	$('#tableSupplier tbody').on( 'click', '#addSupplier', function () {
	var data = tableSupplier.row( $(this).parents('tr') ).data();
		$('#idSupplier').val(data[ 0 ]);
		$('#namaSupplier').val(data[ 1 ]);
		$('#doSupplier').modal('hide');
	} );
	

$( "#addCart" ).click(function () {
var id_barang = $('#idBarang').val();
var kode_barang = $('#kodeBarang').val();
var nama_barang = $('#namaBarang').val();
var harga = $('#hargaJual').val();
var faktur = $('#faktur').val();
var qty = $('#qty').val();
var user_id = $('#user_id').val();
//alert(id_barang+"|"+kode_barang+"|"+nama_barang+"|"+harga+"|"+faktur+"|"+qty);

if(kode_barang=='' || kode_barang==0){
	swal("","Tambahkan Kode Barang").then((value) => {
		$('#kodeBarang').focus();
	});
	return false;
}

	
$.get("data.php?addCartBeli=kasir_pembelian&id_barang="+id_barang+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&harga="+harga+"&qty="+qty+"&faktur="+faktur+"&user_id="+user_id,
function(data){
	tablePembelian.ajax.url( ajaxPembelian ).load();
	$( "#totalSum" ).load( "data.php?totalSum=kasir_pembelian" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_pembelian" );
	$('#idBarang').val('');
	$('#kodeBarang').val('');
	$('#namaBarang').val('');
	$('#hargaJual').val('');
	$('#qty').val(1);
}
);			
} );

$( "#inputBayar" ).click(function () {
var faktur = $('#faktur').val();
var date = $('#date').val();
var total = $('#totalBayar').val();
var metode = $('input[name=metode]:checked', '#formKasir').val();
var tempo = $('#tempo').val();
var supplier_id = $('#idSupplier').val();
var user_id = $('#user_id').val();

if(supplier_id=='' || supplier_id==null || supplier_id==0){
swal("","Pilih Nama Supplier").then((value) => {
	$('#namaSupplier').focus();
});

return false;
}

		
if(metode=='tunai'){
$.get("data.php?inputPembelian=bayar&faktur="+faktur+"&supplier_id="+supplier_id+"&date="+date+"&total="+total+"&metode="+metode+"&tempo="+tempo+"&user_id="+user_id,
function(data){

	table.ajax.url( ajaxData ).load();
	$('#modalPengadaanStok').modal('hide');
	$("#totalPembelian").load("data.php?totalPembelian=faktur");
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
}else if(metode=='kredit'){
if(tempo=='' || tempo==null || tempo==0){
		
		$('#tempo').focus()
		return false;
	}
	$.get("data.php?inputPembelian=bayar&faktur="+faktur+"&supplier_id="+supplier_id+"&date="+date+"&total="+total+"&metode="+metode+"&tempo="+tempo+"&user_id="+user_id,
	function(data){
		table.ajax.url( ajaxData ).load();
		$('#modalPengadaanStok').modal('hide');
	$("#totalPembelian").load("data.php?totalPembelian=faktur");
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
	
}


} );

$( "#insertSupplier" ).click(function () {
var nama_supplier = $('#nama_supplier').val();
var alamat = $('#alamat').val();
var kota = "";
var no_hp = $('#no_hp').val();
var email ="";
var website = "";
var rekening = "";

if(nama_supplier=='' || nama_supplier==null || nama_supplier==0){
swal("","Masukkan Nama Supplier").then((value) => {
	$('#nama_supplier').focus();
});

return false;
}
	
	
$.get("data.php?inputSupplier=supplier&nama_supplier="+nama_supplier+"&alamat="+alamat+"&kota="+kota+"&no_hp="+no_hp+"&email="+email+"&website="+website+"&rekening="+rekening,
function(data){
tableSupplier.ajax.url( ajaxSupplier ).load();

}
);
	
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