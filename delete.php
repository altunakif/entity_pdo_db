<?php
require "entity_pdo.php";

$delete = new dataBase();
$delete -> from('haberler')
		-> delete()
		-> where ("aid = 55")
		-> run();
		
var_dump($delete->sql);	
var_dump($delete->result);		
?>