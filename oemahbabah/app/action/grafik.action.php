
<?php 
if(isset($_GET['grafikPenjualan'])){
	echo '<div class="chart" id="bar-chart" style="height: 300px;"></div>';
	echo '
<p><div style="background:#00a65a;height:15px;width:30px;float:left ;margin-right:5px;"></div> penjualan (dalam ribuan)</p>
<p><div style="background:#6080f2;height:15px;width:30px;float:left ;margin-right:5px;"></div> laba/rugi (dalam ribuan)</p>
<p><div style="background:#f95959;height:15px;width:30px;float:left ;margin-right:5px;"></div> barang terjual</p>
';

if(isset($_GET['bulan'])  ){$m=$_GET['bulan'];}
elseif( !isset($_GET['bulan']) ){$m=date('m');}

if(isset($_GET['tahun'])  ){$y=$_GET['tahun'];}
elseif( !isset($_GET['tahun'])  ){$y=date('Y');}

if(isset($_GET['mode'])  ){$mode=$_GET['mode'];}
elseif( !isset($_GET['mode']) ){$mode='penjualan';}

?>

<script>
$(function() {
"use strict";

//BAR CHART
var bar = new Morris.Bar({
element: 'bar-chart',
resize: true,
data: [
<?php 
if($mode=='penjualan'){

for($i=1;$i<=31;$i++){
$omset=getOmset($i,$m,$y);
$omset=$omset/1000;
//$omset=number_format($omset,2);

?>
{y: '<?php echo $i;?>/<?php echo $m;?>/<?php echo $y;?>', a: <?php echo $omset;?>},						 
<?php } ?>						 
],
barColors: ['#00a65a'],
xkey: 'y',
ykeys: ['a'],
labels: ['Penjualan'],
hideHover: 'auto'

<?php

}elseif($mode=='laba'){
for($i=1;$i<=31;$i++){
$omset=getOmset($i,$m,$y);
$omset=$omset/1000;
$omset=number_format($omset,2);
$hpp=getHPP($i,$m,$y);
$hpp=$hpp/1000;
//$hpp=number_format($hpp,2);
$saldo=$omset-$hpp;
?>
{y: '<?php echo $i;?>/<?php echo $m;?>/<?php echo $y;?>', a: <?php echo $saldo;?>},						 
<?php } ?>						 
],
barColors: ['#6080f2'],
xkey: 'y',
ykeys: ['a'],
labels: ['Laba/Rugi'],
hideHover: 'auto'

<?php
}elseif($mode=='terjual'){
for($i=1;$i<=31;$i++){
$terjual=intval(getTerjual($i,$m,$y));

?>
{y: '<?php echo $i;?>/<?php echo $m;?>/<?php echo $y;?>', a: <?php echo $terjual;?>},						 
<?php } ?>						 
],
barColors: ['#f95959'],
xkey: 'y',
ykeys: ['a'],
labels: ['Terjual'],
hideHover: 'auto'

<?php
}
?>
});
});
</script>
<?php
}
?>

