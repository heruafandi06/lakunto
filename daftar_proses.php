<?php
include "koneksi.php";
$user = $_POST['user'];
$pass = $_POST['pass'];
$nama_customer = $_POST['nama_customer'];
$cekuser = mysql_query("SELECT * FROM customer WHERE username = '$user'");
if(mysql_num_rows($cekuser)==1) {
echo "<script>alert('Username sudah terdafar')</script>";
} else {
$simpan = mysql_query("INSERT INTO customer(username, password, nama_customer) VALUES('$user', MD5('$pass'), '$nama_customer')");
if($simpan==true) {
echo "<script>alert('Pendaftaran sukses, silahkan login')</script>";
} else {
echo "<script>alert('Pendaftaran gagal')</script>";;
}
}
?>
<meta http-equiv="refresh" content="1;URL=index.php">