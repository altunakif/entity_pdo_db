<?php
require "DataBase.php";
$haberler = new DataBase();
$haberler ->from("haberler")
		  ->setBaslik("Düzeltilmiş Yeni Başlık")
		  ->setIcerik("Düzeltilmiş Yeni İçerik")
		  ->where("aid","=", 59)
		  ->run();
		  
var_dump($haberler->sql);
var_dump($haberler->bindPar);
var_dump($haberler->result);		  
?>