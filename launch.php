<?php
include_once"db.php";
db_import(db_connect(),"Blogg.sql");
echo("done");

?>