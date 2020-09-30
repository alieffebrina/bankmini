<?php 
if(isset($_GET['tableUser'])){
doTableJSON($_GET['tableUser'],array(
"id",
"username",
"nama",
"alamat",
"no_hp",
"level",
"password"
));
}

elseif(isset($_GET['inputUser'])){
$user=checkData($_GET['inputUser'],"WHERE username='".$_GET['username']."'");
if($user < 1){
doInsert($_GET['inputUser'],
"
username,level,password,nama,alamat,no_hp
",
"
'".$_GET['username']."',
'".$_GET['level']."',
'".md5($_GET['password'])."',
'".$_GET['nama']."',
'".$_GET['alamat']."',
'".$_GET['no_hp']."'
");
}
}
elseif(isset($_GET['deleteUser'])){
	if($_GET['deleteUser']!=1){
		doDelete('user',"WHERE id=".$_GET['deleteUser']."");
	}
}

elseif(isset($_GET['updateUser'])){
if($_GET['password']!=''){
	doUpdate($_GET['updateUser'],
	"username='".$_GET['username']."',
	nama='".$_GET['nama']."',
	alamat='".$_GET['alamat']."',
	no_hp='".$_GET['no_hp']."',
	password='".md5($_GET['password'])."',
	level='".$_GET['level']."'
	",
	"WHERE id='".$_GET['id']."'"
	);
}else{
	doUpdate($_GET['updateUser'],
	"username='".$_GET['username']."',
	nama='".$_GET['nama']."',
	alamat='".$_GET['alamat']."',
	no_hp='".$_GET['no_hp']."',
	level='".$_GET['level']."'
	",
	"WHERE id='".$_GET['id']."'"
	);		
}
}
?>

