<?php
session_start();
include "koneksi.php";

if(isset($_REQUEST['aksi'])) $aksi = $_REQUEST['aksi'];
else $aksi="";
$aksi= $_REQUEST["aksi"];
switch($aksi){
case 'update' :
$id = $_POST['id'];
$kota = $_POST['kota'];
$alamat = $_POST['txtalamat'];
$kode_pos = $_POST['kode_pos'];
		$query = "UPDATE pemesanan SET kota =  '$kota',
		alamat_pengiriman =  '$alamat', kode_pos = '$kode_pos' WHERE id_pemesanan = '$id'";
		if(mysql_query($query) == true){
			echo"<script>alert('Berhasil')</script>";
			$sql = mysql_query("SELECT * FROM pemesanan_detail WHERE id_pemesanan='$id'");
			while($row = mysql_fetch_array($sql)){
				mysql_query("UPDATE produk SET stok=stok - ".$row['jumlah']." WHERE id_produk='".$row['id_produk']."'");
			}
			} else{
			echo "<script>alert('Gagal')</script>";
			}
			
break;
case 'update_keranjang' :
$id = $_POST['id_produk'];
$jumlah = $_POST['jumlah_produk'];
$username = $_SESSION['nama_customer'];
		$query = "UPDATE keranjang SET jumlah='$jumlah' WHERE id_produk='$id' AND username='$username'";
		if(mysql_query($query) == true){
				$pesan = "1";
			} else{
				$pesan = "2";
			}
$json = array("pesan"=>$pesan);
echo json_encode($json);
			
break;

case 'Hapus':
$id = $_GET['id'];
$username = $_SESSION['nama_customer'];
mysql_query ("DELETE FROM keranjang WHERE id_produk='$id' AND username='$username'");
echo '<meta http-equiv="refresh" content="0;URL=keranjang.php">';

break;
}
?>
<meta http-equiv="refresh" content="1;URL=check.php?idpemesanan=<?php echo $id ?> ">