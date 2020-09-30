<?php
if($database_engine=='sqlite'){
?>

<script>

function saveHakAkses(level,formName,inputAksesName){
<?php
$results=$db->query("SELECT * FROM 'akses' ");
$cols = $results->numColumns(); 
for ($i = 0; $i < $cols; $i++) {
echo "var ".$results->columnName($i)."=$('input[name=".$results->columnName($i)."]:checked', '#'+formName).val();";
}

?>
$.get("data.php?"+inputAksesName+"="+level+
<?php
$results=$db->query("SELECT * FROM 'akses' ");
$cols = $results->numColumns(); 
for ($i = 0; $i < $cols; $i++) {
echo '"&'.$results->columnName($i).'="+'.$results->columnName($i).'+';
}
?>
"&data=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil diupdate',
		type: 'success',
		timer: 2000
	}
	);
}
);
}
$(document).ready(function() {
<?php 
$aksesList=doTableArray("akses",array("id","level"));
foreach( $aksesList as $list){
	$lvl=$list[1];
	$level=ucwords($list[1]);
echo '
$( "#save'.$level.'" ).click(function () {
saveHakAkses("'.$lvl.'","form'.$level.'","inputAkses'.$level.'");
} );
';
}
?>
} );
</script>


<?php
/*======================================================= MYSQL DB ==========================================================*/ 
}elseif($database_engine=='mysql'){
?>

<script>

function saveHakAkses(level,formName,inputAksesName){
<?php
global $db;
$results=$db->query("SELECT * FROM akses ");
$cols = mysql_num_fields($results);

for ($i = 0; $i < $cols; $i++) {
echo "var ".mysql_field_name($results, $i)."=$('input[name=".mysql_field_name($results, $i)."]:checked', '#'+formName).val();";
}

?>
$.get("data.php?"+inputAksesName+"="+level+
<?php
$results=$db->query("SELECT * FROM akses ");
$cols = mysql_num_fields($results);
for ($i = 0; $i < $cols; $i++) {
echo '"&'.mysql_field_name($results, $i).'="+'.mysql_field_name($results, $i).'+';
}
?>
"&data=1",
function(data){
	swal(
	{  
		title: 'Sukses!',
		text: 'Data berhasil diupdate',
		type: 'success',
		timer: 2000
	}
	);
}
);
}
$(document).ready(function() {
<?php 
$aksesList=doTableArray("akses",array("id","level"));
foreach( $aksesList as $list){
	$lvl=$list[1];
	$level=ucwords($list[1]);
echo '
$( "#save'.$level.'" ).click(function () {
saveHakAkses("'.$lvl.'","form'.$level.'","inputAkses'.$level.'");
} );
';
}
?>
} );
</script>
<?php
}
?>