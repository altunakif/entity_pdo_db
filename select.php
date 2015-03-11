<?php
require 'entity_pdo.php';

$select = new dataBase();
$select -> from('haberler')
		-> select()
		-> run();
		
$select = new dataBase();
$select -> from('haberler')
		-> select("id, baslik")
		-> run();
		
$select = new dataBase();
$select -> from('haberler')
		-> select("*")
		-> where ("id >5")
		-> andWhere("id < 8")
		-> run();	
		
$select = new dataBase();
$select -> from('haberler')
		-> select("*")
		-> where ("baslik")
		-> like ("'%Kin%'")
		-> groupBy("baslik")
		-> having("id < 15")
		-> orderBy("id DESC")
		-> limit("0,3")
		-> run();			
				
				
var_dump($select->sql);
var_dump($select->result);		
?>