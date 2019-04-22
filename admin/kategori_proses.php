<?php
session_start();
include "koneksi.php";
if(isset($_REQUEST['aksi'])) $aksi = $_REQUEST['aksi'];
else $aksi="";

switch($aksi){
case 'Tambah':
$id		= $_POST['txtid'];
$nama	= $_POST['txtnama'];
$url	= $_POST['txturl'];

$str = "INSERT INTO kategori VALUES ('$id', '$nama', '$url')";
$query = mysql_query($str) or die (mysql_error());

if($query == true){
echo"<script>alert('Berhasil')</script>";
} else{
echo "<script>alert('Gagal')</script>";
}

break;
case "Update":

$id		= $_POST['txtid'];
$nama	= $_POST['txtnama'];
$url	= $_POST['txturl'];

$str = "UPDATE kategori SET nama='$nama', url='$url' WHERE id_kategori = '$id' ";
$query = mysql_query($str) or die (mysql_error());

if($query == true){
echo"<script>alert('Berhasil')</script>";
} else{
echo "<script>alert('Gagal')</script>";
}

break;

case "Hapus":
$id = $_GET['id'];

$query = mysql_query("DELETE FROM kategori WHERE id_kategori = '$id'");

if($query == true){
echo"<script>alert('Berhasil')</script>";
} else{
echo "<script>alert('Gagal')</script>";
}
break;
}
?>
<meta http-equiv="refresh" content="1;URL=kategori.php">