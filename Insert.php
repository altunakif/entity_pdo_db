<?php
require 'DataBase.php';

$array = array(baslik =>"yeni Başlık", icerik=>"Yeni içerik");

$insert = new DataBase('localhost','k_dbo','root','');
$insert->from('haberler')
	   ->insert($array)
	   ->run();
	   
var_dump($insert->sql);
var_dump($insert->result);	   
?>