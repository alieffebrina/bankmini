<?php 
ob_start();
$serveruri=str_replace('/page.php?page=setup','',$_SERVER['REQUEST_URI']);

$version			= file_get_contents('app/version.txt');

$v=explode($version);


$config='app/version.txt';
$myfile=fopen($config,'w') or die('Gagal menemukan file');
$txt='2.6.'.date('y.m');

fwrite($myfile,$txt);
fclose($myfile);

echo 'Versi : '.$version .'<hr>';
echo 'Rilis : '.$txt ;