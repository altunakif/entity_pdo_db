<?php
require "DataBase.php";
$haberler = new DataBase();
$haberler ->from("haberler")
		  ->getId()
		  ->getBaslik()
		  ->getIcerik()
		  ->where("aid","=", 35)
		  ->run();
		  
var_dump($haberler->sql);
var_dump($haberler->bindPar);
var_dump($haberler->result);
?>