<?php
include "koneksi.php";
if(isset($_REQUEST['aksi'])) $aksi = $_REQUEST['aksi'];
else $aksi="";

switch($aksi){
case 'Tambah':
$iddet	= $_POST['txtiddet'];
$idprod	= $_POST['txtidprod'];
$layar	= $_POST['txtlayar'];
$memori	= $_POST['txtmemori'];
$ram	= $_POST['txtram'];
$internet= $_POST['txtinternet'];
$os	= $_POST['txtos'];
$cpu	= $_POST['txtcpu'];
$kd	= $_POST['txtkd'];
$kb	= $_POST['txtkb'];
$baterai	= $_POST['txtbaterai'];

$str = "INSERT INTO detail VALUES ('$iddet', '$idprod', '$layar', '$memori', '$ram', '$internet', '$os', '$cpu', '$kd', '$kb', '$baterai')";
$query = mysql_query($str) or die (mysql_error());

if($query == true){
echo"<script>alert('Berhasil')</script>";
} else{
echo "<script>alert('Gagal')</script>";
}

break;
case "Update":

$iddet	= $_POST['txtiddet'];
$idprod	= $_POST['txtidprod'];
$layar	= $_POST['txtlayar'];
$memori	= $_POST['txtmemori'];
$ram	= $_POST['txtram'];
$internet	= $_POST['txtinternet'];
$os	= $_POST['txtos'];
$cpu	= $_POST['txtcpu'];
$kd	= $_POST['txtkd'];
$kb	= $_POST['txtkb'];
$baterai	= $_POST['txtbaterai'];

$str = "UPDATE detail SET layar='$layar', memori='$memori', ram='$ram', internet='$internet', os='$os', cpu='$cpu', kd='$kd', kb='$kb', baterai='$baterai' WHERE id_detail = '$iddet' ";
$query = mysql_query($str);

if($query == true){
echo"<script>alert('Berhasil')</script>";
}else{
echo "<script>alert('Gagal')</script>";
}

break;

case "Hapus":

$iddet = $_GET['id'];
$query = mysql_query("DELETE FROM detail WHERE id_detail = '$iddet'");

if($query == true){
echo"<script>alert('Berhasil')</script>";
} else{
echo "<script>alert('Gagal')</script>";
}

break;
}
?>
<meta http-equiv="refresh" content="1;URL=detail.php">