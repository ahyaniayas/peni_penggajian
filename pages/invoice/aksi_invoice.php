	<?php
include ('../koneksi.php');

/* PROSES ENTRI DATA INVOICE */

if ($_GET['proses']=='entri')
	{
		$cari=mysql_query("select * from invoice where no_inv='$_POST[no_inv]");
		$ca=mysql_num_rows($cari);
	
if(empty($ca))
	{

		$no_inv=$_POST['no_inv'];
		$Total_Gaji=$_POST['Total_Gaji'];
		$Management_Fee=$_PST['Management_Fee'];
		$PPN=$_POST['PPN'];
		$PPH_23=$_POST['PPH_23'];
		$total_invocie=($Total_Gaji+$Management_Fee+$PPN)-$PPH_23;

$simpan=mysql_query("insert into invoice(no_inv,Total_Gaji,Management_Fee,PPN,PPH_23) values ('$no_inv','$Total_Gaji','$Management_Fee','$PPN','$PPH_23')");
	if($simpan)
		{
			echo "<script>top.location='../index.php?p=gaji'</script>";
		}
	}
	elseif(!empty($ca)) 
		{
			echo "<script>alert('Data Sudah Ada')</script>";
			echo "<script>top.location='../index.php?p=invoice'</script>";
		}
	}

/* PROSES EDIT DATA INVOICE */
if ($_GET['proses']=='edit')
{
$update=mysql_query("update invoice set no_inv='$_POST[no_inv]',
												  Total_Gaji='$_POST[Total_Gaji]',
												  Management_Fee='$_POST[Management_Fee]',
												  PPN='$_POST[PPN]',
												  PPH_23='$_POST[PPH_23]',
												  total_invocie='$_POST[total_invocie]'
												  where no_inv='$_POST[no_inv]'");
		if($update)
		{
			header("location:../index.php?p=invoice");
		}
}


/* PROSES HAPUS DATA INVOICE */
if($_GET['proses']=='hapus')
{
	$hapus=mysql_query("DELETE from invoice where no_inv='$_GET[no_inv]'");
	if($hapus)
	{
		header("location:../index.php?p=invoice");
	}

}

?>