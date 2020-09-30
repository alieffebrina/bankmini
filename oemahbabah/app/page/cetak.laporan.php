<?php
	include'config.php';
	include'libraries/Helper/laporan.lib.php';
?>
<title>Laporan</title>
<script src="<?php echo $CORE_URL;?>/assets/adminLTE/js/jquery.min.js"></script>
<link href="<?php echo $CORE_URL;?>/assets/adminLTE/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo $CORE_URL;?>/assets/plugins/editor/jquery.cleditor.css" />
<script type="text/javascript" src="<?php echo $CORE_URL;?>/assets/plugins/editor/jquery.cleditor.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$("#desc").cleditor({
height: '95%', // height not including margins, borders or padding
controls: // controls to add to the toolbar
"bold italic underline strikethrough subscript superscript | font size " +
"style | color | bullets numbering |  " +
" alignleft center alignright justify rule | " +
"print ",
colors: // colors in the color popup
"FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
"CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
"BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C " +
"999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C " +
"666 900 C60 C93 990 090 399 33F 60C 939 " +
"333 600 930 963 660 060 366 009 339 636 " +
"000 300 630 633 330 030 033 006 309 303",
fonts: // font names in the font popup
"Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond," +
"Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana",
sizes: // sizes in the font size popup
"1,2,3,4,5,6,7",
styles: // styles in the style popup
[["Paragraph", "<p>"], ["Header 1", "<h1>"], ["Header 2", "<h2>"],
["Header 3", "<h3>"],  ["Header 4","<h4>"],  ["Header 5","<h5>"],
["Header 6","<h6>"]],
useCSS: true, // use CSS to style HTML when possible (not supported in ie)
docType: // Document type contained within the editor
'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
docCSSFile: // CSS file used to style the document contained within the editor
'<?php echo $CORE_URL;?>/assets/adminLTE/css/bootstrap.min.css',
bodyStyle: // style to assign to document body contained within the editor
"margin:4px; font:9pt Arial,Verdana; cursor:text"
});
});

</script>
<textarea id="desc" style="height:500px;width:100%" type="text" name="description"   class="form-control"  >
<html moznomarginboxes mozdisallowselectionprint>
<title>Cetak Laporan</title>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin-top: 5mm;  /* this affects the margin in the printer settings */
        margin-bottom: 5mm;  /* this affects the margin in the printer settings */
    }
</style>
<br>
<div style="padding-bottom:5px;margin-bottom:5px">
<b style="font-size:16px"><?php echo getPengaturan('nama_toko');?></b>
<br>
<?php echo getPengaturan('alamat');?> Telp/HP <?php echo getPengaturan('no_hp');?>
</div>
<?php
if(isset($_GET['modeCetak'])){
$modeCetak=$_GET['modeCetak'];
	$modeCetak();
}

?>

</html>
</textarea> 

