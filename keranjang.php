<?php
session_start();
if(empty($_SESSION['nama_customer'])){
	echo '<meta http-equiv="refresh" content="1;URL=produk.php?kategori=Semua Produk">';
	echo '<script>alert ("Anda harus login dulu sebagai member");</script>';
	exit;
}else{
?>
<?php
include "koneksi.php";
$username = $_SESSION['nama_customer'];
$id_produk = @$_GET['keranjang'];
if($id_produk==""){

}else{
$sql = mysql_query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$rows = mysql_fetch_array($sql);
if($rows["stok"] == 0){
	echo "<script>alert('Maaf, stok habis');</script>";
	echo "<meta http-equiv='refresh' content='0;url=index.php'>";
	exit;
}else{
/*Jika produk nya sudah ada, maka cukup tambah jumlah nya saja, jika belum, maka tambahkan produk nya sekaligus isi jumlah nya = 1*/
list($ada_produknya) = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM keranjang WHERE username = '$username' AND id_produk = '$id_produk' "));
if($ada_produknya == 0){
	/*Masuk ke tabel keranjang*/
mysql_query("INSERT INTO keranjang VALUES('$username', '$id_produk', '1')");
}else{
	/*Tambahkan jumlahnya saja*/
	mysql_query("UPDATE keranjang SET jumlah = (jumlah + 1) WHERE username = '$username' AND id_produk = '$id_produk' ");
}
}
}
?>
<html>
	<head>
		<title>Keranjang</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".update_keranjang").keyup(function(){
					var id = this.name;
					var aksi = "update_keranjang";
					var jumlah = this.value;
					var url = "keranjang_tujuan_proses.php";
					var dataString = "aksi="+aksi+"&id_produk="+id+"&jumlah_produk="+jumlah;
					
					$.ajax({
						url : url,
						data : dataString,
						dataType : "json",
						type : "POST",
						success : function(jsonText){
							var pesan = jsonText["pesan"];
						}
					});
				});
			});
		</script>
	</head>
<body>
	<div id="main">
		<div id="header">
		<div id="logo"><img src="images/img/logo.png"></div>
		</div>
			<div id="konten">
				<div id="menu_tab">
					<ul class="menu">
						<li><a href="index.php" class="nav"> Beranda </a></li>
						<li class="bg"></li>
						<li><a href="produk.php?kategori=Semua Produk" class="nav">Produk</a></li>
						<li class="bg"></li>
						<li><a href="pemesanan.php" class="nav">Cara Pemesanan</a></li>
						<li class="bg"></li>
						<li><a href="tentang.php" class="nav">Tentang Kami</a></li>
					</ul>
				</div>
			<div class="kiri">
				<div class="background">Login</div>
					<style>
						.masuk{
						margin-top:5px;
						}
						.masuk img{
						margin-right:5px;
						}
						.masuk td{
						font-size:10px;
						}
						.masuk a{
						text-decoration:none;
						color:black;
						}
						.masuk a:hover{
						color:blue;
						text-decoration:underline;
						}
					</style>
					<?php 
						$nama_customer = @$_SESSION['nama_customer'];
						if(empty($nama_customer)){
							
					
					echo"<form method='POST' action='login_proses.php'>";
					echo"<input type='text' name='user' placeholder='Username' class='login' required>";
					echo"<input type='password' name='pass' placeholder='Password' class='login' required>";
					echo"<input type='submit' value='Login' class='login'>";
					echo"<a class='login' href='daftar.php'>Daftar</a>";
					echo"</form>";
						}else{
							echo "<div class='masuk'>";
							echo "<table>";
							echo "<tr>";
							echo "<td><img src='images/img/user.png'>Selamat Datang, <b>$nama_customer</b></td>";
							echo "<tr>";
							echo "<td><a href='keranjang.php'><img src='images/img/cart.png'>Keranjang Belanja</a></td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td><a href='histori.php'><img src='images/img/history.png'>History</a></td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td><a href='logout.php'><img src='images/img/logout.png'>Keluar</a></td>";
							echo "</tr>";
							echo "</table>";
							echo "</div>";
						}
					?>
				<div class="background">Brands</div>
					<?php
						$sql="SELECT * FROM kategori ORDER BY nama ASC";
						$query=mysql_query($sql);
						while ($row = mysql_fetch_array($query)){
					?>
					<ul class="menu_kiri">
						<li class="back"><a href="produk.php<?php echo $row['url'];?>"><?php echo $row['nama']; ?></a></li>
					</ul>
					<?php
						}
					?>
			</div>
			<div class="tengah">
				<div class="background_pjg">Keranjang Belanja</div>
				<?php 
				$nama_customer = $_SESSION['nama_customer'];
				$sql = mysql_query("SELECT * FROM keranjang WHERE username='$nama_customer'");
				$jumlah = mysql_num_rows($sql);
				if($jumlah == 0){
				echo "<div style='position:relative;top:10px;left:15px'>Anda belum memiliki keranjang belanja atau belum memilih barang satu pun.</div>";
				}else{
				?>
					<table width="95%" style="border-collapse:collapse;border:1px solid #ccc;position:relative;float:left;margin-left:13px;margin-top:10px;text-align:center;">
						<tr style="background:url(images/img/menu_bg.gif) repeat-x;;color:#ffffff;">
							<th>No.</th><th>Produk</th><th>Harga</th>
							<th>Jumlah</th><th>Subtotal</th><th>Aksi</th>
						</tr>
							<?php
							$query = mysql_query("SELECT A.id_produk, B.nama, B.harga, B.stok, A.jumlah FROM keranjang AS A INNER JOIN produk AS B ON (A.id_produk=B.id_produk) WHERE username = '$username' ");
							$jumlah = mysql_num_rows($query);
							$no=1; 
							$grand_total = 0;
							while($isi = mysql_fetch_array($query)){
							echo "<tr>";
							echo "<td>$no.</td>";	
							echo "<td>$isi[nama]</td>";
							echo "<td><input size='15' type='text' name='txtharga$no' id='txtharga$no' value='$isi[harga]' style='text-align:center;' readonly value='='$isi[harga]'/></td>";
							echo "<td><input size='2' type='text' name='".$isi['id_produk']."' id='txtjumlah$no' class='update_keranjang' onkeyup=\"javascript: var grandtotal=0;							
							document.getElementById('txtsubtotal$no').value=document.getElementById('txtharga$no').value*document.getElementById('txtjumlah$no').value; 
							for(i=1; i<=$jumlah; i++){ 
							grandtotal += parseInt(document.getElementById('txtharga'+i).value*parseInt(document.getElementById('txtjumlah'+i).value)); }

							if(isNaN(this.value)){ 
							alert('Harus Angka !'); this.value=''; 
							
							}else if(".$isi['stok']." <(this.value)){
							alert('Stok hanya tersedia : $isi[stok]'); this.value='';
							} 

							document.getElementById('grandtotal').innerHTML=grandtotal;\" value='$isi[jumlah]' style='text-align:center;'/></td>";
							
							$subtotal = $isi['harga']*$isi['jumlah'];
							echo "<td align='right'><input type='text' name='txtsubtotal$no' id='txtsubtotal$no' readonly value='$subtotal' style='text-align:center'	 /></td>";
							echo "<td width='10%'><a href='#' title='Hapus' onclick=\"javascript: if (confirm('Yakin dihapus?')){
							window.location.href='keranjang_tujuan_proses.php?aksi=Hapus&id=".$isi['id_produk']."';}\"><img src='images/img/hapus.png' style='margin-right:2px;'></a></td>";
							echo "</tr>";
							$no++;
							$grand_total = $grand_total + $subtotal;
							}
							?>
					</table>
					<table align="right" style="margin-top:7px;margin-right:20px;">
					<?php
					echo "<tr>
					<td colspan='4' style='color:#000;'><b>Grand Total : </b></td>
					<td colspan='2' style='color:#000;'><span id='grandtotal'>$grand_total</span></td></tr>";
					?>
					</table>
					<input type="button" value="Lanjut Belanja" onclick="javascript: window.location.href='produk.php?kategori=Semua Produk';" style="cursor:pointer;margin-top:7px;margin-left:10px;width:100;height:30;border-radius:3px;" class="login" />
					<input type="button" value="Selesai" onclick="javascript: window.location.href='selesai.php';" style="cursor:pointer;margin-left:0;width:100px;height:30px;border-radius:3px;" class="login" />
				<?php
				}
				?>
			</div>
			<div class="kanan">
				<div class="background">Pencarian</div>
					<form action="cari.php" method="POST" name="cari">
						<input type="text" name="cari" class="cari" placeholder="Kata Kunci ...">
						<input type="submit" value="cari" class="cari">
					</form>
			</div>
		</div>
		<div class="footer">
			<div class="footer_kiri">UKK &copy; 2015<br /><br />
				<img src="images/img/payment.gif" alt="" />
			</div>
			<div class="footer_tengah">Powered by <a href="hhtp:/facebook.com/sahabatnoah24" target="_blank">Heru Afandi</a>
			</div>
			<div class="footer_kanan"> 
				<a href="index.php">Beranda</a> 
				<a href="produk.php">Produk</a> 
				<a href="kontak.php">Kontak Kami</a> 
				<a href="tentang.php">Tentang Kami</a> 
			</div>
		</div>
</div>
</body>
<?php
}
?>
</html>
