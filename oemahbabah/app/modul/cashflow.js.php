<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>
<script>
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

var ajaxData="data.php?tableCashflow=faktur";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {
$("#pemasukan").prop('disabled', true);	 
$("#pengeluaran").prop('disabled', true);	 
$("#mode_pemasukan").hide();	 
$("#mode_pengeluaran").hide();	 

    $('#tipe').change(function(){
        if($('#tipe').val() == 'pemasukan') {
			$("#pengeluaran").prop('disabled', true);	 
			$("#pengeluaran").val(''); 
			$("#pemasukan").prop('disabled', false);	 
			$("#pemasukan").focus();	
			$("#mode_pemasukan").show();	 
			$("#mode_pengeluaran").hide();	 
			$("#mode_pengeluaran").val('');	 

        } else {
			$("#pengeluaran").prop('disabled', false);	 
			$("#pemasukan").prop('disabled', true);	 
			$("#pengeluaran").focus();	 
			$("#pemasukan").val('');	 
			$("#mode_pengeluaran").show();	 
			$("#mode_pemasukan").hide();	 
			$("#mode_pemasukan").val('');	 
		} 
    });
	
//$('[data-toggle="tooltip"]').tooltip(); 
$("#totalCashflow").load("data.php?totalCashflow=faktur");

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
            pemasukan = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			pengeluaran = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );


			saldo=pemasukan-pengeluaran;
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+ formatNumber(pemasukan) +''
            );
            $( api.column( 5 ).footer() ).html(
		//  '$'+pageTotal +' ( $'+ total +' total)'
                ''+ formatNumber(pengeluaran) +''
            );
            $( api.column( 8 ).footer() ).html(
		//  '$'+pageTotal +' ( $'+ total +' total)'
                'Saldo : '+ formatNumber(saldo) +''
            );
        },
		dom: 'Bfrtip',			
		responsive: true,
		"paginate":true,
		"bFilter":true,
		"info":false,
		"bLengthChange": false,
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
			],
		select: true,		
		"bLengthChange": false,
		"bServerSide": false,
		"bProcessing": false,
        "sAjaxSource": ajaxData ,				
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  class='btn btn-default btn-xs' id='edit' style='display:none'><i class='fa fa-pencil-square-o'></i></button> <button class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button>"
        },
		{
		"targets": [ 6,7 ],
		"visible": false,
		"searchable": false
		}
		]

    } );
	
	$('#dataTable tbody').on( 'click', '#delete', function () {
	var data = table.row( $(this).parents('tr') ).data();


	swal({
	  title: 'Hapus',
	  html: "Anda ingin menghapus data ini? <br> <strong>Faktur</strong>: "+data[ 2 ],
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
			$.get("data.php?deleteCashflow="+data[ 0 ]+"&Cashfaktur="+data[ 2 ],
			function(data){
			table.ajax.url( ajaxData ).load();
			$("#totalCashflow").load("data.php?totalCashflow=faktur");

			}
			);
  }
})
	
		 //table.ajax.url( 'data.txt' ).load();
    } );
	
	
	$('#dataTable tbody').on( 'click', '#viewTransaksiCashflow', function () {
	var data = table.row( $(this).parents('tr') ).data();
	//alert(data[2]);
	
	var ajaxPenjualan="data.php?tableCashflowDetail=faktur&faktur="+data[2]+"&pemasukan="+data[3]+"&pengeluaran="+data[4];
	$('#modalCashflow').modal("show");
	$('#showCashflowDetail').load(ajaxPenjualan);
	

	

} );

$( "#new" ).click(function () {
$("#pemasukan").prop('disabled', true);	 
$("#pengeluaran").prop('disabled', true);	 
$("#mode_pemasukan").hide();	 
$("#mode_pengeluaran").hide();	
$('#editKas').modal("show");
$('#loadFaktur').load('data.php?loadFaktur=faktur&type=KAS');
$("#tipe").val('');	 
$("#pemasukan").val('');	 
$("#pengeluaran").val('');	 
$("#keterangan").val('');	 


});

$( "#inputCashflow" ).click(function () {
	var date=$('#date').val();
	var faktur=$('#faktur').val();
	var tipe=$('#tipe').val();
	var jenis_pemasukan=$('#jenis_pemasukan').val();
	var jenis_pengeluaran=$('#jenis_pengeluaran').val();
	var pemasukan=$('#pemasukan').val();
	var pengeluaran=$('#pengeluaran').val();
	var keterangan=$('#keterangan').val();

	
	$.get("data.php?inputCashflow=faktur&date="+date+"&faktur="+faktur+"&tipe="+tipe+"&jenis_pemasukan="+jenis_pemasukan+"&jenis_pengeluaran="+jenis_pengeluaran+"&pemasukan="+pemasukan+"&pengeluaran="+pengeluaran+"&keterangan="+keterangan,
	function(data){
		table.ajax.url( ajaxData ).load();
		$('#loadFaktur').load('data.php?loadFaktur=faktur&type=KAS');
		$("#totalCashflow").load("data.php?totalCashflow=faktur");

		$('#editKas').modal("hide");
		}
		);

});


$( "#filter1" ).click(function () {
var startDate=$('#startDate').val();
var endDate = $('#endDate').val();
var mode=$('#mode :selected').val();
var getTitle = $(document).attr('title');
document.title ='Cashflow | <?php echo getPengaturan('nama_toko');?> ( '+ startDate.replace("/","-").replace("/","-") +' - ' +endDate.replace("/","-").replace("/","-") +')';

	table.ajax.url( "data.php?filterCashflow=faktur&startDate="+startDate+"&endDate="+endDate+"&mode="+mode ).load();
	$("#totalCashflow").load("data.php?totalCashflowFilter=faktur&startDate="+startDate+"&endDate="+endDate);

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
</script>