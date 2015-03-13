<?php
require "DataBase.php";

$delete = new DataBase();
$delete -> from('haberler')
		-> delete()
		-> where ("aid", "=", "36")
		-> run();
		
var_dump($delete->sql);	
var_dump($delete->result);		
?>