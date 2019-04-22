<?php
session_start();
include "koneksi.php";
include "functions.php"; 
?>
<html>
	<head>
		<title>History</title>
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
				<div class="background_pjg">History Transaksi</div>
				<?php 
				$nama_customer = $_SESSION['nama_customer'];
				$sql = mysql_query("SELECT * FROM pemesanan WHERE username='$nama_customer'");
				$jumlah = mysql_num_rows($sql);
				if($jumlah == 0){
				echo "<div style='position:relative;top:10px;left:15px'>Belum ada data transaksi</div>";
				}else{
				?>
					<table width="95%" style="border-collapse:collapse;border:1px solid #ccc;position:relative;float:left;margin-left:10px;margin-top:10px;margin-bottom:10px;text-align:center;">
						<tr style="background:url(images/img/menu_bg.gif) repeat-x;;color:#ffffff;">
							<th>No.</th><th>Kode Pemesanan</th><th>Tanggal</th>
							<th>Status</th><th>Aksi</th>
						</tr>
							<?php
							$no=1;
							$sql = mysql_query("SELECT * FROM pemesanan WHERE username='$nama_customer' ORDER BY tanggal DESC");
							$jumlah = mysql_num_rows($sql);
							while($row=mysql_fetch_array($sql)){
							echo "<tr>
							<td>".$no++.".</td>
							<td>".$row['id_pemesanan']."</td>
							<td>".SearchDay($row['tanggal']).", ".ReportDate($row['tanggal'])."</td>
							<td>";
							if($row['status']==0){
							echo "<img src='images/img/tunggu.png'>";
							}else if($row['status']==1){
							echo "<img src='images/img/proses.png'>";
							}else if($row['status']==2){
							echo"<img src='images/img/konfirmasi.png'>";
							}
							echo "
							</td>
							<td><a href='check.php?idpemesanan=".$row['id_pemesanan']."'><img src='images/img/view.png'></a></td>
							</tr>
							";
							}
							?>
					</table>
					<?php
					echo "<div style='margin-left:10px'>Jumlah total transaksi pemesanan : <b>$jumlah</b></div>";
					?><br>
					<b style='position:relative;top:10px;left:10px'>Keterangan :</b>
					<table style="position:relative;top:15px;left:10px;font-size:12px;">
						<tr>
							<td><img src="images/img/tunggu.png"></td><td>:</td><td>Menunggu pembayaran</td>
						</tr>
						<tr>
							<td><img src="images/img/proses.png"></td><td>:</td><td> Dalam proses pengiriman</td>
						</tr>
						<tr>
						<td><img src="images/img/konfirmasi.png"></td><td>:</td><td>Barang sedang dikirim oleh kurir kami</td>
						</tr>
					</table><br>
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
</html>
