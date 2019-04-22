<?php
session_start();
include "koneksi.php";
?>
<html>
	<head>
		<title>Daftar</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>

function username_warning(){
    var x = document.getElementById('username_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Username tidak lebih dari 20 karakter';
}

function username_warning1(){
    var x = document.getElementById('username_w');
    x.innerHTML = '';
   
}

function pass_warning(){
    var x = document.getElementById('pass_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Silahkan isi password dengan benar';
}

function pass_warning1(){
    var x = document.getElementById('pass_w');
    x.innerHTML = '';
   
}

function nama_warning(){
    var x = document.getElementById('nama_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Nama tidak lebih dari 20 karakter';
}

function nama_warning1(){
    var x = document.getElementById('nama_w');
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
				<div class="background_pjg">Daftar</div>
				<style>
					.daftar{
					diplay:block;
					margin-top:5px;
					margin-left:15px;
					border:1px #ddd9d9 solid;
					margin:5px 0 5px 17px;
					font-size:12px;
					padding:3px;
					width:150px;
					}
					.daftar:focus{
					background:#eee;
					}
				</style>
				<form action="daftar_proses.php" method="POST">
				<table style="position:relative;float:left;font-size:13px;left:10px;top:5px;">
				<tr>
				<td>Username</td> <td>:</td><td><input type="text" name="user" class="daftar" maxlength="20" onfocus="username_warning()" onblur="username_warning1()" required><span id="username_w" style=""></span></td>
				</tr>
				<tr>
				<td>Password</td> <td>:</td><td><input type="password" name="pass" class="daftar" onfocus="pass_warning()" onblur="pass_warning1()" required><span id="pass_w" style=""></span></td>
				</tr>
				<tr>
				<td>Nama</td> <td>:</td><td><input type="text" name="nama_customer" class="daftar" maxlength="20" onfocus="nama_warning()" onblur="nama_warning1()" required><span id="nama_w" style=""></span></td>
				</tr>
				<tr>
				<td></td>
				<td></td>
				<td><input type="submit" value="Daftar" class="login"></td>
				</tr>
				</table>
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
				<img src="images/payment.gif" alt="" />
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
