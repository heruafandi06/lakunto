<?php
session_start();
include "koneksi.php";
?>
<html>
	<head>
		<title>Konfirmasi</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="datepicker/lib/css/default.css" /> 
		<script src="datepicker/lib/jquery.min.js"></script>
		<script src="datepicker/lib/zebra_datepicker.js"></script>
 
    <script>
    $(document).ready(function(){
        $('#date').Zebra_DatePicker({
            format: 'Y/F/d',
            months : ['01','02','03','04','05','06','07','08','09','10','11','12'],
            days : ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'],
            days_abbr : ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu']
        });
    });
	
	function tanggal_warning(){
    var x = document.getElementById('tanggal_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Pilih tanggal transfer';
	}

	function tanggal_warning1(){
    var x = document.getElementById('tanggal_w');
    x.innerHTML = '';
   
	}
	
	function bank_warning(){
    var x = document.getElementById('bank_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Pilih bank transfer';
	}

	function bank_warning1(){
    var x = document.getElementById('bank_w');
    x.innerHTML = '';
   
	}
	
	function nama_warning(){
    var x = document.getElementById('nama_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Isi nama pengirim';
	}

	function nama_warning1(){
    var x = document.getElementById('nama_w');
    x.innerHTML = '';
   
	}
	
	function jumlah_warning(){
    var x = document.getElementById('jumlah_w');
    x.style.color = '#00f';
    x.style.fontSize = '12px';
    x.style.paddingLeft = '5px';
    x.innerHTML = 'Isi jumlah tanpa titik';
	}

	function jumlah_warning1(){
    var x = document.getElementById('jumlah_w');
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
				<div class="background_pjg">Konfirmasi Pembayaran</div>
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
				</style>
				<form method="POST" action="konfirmasi_proses.php">
				<?php
						if(isset($_GET['id'])){
						echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
						}
				?>
				<table style="position:relative;float:left;font-size:13px;left:10px;top:5px;">
					<tr>
						<td>Tanggal Konfirmasi</td><td>:</td><td><input type="text" name="tgl_konfirmasi" id="date" class="input" onfocus="tanggal_warning()" onblur="tanggal_warning1()"><span id="tanggal_w" style=""></span></td>
					</tr>
					<tr>
						<td>Bank Transfer</td><td>:</td><td><select name="bank" class="input" onfocus="bank_warning()" onblur="bank_warning1()">
						<option value="BCA" name="bank">BCA</option>
						<option value="Mandiri" name="bank">Mandiri</option>
						<option value="BRI" name="bank">BRI</option>
						</select>
						<span id="bank_w" style=""></span>
						</td>
					</tr>
					<tr>
						<td>Nama Pengirim</td><td>:</td><td><input type="text" class="input" name="nama_pengirim" onfocus="nama_warning()" onblur="nama_warning1()" required><span id="nama_w" style=""></span></td>
					</tr>
					<tr>
						<td>Jumlah</td><td>:</td><td><input type="text" class="input" name="jumlah_konfirmasi"  onfocus="jumlah_warning()" onblur="jumlah_warning1()" required><span id="jumlah_w" style=""></span></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><input type="submit" value="Kirim"></td>
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
