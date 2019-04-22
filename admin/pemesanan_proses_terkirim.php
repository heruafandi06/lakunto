<?php
include "koneksi.php";
if(isset($_REQUEST['aksi'])) $aksi = $_REQUEST['aksi'];
else $aksi="";

switch($aksi){
case "Update":
$id = $_GET['id'];

$query = mysql_query("UPDATE pemesanan SET status = 2 WHERE id_pemesanan='$id'");
if($query == true){
echo"<script>alert('Berhasil')</script>";
} else{
echo "<script>alert('Gagal')</script>";
}

break;
}
?>
<meta http-equiv="refresh" content="0;URL=pemesanan.php">