<?php sleep(1); ?>
<?php session_start();?>
<?php if(isset($_SESSION['username'])){ ?>
<?php include "koneksi.php"; ?>
<?php
if(isset($_GET['id'])){
$sql= "SELECT id_pemesanan, username, tanggal, alamat_pengiriman, kota, status FROM pemesanan WHERE id_pemesanan = '$_GET[id]'";
$query= mysql_query($sql);
}
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
<form method="POST" action="pemesanan.php" enctype="multipart/form-data">
Pencarian : <input type="text" name="txtkata" placeholder="Ketikkan Sesuatu ...">
<input type="submit" value="Cari">
</form>
<?php
//pagging
//1. cari banyak total data
$total = mysql_query("SELECT * FROM pemesanan");
$total_data = mysql_num_rows($total);

//2. tentukan banyak data yg diinginkan tampil
$hal = 6;

//3. cari jumlah banyak halaman
$jum_hal = ceil($total_data/$hal);

if(isset($_GET['awal'])) $awal = $_GET['awal'];
else $awal = 0;
?>
<table border="1" bordercolor="black" width="100%" style="border-collapse:collapse;text-align:center;">
	<tr style="background: #c30; color: white;">
		<th>Id Pemesanan</th>
		<th>Username</th>
		<th>Tanggal</th>
		<th>Alamat Pengiriman</th>
		<th width="15%">Status Pemesanan</th>
		<th colspan="2">Edit Status</th>
		<th colspan="2">Aksi</th>
	</tr>
	
	<?php
	if(isset($_POST['txtkata'])) $kata = $_POST['txtkata'];
	else $kata = "";
	//4. batasi query dg Limit
	$str = "SELECT id_pemesanan, username, tanggal, alamat_pengiriman, status FROM pemesanan WHERE username LIKE '%$kata%' OR alamat_pengiriman LIKE '%$kata%' OR status LIKE '%$kata%' ORDER BY tanggal DESC LIMIT $awal, $hal ";
	
	$query = mysql_query ($str) or die (mysql_error());
	$jumlah = mysql_num_rows($query);
	if($jumlah == '0'){
	echo "<tr><td colspan='7' align='center'>Data kosong</td></tr>";
	} else {
	while(list($id, $username, $tanggal, $alamat_pengiriman, $status) = mysql_fetch_row($query)) {
	echo "<tr>";
	echo "<td>$id</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $username)."</td>";
	echo "<td>$tanggal</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $alamat_pengiriman)."</td>";
	
	if($status == '0')	echo "<td><blink style='color:red;'>Menunggu pembayaran</blink></td>";
	else if($status == '1') echo "<td><span style='color:green;'>Dalam proses pengiriman</span></td>";
	else echo"<td><span style='color:blue;'>Barang sudah dikirim</span></td>";
			
	echo "<td width='10%'><a href='pemesanan_proses.php?aksi=Update&id=$id'><button>Proses!</button></a></td>";
	echo "<td width='10%'><a href='pemesanan_proses_terkirim.php?aksi=Update&id=$id'><button>Kirim!</button></a></td>";
	echo "<td width='10%'><a href='#' onclick=\"javascript: if (confirm('Yakin dihapus?')){
	window.location.href='pemesanan_proses.php?aksi=Hapus&id=$id';}\"><img src='images/img/hapus.png' style='margin-right:2px;'></a></td>";
	echo "<td width='10%'><a href='pemesanan_view.php?id=$id'><img src='images/img/view.png'></td>";
	echo "</tr>";
	}
	}
	?>
	
</table><br>
<style>
.aktif {
border:1px solid #428bca;
padding:6px 12px;
background:#428bca;
color:#fff;
display:inline-block;
width:6px;
margin-right:5px;
}
</style>
<?php
//5. buat link pagging
//munculkan prev
if($awal != 0){
echo "<a href='pemesanan.php?awal=".($awal-$hal)."' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;margin:5px; text-decoration:none;'>Prev</a>";
}
//link tengah
for($i=0; $i <  $jum_hal; $i++){
$x = $i * $hal;
if($awal == $x){
echo "<div class='aktif'>".($i+1)."</div>";
}else{
echo "<a href='pemesanan.php?awal=$x' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;margin-right:5px; text-decoration:none;'>".($i+1)."</a>";
}
}
//link next
if($awal != $x){
echo "<a href='pemesanan.php?awal=".($awal+$hal)."' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;text-decoration:none;'>Next</a>";
}
?>
    </div>
    <!-- end of center content -->
  </div>
  <!-- end of main content -->
  <div class="footer" style="position:relative;top:335px;">
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
