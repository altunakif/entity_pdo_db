<?php
require 'DataBase.php';

/*$select = new DataBase();
$select -> from('haberler')
		-> select()
		-> run();*/
		
/*$select = new DataBase();
$select -> from('haberler')
		-> select("id, baslik")
		-> run();*/
		
/*$select = new DataBase();
$select -> from('haberler')
		-> select("*")
		-> where ("id", ">", "5")
		-> andWhere("id", "<", "8")
		-> run();*/
		
/*$select = new DataBase();
$select -> from('haberler')
		-> select("*")
		-> where ("id", ">", "5")
		-> orWhere("id", "<", "8")
		-> run();*/	
		
/*$select = new DataBase();
$select -> from('haberler')
		-> select("*")
		-> where ("baslik")
		-> like ("%Kin%")
		-> groupBy("baslik")
		-> having("id", "<", "15")
		-> orderBy("id", "DESC")
		-> limit(0,3)
		-> run();*/
		
/*$select = new DataBase();
$select -> from('haberler as h')
		-> select("h.id, h.baslik, i.ilid, i.Sehir")
		-> innerJoin("iller as i")
		-> run();*/						
				
				
var_dump($select->sql);
var_dump($select->bindPar);
var_dump($select->result);
		
?>