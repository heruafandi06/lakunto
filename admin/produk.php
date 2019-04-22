<?php sleep(1); ?>
<?php session_start(); ?>
<?php if(isset($_SESSION['username'])){ ?>
<?php include "koneksi.php"; ?>
<?php
if(isset($_GET['id'])){
$a= "SELECT id_produk, nama, gambar, harga, tanggal, kategori, stok, deskripsi FROM produk WHERE id_produk = '$_GET[id]'";
$b= mysql_query($a);
list($idedit, $namaedit, $gambaredit, $hargaedit,  $tanggaledit, $kategoriedit, $stokedit, $deskripsiedit) = mysql_fetch_row($b);
}
?>
<html>
<head>
<title>Administrator</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="../datepicker/lib/css/default.css" /> 
		<script src="../datepicker/lib/jquery.min.js"></script>
		<script src="../datepicker/lib/zebra_datepicker.js"></script>
 
    <script>
    $(document).ready(function(){
        $('#date').Zebra_DatePicker({
            format: 'Y-F-d',
            months : ['01','02','03','04','05','06','07','08','09','10','11','12'],
            days : ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'],
            days_abbr : ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu']
        });
    });
</script>
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
      <form method="POST" action="produk_proses.php" enctype="multipart/form-data">
<?php
if(isset($_GET['id'])){
echo "<input type='hidden' name='aksi' value='Update'>";
}else{
echo "<input type='hidden' name='aksi' value='Tambah'>";
}
?>
<table>
	<tr>
		<td>Id Produk</td>
		<td><input type="text" name="txtid" value="<?php if(isset($_GET['id'])){ echo $idedit; } ?>"></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="txtnama" value="<?php if(isset($_GET['id'])){ echo $namaedit; } ?>"></td>
	</tr>
	<tr>
		<td>Gambar</td>
		<td>
			<?php
			if(isset($_GET['id'])){
			echo "<img src='$gambaredit' id='gambar' width='50'>";
			echo "<input type='checkbox' name='cbcek' value='1' onclick=\"javascript: if(this.checked==true){document.getElementById('gambar').style.display='none';}else{document.getElementById('gambar').style.display='block';} \"/> Centang untuk ganti foto";
			}
			?>
			<input type="file" name="filefoto">
		</td>
	</tr>
	<tr>
		<td>Harga</td>
		<td><input type="text" name="txtharga" value="<?php if(isset($_GET['id'])){ echo $hargaedit; } ?>"></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td><input type="text" name="txttanggal" value="<?php if(isset($_GET['id'])){ echo $tanggaledit; } ?>" id="date"></td>
	</tr>
	<tr>
		<td>Kategori</td>
		<td><input type="text" name="txtkategori" value="<?php if(isset($_GET['id'])){ echo $kategoriedit; } ?>"></td>
	</tr>
	<tr>
		<td>Stok</td>
		<td><input type="text" name="txtstok" value="<?php if(isset($_GET['id'])){ echo $stokedit; } ?>"></td>
	</tr>
	<tr>
		<td>Deskripsi</td>
		<td><textarea name="txtdeskripsi" style="height:25px;width:142px;"><?php if(isset($_GET['id'])){ echo $deskripsiedit; } ?></textarea></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="button" <?php if(isset($_GET['id'])){ ?> value="Update" <?php }else{ ?> value="Simpan" <?php } ?> onclick="javascript: var a='';
			if(this.form.txtid.value== '') a+='Isi Id dulu\n';
		
			if(a!='') alert(a);
			else this.form.submit();
			">
			<input type="reset" value="Batal">
		</td>
	</tr>
</table>
</form><br>
<form method="POST" action="produk.php">
Pencarian : <input type="text" name="txtkata" placeholder="Cari Nama...">
<input type="submit" value="Cari">
</form>
<?php
//pagging
//1. cari banyak total data
$total = mysql_query("SELECT * FROM produk");
$total_data = mysql_num_rows($total);

//2. tentukan banyak data yg diinginkan tampil
$hal = 3;

//3. cari jumlah banyak halaman
$jum_hal = ceil($total_data/$hal);

if(isset($_GET['awal'])) $awal = $_GET['awal'];
else $awal = 0;
?>
<table border="1" bordercolor="black" width="100%" style="border-collapse:collapse;text-align:center;">
	<tr style="background: #c30; color: white;">
		<th>Id Produk</th>
		<th>Nama</th>
		<th>Gambar</th>
		<th>Harga</th>
		<th>Tanggal</th>
		<th>Kategori</th>
		<th>Stok</th>
		<th>Deskripsi</th>
		<th colspan="2">Aksi</th>
	</tr>
	
	<?php
	if(isset($_POST['txtkata'])) $kata = $_POST['txtkata'];
	else $kata = "";
	//4. batasi query dg Limit
	$str = "SELECT id_produk, nama, gambar, harga, tanggal, kategori, stok, deskripsi FROM produk WHERE nama LIKE '%$kata%' LIMIT $awal, $hal ";
	$query = mysql_query ($str) or die (mysql_error());
	$jumlah = mysql_num_rows($query);
	if($jumlah == '0'){
	echo "<tr><td colspan='8' align='center'>Data kosong</td></tr>";
	} else {
	while(list($id, $nama, $gambar, $harga, $tanggal, $kategori, $stok, $deskripsi) = mysql_fetch_row($query)) {
	echo "<tr>";
	echo "<td>$id</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $nama)."</td>";
	echo "<td><a href='#' onclick=\"javascript:window.open('$gambar', '_blank', 'width=200, height=100, menubar=0, scrollbars=0');\"><img src='$gambar' width='50'></a></td>";
	echo "<td>$harga</td>";
	echo "<td>$tanggal</td>";
	echo "<td>$kategori</td>";
	echo "<td>$stok</td>";
	echo "<td><textarea>$deskripsi</textarea></td>";
	echo "<td width='10%'><a href='produk.php?id=$id'><img src='images/img/edit.png' style='margin-right:2px;'></a></td>";
	echo "<td width='10%'><a href='#' onclick=\"javascript: if (confirm('Yakin dihapus?')){
	window.location.href='produk_proses.php?aksi=Hapus&id=$id';}\"><img src='images/img/hapus.png' style='margin-right:2px;'></a></td>";
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
echo "<a href='produk.php?awal=".($awal-$hal)."' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;margin:5px; text-decoration:none;'>Prev</a>";
}
//link tengah
for($i=0; $i <  $jum_hal; $i++){
$x = $i * $hal;
if($awal == $x){
echo "<div class='aktif'>".($i+1)."</div>";
}else{
echo "<a href='produk.php?awal=$x' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;margin-right:5px; text-decoration:none;'>".($i+1)."</a>";
}
}
//link next
if($awal != $x){
echo "<a href='produk.php?awal=".($awal+$hal)."' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;text-decoration:none;'>Next</a>";
}
?>
    </div>
    <!-- end of center content -->
  </div>
  <!-- end of main content -->
  <div class="footer" style="position:relative;top:100px;">
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
