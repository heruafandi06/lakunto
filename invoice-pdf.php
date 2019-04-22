<?php
	session_start();
	include "koneksi.php";
	include "fpdf/fpdf.php";
	include "functions.php";
	
	$pdf = new FPDF("L", "mm", "A5");
	$pdf->AddPage();
	
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->Text(10, 10, "Data Pemesanan");
	
	$idPemesanan = $_GET['id'];
	list($nama, $tanggal, $kota, $alamat, $status, $kode_pos) = mysql_fetch_row(mysql_query("SELECT username, tanggal, kota, alamat_pengiriman, status, kode_pos FROM pemesanan WHERE id_pemesanan = '$idPemesanan'"));
	
	$pdf->SetFont('Arial', '', 12);
	$pdf->Text(10, 20, "Kode Pemesanan");
	$pdf->Text(50, 20, " : ".$idPemesanan);
	
	$pdf->Text(10, 25, "Hari, Tanggal");
	$pdf->Text(50, 25, " : ".SearchDay($tanggal).", ".ReportDate($tanggal));
	
	$pdf->Text(10, 30, "Nama");
	$pdf->Text(50, 30, " : ".$nama);
	
	$pdf->Text(10, 35, "Alamat Pengiriman");
	$pdf->Text(50, 35, " : ".$alamat. ", ".$kota);
	
	$pdf->Text(10, 40, "Kode Pos");
	$pdf->Text(50, 40, " : ".$kode_pos);
	
	$pdf->Text(10, 45, "Status Pemesanan");
	if($status == '0'){ $st = "MENUNGGU PEMBAYARAN"; $pdf->SetTextColor(21, 11, 152);$pdf->SetFont('Arial', 'B', 12); }
	if($status == '1'){ $st = "DALAM PROSES PENGIRIMAN"; $pdf->SetTextColor(255, 0, 0);$pdf->SetFont('Arial', 'B', 12); }
	if($status == '2'){ $st = "BARANG SUDAH DIKIRIM"; $pdf->SetTextColor(21, 11, 152);$pdf->SetFont('Arial', 'B', 12); }
	$pdf->Text(50, 45, " : ".$st);
		
	$pdf->SetXY(10, 50);
	
	$pdf->SetFillColor(102, 102, 102);
	$pdf->SetTextColor(255,255,255);
	$pdf->Cell(10, 5, "No.", 1, 0, 'C', true);
	$pdf->Cell(50, 5, "Nama Barang", 1, 0, 'C', true);
	$pdf->Cell(30, 5, "Harga", 1, 0, 'C', true);
	$pdf->Cell(20, 5, "Jumlah", 1, 0, 'C', true);
	$pdf->Cell(30, 5, "Subtotal", 1, 1, 'C', true);
	
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0,0,0);
	$no=1; $x=0; $grandtotal = 0;
	$qData = "SELECT id_produk, jumlah FROM pemesanan_detail WHERE id_pemesanan = '$idPemesanan'";
	$hqData = mysql_query($qData);
	while(list($id_produk, $jumlah) = mysql_fetch_row($hqData)){
		list($nama, $harga) = mysql_fetch_row(mysql_query("SELECT nama, harga FROM produk WHERE id_produk = '$id_produk'"));
		$pdf->Cell(10, 5, $no.".", 1, 0, 'C');
		$pdf->Cell(50, 5, $nama, 1, 0, 'C');
		$pdf->Cell(30, 5, "Rp. ".number_format($harga, 0, ',', '.'), 1, 0, 'R');
		$pdf->Cell(20, 5, $jumlah, 1, 0, 'C');
			$subtotal = $harga * $jumlah;
		$pdf->Cell(30, 5, "Rp. ".number_format($subtotal, 0, ',', '.'), 1, 1, 'R');
		
		$grandtotal += $subtotal;
		$no++;
		$x++;
	}
	$pdf->Cell(110, 5, "Grand Total", 1, 0, 'C');
	$pdf->Cell(30, 5, "Rp. ".number_format($grandtotal, 0, ',', '.'), 1, 1, 'R');
	$biayaKirim = 0;
	
	if($kota == 'Bandung'){
			$biayaKirim = 16000;
		}
		
		else if($kota == 'Jakarta'){
			$biayaKirim = 17000;
		}
		
		else if($kota == 'Surabaya'){
			$biayaKirim = 5000;
		}
								if($kota == 'Bandung'){
									
									$pdf->Cell(110, 5, "Biaya Pengiriman", 1, 0, 'C');
									$pdf->Cell(30, 5, "Rp. ".number_format($biayaKirim, 0, ',', '.'), 1, 1, 'R');
								
									
								}else if($kota == 'Jakarta'){
									
									$pdf->Cell(110, 5, "Biaya Pengiriman", 1, 0, 'C');
									$pdf->Cell(30, 5, "Rp. ".number_format($biayaKirim, 0, ',', '.'), 1, 1, 'R');
									
								}else if($kota == 'Surabaya'){
									
									$pdf->Cell(110, 5, "Biaya Pengiriman", 1, 0, 'C');
									$pdf->Cell(30, 5, "Rp. ".number_format($biayaKirim, 0, ',', '.'), 1, 1, 'R');
									
								}
								$totalBiaya = $grandtotal + $biayaKirim;
									
									$pdf->Cell(110, 5, "Total", 1, 0, 'C');
									$pdf->Cell(30, 5, "Rp. ".number_format($totalBiaya, 0, ',', '.'), 1, 1, 'R');
								
									
								
	
	
		
	$pdf->Output();
?>