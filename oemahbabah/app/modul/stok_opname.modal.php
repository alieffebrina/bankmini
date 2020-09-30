<div class="modal fade" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Stok Opname</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<h4 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i>  Stok Opname</h4>
<table class="table">
<tr style="display:none"><td style='width:150px'>Id</td><td>:</td><td><input class='form-control' id='id'>	</td></tr>
<tr style="display:none"><td style='width:150px'>Id Barang</td><td>:</td><td><input class='form-control' id='id_barang'>	</td></tr>
<tr><td style='width:150px'>Kode Barang</td><td>:</td><td>
<div class="input-group" >
<input  class="form-control" type="text" id="kode_barang" value=""  title="kode barang" >
<span class="input-group-btn"><button class="btn " type="button" id="showBarang"  title="cari barang" ><i class='fa fa-search'></i> [F1]</button></span>
</div></td></tr>
<tr><td style='width:150px'>Nama Barang</td><td>:</td><td><input class='form-control' id='nama_barang'>	</td></tr>
<tr><td style='width:150px'>Harga Beli</td><td>:</td><td><input class='form-control' id='harga_beli'>	</td></tr>
<tr><td style='width:150px'>Stok Komputer</td><td>:</td><td><input class='form-control' id='stok_komputer'>	</td></tr>
<tr><td style='width:150px'>Stok Nyata</td><td>:</td><td><input class='form-control' id='stok_nyata'>	</td></tr>
<tr style="display:"><td style='width:150px'>Keterangan</td><td>:</td><td>
<select id="keterangan" class="form-control">
<option>hilang</option>
<option>rusak</option>
<option>dipakai</option>
</select>	
</td></tr>

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

<div class="modal fade" id="doBarang" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content" >
<div class="modal-header" >
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
<h5 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i> Data Barang</h5>

</div>
<div class="modal-body">
	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="tableBarang" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">ID</th>
			  <th>Kode</th>
			  <th>Nama Barang</th>
			  <th>Harga Beli</th>
			  <th>Stok</th>
			  <th style="width:20px">#</th>
			</tr>
		  </thead>
		</table>
	  </div>	  
</div>
</div>
</div>
</div>