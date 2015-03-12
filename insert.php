<?php
require 'entity_pdo.php';

$array = array(baslik =>"'yeni Başlık'", icerik=>"'Yeni içerik'");

$insert = new DataBase('localhost','k_dbo','root','');
$insert->from('haberler')
	   ->insert($array)
	   ->run();

$insert = new DataBase();
$insert->from('haberler')
	   ->insert("baslik, icerik", "'yeni Başlık','Yeni içerik'")
	   ->run();
	   
	   
var_dump($insert->sql);
var_dump($insert->result);	   
?>