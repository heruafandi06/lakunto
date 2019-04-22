<?php
session_start();
include "koneksi.php";
$user	= $_POST['user'];
$pass	= $_POST['pass'];
$query	= "SELECT username, nama_customer FROM customer WHERE username = '$user' AND password = MD5('$pass')";
$proses	= mysql_query($query) or die (mysql_error());
$jumlah	= mysql_num_rows($proses);
if($jumlah == 0){
echo "<script>alert('Login gagal');</script>";
}else{
list($username, $nama_customer) = mysql_fetch_row($proses);
$_SESSION['nama_customer'] = $nama_customer;
}
?>
<meta http-equiv="refresh" content="1;URL=index.php">