 <?php
include ('../koneksi.php');

/* PROSES ENTRI DATA GAJI */

if ($_GET['proses']=='entri')
	{
		$cari=mysql_query("select * from gaji where nip='$_POST[nip]' and tgl_gaji='$_POST[tgl_gaji]' ");
		$ca=mysql_num_rows($cari);
	
if(empty($ca))
	{

		$tgl_gaji=$_POST['tgl_gaji'];
		$nip=$_POST['nip'];
		$gaji=$_POST['gaji_pokok'];
		$tunjangan=$_POST['tunjangan'];
		$potongan=$_POST['potongan'];
		$total_gaji=($gaji+$tunjangan)-$potongan;

$simpan=mysql_query("insert into gaji(tgl_gaji,nip,gaji_pokok,tunjangan,potongan,total_gaji) values ('$tgl_gaji','$nip','$gaji_pokok','$tunjangan','$potongan','$total_gaji')");
	if($simpan)
		{
			echo "<script>top.location='../index.php?p=gaji'</script>";
		}
	}
	elseif(!empty($ca)) 
		{
			echo "<script>alert('Data Sudah Ada')</script>";
			echo "<script>top.location='../index.php?p=gaji'</script>";
		}
	}

/* PROSES EDIT DATA GAJI */
if ($_GET['proses']=='edit')
{
$update=mysql_query("update gaji set tgl_gaji='$_POST[tgl_gaji]',
												  nip='$_POST[nip]',
												  gaji_pokok='$_POST[gaji_pokok]',
												  tunjangan='$_POST[tunjangan]',
												  potongan='$_POST[potongan]',
												  total_gaji='$_POST[total_gaji]'
												  where id_gaji='$_POST[id_gaji]'");
		if($update)
		{
			header("location:../index.php?p=gaji");
		}
}


/* PROSES HAPUS DATA GAJI */
if($_GET['proses']=='hapus')
{
	$hapus=mysql_query("DELETE from gaji where id_gaji='$_GET[id_gaji]'");
	if($hapus)
	{
		header("location:../index.php?p=gaji");
	}

}

?>