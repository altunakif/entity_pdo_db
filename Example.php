<?php
require "DataBase.php";

$exe = new DataBase();
$exe ->from("haberler")
	 ->insert(array(baslik=>"'başlık'", icerik=>"'icerik'"))
	 ->run();
	 
$exe ->select()
	 ->run();

var_dump($exe->result);	 	 

?>