<?php
session_start();
include "koneksi.php";
include "functions.php"; 
?>
<html>
	<head>
		<title>Checkout</title>
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
				<div class="background_pjg">Data Pemesanan</div>
				<?php
						$idPemesanan = $_GET["idpemesanan"];
						$sql = "SELECT id_pemesanan, username, tanggal, kota, alamat_pengiriman, status, kode_pos FROM pemesanan WHERE id_pemesanan = '$idPemesanan'";
				
						$query = mysql_query ($sql) or die (mysql_error());
						while(list($idPemesanan, $nama, $tanggal, $kota, $alamat, $status, $kode_pos) = mysql_fetch_row($query)) {
						
	
	echo "<table width='75%' style='position:relative;left:15px;top:7px;'>";
		echo "<tr>";
			echo "<td width='35%'>Kode Pesanan</td>";
			echo "<td>:</td>";
			echo "<td><b>$idPemesanan</b></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Hari, Tanggal</td>";
			echo "<td>:</td>";
			echo "<td>".SearchDay($tanggal).", ".ReportDate($tanggal)."</td>";			
		echo "</tr>";
		echo "<tr>";
			echo "<td>Nama</td>";
			echo "<td>:</td>";
			echo "<td>$nama</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Alamat Pengiriman</td>";
			echo "<td>:</td>";
			echo "<td>$alamat, $kota</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Kode Pos</td>";
			echo "<td>:</td>";
			echo "<td>$kode_pos</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>Status</td>";
			echo "<td>:</td>";
			if($status == '0')	echo "<td><blink style='color:blue;font-weight:bold;'>MENUNGGU PEMBAYARAN</blink></td>";
			else if($status == '1') echo "<td><span style='color:blue;font-weight:bold;'>PROSES PENGIRIMAN BARANG</span></td>";
			else echo"<td><span style='color:blue;font-weight:bold;'>BARANG SUDAH DIKIRIM</span></td>";
		echo "</tr>";
	echo "</table>";
	echo "<p>&nbsp;</p>";
	echo "<table width='90%' border=1 style='position:relative;left:15px;top:7px;border-collapse:collapse;'>";
		echo "<tr style='background:#666;color:#fff'>";
			echo "<th >No.</th>";
			echo "<th>Nama Produk</th>";
			echo "<th>Harga</th>";
			echo "<th>Jumlah</th>";
			echo "<th>Subtotal</th>";
		echo "</tr>";
	$no=1; $x=0; $grandtotal = 0;
	$sql = "SELECT id_produk, jumlah FROM pemesanan_detail WHERE id_pemesanan = '$idPemesanan'";
	$query = mysql_query($sql);
	while(list($id_produk, $jumlah) = mysql_fetch_row($query)){
		list($nama, $harga) = mysql_fetch_row(mysql_query("SELECT nama, harga FROM produk WHERE id_produk = '$id_produk'"));
		echo "<tr>";
			echo "<td align='center'>$no.</td>";
			echo "<td align='center'>$nama</td>";
			echo "<td align='center'>Rp ".number_format($harga,.2,",",".")."</td>";
			echo "<td align='center'>$jumlah</td>";
			$subtotal = $harga * $jumlah;
			echo "<td align='right'>Rp ".number_format($subtotal,.2,",",".")."</td>";
		echo "</tr>";
		$grandtotal += $subtotal;
		$no++;
		$x++;
	}
		echo "<tr>";				
			echo "<td align='center' colspan='4'>Grand Total</td>";
			echo "<td align='right'><i>Rp ".number_format($grandtotal,.2,",",".")."</i></td>";
		echo "</tr>";
		if($kota == 'Bandung'){
			$biayaKirim = 16000;
		}
		
		else if($kota == 'Jakarta'){
			$biayaKirim = 17000;
		}
		
		else if($kota == 'Surabaya'){
			$biayaKirim = 5000;
		}
		
			echo "<tr>";				
				echo "<td align='center' colspan='4'>Biaya Pengiriman</td>";
				echo "<td align='right'><i>Rp ".number_format($biayaKirim,.2,",",".")."</i></td>";
			echo "</tr>";
			
		
		$totalBiaya = $grandtotal + $biayaKirim;
		echo "<tr>";				
			echo "<td align='center' colspan='4'><b>Total Biaya</b></td>";
			echo "<td align='right'><b>Rp ".number_format($totalBiaya,.2,",",".")."</b></td>";
		echo "</tr>";
	echo "</table>";
	echo "<p>&nbsp;</p>";
	echo "<p>";
	echo "<input type='button' value='Export PDF' onclick=\"javascript: window.open('invoice-pdf.php?id=$idPemesanan', '_blank', 'menubar=no, width=600, height=400');\"  style='position:relative;left:15px;top:7px;' />&nbsp;";
	echo "&nbsp;<input type='button' value='Print' onclick=\"javascript: window.print();\"  style='position:relative;left:15px;top:7px;' />";
	echo "</p>";
	
	echo "<ol  style='position:relative;top:7px;font-size:12px;'>
		<li>Segera lakukan pembayaran ke rekening kami :
			<ul>
				<li><span style='font-weight: bold;'>BCA</span> 470 0342 889 an: HERU AFANDI WINATA</li>
			</ul>
		</li>
		<li>Setelah melakukan pembayaran, segera lakukan konfirmasi <a style='cursor:pointer;color:blue;' href='konfirmasi.php?id=".$idPemesanan."';\">disini</a></li>
		<li>Barang akan dikirim paling lambat 3 hari setelah pembayaran. </li>
        <li>Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka barang pesanan anda kami batalkan.</li>
	</ol>";
	echo "<div class='content'></div>";
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
