<?php
session_start();
include "koneksi.php";
?>
<html>
	<head>
		<title>Cara Pemesanan</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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
				<div class="background_pjg">Cara Pemesanan</div>
				<div style="position:relative;top:10px;font-size:12px;">
				<ol>
						<li><p align="left">Langkah pertama yang harus Anda lakukan adalah Login dengan menggunakan nama pengguna dan sandi yang telah Anda daftarkan sebelumnya.<br></li><li>Klik pada tombol&nbsp;<span style="font-weight: bold;">Beli</span> pada produk yang ingin Anda pesan.</p></li>
						<li><p align="left">Produk yang Anda pesan akan masuk ke dalam <span style="font-weight: bold;">Keranjang Belanja</span>. Anda dapat melakukan perubahan jumlah produk yang diinginkan dengan mengganti angka di kolom <span style="font-weight: bold;">Jumlah</span>. Sedangkan untuk menghapus sebuah produk dari Keranjang Belanja, klik tombol Tong Sampah yang berada di kolom paling kanan.</p></li>
						<li><p align="left">Jika sudah selesai, klik tombol <span style="font-weight: bold;">Selesai</span>, maka akan tampil form untuk pengisian data kustomer/pembeli.</p></li>
						<li><p align="left">Setelah data pembeli selesai diisikan, klik tombol <span style="font-weight: bold;">Kirim</span>, maka akan tampil data pembeli beserta produk yang dipesan (jika diperlukan catat nomor ordernya). Dan juga ada total pembayaran serta nomor rekening pembayaran.</p></li>
						<li><p align="left">Lakukan pembayaran melalui transfer ke rekening bank kami :</p>
						<ul>
							<li><span style="font-weight: bold;">BCA</span> 470 0342 889 an: HERU AFANDI WINATA</li>
						</ul>
						</li>
						<li><p align="left">Apabila pembayaran telah terlaksana, kami akan memproses pengiriman produk yang anda pesan.</p></li>
			</ol>
				</div>
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
</html>
