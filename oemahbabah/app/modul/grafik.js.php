<script>
$(document).ready(function() {

$('#loadGrafikJS').load("data.php?grafikPenjualan=1");
$( "#viewChart" ).click(function () {
var bulan = $('#bulan').val();
var tahun = $('#tahun').val();
var mode = $('#mode').val();
$('#loadGrafikJS').load("data.php?grafikPenjualan=1&bulan="+bulan+"&tahun="+tahun+"&mode="+mode);

});

});
</script>
