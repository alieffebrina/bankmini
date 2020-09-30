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



function jquery_get($open,$fields,$close=false){
	
	$data='$.get("'.$open.'"+';
	
	foreach($fields as $field)
	{
	$data .= '"&'.$field.'="+'.$field.'+';
	}
	$data .= '""';
	if($close==TRUE)
	{
		$data .=');';
	}
	return $data;
	
}

function jquery_post($formID,$url='data.php',$success='',$error=''){
	?>
	$("#<?php echo $formID;?>").on('submit',(function(e) {
	e.preventDefault();
	$.ajax({
	url: "<?php echo $url;?>",
	type: "POST",
	data:  new FormData(this),
	contentType: false,
	cache: false,
	processData:false,
	success: function(data)
	{
	<?php echo $success;?>
	},
	error: function() 
	{
	<?php echo $error;?>
	} 	        
	});
	}));
<?php
}

?>