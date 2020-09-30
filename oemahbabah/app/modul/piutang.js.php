<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>
<script>
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


var ajaxData="data.php?tableFakturPiutang=faktur";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {
$("#totalPiutang").load("data.php?totalPiutang=faktur");
$("#formPiutang").hide();
//$('[data-toggle="tooltip"]').tooltip(); 
    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },
	    "createdRow": function( row, data, dataIndex ) {
        if ( data[4] == 0 ) {        
         $(row).css('color', 'red');
     
       } else
	   if ( data[5] == 0 ) {        
         $(row).css('color', 'black');
     
       }     

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
            piutang = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			piutang_dibayar = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			piutang_sisa = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 

 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+ formatNumber(piutang) +''
            );
            $( api.column( 4 ).footer() ).html(
                ''+ formatNumber(piutang_dibayar) +''
            );
            $( api.column( 5 ).footer() ).html(
                ''+ formatNumber(piutang_sisa) +''
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
        "ajax": ajaxData ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-default btn-xs' id='viewPenjualan'><i class='fa fa-gear' title='buka'></i></button>"
        } ]
    } );
	

	$('#dataTable tbody').on( 'click', '#viewPenjualan', function () {
	var data = table.row( $(this).parents('tr') ).data();


	$('#modalPenjualan').modal("show");
	var ajaxPenjualan="data.php?tablePiutang=kasir_penjualan&faktur="+data[2];
	$('#showTablePenjualan').load(ajaxPenjualan);	


} );
	
$( "#filter1" ).click(function () {
	var startDate=$('#startDate').val();
	var endDate = $('#endDate').val();
	var status=$('#status :selected').val();
	var getTitle = $(document).attr('title');
	var user_id=$('#user_id :selected').val();
	var pelanggan_id=$('#pelanggan_id :selected').val();

	document.title ='Piutang | <?php echo getPengaturan('nama_toko');?> ('+ startDate.replace("/","-").replace("/","-") +' - ' +endDate.replace("/","-").replace("/","-") +')';
	table.ajax.url( "data.php?filterPiutang=faktur&startDate="+startDate+"&endDate="+endDate+"&status=kredit"+"&user_id="+user_id+"&pelanggan_id="+pelanggan_id ).load();
	$("#totalPiutang").load("data.php?totalPiutangFilter=faktur&startDate="+startDate+"&endDate="+endDate+"&status=kredit"+"&user_id="+user_id+"&pelanggan_id="+pelanggan_id);
	//alert(status);
} );

	$( "#filter2" ).click(function () {
	var bulan=$('#bulan').val();
	var tahun = $('#tahun').val();
	table.ajax.url( "data.php?filterPiutang=faktur&bulan="+bulan+"&tahun="+tahun ).load();

} );
	$( "#refresh" ).click(function () {
	table.ajax.url( ajaxData ).load();

} );
	$( "#lunas" ).click(function () {
	table.ajax.url( ajaxData+"&lunas=1" ).load();

} );
	$( "#belum_lunas" ).click(function () {
	table.ajax.url( ajaxData+"&belum_lunas=1" ).load();

} );

	$( "#belum_dibayar" ).click(function () {
	table.ajax.url( ajaxData+"&belum_dibayar=1" ).load();

} );

	$( "#bayarPiutang" ).click(function () {
	var getFaktur=$('#getFaktur').val();
	$('#modalBayarPiutang').modal("show");
	$('#showFormPiutang').load("data.php?bayarPiutang=kasir_penjualan&faktur="+getFaktur);
	
} );
	$( "#inputPiutang" ).click(function () {
	var fakturPiutang=$('#fakturPiutang').val();
	var fakturPenjualan=$('#fakturPenjualan').val();
	var hutang=$('#hutang').val();
	var hutang_dibayar=$('#hutang_dibayar').val();
	var hutang_sisa=$('#hutang_sisa').val();
	var bayarTunai=$('#bayarTunai').val();
	var ajaxPenjualan="data.php?tablePiutang=kasir_penjualan&faktur="+fakturPenjualan;

	if(bayarTunai=='' || bayarTunai==null || bayarTunai==0){
		//alert("Masukkan Pembayaran!");
		swal("","Masukkan Pembayaran").then((value) => {
		$('#bayarTunai').focus();
		});
		return false;
	}else{

		$.get("data.php?inputPiutang=faktur&fakturPiutang="+fakturPiutang+"&fakturPenjualan="+fakturPenjualan+"&hutang="+hutang+"&hutang_sisa="+hutang_sisa+"&hutang_dibayar="+hutang_dibayar+"&bayarTunai="+bayarTunai,
		function(data){
		$('#showTablePenjualan').load(ajaxPenjualan);
		table.ajax.url( ajaxData ).load();
		$('#modalBayarPiutang').modal("hide");
		$("#totalPiutang").load("data.php?totalPiutang=faktur");
		});
	
	}
	
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
			$("#totalPiutang").load("data.php?totalPiutang=faktur");

			}
			);
  }
});

} );

} );


String.prototype.reverse = function () {
		return this.split("").reverse().join("");
	}

function reformatText(input) {
	var x = input.value;
	x = x.replace(/,/g, ""); // Strip out all commas
	x = x.reverse();
	x = x.replace(/.../g, function (e) {
		return e + ",";
	}); // Insert new commas
	x = x.reverse();
	x = x.replace(/^,/, ""); // Remove leading comma
	input.value = x;
}
function formatValue(input) {
	
var bayarTunai=$("#bayarTunai").val();
var hutang=$("#hutang").val();
var hutang_dibayar=$("#hutang_dibayar").val();
var hutang_sisa_hide=$("#hutang_sisa_hide").val();
var hutang_sisa=$("#hutang_sisa").val();

	var result = parseInt(hutang_sisa_hide) - parseInt(bayarTunai);
	//$( "#hitungTotal" ).load( "data.php?hitungTotal="+result+"&total="+num1+"&diskon="+diskon+"&voucher="+voucher+"&pajak="+pajak );

	if (!isNaN(result)) {
	document.getElementById('hutang_sisa').value = result;
	//$( "#subt2" ).load( "data.php?hitungKembali="+result+"&total="+num1+"&bayar="+num2+"&diskon="+diskon+"&voucher="+voucher+"&pajak="+pajak );
	}

}

</script>