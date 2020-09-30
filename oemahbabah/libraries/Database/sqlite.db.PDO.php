<?php 
/* APLIKASI PENJUALAN DPOS PRO
 *
 * Framework DPOS BISNIS berbasis PHP
 *
 * Developed by djavasoft.com
 * Copyright (c) 2018, Djavasoft Smart Technology
 *
 * @author	Mohamad Anton Arizal
 * @copyright	Copyright (c) 2018 Djavasoft. (https://djavasoft.com/)
 *
 *
*/



function sumData($table,$column,$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		$rs= PDO_FetchRow("select sum(".$column.") as sum_".$column." from ".$table." ".$arg."");
		$total = $rs["sum_".$column.""];
		return $total;
}

function checkData($table,$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		$rs= PDO_FetchRow("select count(*) from ".$table." ".$arg."");
		$total = $rs["count(*)"];
		return $total;
}

function doList($table,$column="",$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		$rs= PDO_FetchRow("select count(*) from ".$table." ".$arg."");
		$result["draw"] = 1;
		$result["recordsTotal"] = $rs["count(*)"];
		$result["recordsFiltered"] = $rs["count(*)"];
		$data=PDO_FetchAll("SELECT * FROM ".$table." ");
		return $data;
}

function doTable($table,$column,$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		$rs= PDO_FetchRow("select count(*) from ".$table." ".$arg."");
		$result["draw"] = 1;
		$result["recordsTotal"] = $rs["count(*)"];
		$result["recordsFiltered"] = $rs["count(*)"];
		$data=PDO_FetchAll("SELECT * FROM ".$table." ".$arg."");
		$items= array();	
		foreach($data as $row){			
			for($i=0;$i<count($column);$i++){
				//if($column[$i]=='harga_jual'){$row[$column[$i]]=currency($row[$column[$i]]);}
			$col[$i]=$row[$column[$i]];
			}			
			$items[] = $col;
		}
		$result["data"] = $items;
		echo json_encode($result);
}
function doDelete($table,$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		
		PDO_Execute("DELETE FROM ".$table." ".$arg."");

}

function doInsert($table,$column="",$values=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		PDO_Execute("INSERT INTO  ".$table." 
		
		(".$column.") 
		
		VALUES 
		
		(".$values.")
		
		");

}

function doUpdate($table,$param="",$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		PDO_Execute("UPDATE  ".$table." SET

		".$param."
		
		".$arg."
		
		");

}

function lastInsert($table,$column,$arg=""){
	global $db_file;
		PDO_Connect("sqlite:$db_file");
		$data=PDO_FetchRow("select $column from ".$table." ".$arg." ORDER BY $column DESC LIMIT 1");
		return $data['id'];
}

function getFaktur($type){
	
$fktID=lastInsert("faktur","id","");
$fktID=$fktID+1;
$fktID=$type."-".date("Ymd").'-'.sprintf("%04d", $fktID);
return $fktID;
}


?>

