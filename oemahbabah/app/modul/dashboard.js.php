<script>
/*  $(function () {
	  


    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [

        {
          label               : 'Dasa',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [12, 54, 43, 87, 86, 27, 44]
        },
        {
          label               : 'Dasdsdssa',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [54, 77, 33, 45, 87, 34, 23]
        }
      ]
    }



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {


      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
  */
</script>
<script>
$(function() {
"use strict";

//BAR CHART
var bar = new Morris.Bar({
element: 'bar-chart',
resize: true,
data: [
<?php 
$d=date('d');
$m=date('m');
$y=date('Y');

if($d<15){
	$d_awal=1;
	$d_akhir=14;
	
}else{
	$d_awal=15;
	$d_akhir=32;	
}

for($i=1;$i<=12;$i++){

$omset=getOmset('',$i,$y);
$omset=$omset/1000;

$hpp=getHPP('',$i,$y);
$hpp=$hpp/1000;

$saldo=$omset-$hpp;

?>
{y: '<?php echo ucwords(bln($i));?> <?php echo $y;?>', a: <?php echo $omset;?>,c:<?php echo $saldo;?>},						 
<?php } ?>						 
],
barColors: ['#00a65a',  '#6080f2'],
xkey: 'y',
ykeys: ['a','c'],
labels: ['Penjualan','Laba/Rugi'],
hideHover: 'auto'
});
});
</script>