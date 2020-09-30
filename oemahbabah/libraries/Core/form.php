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


function form_data_post($field){
	$data=$_POST[$field];
	return $data;
}

function form_data_get($field){
	$data=$_GET[$field];
	return $data;
}

function form_data_request($field){
	$data=$_REQUEST[$field];
	return $data;
}

function form_button($name="",$id="",$class="form-control",$value="", $args=""){
	$input='<button autocomplete=off name="'.$name.'" id="'.$id.'" class="'.$class.'" '.$args.'>'.$value.'</button>';
	return $input;
}

function form_input($name="",$id="",$class="form-control",$value="", $args=""){
	$input='<input autocomplete=off name="'.$name.'" id="'.$id.'" class="'.$class.'" value="'.$value.'" '.$args.'>';
	return $input;
}

function form_input_hidden($name="",$id="",$value=""){
	$input='<input type="hidden"  name="'.$name.'" id="'.$id.'" value="'.$value.'" >';
	return $input;
}

function form_textarea($name="",$id="",$class="form-control",$value="", $args=""){
	$input='<textarea autocomplete=off name="'.$name.'" id="'.$id.'" class="'.$class.'" '.$args.'>'.$value.'</textarea>';
	return $input;
}

function form_swal_success($data="'Data berhasil ditambahkan'"){
	$swal="swal(
		{
			title: 'Sukses!',
			text: ".$data.",
			type: 'success',
			timer: 2000
		}
		);";
	return $swal;
}

function form_swal_delete($data="''"){
	$swal="
	swal({
	  title: 'Hapus',
	  html: 'Anda ingin menghapus data ini? <br> ' + ".$data.",
	  type: 'warning',
	  
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Ya, Hapus!'
	}).then((result) => {
	  if (result.value) {
		swal({  
		title: 'Hapus',
		text: 'Data berhasil dihapus',
		type: 'success',
		timer: 2000
	}
	);
	";
	return $swal;
}