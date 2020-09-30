  <footer class="main-footer ">
    <div class="pull-right hidden-xs">
<i class="fa fa-calendar"></i>  &nbsp; <?php echo date('d');?> <?php echo ucwords(bulan(date('m')));?> <?php echo date('Y');?>  <span id="time"></span>
			
<i class="fa fa-desktop"></i> Alamat Server : <input style="width:150px" readonly value="<?php IPServer();?>:<?php echo SID();?>">
<div id="session" ></div>
    </div>
    <b><?php echo SNAME();?> <?php echo version();?></b> Copyright &copy; <a href="http://djavasoft.com">djavasoft.com</a> 2018 </footer>
 
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script>
var auto_refresh = setInterval(
function ()
{
$('#sync').load('alert.php').fadeIn("slow");
}, 5000); 

var auto_refresh = setInterval(
function ()
{
$('#session').load('session.php?session=logout').fadeIn("slow");
}, 3000); 

var auto_refresh = setInterval(
function ()
{
$('#expired').load('data.php?notifBarangExpired=1').fadeIn("slow");
}, 1000); 

function startbody() {
$("#loadBody").load("load.php?mode=dashboard");	
$("#alert").load("alert.php");
startTime();
}
function startTime() {
	

    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);

}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}


function loadPage(page){
swal({
  title: '',
  html: '<img src="images/system/ajax-loader.gif"> <br> Memuat..',
  showCancelButton: false,
  showConfirmButton: false
})

$("#loadBody").load("load.php?mode="+page,function(){
	swal.close();
}

);



 document.title = ucwords(page) + ' | <?php echo getPengaturan('nama_toko');?> ';
var getTitle = $(document).attr('title');
if(page!='dashboard'){
	$("#header-toko").hide();
}else{
		$("#header-toko").show();

}

}

function loadPlugin(page){
swal({
  title: '',
  html: '<img src="images/system/ajax-loader.gif"> <br> Memuat..',
  showCancelButton: false,
  showConfirmButton: false
})

$("#loadBody").load("load.php?plugin="+page,function(){
	swal.close();
}

);



 document.title = ucwords(page) + ' | <?php echo getPengaturan('nama_toko');?> ';
var getTitle = $(document).attr('title');
if(page!='dashboard'){
	$("#header-toko").hide();
}else{
		$("#header-toko").show();

}

}

</script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/jquery.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/js/jQuery.print.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/bootstrap.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/dashboard2.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/demo.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/dataTables.buttons.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/buttons.flash.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/jszip.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/pdfmake.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/vfs_fonts.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/buttons.html5.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/export/buttons.print.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/components/raphael/raphael.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/plugins/components/morris.js/morris.min.js"></script>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/adminlte.min.js"></script>
</body>
</html>
