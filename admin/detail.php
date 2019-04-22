<?php sleep(1); ?>
<?php session_start();?>
<?php if(isset($_SESSION['username'])){ ?>
<?php include "koneksi.php"; ?>
<?php
if(isset($_GET['id'])){
$a= "SELECT id_detail, id_produk, layar, memori, ram, internet, os, cpu, kd, kb, baterai FROM detail WHERE id_detail = '$_GET[id]'";
$b= mysql_query($a);
list($id_detedit, $id_prodedit, $layaredit, $memoriedit,  $ramedit,  $internetedit,  $osedit,  $cpuedit,  $kdedit,  $kbedit,  $bateraiedit) = mysql_fetch_row($b);
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
<form method="POST" action="detail_proses.php" enctype="multipart/form-data">
<?php
if(isset($_GET['id'])){
echo "<input type='hidden' name='aksi' value='Update'>";
}else{
echo "<input type='hidden' name='aksi' value='Tambah'>";
}
?>
<table>
	<tr>
		<td>Id Detail</td>
		<td><input type="text" name="txtiddet" value="<?php if(isset($_GET['id'])){ echo $id_detedit; } ?>"></td>
	</tr>
	<tr>
		<td>Id Produk</td>
		<td><input type="text" name="txtidprod" value="<?php if(isset($_GET['id'])){ echo $id_prodedit; } ?>"></td>
	</tr>
	<tr>
		<td>Layar</td>
		<td><input type="text" name="txtlayar" value="<?php if(isset($_GET['id'])){ echo $layaredit; } ?>"></td>
	</tr>
	<tr>
		<td>Memori</td>
		<td><input type="text" name="txtmemori" value="<?php if(isset($_GET['id'])){ echo $memoriedit; } ?>"></td>
	</tr>
	<tr>
		<td>Ram</td>
		<td><input type="text" name="txtram" value="<?php if(isset($_GET['id'])){ echo $ramedit; } ?>"></td>
	</tr>
	<tr>
		<td>Internet</td>
		<td><input type="text" name="txtinternet" value="<?php if(isset($_GET['id'])){ echo $internetedit; } ?>"></td>
	</tr>
	<tr>
		<td>Os</td>
		<td><input type="text" name="txtos" value="<?php if(isset($_GET['id'])){ echo $osedit; } ?>"></td>
	</tr>
	<tr>
		<td>Cpu</td>
		<td><input type="text" name="txtcpu" value="<?php if(isset($_GET['id'])){ echo $cpuedit; } ?>"></td>
	</tr>
	<tr>
		<td>Kamera Depan</td>
		<td><input type="text" name="txtkd" value="<?php if(isset($_GET['id'])){ echo $kdedit; } ?>"></td>
	</tr>
	<tr>
		<td>Kamere Belakang</td>
		<td><input type="text" name="txtkb" value="<?php if(isset($_GET['id'])){ echo $kbedit; } ?>"></td>
	</tr>
	<tr>
		<td>Baterai</td>
		<td><input type="text" name="txtbaterai" value="<?php if(isset($_GET['id'])){ echo $bateraiedit; } ?>"></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="button" <?php if(isset($_GET['id'])){ ?> value="Update" <?php }else{ ?> value="Simpan" <?php } ?> onclick="javascript: var a='';
			if(this.form.txtiddet.value== '') a+='Isi Id Detail dulu\n';
			if(this.form.txtidprod.value== '') a+='Isi Id Produk dulu\n';
			if(a!='') alert(a);
			else this.form.submit();
			">
			<input type="reset" value="Batal">
		</td>
	</tr>
</table>
</form><br>
<form method="POST" action="detail.php">
Pencarian : <input type="text" name="txtkata" placeholder="Ketikkan Sesuatu...">
<input type="submit" value="Cari">
</form>
<?php
//pagging
//1. cari banyak total data
$total = mysql_query("SELECT * FROM detail");
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
		<th>Id Detail</th>
		<th>Id Produk</th>
		<th>Layar</th>
		<th>Memori</th>
		<th>Ram</th>
		<th>Internet</th>
		<th>Os</th>
		<th>Cpu</th>
		<th>Kamera Depan</th>
		<th>Kamera Belakang</th>
		<th>Baterai</th>
		<th colspan="2">Aksi</th>
	</tr>
	
	<?php
	if(isset($_POST['txtkata'])) $kata = $_POST['txtkata'];
	else $kata = "";
	//4. batasi query dg Limit
	$str = "SELECT id_detail, id_produk, layar, memori, ram, internet, os, cpu, kd, kb, baterai FROM detail WHERE layar LIKE '%$kata%' OR memori LIKE '%$kata%' OR ram LIKE '%$kata%' OR internet LIKE '%$kata%' OR os LIKE '%$kata%' OR os LIKE '%$kata%' OR kd LIKE '%$kata%' OR kb LIKE '%$kata%' OR baterai LIKE '%$kata%' LIMIT $awal, $hal ";
	
	$query = mysql_query ($str) or die (mysql_error());
	$jumlah = mysql_num_rows($query);
	if($jumlah == '0'){
	echo "<tr><td colspan='13' align='center'>Data kosong</td></tr>";
	} else {
	while(list($id_detail, $id_produk, $layar, $memori, $ram, $internet, $os, $cpu, $kd, $kb, $baterai) = mysql_fetch_row($query)) {
	echo "<tr>";
	echo "<td>$id_detail</td>";
	echo "<td>$id_produk</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $layar)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $memori)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $ram)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $internet)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $os)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $cpu)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $kd)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $kb)."</td>";
	echo "<td>".str_replace($kata, "<font color='blue'><b>$kata</b></font>", $baterai)."</td>";
	echo "<td width='10%'><a href='detail.php?id=$id_detail'><img src='images/img/edit.png' style='margin-right:2px;'></a></td>";
	echo "<td width='10%'><a href='#' onclick=\"javascript: if (confirm('Yakin dihapus?')){
	window.location.href='detail_proses.php?aksi=Hapus&id=$id_detail';}\"><img src='images/img/hapus.png' style='margin-right:2px;'></a></td>";
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
echo "<a href='detail.php?awal=".($awal-$hal)."' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;margin:5px; text-decoration:none;'>Prev</a>";
}
//link tengah
for($i=0; $i <  $jum_hal; $i++){
$x = $i * $hal;
if($awal == $x){
echo "<div class='aktif'>".($i+1)."</div>";
}else{
echo "<a href='detail.php?awal=$x' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;margin-right:5px; text-decoration:none;'>".($i+1)."</a>";
}
}
//link next
if($awal != $x){
echo "<a href='detail.php?awal=".($awal+$hal)."' style='border:1px solid #ddd;padding:6px 12px;background:#fff;color:#428bca;text-decoration:none;'>Next</a>";
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
