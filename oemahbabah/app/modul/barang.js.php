<?php 
$username=$_SESSION['user'];
$userlevel=userLevel($username);
?>
<style>
.bgColor label{
font-weight: bold;
color: #A0A0A0;
}
#targetLayer{
float:left;
width:150px;
height:150px;
text-align:center;
line-height:150px;
font-weight: bold;
color: #C0C0C0;
background-color: #F0E8E0;
border-radius: 4px;
}
#uploadFormLayer{
padding-top:5px
}
.btnSubmit {
	background-color: #696969;
    padding: 5px 30px;
    border: #696969 1px solid;
    border-radius: 4px;
    color: #FFFFFF;
    margin-top: 10px;
}

.image-preview {	
width:150px;
height:150px;
border-radius: 4px;
}
table.dataTable.select tbody tr,
table.dataTable thead th:first-child {
  cursor: pointer;
}
</style>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>
<script>
var ajaxData="data.php?tableBarang=daftar_barang";
var ajaxSatuan="data.php?tableSatuan=satuan";
var ajaxKategori="data.php?tableKategori=kategori_barang";
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
//$('#selectSatuan').hide();
//$('#selectKategori').hide();
//$('[data-toggle="tooltip"]').tooltip(); 
$('#loadUploader').load('data.php?imgUpload=img&imgID=');
    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "No data available in table"
    },
		  "rowCallback": function(row, data, dataIndex){

      },
	  
		scrollY: '46vh',
		scrollX: true,
		scrollCollapse: true,
		select: true,		
		responsive: true,
		 "ordering": true,
//		bSort: false,
/* 		dom: 'Bfrtip',		

       buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		*/
		"pageLength": 20,
		"paginate":true,
		"filter":true,
		"info":true,
		"length":false,
        "ajax": ajaxData ,
		"bLengthChange": false,
		"order": [[ 14, "desc" ]],
        "columnDefs": [ {
            "targets": 0,
            "data": null,
            "defaultContent": "<div style='width:60px'><button  <?php displayAkses('barang_edit',$userlevel);?> class='btn btn-default btn-xs' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button <?php displayAkses('barang_hapus',$userlevel);?> class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o'></i></button></div>"
        } ,
		{
		"targets": [ 10,11,12],
		"visible": false,
		"searchable": false
		}],

    } );
 

 var tableSatuan = $('#tableSatuan').DataTable( {
    "language": {
      "emptyTable": "No data available in table"
    },
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: false,
		"bSort" : false,
		"pageLength": 1000,
		"lengthMenu": [ 1000,2000 ],
		"paginate":false,
		"bFilter":true,
		"info":false,
		"bLengthChange": false,
        "ajax": ajaxSatuan ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='pull-right' style='width:50px'><button class='btn btn-success btn-xs ' id='addSatuan' title='pilih'><i class='fa fa-check-square-o'></i></button> <button class='btn btn-danger btn-xs ' id='deleteSatuan'><i class='fa fa-trash-o'></i></button></div>"
        },
		{
		"targets": [ 0 ],
		"visible": false,
		"searchable": false
		}
		]
    } );

	var tableKategori = $('#tableKategori').DataTable( {
    "language": {
      "emptyTable": "No data available in table"
    },
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: false,
		"bSort" : false,
		"pageLength": 1000,
		"lengthMenu": [ 1000,2000 ],
		"paginate":false,
		"bFilter":true,
		"info":false,
		"bLengthChange": false,
        "ajax": ajaxKategori ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='pull-right' style='width:50px'><button class='btn btn-success btn-xs ' id='addKategori' title='pilih'><i class='fa fa-check-square-o'></i> </button> <button class='btn btn-danger btn-xs ' id='deleteKategori'><i class='fa fa-trash-o'></i> </button></div>"
        },
		{
		"targets": [ 0 ],
		"visible": false,
		"searchable": false
		}
		]
    } );
	
 
    $('#tableSatuan tbody').on( 'click', '#addSatuan', function () {
        var data = tableSatuan.row( $(this).parents('tr') ).data();
		$('#satuan').val(data[ 1 ]);
		$('#EditSatuan').modal('hide');
	} );
	
    $('#tableKategori tbody').on( 'click', '#addKategori', function () {
        var data = tableKategori.row( $(this).parents('tr') ).data();
		$('#kategori_barang').val(data[1]);
		$('#EditKategori').modal('hide');
	} );
	
    $('#tableSatuan tbody').on( 'click', '#deleteSatuan', function () {
        var data = tableSatuan.row( $(this).parents('tr') ).data();
			$.get("data.php?deleteSatuan="+data[ 0 ],
			function(data){
			tableSatuan.ajax.url( ajaxSatuan ).load();
			 $(this).parents('tr').fadeOut(300);
			$( "#selectSatuan" ).load( "data.php?satuanBarang=satuan" );
			});
	} );
	
    $('#tableKategori tbody').on( 'click', '#deleteKategori', function () {
        var data = tableKategori.row( $(this).parents('tr') ).data();
			$.get("data.php?deleteKategori="+data[ 0 ],
			function(data){
			tableKategori.ajax.url( ajaxKategori ).load();
			 $(this).parents('tr').fadeOut(300);
			$( "#selectKategori" ).load( "data.php?kategoriBarang=kategori" );

			});
	} );
	
	$('#dataTable tbody').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tr') ).data();


	swal({
	  title: 'Hapus',
	  html: "Anda ingin menghapus data ini? <br> <strong>Nama Produk </strong>: "+data[ 2 ],
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
			$.get("data.php?deleteBarang="+data[ 0 ],
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
		$('#id_barang').val(data[ 0 ]);
		$('#kode_barang').val(data[ 1 ]);
		$('#imgID').val(data[ 1 ]);
		$('#nama_barang').val(data[ 2 ]);
		//$('#satuan option[value='+ data[ 7 ] +']').attr('selected','selected');
		//$('#kategori_barang').val(data[ 8 ]);
		//$('#satuan').val(data[ 7 ]);
		//$('#satuan2').val(data[ 7 ]);
		$('#harga_beli').val(data[ 3 ]);
		$('#harga_jual').val(data[ 4 ]);
		$('#stok').val(data[ 5 ]);
		$('#lokasi').val(data[ 9 ]);
		$('#warna').val(data[ 10 ]);
		$('#ukuran').val(data[ 11 ]);
		$('#merek').val(data[ 12 ]);
		$('#expired').val(data[ 13 ]);
		$('#stok_minimal').val(data[ 15 ]);
		$('#reset').hide();
		$('#SaveEdit').show();
		$('#SaveInput').hide();
		$( "#selectSatuan" ).load( "data.php?satuanBarang=satuan&satuan="+data[ 7 ] );
		$( "#selectKategori" ).load( "data.php?kategoriBarang=kategori&kategori="+data[ 8 ] );
		$('#loadUploader').load('data.php?imgUpload=img&imgID='+data[ 1 ]);

    } );
	
	$( "#pilihKategori" ).click(function () {
			//$('#selectKategori').toggle();
			$('#EditKategori').modal("show");
    } );
	$( "#pilihSatuan" ).click(function () {
			//$('#selectSatuan').toggle();
		$('#EditSatuan').modal("show");

    } );
	
$( "#category" ).click(function () {
var category = $(this).val();

} );

$( "#new" ).click(function () {
	//$('#selectKategori').hide();
	//$('#selectSatuan').hide();
	$('#SaveEdit').hide();
	$('#reset').show();
	$('#SaveInput').show();
	$('#EditPost').modal('show');
	$('#id_barang').val('');
	$('#kode_barang').val('');
	$('#nama_barang').val('');
	$('#kategori_barang').val('');
	$('#satuan').val('');
	$('#harga_beli').val('');
	$('#harga_jual').val('');
	$('#ukuran').val('');
	$('#warna').val('');
	$('#merek').val('');
	$('#lokasi').val('');
	$('#stok_minimal').val('');
	$('#stok').val('');
	$('#expired').val('');
	$( "#selectSatuan" ).load( "data.php?satuanBarang=satuan" );
	$( "#selectKategori" ).load( "data.php?kategoriBarang=kategori" );
	$('#loadUploader').load('data.php?imgUpload=img&imgID=0');

} );

$( "#reset" ).click(function () {

	$('#id_barang').val('');
	$('#kode_barang').val('');
	$('#nama_barang').val('');
	$('#kategori_barang').val('');
	$('#satuan').val('');
	$('#harga_beli').val('');
	$('#harga_jual').val('');
	$('#ukuran').val('');
	$('#warna').val('');
	$('#merek').val('');
	$('#lokasi').val('');
	$('#stok').val('');
	$('#stok_minimal').val('');
	$('#expired').val('');
	$( "#selectSatuan" ).load( "data.php?satuanBarang=satuan" );
	$( "#selectKategori" ).load( "data.php?kategoriBarang=kategori" );
	$('#loadUploader').load('data.php?imgUpload=img&imgID=0');

} );

$( "#SaveInput" ).click(function () {
var kode_barang = $('#kode_barang').val();
var nama_barang = $('#nama_barang').val();
var kategori_barang = $('#kategori_barang').val();
var satuan = $('#satuan').val();
var harga_beli = $('#harga_beli').val();
var harga_jual = $('#harga_jual').val();
var stok = $('#stok').val();
var lokasi = $('#lokasi').val();
var warna = $('#warna').val();
var ukuran = $('#ukuran').val();
var merek = $('#merek').val();
var expired = $('#expired').val();
var stok_minimal = $('#stok_minimal').val();

if(kode_barang==''){
	swal("","Kode Barang masih kosong!").then((value) => {
		$('#kode_barang').focus();
	});
	return false;
}
if(nama_barang==''){
	swal("","Nama Barang masih kosong!").then((value) => {
		$('#nama_barang').focus();
	});
	return false;
}
		
$.get("data.php?inputBarang=daftar_barang&id_barang="+id_barang+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&kategori_barang="+kategori_barang+"&satuan="+satuan+"&harga_beli="+harga_beli+"&harga_jual="+harga_jual+"&stok="+stok+"&lokasi="+lokasi+"&warna="+warna+"&ukuran="+ukuran+"&merek="+merek+"&expired="+expired+"&stok_minimal="+stok_minimal,
function(data){
	if(data==1){
		swal("Maaf ! ","Kode barang sudah ada").then((value) => {
			$('#kode_barang').focus();
			$('#kode_barang').select();
		});
		return false;
	}else{
		table.ajax.url( ajaxData ).load();
		//$('#EditPost').modal('hide');
		swal(
		{
		title: 'Sukses!',
		text: 'Data berhasil ditambahkan',
		type: 'success',
		timer: 2000
		}
		);
}
}
);

			
} );
$( "#SaveEdit" ).click(function () {
var id_barang = $('#id_barang').val();
var kode_barang = $('#kode_barang').val();
var nama_barang = $('#nama_barang').val();
var kategori_barang = $('#kategori_barang').val();
var satuan = $('#satuan').val();
var harga_beli = $('#harga_beli').val();
var harga_jual = $('#harga_jual').val();
var stok = $('#stok').val();
var lokasi = $('#lokasi').val();
var warna = $('#warna').val();
var ukuran = $('#ukuran').val();
var merek = $('#merek').val();
var expired = $('#expired').val();
var stok_minimal = $('#stok_minimal').val();

if(kode_barang==''){
	swal("","Kode Barang masih kosong!").then((value) => {
		$('#kode_barang').focus();
	});
	return false;
}
//alert(stok_minimal);
$.get("data.php?updateBarang=daftar_barang&id_barang="+id_barang+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&kategori_barang="+kategori_barang+"&satuan="+satuan+"&harga_beli="+harga_beli+"&harga_jual="+harga_jual+"&stok="+stok+"&lokasi="+lokasi+"&warna="+warna+"&ukuran="+ukuran+"&merek="+merek+"&expired="+expired+"&stok_minimal="+stok_minimal,
function(data){
	table.ajax.url( ajaxData ).load();
	//$('#EditPost').modal('hide');
	//setTimeout(function() { $('#ModalSukses').modal('show'); }, 1000);
	//setTimeout(function() { $('#ModalSukses').modal('hide'); }, 2000);
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

$( "#insertSatuan" ).click(function () {
var satuan = $('#inputSatuan').val();
$.get("data.php?inputSatuan=satuan&satuan="+satuan,
function(data){
	tableSatuan.ajax.url( ajaxSatuan ).load();
	$('#inputSatuan').val('');
	$( "#selectSatuan" ).load( "data.php?satuanBarang=satuan" );
}
);

});

$( "#import" ).click(function () {
 $('#modalImport').modal('show');
 $('#fileExcel').val('');


});
$( "#insertKategori" ).click(function () {
var satuan = $('#inputKategori').val();
$.get("data.php?inputKategori=daftar_kategori&kategori="+satuan,
function(data){
	tableKategori.ajax.url( ajaxKategori ).load();
	$('#inputKategori').val('');
	$( "#selectKategori" ).load( "data.php?kategoriBarang=kategori" );

}
);

			
} );

$( "#refresh" ).click(function () {
	table.ajax.url( ajaxData ).load();
} );	
$( "#stokLimit" ).click(function () {
	table.ajax.url( "data.php?tableBarangLimit=daftar_barang" ).load();
} );	
	
$( "#stokExpired" ).click(function () {
	table.ajax.url( "data.php?tableBarangExpired=daftar_barang" ).load();
} );	
	
	
$( "#showKategori" ).click(function () {
	
	$("#EditKategori").modal("show");
} );	
	

	
} );
function brgID(){
	var imgID=document.getElementById("imgID");
	var b=document.getElementById("kode_barang");
	var a=""+Math.floor((Math.random()*10000)+1);
	var c=""+Math.floor((Math.random()*10000)+1);
	b.value=""+a+c
	imgID.value=""+a+c
	};
function showSatuan() {
		$('#EditSatuan').modal("show");
		tableSatuan.ajax.url( ajaxSatuan ).load();


}

function showKategori() {
		$('#EditKategori').modal("show");
		tableKategori.ajax.url( ajaxKategori ).load();


}
/*
function pilihSatuan(e) {
    document.getElementById("satuan").value = e.target.value;
		$('#selectSatuan').hide();

}
function pilihKategori(e) {
    document.getElementById("kategori_barang").value = e.target.value;
		$('#selectKategori').hide();

}
*/
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