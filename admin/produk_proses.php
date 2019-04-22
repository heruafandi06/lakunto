<?php
include "koneksi.php";
if(isset($_REQUEST['aksi'])) $aksi = $_REQUEST['aksi'];
else $aksi="";

switch($aksi){
	case 'Tambah':
	$id		= $_POST['txtid'];
	$nama	= $_POST['txtnama'];
	$harga	= $_POST['txtharga'];
	$tanggal	= $_POST['txttanggal'];
	$kategori	= $_POST['txtkategori'];
	$stok	= $_POST['txtstok'];
	$deskripsi	= $_POST['txtdeskripsi'];

	$tipe	= $_FILES['filefoto']['type'];
	if($tipe == 'image/gif' || $tipe == 'image/png' || $tipe == 'image/jpeg'){

		$ukuran	= $_FILES['filefoto']['size'];
		if($ukuran < 100000){
		//buat folder foto
			if(!file_exists("images")){
				mkdir("images");
			}
			$asal	= $_FILES['filefoto']['tmp_name'];
			$tujuan	= "images/".$_FILES['filefoto']['name'];
			move_uploaded_file($asal, $tujuan);

			$str = "INSERT INTO produk VALUES ('$id', '$nama', '$tujuan', '$harga', '$tanggal', '$kategori', '$stok', '$deskripsi')";
			$query = mysql_query($str) or die (mysql_error());

			if($query == true){
			echo"<script>alert('Berhasil')</script>";
			} else{
			echo "<script>alert('Gagal')</script>";
			}

		}else{
			echo"<script>alert('Gambar terlalu besar')</script>";
		}

	}else{
		echo "<script>alert('Type harus gambar')</script>";
	}

	break;
	case "Update":

	$id		= $_POST['txtid'];
	$nama	= $_POST['txtnama'];
	$harga	= $_POST['txtharga'];
	$tanggal	= $_POST['txttanggal'];
	$kategori	= $_POST['txtkategori'];
	$stok	= $_POST['txtstok'];
	$deskripsi	= $_POST['txtdeskripsi'];
	if(isset($_POST['cbcek'])) $cek = $_POST['cbcek'];
	else $cek = "";

	if($cek == '1'){
	//hapus foto lama
	list($foto) = mysql_fetch_row(mysql_query("SELECT gambar FROM produk WHERE id_produk = '$id'"));
	if(file_exists($foto)){
	unlink($foto);
	}
	$asal	= $_FILES['filefoto']['tmp_name'];
	$tujuan	= "images/".$_FILES['filefoto']['name'];
	move_uploaded_file($asal, $tujuan);
	$str = "UPDATE produk SET nama='$nama', harga='$harga', tanggal='$tanggal', kategori='$kategori', stok='$stok', deskripsi='$deskripsi', gambar='$tujuan' WHERE id_produk = '$id' ";
	$query = mysql_query($str);
	}else{
	$str = "UPDATE produk SET nama='$nama', harga='$harga', tanggal='$tanggal', kategori='$kategori', stok='$stok', deskripsi='$deskripsi' WHERE id_produk = '$id' ";
	$query = mysql_query($str);
	}

	if($query == true){
	echo"<script>alert('Berhasil')</script>";
	} else{
	echo "<script>alert('Gagal')</script>";
	}

	break;

	case "Hapus":
	$id = $_GET['id'];
	list($foto) = mysql_fetch_row(mysql_query("SELECT gambar FROM produk WHERE id_produk = '$id'"));
	if(file_exists($foto)){
	unlink($foto);
	}
	$query = mysql_query("DELETE FROM produk WHERE id_produk = '$id'");

	if($query == true){
	echo"<script>alert('Berhasil')</script>";
	} else{
	echo "<script>alert('Gagal')</script>";
	}
	break;
}
?>
<meta http-equiv="refresh" content="1;URL=produk.php">