<?php
include "koneksi.php";
$id = @$_POST['id'];
$tanggal = $_POST['tgl_konfirmasi'];
$bank = $_POST['bank'];
$nama = $_POST['nama_pengirim'];
$jumlah = $_POST['jumlah_konfirmasi'];
$sql = "UPDATE pemesanan SET tanggal_konfirmasi='$tanggal', bank='$bank', nama_pengirim='$nama', jumlah_konfirmasi='$jumlah' WHERE id_pemesanan='$id'";
$query = mysql_query($sql);
if($query == true){
echo "<script>alert('Berhasil')</script>";
}else{
echo "<script>alert('Gagal	')</script>";
}
?>
<meta http-equiv="refresh" content="1;URL=histori.php">