<?php 

?>

<div class="col-xs-12">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Produk</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<p>
<a href="#"   class='btn btn-success btn-sm' id='new' <?php displayAkses('barang_tambah',$userlevel);?> ><i class='fa fa-pencil-square-o'></i> Tambah</a>
<a href="#"  class="btn btn-primary btn-sm" id="import" <?php displayAkses('barang_import',$userlevel);?> ><i class='fa fa-upload'></i> Import Data</a>
<a href="#"  class="btn btn-warning btn-sm" id="refresh"><i class='fa fa-refresh'></i> Refresh</a>
<a href="#"  class="btn btn-warning btn-sm" id="stokLimit"><i class='fa fa-refresh'></i> Stok Limit</a>
<a href="#"  class="btn btn-warning btn-sm" id="stokExpired"><i class='fa fa-refresh'></i> Expired</a>
</p>
<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th style="width:70px">Action</th>
<th>Kode</th>
<th style="width:200px">Nama&nbsp;Produk&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Harga&nbsp;Beli&nbsp;</th>
<th>Harga&nbsp;Jual&nbsp;</th>
<th>Stok</th>
<th>Terjual</th>
<th>Satuan</th>
<th>Kategori</th>
<th>Lokasi</th>
<th>Warna</th>
<th>Ukuran</th>
<th>Merek</th>
<th>Expired</th>
<th>ID</th>
</tr>
</thead>
</table>

</div>
</div>
</div>





