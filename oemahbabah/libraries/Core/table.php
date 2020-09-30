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


function dataTable($class="table table-bordered table-hover",$id="dataTable",$ths,$tfs){
$table = '	<table class="'.$class.'" id="'.$id.'" width="100%" cellspacing="0">
			<thead>
				<tr>
				';
				foreach($ths as $th)
				{
				$table .= '	<th>'.$th.'</th>';
				}

				$table .='
				</tr>
			</thead>
			<tfoot>
				<tr>
				';
				foreach($tfs as $tf)
				{
				$table .= '	<th>'.$tf.'</th>';
				}	  
				$table .='
				</tr>
			</tfoot>
		</table>
		';
	
	return $table;
}