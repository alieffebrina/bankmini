<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/datepicker.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/air-datepicker/js/i18n/datepicker.id.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/numpad/jquery.numpad.js"></script>

<style>
.addBarang:focus{border:3px solid blue}
#tMeja{display:none}
</style>
<script>  
function bayarKasir(){
	$('#num2').focus();
	var nilaiTotal=$('#totalBayar').val();
	var totalGrandKasir=$('#totalGrandKasir').val();
	var num1 = document.getElementById('num1').value;
	var num2 = document.getElementById('num2').value;
	var diskon = document.getElementById('diskon').value;
	var voucher = document.getElementById('voucher').value;
	$('#doBayarKasir').modal('show');
	$('#modalGrandKasir').val(totalGrandKasir);
	$('#num1').val(nilaiTotal);
	$('#num2').val('');
	$('#subt').val('');
	$('#voucher').val('');
	$('#diskon').val('');
	$('#pajak').val('');
	$('#ekspedisi').val('');
	$('#ongkir').val('');
	$("#idPelanggan").val('');
	$("#namaPelanggan").val('');
	$( "#subt2" ).load( "data.php?kembaliNol=0" );
	$( "#hitungTotal" ).html('<b>Rp.'+totalGrandKasir+'</b>');
	

	
}
var ajaxBarang="data.php?kasirBarang=daftar_barang";
var ajaxPelanggan="data.php?tablePelanggan=pelanggan";
var ajaxData="data.php?tableKasir=kasir_penjualan&meja=<?php echo $_GET['meja'];?>";
shortcut.add("f1",function() {
$('#doBarang').modal('show');
$('input[type=search]', '').focus();
$('input[type=search]', '').select();

});
shortcut.add("f2",function() {
$('#qty').focus();
});
shortcut.add("f3",function() {
$('#addCart').focus();
});
shortcut.add("end",bayarKasir);


$(document).ready(function() {
<?php //xKasir();?>
var $btns = $('.group').click(function() {
	if (this.id == 'all') {
	  $('#parent > div').fadeIn(450);
	} else {
	  var $el = $('.' + this.id).fadeIn(450);
	  $('#parent > div').not($el).hide();
	}
	$btns.removeClass('active');
	$(this).addClass('active');
  })

var $search = $("#searchProduct").on('input',function(){
	$btns.removeClass('active');
	var matcher = new RegExp($(this).val(), 'gi');
	$('.boxs').show().not(function(){
		return matcher.test($(this).find('.name, .kode').text())
	}).hide();
})

$( "#grid" ).click(function () {
	$( "#grid-mode" ).show();
	$( "#list-mode" ).hide();
	$(this).addClass('active');
	$("#list").removeClass('active');
	
});	
$( "#list" ).click(function () {
	$( "#grid-mode" ).hide();
	$( "#list-mode" ).show();
	$(this).addClass('active');
	$("#grid").removeClass('active');
	$("#kodeBarang").focus();
	
	 	
});	

$( ".addProduct" ).click(function () {
var kode = $(this).attr('id');

var user_id = $('#user_id').val();
var id_barang = $('#idBarang').val();
var kode_barang = $('#kodeBarang').val();
var nama_barang = $('#namaBarang').val();
var stok_barang =  $(this).attr('stok');
var harga = $('#hargaJual').val();
var faktur = $('#faktur').val();
var qty = $('#qty').val();
var noMeja = $('#noMeja').val();

$('.overlay-'+kode).fadeIn();
if(parseInt(stok_barang) < 1){
	//alert('Maaf! Stok barang tidak mencukupi ( sisa : '+ stok_barang +' )');
	swal("","Maaf! Stok barang tidak mencukupi ").then(function(value) {
			//$('#qty').focus();
	});
		$('.overlay-'+kode).fadeOut("slow");

	return false;
	
}else{
	
	$.get("data.php?addCart=kasir_penjualan&id_barang="+id_barang+"&kode_barang="+kode+"&nama_barang="+nama_barang+"&harga="+harga+"&qty="+qty+"&faktur="+faktur+"&user_id="+user_id+"&noMeja="+noMeja,
	function(data){
		$('.overlay-'+kode).fadeOut("slow");
		table.ajax.url( ajaxData ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$('#idBarang').val('');
		$('#kodeBarang').val('');
		$('#namaBarang').val('');
		$('#stokBarang').val('');
		$('#hargaJual').val('');
		$('#ekspedisi').val('');
		$('#ongkir').val('');
		$('#qty').val(1);
		$('#kodeBarang').focus();

		}
		);
}		
});

$("#TbDibayar").hide();

$('#kodeBarang').focus();

var faktur = $('#faktur').val();
$('#loadUser').load("data.php?loadUser=user");
$('#loadFaktur').load("data.php?loadFaktur=1&type=PJ");
$('#loadDate').load("data.php?loadDate=1");
 $("#showTempo").hide();
//$('[data-toggle="tooltip"]').tooltip(); 


$('#selectSatuan').hide();
$('#selectKategori').hide();
$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
    var tableBarang = $('#tableBarang').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },
		keys: true,
		"pageLength": 8,
		"lengthMenu": [ 5,10, 25, 50 ],
		"paginate":true,
		"bLengthChange": false,
		"info":false,
		"length":false,
		"pagingType": "simple",
       "ajax": ajaxBarang ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ 
		{	"targets": [ -1 ],    
			"data": null,
			"render": function ( data, type, row ) {

			
				if(parseInt(data[4])<=parseInt(data[7])){
					btn_pilih="<button href='#' class='btn btn-default btn-sm' id='addBarang' disabled><i class='fa fa-check-square-o'></i> pilih </button>";
				}else{
					btn_pilih="<button href='#' class='btn btn-warning btn-sm' id='addBarang'><i class='fa fa-check-square-o'></i> pilih </button>";
				}
			return btn_pilih;
			},
		},
		{
		"targets": [ 0 ],
		"visible": false,
		"searchable": false
		}
		]
    } );
		$('#cariBarang').keyup(function(){
		tableBarang.search( $(this).val() ).draw();
		});

    var tablePelanggan = $('#tablePelanggan').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },

		"pageLength": 6,
		"lengthMenu": [ 5,10, 25, 50 ],
		"paginate":true,
		"bLengthChange": false,
		"info":false,
		"length":false,
        "ajax": ajaxPelanggan ,
		"order": [[ 0, "desc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<a href='#' class='btn btn-warning btn-sm' id='addPelanggan'><i class='fa fa-check-square-o'></i> pilih</a>"
        },
		{
		"targets": [ 0,3 ],
		"visible": false,
		"searchable": false
		}
		]
    } );

	$('#tablePelanggan tbody').on( 'click', '#addPelanggan', function () {
	var data = tablePelanggan.row( $(this).parents('tr') ).data();
		$('#idPelanggan').val(data[ 0 ]);
		$('#namaPelanggan').val(data[ 1 ]);
		$('#doPelanggan').modal('hide');
	} );
	
	$('#tableBarang tbody').on( 'click', '#addBarang', function () {
	var data = tableBarang.row( $(this).parents('tr') ).data();
		$('#idBarang').val(data[ 0 ]);
		$('#kodeBarang').val(data[ 1 ]);
		$('#namaBarang').val(data[ 2 ]);
		$('#hargaJual').val(data[ 3 ]);
		$('#stokBarang').val(data[ 4 ]);
		$('#doBarang').modal('hide');
		$('#qty').focus();
		$('#qty').select();
		var faktur=$('#faktur').val();
		var user_id = $('#user_id').val();
		var noMeja = $('#noMeja').val();

if(parseInt(data[ 4 ]) < 1){
	//alert('Maaf! Stok barang tidak mencukupi ( sisa : '+ stok_barang +' )');
	swal("","Maaf! Stok barang tidak mencukupi ").then(function(value) {
			//$('#qty').focus();
	});

	return false;
	
}else{
	
	$.get("data.php?addCart=kasir_penjualan&id_barang="+data[ 0 ]+"&kode_barang="+data[ 1 ]+"&nama_barang="+data[ 2 ]+"&harga="+data[ 3 ]+"&qty=1&faktur="+faktur+"&user_id="+user_id+"&noMeja="+noMeja,
	function(data){
		table.ajax.url( ajaxData ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$('#idBarang').val('');
		$('#kodeBarang').val('');
		$('#namaBarang').val('');
		$('#stokBarang').val('');
		$('#hargaJual').val('');
		$('#ekspedisi').val('');
		$('#ongkir').val('');
		$('#qty').val(1);
		$('#kodeBarang').focus();
		});
}
		
		
	});
	
    var table = $('#dataTable').DataTable( {
    "language": {
      "emptyTable": "&lt;  No data available in table &gt;"
    },
		scrollY:        '45vh',
		"scrollX": true,
		"pageLength": 5000,
		"paginate":false,
		"bFilter":false,
		"info":false,
		"bLengthChange": false,
		select: true,
        "ajax": ajaxData ,
	    "ordering": false,
		"order": [[ 0, "asc" ]],
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button  style='display:none' class='btn btn-default btn-xs' id='edit'><i class='fa fa-pencil-square-o'></i></button> <button class='btn btn-default btn-xs' id='delete'><i class='fa fa-trash-o' onclick='playTrash()'></i></button>"
        },
		{
		"targets": [2 ],
		"render": function ( data, type, row ) {
                    return '<a href="#" id="edit"> ' + data +' </a>';
                },
		},
		{
		"targets": [4 ],
		"render": function ( data, type, row ) {
                    return '<button id="minus" class="btn btn-xs btn-default" onclick="playTrash()"><i class="fa fa-minus"></i></button><span style="width:80px;padding:3px"> ' + data +' </span><button id="plus" class="btn btn-xs btn-default" onclick="playAddCart()"><i class="fa fa-plus"></i></button>';
                },
		},
		{
		"targets": [ 0,1,3 ],
		"visible": false,
		"searchable": false
		}
		]
    } );
 
    $('#dataTable tbody').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tr') ).data();

//alert(data[ 0 ]);
	$.get("data.php?delCart="+data[ 0 ]+"&tableCart=kasir_penjualan",
	function(data){
	table.ajax.url( ajaxData ).load();
	$(this).parents('tr').fadeOut(300);
	$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
	}
	);
    } );
	
	$('#dataTable tbody').on( 'click', '#edit', function () {
	var data = table.row( $(this).parents('tr') ).data();
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
	
	$('#dataTable tbody').on( 'click', '#plus', function () {
	var data = table.row( $(this).parents('tr') ).data();
	$.get("data.php?plusCart="+data[4]+'&id='+data[0]+'&harga='+data[3]+"&modeCart=kasir_penjualan",
	function(data){
		table.ajax.url( ajaxData ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		}
		);

} );
	$('#dataTable tbody').on( 'click', '#minus', function () {
	var data = table.row( $(this).parents('tr') ).data();
	
if(data[4]<=1){
	swal("","Jumlah barang minimum").then(function(value)  {
	});
	return false;
}

	$.get("data.php?minusCart="+data[4]+'&id='+data[0]+'&harga='+data[3]+"&modeCart=kasir_penjualan",
	function(data){
		table.ajax.url( ajaxData ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );

		}
		);


} );

$( "#showBarang" ).click(function () {
	$('#doBarang').modal('show');
	$('input[type=search]', '').select();
	$('input[type=search]', '').select();
	

	tableBarang.ajax.url( ajaxBarang ).load();
} );


$( ".pesanMeja" ).click(function () {
	var idMeja=$( this ).val();
	$( "#loadBody" ).load( "load.php?mode=kasir&meja="+idMeja );

} );

$( "#submitMeja" ).click(function () {
	var jumlahMeja=$( '#jumlahMeja' ).val();

	$.get("data.php?jumlahMeja="+jumlahMeja,
	function(data){
		swal(
		{
		title: 'Sukses!',
		text: 'Data berhasil diperbaharui',
		type: 'success',
		timer: 2000
		}
		);
	$( "#loadBody" ).load( "load.php?mode=kasir" );
	});
	

	
} );

$( "#batalMeja" ).click(function () {
	var noMeja=$( '#noMeja' ).val();

	swal({
  title: '',
  html: "Anda ingin membatalkan pemesaan<br><b>MEJA "+noMeja+"</b>",
  type: 'warning',
  
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ya, Batalkan!'
}).then((result) => {
  if (result.value) {
	$.get("data.php?batalMeja="+noMeja,
	function(data){
	$( "#loadBody" ).load( "load.php?mode=kasir" );
	});

  }
})
} );

$( "#pindahMeja" ).click(function () {
	$( "#tMeja" ).toggle(  );

});
$( "#pindahMejaBaru" ).click(function () {
	var noMeja=$( '#noMeja' ).val();
	var mejaBaru =	$( "#newMeja" ).val(  );
	var faktur =	$( "#faktur" ).val(  );

	$.get("data.php?noMeja="+noMeja+"&pindahMejaBaru="+mejaBaru+"&faktur="+faktur,
	function(data){
		//alert(data)
	$( "#loadBody" ).load( "load.php?mode=kasir&meja="+mejaBaru );
	});

});

$( "#back" ).click(function () {
	$( "#loadBody" ).load( "load.php?mode=kasir" );

});

$( "#newKasir" ).click(function () {

	$('#modalPrint').modal('hide');
	table.ajax.url( ajaxData ).load();
	$('#loadFaktur').load("data.php?loadFaktur=1&type=PJ");
	$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
	//$( "#loadBody" ).load( "load.php?mode=kasir" );
	$("#date").val("<?php echo date("d/m/Y");?>");
	$( "#loadBody" ).load( "load.php?mode=kasir" );

	
} );

$( "#showPelanggan" ).click(function () {
	$('#doPelanggan').modal('show');
	$('#nama_pelanggan').focus();
	//tableBarang.ajax.url( ajaxBarang ).load();
} );
$( "#bayarKasir" ).click(bayarKasir);

$('#addCartForm').submit(function(e) {
	
var user_id = $('#user_id').val();
var id_barang = $('#idBarang').val();
var kode_barang = $('#kodeBarang').val();
var nama_barang = $('#namaBarang').val();
var stok_barang = $('#stokBarang').val();
var harga = $('#hargaJual').val();
var faktur = $('#faktur').val();
var qty = $('#qty').val();
var noMeja = $('#noMeja').val();

if(kode_barang=='' || kode_barang==0){
	swal("","Tambahkan Kode Barang").then(function(value) {
		$('#kodeBarang').focus();
	});
	return false;
}
	
if(parseInt(stok_barang) < parseInt(qty)){
	//alert('Maaf! Stok barang tidak mencukupi ( sisa : '+ stok_barang +' )');
	swal("","Maaf! Stok barang tidak mencukupi ( sisa : "+ stok_barang +" )").then(function(value) {
			$('#qty').focus();
	});

	return false;
	
}

e.preventDefault();
$.ajax({
	url: "data.php",
	type: "POST",
	data:  new FormData(this),
	contentType: false,
	cache: false,
	processData:false,
	success: function(data)
	{
		table.ajax.url( ajaxData ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan" );
		$('#idBarang').val('');
		$('#kodeBarang').val('');
		$('#namaBarang').val('');
		$('#stokBarang').val('');
		$('#hargaJual').val('');
		$('#ekspedisi').val('');
		$('#ongkir').val('');
		$('#qty').val(1);
		$('#kodeBarang').focus();
		//$( "#loadBody" ).load( "load.php?mode=kasir" );

	},
	error: function() 
	{} 	        
});
});

$( "#addCart" ).click(function () {
var user_id = $('#user_id').val();
var id_barang = $('#idBarang').val();
var kode_barang = $('#kodeBarang').val();
var nama_barang = $('#namaBarang').val();
var stok_barang = $('#stokBarang').val();
var harga = $('#hargaJual').val();
var faktur = $('#faktur').val();
var qty = $('#qty').val();
var noMeja = $('#noMeja').val();

if(kode_barang=='' || kode_barang==0){
	swal("","Tambahkan Kode Barang").then(function(value) {
		$('#kodeBarang').focus();
	});
	return false;
}
	
 if(parseInt(stok_barang) < parseInt(qty)){
	//alert('Maaf! Stok barang tidak mencukupi ( sisa : '+ stok_barang +' )');
	swal("","Maaf! Stok barang tidak mencukupi ( sisa : "+ stok_barang +" )").then(function(value) {
			$('#qty').focus();
	});

	return false;
	
}else{
	
	$.get("data.php?addCart=kasir_penjualan&id_barang="+id_barang+"&kode_barang="+kode_barang+"&nama_barang="+nama_barang+"&harga="+harga+"&qty="+qty+"&faktur="+faktur+"&user_id="+user_id+"&noMeja="+noMeja,
	function(data){
		table.ajax.url( ajaxData ).load();
		$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
		$('#idBarang').val('');
		$('#kodeBarang').val('');
		$('#namaBarang').val('');
		$('#stokBarang').val('');
		$('#hargaJual').val('');
		$('#ekspedisi').val('');
		$('#ongkir').val('');
		$('#qty').val(1);
		$('#kodeBarang').focus();

		}
		);
}

			
} );

$( "#addPelanggan" ).click(function () {
var nama_pelanggan = $('#nama_pelanggan').val();
var alamat = $('#alamat').val();
var no_hp = $('#no_hp').val();

if(nama_pelanggan==''){
		swal("","Masukkan Nama Pelanggan").then(function(value) {
			$('#nama_pelanggan').focus();
		});
		return false;
	}
	
$.get("data.php?inputPelanggan=pelanggan&nama_pelanggan="+nama_pelanggan+"&alamat="+alamat+"&no_hp="+no_hp,
function(data){
	tablePelanggan.ajax.url( ajaxPelanggan ).load();
	$('#EditPost').modal('hide');
	$('#nama_pelanggan').val('');
	$('#alamat').val('');
	$('#no_hp').val('');
	}
);
		
} );

$( "#inputBayar" ).click(function () {
var faktur = $('#faktur').val();
var user_id = $('#user_id').val();
var pelanggan_id = $('#idPelanggan').val();
var date = $('#date').val();
var total = $('#num1').val();
var dibayar = $('#num2').val();
var voucher = $('#voucher').val();
var diskon = $('#diskon').val();
var pajak = $('#pajak').val();
var ongkir = $('#ongkir').val();
var ekspedisi = $('#ekspedisi').val();
var metode = $('input[name=metode]:checked', '#formKasir').val();
var tempo = $('#tempo').val();
var meja=$('#noMeja').val();

 if(metode=='tunai'){

	if(dibayar=='' || dibayar==null || dibayar==0){
		//alert("Masukkan Nama Pelanggan!");
		swal("","Masukkan Pembayaran").then(function(value) {
			$('#num2').focus();
		});
		
		return false;
	}
	
	var bayarKurang = $('#bayarKurang').val();
	if(bayarKurang==1){
		//alert("Masukkan Nama Pelanggan!");
		swal("","Pembayaran Kurang").then(function(value){
			$('#num2').focus();
			$('#num2').select();
		});
		
		return false;
	}
	
	$.get("data.php?inputBayar=bayar&faktur="+faktur+"&pelanggan_id="+pelanggan_id+"&date="+date+"&total="+total+"&voucher="+voucher+"&diskon="+diskon+"&dibayar="+dibayar+"&metode="+metode+"&tempo="+tempo+"&user_id="+user_id+"&pajak="+pajak+"&ongkir="+ongkir+"&ekspedisi="+ekspedisi+"&meja=<?php echo $_GET['meja'];?>",
	function(data){
		//location.reload();	
		table.ajax.url( ajaxData ).load();
		$('#doBayarKasir').modal('hide');
		$('#dataPrint').load("data.php?printKasir=bayar&faktur="+faktur);	
		$('#modalPrint').modal('show');
		//slocation.reload();
		$("#idPelanggan").val('');
		$("#namaPelanggan").val('');
		$("#frame").hide();
		$("#printKasir").show();
		$('#dataPrint').show();

	}
	);	


}else if(metode=='kredit'){
	if(pelanggan_id=='' || pelanggan_id==null || pelanggan_id==0){
		//alert("Masukkan Nama Pelanggan!");
		swal("","Pilih Nama Pelanggan").then(function(value) {
			$('#namaPelanggan').focus();
		});
		
		return false;
	}
	else if(tempo=='' || tempo==null || tempo==0){
		
		$('#tempo').focus()
		return false;
	}
	else{
	
	$.get("data.php?inputBayar=bayar&faktur="+faktur+"&pelanggan_id="+pelanggan_id+"&date="+date+"&total="+total+"&voucher="+voucher+"&diskon="+diskon+"&dibayar="+dibayar+"&metode="+metode+"&tempo="+tempo+"&user_id="+user_id+"&meja=<?php echo $_GET['meja'];?>",
	function(data){
		//location.reload();	
		table.ajax.url( ajaxData ).load();
		$('#doBayarKasir').modal('hide');
		$('#dataPrint').load("data.php?printKasir=bayar&faktur="+faktur);	
		$('#modalPrint').modal('show');
		$('#tempo').val('');
		$("#num2").prop('disabled', false);	 
		$("#metode1").prop('checked', true);
		$("#metode2").prop('checked', false);
		$("#showTempo").hide();
		$("#idPelanggan").val('');
		$("#namaPelanggan").val('');
		$("#frame").hide();
		$("#printKasir").show();
		$('#dataPrint').show();

		//slocation.reload();
	}
	);	
	}
}


} );

$( "#printKasir" ).click(function () {
	//jQuery('#printArea').print()
	$("#printKasir").hide();
	$("#frame").show();
	$('#dataPrint').hide();
	var faktur = $('#faktur').val();
	var ukuran = $('#ukuran').val();
	var font_family = $('#font_family').val();
	var font_size = $('#font_size').val();
    $("#frame").attr("src", "page.php?page=nota&faktur="+faktur+"&ukuran="+ukuran+"&font_family="+font_family+"&font_size="+font_size);

	//window.open("nota.php?faktur="+faktur+"&ukuran="+ukuran+"&font_family="+font_family+"&font_size="+font_size," ", "width=500,height=450"); 
//	$('#modalPrint').modal('hide');
//	$( "#loadBody" ).load( "load.php?mode=kasir" );	
	//$( "#loadBody" ).load( "load.php?mode=kasir" );
	
} );

$( "#SaveCart" ).click(function () {
var id = $('#idCart').val();
var qty = $('#qtyCart').val();
var harga = $('#hargaCart').val();
//alert(harga);

$.get("data.php?updateCart=kasir_penjualan&id="+id+"&qty="+qty+"&harga="+harga,
function(data){
	table.ajax.url( ajaxData ).load();
	$('#EditCart').modal('hide');
	$( "#totalSum" ).load( "data.php?totalSum=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
	$( "#totalSumBayar" ).load( "data.php?totalSumBayar=kasir_penjualan&meja=<?php echo $_GET['meja'];?>" );
}
);		
} );

$( "#refresh" ).click(function () {
	table.ajax.url( ajaxData ).load();
});	



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
	
	var ongkir = document.getElementById('ongkir').value;
	var num1 = document.getElementById('num1').value;
	var num2 = document.getElementById('num2').value;
	var diskon = document.getElementById('diskon').value;
	var voucher = document.getElementById('voucher').value;
	var pajak = document.getElementById('pajak').value;
	var result = parseInt(num2) - parseInt(num1);
	$( "#hitungTotal" ).load( "data.php?hitungTotal="+result+"&total="+num1+"&diskon="+diskon+"&voucher="+voucher+"&pajak="+pajak+"&ongkir="+ongkir );

	if (!isNaN(result)) {
	document.getElementById('subt').value = result;
	$( "#subt2" ).load( "data.php?hitungKembali="+result+"&total="+num1+"&bayar="+num2+"&diskon="+diskon+"&voucher="+voucher+"&pajak="+pajak+"&ongkir="+ongkir );
	}
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

$('#formKasir input').on('change', function() {
	var metode=$('input[name=metode]:checked', '#formKasir').val();
   //alert($('input[name=metode]:checked', '#formKasir').val()); 
   if(metode == 'pre_order'){
	   $("#showTempo").hide();
	   $("#TbDibayar").hide();
		$("#num2").prop('disabled', true);	 
		$("#num2").val('');
   }else
   if(metode == 'kredit'){
	   $("#showTempo").show();
		$("#num2").prop('disabled', true);	 
		$("#num2").val('');
   }else{
	   $("#TbDibayar").show();
	    $("#showTempo").hide();
		$('#tempo').val('');
		$("#num2").prop('disabled', false);	   

   }   
   
});
</script>