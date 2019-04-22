<?php
session_start();
include "koneksi.php";
$user	= $_POST['user'];
$pass	= $_POST['pass'];
$query	= "SELECT username, nama FROM tb_admin WHERE username = '$user' AND password = MD5('$pass')";
$proses	= mysql_query($query) or die (mysql_error());
$jumlah	= mysql_num_rows($proses);
if($jumlah == 0){
echo "<script>alert('Login gagal');</script>";
}else{
list($username) = mysql_fetch_row($proses);
$_SESSION['username'] = $username;
}
?>
<meta http-equiv="refresh" content="1;URL=index.php">