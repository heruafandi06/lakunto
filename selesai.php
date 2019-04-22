<?php
session_start();
include "koneksi.php";
$username = $_SESSION['nama_customer'];
/*Masukkan ke tabel pemesanan*/
$idnya = date("Ymdhis");
mysql_query("INSERT INTO pemesanan VALUES('$idnya', '$username', NOW(), '', '', '', '0', '', '', '', '' )");
$query = mysql_query("SELECT * FROM keranjang WHERE username = '$username' ");
while($keranjang = mysql_fetch_array($query)){
	mysql_query("INSERT INTO pemesanan_detail VALUES('$idnya', '$keranjang[id_produk]', '$keranjang[jumlah]')");
}
mysql_query("DELETE FROM keranjang WHERE username = '$username' ");
?>
<meta http-equiv="refresh" content="0;URL=keranjang_tujuan.php?id=<?php echo $idnya; ?>" />