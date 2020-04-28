<?php
session_start();
if($_SESSION['level']!="keu"){
  echo "<script>location='../index.php'</script>";
}

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
$PDF_PAGE_FORMAT = array("210", "297");
$pdf = new TCPDF("P", PDF_UNIT, $PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
$periode = $_POST['periode'];
$status = $_POST['status'];
$blnSekarang = date('n');
$thnSekarang = date('Y');

$where = "(MONTH(tgl_invoice)='$blnSekarang'";
$bln = $blnSekarang;
for($i=0; $i<$periode-1; $i++ ){
	$bln = $blnSekarang-($i+1);
	$where .= " OR MONTH(tgl_invoice)='$bln'";
}
$where .= ") AND YEAR(tgl_invoice)='$thnSekarang'";

if($status=='1'){
	$where .= " AND bayar>0";
}else if($status=='0'){
	$where .= " AND bayar<=0";
}

$sql = "SELECT a.*, b.nama nama_perusahaan FROM invoice a
        JOIN perusahaan b ON a.id_perusahaan=b.id_perusahaan
        WHERE $where
        ORDER BY tgl_invoice ASC";
$row = $koneksi->prepare($sql);
$row->execute();
$hasil = $row->fetchAll(PDO::FETCH_OBJ);

$blnThn = $bln."_".$blnSekarang." ".$thnSekarang;
$judul = "Laporan Invoice $blnThn.pdf";
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
			// <img src="" style="width: 50px"/>
			LOGO
		</td>
		<td class="bB" style="width: 90%; text-align: center;">
			PT ESSEI PERBAMA<br>
			LAPORAN INVOICE $blnThn<br>
		</td>
	</tr>
</table>
<table>
<tr>
<td style="font-size: 4pt"></td>
</tr>
</table>
<table cellpadding="3">
	<tr>
		<td class="bB" style="width: 5%">No</td>
		<td class="bB" style="width: 10%">No. Invoice</td>
		<td class="bB" style="width: 12%">Tanggal</td>
		<td class="bB" style="width: 21%">Perusahaan</td>
		<td class="bB" style="width: 15%">Total</td>
		<td class="bB" style="width: 15%">Bayar</td>
		<td class="bB" style="width: 12%">Tgl. Bayar</td>
		<td class="bB" style="width: 10%">Saldo</td>
	</tr>
EOD;
$no=0;
foreach($hasil as $isi){
	$no++;
	$nomor = $isi->nomor;
	$tgl_invoice = date("d-m-Y", strtotime($isi->tgl_invoice));
	$nama_perusahaan = $isi->nama_perusahaan;
	$total = number_format(($isi->total_gaji + $isi->mfee + ($isi->mfee*10/100)) - ($isi->mfee*2/100));
	$bayar = $isi->bayar>0? number_format($isi->bayar): "Belum Dibayar";
	$tgl_bayar = $isi->bayar>0? date("d-m-Y", strtotime($isi->tgl_bayar)): "Belum Dibayar";
	$saldo = number_format((($isi->total_gaji + $isi->mfee + ($isi->mfee*10/100)) - ($isi->mfee*2/100)) - $isi->bayar);
$html .= <<<EOD
	<tr>
		<td class="bB">{$no}</td>
		<td class="bB">{$nomor}</td>
		<td class="bB">{$tgl_invoice}</td>
		<td class="bB">{$nama_perusahaan}</td>
		<td class="bB">{$total}</td>
		<td class="bB">{$bayar}</td>
		<td class="bB">{$tgl_bayar}</td>
		<td class="bB">{$saldo}</td>
	</tr>
EOD;
}
$html .= <<<EOD
</table>
<table>
<tr>
<td style="font-size: 36pt">
</td>
</tr>
</table>
<table cellpadding="5">
	<tr>
		<td style="width: 70%"></td>
		<td style="width: 30%; text-align: center;font-size: 6pt;">
			ttd. PT ESSEI PERBAMA
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