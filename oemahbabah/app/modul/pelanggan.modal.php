<div class="modal fade" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel">Data Pelanggan</h5>

</div>
<div class="modal-body">
<h4 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i>  Data Pelanggan</h4>
<span style="display:none"><input  class="form-control" type="text" id="id"></span>
<table class="table">
<tr><td style="width:150px">Nama Pelanggan</td><td>:</td><td><input class="form-control" id="nama_pelanggan">	</td></tr>
<tr><td>Alamat</td><td>:</td><td><input class="form-control" id="alamat">	</td></tr>
<tr><td>Kota</td><td>:</td><td><input class="form-control" id="kota">	</td></tr>
<tr><td>No HP</td><td>:</td><td><input class="form-control" id="no_hp">	</td></tr>
<tr><td>Email</td><td>:</td><td><input class="form-control" id="email">	</td></tr>
</table>  
</div>
<div class="modal-footer">
<a class="btn btn-primary" href="#" id="SaveEdit"><i class="fa fa-check-square-o" aria-hidden="true"></i> Update</a>
<a class="btn btn-primary" href="#" id="SaveInput"><i class="fa fa-check-square-o" aria-hidden="true"></i> Simpan</a>
<button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i> Tutup</button>
</div>
</div>
</div>
</div>


<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header modal-header-primary" style="display:block">
<h5 class="modal-title" id="EditPostLabel">Import Data Pelanggan</h5>
</div>
<div class="modal-body">
<div class="well">
<form id="uploadForm" action="" method="post">
<input name="fileExcel" type="file" class="inputFile" id="fileExcel"/>
<input name="fileTable" type="text" id="fileTable" value="pelanggan" style="display:none"/>
<input type="submit" value="Upload Excel " class="btn btn-primary btn-sm" style="margin-top:3px"/>
<div id="data"></div>
</form>
</div>
<a href="files/template_pelanggan.xls" class="btn btn-success"><i class="fa fa-file-excel-o"></i> template_pelanggan.xls</a>
<br/>
<h4>Panduan import data dari Excel :</h4>
<ol>
<li>Download file excel <b>template_pelanggan.xls</b> kemudian edit sesuai data Anda</li>
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
