<div class="col-lg-12">
<div class="row">
<div class="col-lg-12">
<div class="box box-success">
<div class="box-header">
<div class="well">
<table><tr>
<td>
<select name="mode" class="form-control" style="width:130px;" id="mode">
<option>penjualan</option>
<option>laba</option>
<option value="terjual">terjual</option>
</select>
</td>
<td>
<select name="bulan" class="form-control" style="width:130px;" id="bulan">
<option value="">Pilih Periode</option>
<?php for($i=1;$i<13;$i++){?>
<option value="<?php echo $i;?>" <?php 

if(isset($_GET['bulan']) AND $i==$_GET['bulan'] ){echo 'selected';}
elseif( !isset($_GET['bulan'])  AND $i==date('m')){echo 'selected';}

?>><?php echo ucwords(bulan($i));?></option>
<?php } ?>
</select>
</td><td>
<select name="tahun" class="form-control" style="width:100px;" id="tahun">
<option value="">Pilih Periode</option>
<?php 
$i1=2010;
$i2=2050;
for($i=$i1;$i<=$i2;$i++){?>
<option value="<?php echo $i;?>" <?php 
if(isset($_GET['tahun']) AND $i==$_GET['tahun'] ){echo 'selected';}
elseif( !isset($_GET['tahun'])  AND $i==date('Y')){echo 'selected';}
?> ><?php echo $i;?></option>
<?php } ?>
</select>
</td>
<td><input type="submit" class="btn btn-primary" value="submit" id="viewChart"></td>
</tr>
</table>
</div>
<?php
if(isset($_GET['bulan'])  ){$m=$_GET['bulan'];}
elseif( !isset($_GET['bulan']) ){$m=date('m');}

if(isset($_GET['tahun'])  ){$y=$_GET['tahun'];}
elseif( !isset($_GET['tahun'])  ){$y=date('Y');}
?>
<h3 class="box-title">Grafik Penjualan</h3> 
</div>
<div class="box-body chart-responsive">
<div id="loadGrafikJS"></div>

</div>			
</div>
</div>
</div>
</div>
      <!-- /.row -->
