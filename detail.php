<?php
session_start();
include "koneksi.php";
?>
<html>
	<head>
		<title>Detail</title>
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/cloud-zoom.1.0.3.min.js"></script>
		<link href="cloud-zoom.css" type="text/css" rel="stylesheet" />
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
				<div class="background_pjg">Detail Produk</div>
				<?php
					$id_produk = $_GET['detail'];
					$sql = mysql_query("SELECT * FROM produk INNER JOIN detail ON produk.id_produk=detail.id_produk WHERE produk.id_produk = $id_produk");
					while($row=mysql_fetch_array($sql)){
					
					$harga	= number_format($row['harga'],.2,",",".");
				?>
			
			<div class="kotak_detail_produk">
				<div class="produk_tengah">
					<div class="gambar_produk"><img src="admin/<?php echo $row['gambar']; ?>"></a></div>
					<div class="kotak_detail">
					<div class="nama_produk"><?php echo $row['nama']; ?></div>
					<div class="produk_detail"> 
					Stok : <span class="blue"><?php if($row['stok'] == '0'){ echo "Tidak Tersedia"; }else{ echo "Tersedia";} ?></span><br />
					Kategori : <span class="blue"><a href="produk.php?kategori=<?php echo $row['kategori']; ?>"><?php echo $row['kategori']; ?></a></span><br />
					Harga : <span class="harga">Rp <?php echo $harga ?></span>
					</div><br>
					<a href="keranjang.php?keranjang=<?php echo $row['id_produk']; ?>" class="beli">Beli</a>
					</div>
				</div>
			</div>
			<div class="deskripsi">Deskripsi Produk</div>
			<div class="tulisan"><?php echo $row['deskripsi']; ?></div>
			
			<div class="spesifikasi">
			Spesifikasi
			<table border="1" width="100%" style="border-collapse:collapse;">
				<tr>
					<td>Layar</td><td><?php echo $row['layar']; ?></td>
				</tr>
				<tr>
					<td>Memory</td><td><?php echo $row['memori']; ?></td>
				</tr>
				<tr>
					<td>RAM</td><td><?php echo $row['ram']; ?></td>
				</tr>
				<tr>
					<td>Internet</td><td><?php echo $row['internet']; ?></td>
				</tr>
				<tr>
					<td>OS</td><td><?php echo $row['os']; ?></td>
				</tr>
				<tr>
					<td>CPU</td><td><?php echo $row['cpu']; ?></td>
				</tr>
				<tr>
					<td>Kamera Depan</td><td><?php echo $row['kd']; ?></td>
				</tr>
				<tr>
					<td>Kamera Belakang</td><td><?php echo $row['kb']; ?></td>
				</tr>
				<tr>
					<td>Baterai</td><td><?php echo $row['baterai']; ?></td>
				</tr>
			</table>
			</div>
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
<script>jQuery('#zoom01, .cloud-zoom-gallery').CloudZoom();</script>
</body>
</html>
