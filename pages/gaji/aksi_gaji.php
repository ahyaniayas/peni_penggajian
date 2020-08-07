<?php
session_start();
if($_SESSION['level']!="spv" && $_SESSION['level']!="super"){
  echo "<script>location='../index.php'</script>";
}else{

	include ('../_part/koneksi.php');
	$proses = empty($_POST['proses'])? "": $_POST['proses']; 
	if($proses=='simpan'){

		$nip=$_POST['nip'];
		$gaji=str_replace(",", "", $_POST['gaji']);
		$hari_kerja=str_replace(",", "", $_POST['hari_kerja']);
		$lembur=str_replace(",", "", $_POST['lembur']);
		$uang_makan=str_replace(",", "", $_POST['uang_makan']);
		$transport=str_replace(",", "", $_POST['transport']);
		$bpjs=str_replace(",", "", $_POST['bpjs']);
		$pph21=str_replace(",", "", $_POST['pph21']);

		$sql = "INSERT INTO gaji(tgl_gaji, nip, gaji, hari_kerja, lembur, uang_makan, transport, bpjs, pph21) values (NOW(), '$nip', '$gaji', '$hari_kerja', '$lembur', '$uang_makan', '$transport', '$bpjs', '$pph21')";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Tambah Berhasil'); location='../index.php?p=gaji&page=entri'</script>";

	}else if($proses=='edit'){

		$id_gaji=$_POST['id_gaji'];

		$gaji=str_replace(",", "", $_POST['gaji']);
		$hari_kerja=str_replace(",", "", $_POST['hari_kerja']);
		$lembur=str_replace(",", "", $_POST['lembur']);
		$uang_makan=str_replace(",", "", $_POST['uang_makan']);
		$transport=str_replace(",", "", $_POST['transport']);
		$bpjs=str_replace(",", "", $_POST['bpjs']);
		$pph21=str_replace(",", "", $_POST['pph21']);

		$sql = "UPDATE gaji SET 
				gaji='$gaji',
				hari_kerja='$hari_kerja',
				lembur='$lembur',
				uang_makan='$uang_makan',
				transport='$transport',
				bpjs='$bpjs',
				pph21='$pph21'
				where id_gaji='$id_gaji'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Edit Berhasil'); location='../index.php?p=gaji&page=edit&id=$id_gaji'</script>";

	}

	if(isset($_GET['id'])){
		$id_gaji = $_GET['id'];
		$sql = "DELETE FROM gaji where id_gaji = '$id_gaji'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Hapus Berhasil'); location='../index.php?p=gaji'</script>";

	}
}
?>