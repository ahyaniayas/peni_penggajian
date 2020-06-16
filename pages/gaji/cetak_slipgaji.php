<?php
session_start();
if($_SESSION['level']!="spv" && $_SESSION['level']!="super"){
  echo "<script>location='../index.php'</script>";
}else{

require_once ("../_part/koneksi.php");
require_once ("../../assets/TCPDF/tcpdf.php");
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// create new PDF document
$PDF_PAGE_FORMAT = array("210", "99");
$pdf = new TCPDF("L", PDF_UNIT, $PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 8, '', true);

// Custom setting AHYANI
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(2, 2, 1);
$pdf->SetAutoPageBreak(TRUE, 2);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Style for Barcode/write1DBarcode
$barcodestyle = array(
	'position' => '',
	'align' => '',
	'stretch' => false, 
	'fitwidth' => false, 
	'cellfitalign' => '', 
	'border' => false, 
	'hpadding' => '0', 
	'vpadding' => '0', 
	'fgcolor' => array(0, 0, 0), 
	'bgcolor' => false, 
	'text' => false, 
	'font' => 'helvetica', 
	'fontsize' => 10, 
	'stretchtext' => 1
);

// data
$id_gaji = $_GET['id'];
$sql = "SELECT a.*, b.nama, c.nama nama_perusahaan FROM gaji a 
        JOIN pegawai b ON a.nip=b.nip
        JOIN perusahaan c ON b.id_perusahaan=c.id_perusahaan
        WHERE id_gaji='$id_gaji'";
$row = $koneksi->prepare($sql);
$row->execute();
$isi = $row->fetch(PDO::FETCH_OBJ);

$nama_perusahaan = $isi->nama_perusahaan;
$tgl_gaji = date("d-mY", strtotime($isi->tgl_gaji));
$nama = $isi->nama;
$nip = $isi->nip;
$gaji = number_format($isi->gaji);
$hari_kerja = number_format($isi->hari_kerja);
$lembur = number_format($isi->lembur);
$uang_makan = number_format($isi->uang_makan);
$transport = number_format($isi->transport);
$bpjs = number_format($isi->gaji * 2/100 + $isi->gaji * 1/100 );
$pph21 = number_format($isi->pph21);

$totalPendapatan = ($isi->gaji + $isi->lembur + $isi->uang_makan + $isi->transport);
$totalPendapatan = number_format($totalPendapatan);

$totalPotongan = ($isi->gaji * 2/100 + $isi->gaji * 1/100 + $isi->pph21);
$totalPotongan = number_format($totalPotongan);

$total = ($isi->gaji + $isi->lembur + $isi->uang_makan + $isi->transport) - ($isi->gaji * 2/100 + $isi->gaji * 1/100 + $isi->pph21);
$total = number_format($total);

$judul = "slipgaji_".date("dmY", strtotime($isi->tgl_gaji))."_".$nip.".pdf";
// end data

// Set some content to print
$pdf->SetTitle($judul);
$html = <<<EOD

<style>
	.bA{
		border: 0.1px #bed7e8 solid;
	}
	.bL{
		border-left: 0.1px #bed7e8 solid;
	}
	.bR{
		border-right: 0.1px #bed7e8 solid;
	}
	.bT{
		border-top: 0.1px #bed7e8 solid;
	}
	.bB{
		border-bottom: 0.1px #bed7e8 solid;
	}
	table{
		font-size: 10pt;
	}
</style>
<table width>
<tr>
<td class="" style="height: 335px">
<table cellpadding="5">
	<tr>
		<td class="bB" style="width: 10%; text-align: center">
			<img src="../../assets/img/logo.jpg" style="width: 50px"/>
		</td>
		<td class="bB" style="width: 90%; text-align: center">
			PT ESSEI PERBAMA<br>
			Slip Gaji<br>
		</td>
	</tr>
</table>
<table>
<tr>
<td style="font-size: 4pt"></td>
</tr>
</table>
<table cellpadding="5">
	<tr>
		<td class="">
			Perusahaan : <b>{$nama_perusahaan}</b><br>
			Tanggal Gaji : {$tgl_gaji}
		</td>
		<td class="">
			Nama : <b>{$nama}</b><br>
			NIK : {$nip}
		</td>
	</tr>
</table>
<hr>
<table>
<tr>
<td style="font-size: 4pt"></td>
</tr>
</table>
<table>
<tr>
<td style="height: 200px;">
<table>
	<tr>
		<td></td>
		<td width="120">Gaji Pokok</td>
		<td>:</td>
		<td style="text-align: right">{$gaji}</td>
		<td></td>
		<td width="120">BPJS</td>
		<td>:</td>
		<td style="text-align: right">{$bpjs}</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>Hari Kerja</td>
		<td>:</td>
		<td style="text-align: right">{$hari_kerja}</td>
		<td></td>
		<td>PPH 21</td>
		<td>:</td>
		<td style="text-align: right">{$pph21}</td>
		<td></td>
	</tr>
	<tr>
	<td></td>
		<td>Lembur</td>
		<td>:</td>
		<td style="text-align: right">{$lembur}</td>
	</tr>
	<tr>
		<td></td>
		<td>Uang Makan</td>
		<td>:</td>
		<td style="text-align: right">{$uang_makan}</td>
	</tr>
	<tr>
		<td></td>
		<td>Transport</td>
		<td>:</td>
		<td style="text-align: right">{$transport}</td>
	</tr>
	<tr>
		<td></td>
		<td><br><br><b>Total Pendapatan</b></td>
		<td><br><br>:</td>
		<td style="text-align: right"><br><br><b>{$totalPendapatan}</b></td>
		<td></td>
		<td><br><br><b>Total Potongan</b></td>
		<td><br><br>:</td>
		<td style="text-align: right"><br><br><b>{$totalPotongan}</b></td>
		<td></td>
	</tr>
</table>
<table>
<tr>
<td style="font-size: 4pt">
</td>
</tr>
</table>
<table cellpadding="10">
	<tr>
		<td class="bA" style="font-size: 16pt;text-align: center">
			<b>Total Gaji : {$total}</b>
		</td>
	</tr>
</table>
</td>
</tr>
</table>
<table cellpadding="5">
	<tr>
		<td style="width: 70%"></td>
		<td style="width: 30%; text-align: center;font-size: 6pt;">
			PT ESSEI PERBAMA
		</td>
	</tr>
</table>
</td>
</tr>
</table>
EOD;

// $pdf->write1DBarcode("INI ISI BARCODE", "C39", LEFT, TOP, LONG, HEIGHT, PIXEL , $barcodestyle, '');
// $pdf->write1DBarcode($transaksi_kode, "C39", '5', '90', '75', '5', '0.4' , $barcodestyle, '');

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($judul, 'I');

//============================================================+
// END OF FILE
//============================================================+
}