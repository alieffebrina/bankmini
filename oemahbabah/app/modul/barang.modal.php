<div class="modal fade" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
<h4 class="modal-title" id="EditPostLabel"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Data Barang</h4>

</div>
<div class="modal-body nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#tab_1" data-toggle="tab">Data Barang</a></li>
<li style=""><a href="#tab_2" data-toggle="tab">Advance</a></li>

</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1">
<div class="row">
<div class="col-lg-7">
<span style="display:none"><input style="width:400px" class="form-control" type="text" id="id_barang"></span>
<table class="table">
<tr>
<td style="width:150px">Kode Barang</td><td style="width:10px">:</td><td>
<div class="form-group">
<div class="input-group">
<input  class="form-control" type="text" id="kode_barang"><span class="input-group-btn">
<button onclick="brgID()" class="btn btn-default" type="button" ><i class="fa fa-refresh" aria-hidden="true"></i> Auto</button></span>
</div>
</div>	</td></tr>
<tr><td>Nama Barang</td><td>:</td><td><input class="form-control" id="nama_barang">	</td></tr>
<tr><td>Kategori Barang </td><td>:</td><td>
<p>
<div id="selectKategori"></div>
</p>
</td></tr>
<tr><td>Satuan</td><td>:</td><td>
<p>
<div id="selectSatuan"></div>
</p>
</td></tr>
<tr><td>Harga Beli</td><td>:</td><td><input class="form-control" id="harga_beli" onkeyup="reformatText(this)" >	</td></tr>
<tr><td>Harga Jual</td><td>:</td><td><input class="form-control" id="harga_jual" onkeyup="reformatText(this)" >	</td></tr>

</table>  
</div>
<div class="col-lg-5">
<table class="table">
<tr><td>Stok Sekarang</td><td>:</td><td><input class="form-control" id="stok" type="number" min="1">	</td></tr>
<tr><td>Stok Minimal</td><td>:</td><td><input class="form-control" id="stok_minimal" type="number" min="1">	</td></tr>
</table> 
<div id="loadUploader"></div>
</div>
</div>
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="tab_2">



<div class="row">
<div class="col-lg-8">
<table class="table">
<tr><td>Ukuran</td><td>:</td><td>
<select class="form-control" id="ukuran">
<option value="">--Pilih--</option>

<option>XXL</option>
<option>XL</option>
<option>L</option>
<option>M</option>
<option>S</option>
<option>XS</option>
</select>
</td></tr>
<tr><td>Warna</td><td>:</td><td><input class="form-control" id="warna"  >	</td></tr>
<tr><td>Merek</td><td>:</td><td><input class="form-control" id="merek">	</td></tr>
<tr><td>Lokasi Rak</td><td>:</td><td>
<input class="form-control" id="lokasi">
</td></tr>
<tr><td>Expired</td><td>:</td><td>
<input id="expired" class="form-control datepicker-here"  data-language="en" >
</td></tr>
</table>  
</div>
</div>

</div>

<!-- /.tab-pane -->
</div>

</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="SaveEdit"><i class="fa fa-check-square-o" aria-hidden="true"></i> Update</a>
<a class="btn btn-primary" href="#" id="SaveInput"><i class="fa fa-check-square-o" aria-hidden="true"></i> Simpan</a>
<a class="btn btn-warning" href="#" id="reset"><i class="fa fa-retweet" aria-hidden="true"></i> Reset</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>

<div class="modal fade" id="EditSatuan" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary" style="display:block">
<h5 class="modal-title" id="EditPostLabel">Satuan Barang</h5>
</div>
<div class="modal-body">

		<table class="table table-stripped table-hover" id="tableSatuan" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:30px">ID</th>
			  <th >Satuan</th>
			  <th style="width:40px!important"></th>
			</tr>
		  </thead>
		</table>
	  </div>

<div class="modal-footer">
<span class="pull-left ">Tambah Satuan : </span><input class="" id="inputSatuan" placeholder="satuan"> 
<button class="btn btn-warning btn-sm" type="button" id="insertSatuan"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
<button class="btn btn-default btn-sm" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>

</div>
</div>
</div>
</div>

<div class="modal fade" id="EditKategori" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary" style="display:block">
<h5 class="modal-title" id="EditPostLabel">Kategori Barang</h5>
</div>
<div class="modal-body">
<div >

		<table class="table table-stripped table-hover" id="tableKategori" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:30px">ID</th>
			  <th >Kategori</th>
			  <th style="width:40px!important"></th>
			</tr>
		  </thead>
		</table>
</div>
</div>
<div class="modal-footer">
<span class="pull-left ">Tambah Kategori : </span><input class="" id="inputKategori" placeholder="kategori"> 
<button class="btn btn-warning btn-sm" type="button" id="insertKategori"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
<button class="btn btn-default btn-sm" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>

</div>
</div>
</div>
</div>

<!-- import -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary" style="display:block">
<h5 class="modal-title" id="EditPostLabel">Import Data Barang</h5>
</div>
<div class="modal-body">
<div class="well">
<form id="uploadForm" action="" method="post">
<input name="fileExcel" type="file" class="inputFile" id="fileExcel"/>
<input name="fileTable" type="text" id="fileTable" value="daftar_barang" style="display:none"/>
<input type="submit" value="Upload Excel " class="btn btn-primary btn-sm" style="margin-top:3px"/>
<div id="data"></div>
</form>
</div>
<a href="files/template_barang.xls" class="btn btn-success"><i class="fa fa-file-excel-o"></i> template_barang.xls</a>
<br/>
<h4>Panduan import data dari Excel :</h4>
<ol>
<li>Download file excel <b>template_barang.xls</b> kemudian edit sesuai data Anda</li>
<li>Jika file Excel sudah selesai diedit, upload file tersebut pada form di atas.</li>
<li>klik Upload Excel untuk mulai mengupload</li>
<li>Proses upload selesai</li>
</ol>
</div>
<div class="modal-footer">
<button class="btn btn-default btn-sm" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>

</div>
</div>
</div>
</div>
