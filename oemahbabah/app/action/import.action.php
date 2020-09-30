<?php 

if(isset($_FILES['fileExcel']['tmp_name']))
{
include 'libraries/Helper/excel_reader.php'; 
$excel = new PhpExcelReader;

if(is_array($_FILES)) 
{
	if(is_uploaded_file($_FILES['fileExcel']['tmp_name'])) 
	{
		$sourcePath = $_FILES['fileExcel']['tmp_name'];
		$targetPath = "files/import.xls";
		//if(file_exists($targetPath)){unlink($targetPath);}
		if(move_uploaded_file($sourcePath,$targetPath)) 
		{
			flush();
		}
	}
}


$excel->read($targetPath);
$sheet=$excel->sheets[0];
$data='';
$hasil='<table class="table table-bordered">';
//$hasil.='<thead><tr><th>';
$rows=$sheet['numRows'];
  $x = 2;
  
  while($x <= $rows) {
    $y = 1;	
	if($_POST['fileTable']=='daftar_barang')
	{
		$data .= 'INSERT INTO `daftar_barang`(`kode_barang`,`nama_barang`,`kategori_barang`,`satuan`,`harga_beli`,`harga_jual`,`stok`,`stok_minimal`,`lokasi`,`ukuran`,`warna`,`merek`,`expired`) VALUES (';
	}
	if($_POST['fileTable']=='pelanggan')
	{
		$data .= 'INSERT INTO `pelanggan` (`nama_pelanggan`,`alamat`,`kota`,`no_hp`,`email`) VALUES (';
	}
	if($_POST['fileTable']=='supplier')
	{
		$data .= 'INSERT INTO `supplier` (`nama_supplier`,`alamat`,`kota`,`no_hp`,`email`,`website`) VALUES (';
	}
	$data .= "";
	$hasil.='<tr>';
	$cols=$sheet['numCols'];
    while($y <= $cols) 
	{
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
	  if($y == $cols){
      $data .= '"'.xString($cell).'"'; 
	  }else{
      $data .= '"'.xString($cell).'",'; 
	  }	  
	  $hasil.='<td>'.xString($cell).'</td>';
      $y++;
    }
	
    $data .= ");";
    $data .= "<br/>";
    $hasil .= "</tr>";
    $x++;
  }
$hasil.='</table>';

$data=explode('<br/>',$data);
$totalData=count($data) - 1;
foreach($data as $sql){
	if( $sql!=''){
		if($database_engine=='sqlite'){
			if($db->exec($sql)){
					$success='style="display:block"';

			}else{
					echo '<br><pre>QUERY GAGAL DIPROSES!</pre>';
					$success='style="display:none"';
					//echo '<pre>'.$sql.'</pre><br>';

			}
		}elseif($database_engine=='mysql'){
			$mysqli = new mysqli($db->dbHost, $db->dbUser, $db->dbPass, $db->dbName);
			if (mysqli_connect_errno()) { /* check connection */
				printf('Connect failed: %s\n', mysqli_connect_error());
				exit();
			}
				if ($mysqli->multi_query($sql)) {
						//echo '<pre>'.$sql.'<br></pre>';
						$success='style="display:block"';

				}else{
						echo '<br><pre>QUERY GAGAL DIPROSES!</pre>';
						$success='style="display:none"';
						//echo '<pre>'.$sql.'</pre><br>';

				}
		//$db->query($sql);
		}
		}
}

//echo $hasil;
?>
<br>
<div <?=$success;?>>
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Jumlah data : <?php echo $totalData;?><br>
<h5>Data Berhasil diupload!</h5>
</div>
</div>

<?php
}