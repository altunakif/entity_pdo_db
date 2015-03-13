<?php
require 'DataBase.php';

$array 	= array(baslik=>"Update Baslik", icerik=>"Update icerik");
$update = new DataBase();
$update ->from('haberler')
		->update($array)
		->where("aid", "=", "58")
		->run();
		
var_dump($update->sql);
var_dump($update->bindPar);
var_dump($update->result);		

?>