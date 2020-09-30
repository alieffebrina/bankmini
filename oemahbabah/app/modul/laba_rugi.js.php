<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>
<script>
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

var ajaxData="data.php?tableLabaRugi=faktur";
shortcut.add("f1",function() {
$('#EditPost').modal('show');
});
//$.fn.dataTable.ext.errMode = 'throw';

$(document).ready(function() {

//$('[data-toggle="tooltip"]').tooltip(); 
$("#totalLabaRugi").load("data.php?totalLabaRugi=faktur");

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
			hpp = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			laba=pemasukan-hpp;
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
                ''+ formatNumber(hpp) +''
            );

            $( api.column( 6 ).footer() ).html(
		//  '$'+pageTotal +' ( $'+ total +' total)'
                'Laba Rugi : '+ formatNumber(laba) +''
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


    } );
	


$( "#filter1" ).click(function () {
var startDate=$('#startDate').val();
var endDate = $('#endDate').val();
var mode='penjualan';
var getTitle = $(document).attr('title');
document.title ='Laba Rugi | <?php echo getPengaturan('nama_toko');?> ( '+ startDate.replace("/","-").replace("/","-") +' - ' +endDate.replace("/","-").replace("/","-") +')';

	table.ajax.url( "data.php?filterLabaRugi=faktur&startDate="+startDate+"&endDate="+endDate+"&mode="+mode ).load();
	$("#totalLabaRugi").load("data.php?totalLabaRugiFilter=faktur&startDate="+startDate+"&endDate="+endDate);

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