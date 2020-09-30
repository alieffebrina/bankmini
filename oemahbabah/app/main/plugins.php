<div class="col-md-10">
<div class="box">
<div class="box-header">
<h3 class="box-title"><i class="glyphicon glyphicon-th"></i> Plugins</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
	<p>
<a href="#"   class='btn btn-success btn-sm' id='new'><i class='fa fa-pencil-square-o'></i> Tambah</a>
</p>
	  <div class="table-responsive">
		<table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th style="width:50px">No</th>
			  <th >Nama Plugin</th>
			  <th style="width:100px">Action</th>
			</tr>
		  </thead>
		  <tbody>

			<?php
$dirs='app/plugins';
$cdir = scandir($dirs); 
$i=-1;
foreach ($cdir as $k) 
{
if ($k=='..' || $k=='.' ){}else	  
{
echo '<tr><td>'.$i.'</td><td><b>'. ucwords(str_replace('_',' ',$k)).'</b></td><td></td></tr>
';
}
$i++;
}

?>

		  </tbody>
		</table>
	  </div>
	</div>
  </div>
</div>


