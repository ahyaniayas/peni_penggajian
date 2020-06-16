<?php
session_start();
if($_SESSION['level']!="keu" && $_SESSION['level']!="super"){
  echo "<script>location='../index.php'</script>";
}else{

	include ('../_part/koneksi.php');
	$proses = empty($_POST['proses'])? "": $_POST['proses']; 
	if($proses=='simpan'){

		$tgl_invoice=$_POST['tgl_invoice'];
		$total_gaji=$_POST['total_gaji'];
		$mfee=$_POST['mfee'];
		$id_perusahaan=$_POST['id_perusahaan'];

		$nomor = "INV-".$id_perusahaan.date("dmYHis");

		$sql = "INSERT INTO invoice(tgl_invoice, nomor, total_gaji, mfee, id_perusahaan) values ('$tgl_invoice', '$nomor', '$total_gaji', '$mfee', '$id_perusahaan')";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Tambah Berhasil'); location='../index.php?p=invoice&page=entri'</script>";

	}else if($proses=='edit'){
		$id_invoice=$_POST['id_invoice'];
		$tgl_invoice=$_POST['tgl_invoice'];
		$total_gaji=$_POST['total_gaji'];
		$mfee=$_POST['mfee'];

		$sql = "UPDATE invoice SET 
				tgl_invoice='$tgl_invoice',
				total_gaji='$total_gaji',
				mfee='$mfee'
				where id_invoice='$id_invoice'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Edit Berhasil'); location='../index.php?p=invoice&page=edit&id=$id_invoice'</script>";

	}else if($proses=='bayar'){
		$id_invoice=$_POST['id_invoice'];
		$bayar=$_POST['bayar'];
		$tgl_bayar=$_POST['tgl_bayar'];

		$sql = "UPDATE invoice SET 
				bayar='$bayar',
				tgl_bayar='$tgl_bayar'
				where id_invoice='$id_invoice'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Bayar Berhasil'); location='../index.php?p=pembayaran&page=edit&id=$id_invoice'</script>";

	}

	if(isset($_GET['id'])){
		$id_invoice = $_GET['id'];
		$sql = "DELETE FROM invoice where id_invoice = '$id_invoice'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Hapus Berhasil'); location='../index.php?p=invoice'</script>";

	}
}
?>