<?php
session_start();
include "koneksi.php";
?>
<html>
	<head>
		<title>Tujuan Pengiriman</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>

function kota_warning(){
    var x = document.getElementById('kota_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Pilih kota';
}

function kota_warning1(){
    var x = document.getElementById('kota_w');
    x.innerHTML = '';
   
}
		

function kode_warning(){
    var x = document.getElementById('kode_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Silahkan masukan kode pos dengan benar';
}

function kode_warning1(){
    var x = document.getElementById('kode_w');
    x.innerHTML = '';
   
}

function alamat_warning(){
    var x = document.getElementById('alamat_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Silakan masukan alamat lengkap dengan benar';
}

function alamat_warning1(){
    var x = document.getElementById('alamat_w');
    x.innerHTML = '';
   
}
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
				<div class="background_pjg">Tujuan Pengiriman</div>
				<style>
				.input{
					border:1px #ddd9d9 solid;
					font-size:12px;
					padding:3px;
					width:150px;
				}
				.input:focus{
					background:#eee;
				}
				.kirim{
				border:1px #ddd9d9 solid;
				font-size:12px;
				padding:3px;
				}
				</style>
				<form method="POST" action="keranjang_tujuan_proses.php">
					<?php
						if(isset($_GET['id'])){
						echo "<input type='hidden' name='aksi' value='update'>";
						echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
						}
					?>
					<?php
						echo "<table style='position:relative;float:left;font-size:13px;left:10px;top:5px;'>";
						echo "<tr>";
						echo "<td>Kota Tujuan</td>";
						echo "<td>:</td>";
						echo "<td><select name='kota' class='input' onfocus='kota_warning()'onblur='kota_warning1()'>
							<option>Bandung</option>
							<option>Jakarta</option>
							<option>Surabaya</option>
							</select><span id='kota_w' style=''></span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td valign='top'>Alamat Lengkap</td>";
						echo "<td valign='top'>:</td>";
						echo "<td><textarea name='txtalamat' id='txtalamat' class='input' style='resize:none;' onfocus='alamat_warning()'onblur='alamat_warning1()' required></textarea><span id='alamat_w' style=''></span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td valign='top'>Kode Pos</td>";
						echo "<td valign='top'>:</td>";
						echo "<td><input type='text' name='kode_pos' id='kode_pos' class='input' onfocus='kode_warning()' onblur='kode_warning1()' onkeyup=\"javascript: var kode=0; if(isNaN(this.value)){ 
							alert('Harus Angka !'); this.value='';} document.getElementById('kode').innerHTML=kode;\" required><span id='kode_w' style=''></span></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td><input type='submit' value='Kirim' class='kirim' /></td>";
						echo "</tr>";
						echo "</table>";
					?>
				</form>	
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
