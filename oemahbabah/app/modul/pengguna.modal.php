<div class="modal fade" id="EditPost" tabindex="-1" role="dialog" aria-labelledby="EditPostLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
<div class="modal-content">
<div class="modal-header" style="display:none">
<h5 class="modal-title" id="EditPostLabel">Data Pengguna</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<h4 class="modal-title" id="EditPostLabel"><i class="fa fa-check-square-o" aria-hidden="true"></i>  Data Pengguna</h4>
<span style="display:none"><input  class="form-control" type="text" id="id"></span>
<table class="table">
<tr><td style="width:150px">Username</td><td>:</td><td><input class="form-control" id="username">	</td></tr>
<tr><td style="width:150px">Nama</td><td>:</td><td><input class="form-control" id="nama">	</td></tr>
<tr><td style="width:150px">Alamat</td><td>:</td><td><input class="form-control" id="alamat">	</td></tr>
<tr><td style="width:150px">Telp/HP</td><td>:</td><td><input class="form-control" id="no_hp">	</td></tr>
<tr><td>Level</td><td>:</td><td>
<select name="level" id="level" class="form-control">

<?php 

$aksesList=doTableArray("akses",array("id","level"));
foreach( $aksesList as $list){
	if($list[0]==1){$selected='selected';}else{$selected='';}
?>
<option <?php echo $selected;?>><?php echo $list[1];?></option>
<?php
}
?>
</select>

</td></tr>
<tr><td>Password</td><td>:</td><td><input type="password"  class="form-control" id="password">	</td></tr>


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

