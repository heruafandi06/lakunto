<?php session_start(); ?>
<?php if(isset($_SESSION['username'])){ ?>
<?php 
include "koneksi.php"; 
include "../functions.php";
$id = $_GET['id'];
?>
<html>
<head>
<title>Administrator</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="main_container">
  <div class="top_bar">
	<style>
	.selamat{
	padding:10px;
	}
	</style>
	<div class="selamat" style="color:white;">Selamat datang, <b><?php echo $_SESSION['username']; ?>.</b></div>
	<a href="#" onclick="javascript: if (confirm('Yakin keluar?'))
	window.location.href='logout.php';" style="position:absolute;right:200px;top:-1px;opacity:0.6;"><img src="images/img/logout.png"></a>
  </div>
  <div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="index.php" class="nav1"> Home</a></li>
        <li class="divider"></li>
        <li><a href="produk.php" class="nav2">Produk</a></li>
        <li class="divider"></li>
        <li><a href="kategori.php" class="nav3">Kategori</a></li>
        <li class="divider"></li>
		<li><a href="detail.php" class="nav4">Detail</a></li>
        <li class="divider"></li>
        <li><a href="pemesanan.php" class="nav5">Pemesanan</a></li>
        <li class="divider"></li>        
      </ul>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->
    <div class="center_content"> 
	<?php
	$qData = " SELECT tanggal, username, kota, alamat_pengiriman, tanggal, bank, nama_pengirim, jumlah_konfirmasi, status FROM pemesanan WHERE id_pemesanan = '$id' ";
	$hqData = mysql_query($qData) or die (mysql_error());
	list($tanggal, $username, $kota, $alamat_pengiriman, $tgl_pembayaran, $bank, $nama_pengirim, $jumlah_pembayaran, $status) = mysql_fetch_row($hqData);
	?>
	<table>
		<tr>
			<td>
				<table>
					<tr>
						<td>Tanggal&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo SearchDay($tanggal).", ".ReportDate($tanggal); ?></td>
					</tr>
					<tr>
						<td>Username&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo $username; ?></td>
					</tr>
					<tr>
						<td>Alamat&nbsp;Pengiriman</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php echo "$alamat_pengiriman, $kota" ?></td>
					</tr>
					<tr>
						<td>Status&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($status == '0') echo "<span style='color:red;'>Menunggu pembayaran</span>"; else if($status == '1') echo "<span style='color:green;'>Dalam proses pengiriman</span>"; else echo "<span style='color:blue;'>Barang sudah dikirim</span>";?></td>
					</tr>
					<tr><td colspan="3"><hr style="border:1px solid grey;"></td></tr>
					<tr>
						<td>Tanggal&nbsp;Pembayaran</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($tanggal == '0000-00-00 00:00:00') echo "-"; else echo SearchDay($tanggal).", ".ReportDate($tgl_pembayaran); ?></td>
					</tr>
					<tr>
						<td>Bank&nbsp;Transfer</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($bank == '') echo "-"; else echo $bank; ?></td>
					</tr>
					<tr>
						<td>Nama&nbsp;Pengirim</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?php if($nama_pengirim == '') echo "-"; else echo $nama_pengirim; ?></td>
					</tr>
					<tr>
						<td>Jumlah&nbsp;Pembayaran</td>
						<td>&nbsp;:&nbsp;</td>
						<td>Rp <?php if($bank == '0') echo "-"; else echo number_format($jumlah_pembayaran, 0, ',', '.'); ?></td>
					</tr>
					<tr><td colspan="3"><hr style="border:1px solid grey;"></td></tr>
					<tr>
						<td colspan="3">
							<table cellspacing="8">
								<tr>
									<td>No.</td>
									<td>Produk</td>
									<td>Harga</td>
									<td>Jumlah</td>
									<td>Subtotal</td>
								</tr>
								<?php
								$qData = "SELECT B.nama, B.harga, A.jumlah FROM pemesanan_detail AS A INNER JOIN produk AS B ON (A.id_produk = B.id_produk) WHERE A.id_pemesanan = '$id'";
								$hqData = mysql_query($qData);
								$grandTotal = 0;
								$no=1;
								while(list($nama, $harga, $jumlah) = mysql_fetch_row($hqData)){
									$subtotal = (int)$harga * (int)$jumlah;
									echo "<tr>";
										echo "<td align='center'>$no.</td>";
										echo "<td>$nama</td>";
										echo "<td align='right'>Rp ".number_format($harga, 0, ',', '.')."</td>";
										echo "<td align='center'>$jumlah</td>";
										echo "<td align='center'>Rp ".number_format($subtotal, 0, ',', '.')."</td>";
										
									echo "</tr>";
									$grandTotal += $subtotal;
									
									$no++;
								}
								echo "<tr>";
								echo "<td colspan='4' align='center'>Jumlah Total</td>";
								echo "<td align='right'>Rp ".number_format($grandTotal, 0, ',', '.')."</td>";
								echo "</tr>";
								$biayaKirim = 0;
								if($kota == 'Bandung'){
			$biayaKirim = 16000;
		}else if($kota == 'Jakarta'){
			$biayaKirim = 17000;
		}else if($kota == 'Surabaya'){
			$biayaKirim = 5000;
		}
		
			echo "<tr>";				
				echo "<td align='center' colspan='4'>Biaya Pengiriman</td>";
				echo "<td align='right'>Rp ".number_format($biayaKirim,.2,",",".")."</td>";
			echo "</tr>";
			
								$totalBiaya = $grandTotal + $biayaKirim;
								echo "<tr>";
								echo "<td colspan='4' align='center'><b>Total</b></td>";
								echo "<td align='right'><b>Rp ".number_format($totalBiaya, 0, ',', '.')."</b></td>";
								echo "</tr>";
								?>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
    </div>
    <!-- end of center content -->
  </div>
  <!-- end of main content -->
  <div class="footer" style="position:relative;top:490px;">
    <div class="center_footer">UKK &copy; 2015</div>
  </div>
</div>
<!-- end of main_container -->
</body>
</html>
<?php 
}else{
header("location:login.php");
}
?>
