<?php
//Koneksi ke database
//Host local
$host 	= "localhost";
$user	= "root";
$pass	= "";
$db		= "handphone";

mysql_connect($host, $user, $pass) or die (mysql_error());
mysql_select_db($db) or die ("Tidak terdapat database dengan nama <b><i>\"$db\"</i></b>");

?>

