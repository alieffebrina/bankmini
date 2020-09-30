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


function upload_zip($dir,$field,$success_message){
	
	$filename = $_FILES[$field]["name"];
	$source = $_FILES[$field]["tmp_name"];
	$type = $_FILES[$field]["type"];
	
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "The file you are trying to upload is not a .zip file. Please try again.";
	}
  /* PHP current path */
//  $path = 'moduls/';  // absolute path to the directory where zipper.php is in
  $path = $dir.'/';  // absolute path to the directory where zipper.php is in
  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
  $targetdir = $path . $filenoext; // target directory
  $targetzip = $path . $filename; // target zip file
  if (is_dir($targetdir))  rrmdir ( $targetdir);     
  mkdir($targetdir, 0777);  
  /* here it is really happening */	
	if(move_uploaded_file($source, $targetzip)) {
		$zip = new ZipArchive();
		$x = $zip->open($targetzip);  // open the zip file to extract
		if ($x === true) {
			$zip->extractTo($path); // place in the directory with same name  
			$zip->close();
	
			unlink($targetzip);
		}
	echo $success_message;
	} else {	
		$message = "There was a problem with the upload. Please try again.";
	}
}

function upload_file_data($field,$arg)
{
/*
Type : [name] , [type] , [tmp_name] , [error] , [size]
*/
	$file_data = $_FILES[$field][$arg];
	return $file_data;
}

function image_data($file,$arg)
	{
		$file_data=@getimagesize($file);

		if($arg=='width'){
			return $file_data[0];

		}elseif($arg=='height'){
			return $file_data[1];

		}
	}


function file_ext($filename)
	{
		$x = explode('.', $filename);

		if (count($x) === 1)
		{
			return '';
		}

		$ext = strtolower(end($x));
		return '.'.$ext;
	}

function remove_spaces($filename)
	{
		return preg_replace('/\s+/', '_', $filename);
	}
function is_image($file)
	{
		// IE will sometimes return odd mime-types during upload, so here we just standardize all
		// jpegs or pngs to the same file type.

		$png_mimes  = array('image/x-png','image/png');
		$jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');

		if (in_array(get_file_data($file,'type'), $png_mimes))
		{
			$type = 'image/png';
		}
		elseif (in_array(get_file_data($file,'type'), $jpeg_mimes))
		{
			$type = 'image/jpeg';
		}
		else{
			$type = '';
		}

		$img_mimes = array('image/gif',	'image/jpeg', 'image/png');

		return in_array($type, $img_mimes, TRUE);
	}





