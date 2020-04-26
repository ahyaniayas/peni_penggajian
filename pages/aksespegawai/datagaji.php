<?php
include ('koneksi.php');
?>
<h1> Data Gaji </h1>
<p>
<table width="492" border="1" class="table table-striped">
    <tr>
      <td width="21"><div align="center"><strong>Id Gaji</strong></div></td>
      <td width="105"><div align="center"><strong>Tgl Gaji  </strong></div></td>
      <td width="120"><div align="center"><strong>Nip </strong></div></td>
      <td width="105"><div align="center"><strong>Gaji</strong></div></td>
      <td width="105"><div align="center"><strong>Tunjangan</strong></div></td>
      <td width="105"><div align="center"><strong>Potongan</strong></div></td>
      <td width="105"><div align="center"><strong>Total Gaji</strong></div></td>
    </tr>
	<?php
		$tampil=mysql_query("select * from gaji where nip='$_GET[username]';");
		$no=1;
		while($data=mysql_fetch_array($tampil))
		{
	?>
    <tr>
      <td><div align="center"><?php echo $data['id_gaji'];?></div></td>
      <td><div align="left"><?php echo $data['tgl_gaji'];?></div>
      <td><div align="center"><?php echo $data['nip'];?></div></td>
      <td><div align="center"><?php echo $data['gaji'];?></div></td>
      <td><div align="center"><?php echo $data['tunjangan'];?></div></td>
      <td><div align="center"><?php echo $data['potongan'];?></div></td>
      <td><div align="center"><?php echo $data['total_gaji'];?></div></td>
    </tr>
	<?php
		$no++;
		}
	?>
</table>