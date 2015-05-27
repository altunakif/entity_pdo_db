<?php
include_once('DataBase.php');

$select = new DataBase();
$select -> run("UPDATE drafts SET status=1 WHERE id=195");

var_dump($select->sql);
var_dump($select->bindPar);
var_dump($select->result);
?>