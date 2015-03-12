<?php
require 'entity_pdo.php';

$array = array(baslik=>"'Update Baslik'", icerik=>"'Update icerik'");
$update = new DataBase();
$update ->from('haberler')
		->update($array)
		->where("aid = 56")
		->run();
		
$update = new DataBase();
$update ->from('haberler')
		->update("baslik = 'değisen başlık', icerik = 'değisen içerik'")
		->where("aid = 56")
		->run();		
		
var_dump($update->sql);
var_dump($update->result);		

?>