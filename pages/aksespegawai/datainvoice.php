<?php
include ('koneksi.php');
?>
<h1> Data Invoice</h1>
<p>
<table width="492" border="1" class="table table-striped">
    <tr>
      <td width="21"><div align="center"><strong>Total Gaji</strong></div></td>
      <td width="105"><div align="center"><strong>Management fee</strong></div></td>
      <td width="105"><div align="center"><strong>PPN</strong></div></td>
      <td width="105"><div align="center"><strong>PPH23</strong></div></td>
    </tr>
  <?php
    $tampil=mysql_query("select * from invoice where noinv='$_GET[username]';");
    while($data=mysql_fetch_array($tampil))
    {
  ?>
    <tr>
      <td><div align="center"><?php echo $data['nip'];?></div></td>
      <td><div align="center"><?php echo $data['nama'];?></div>
      <td><div align="center"><?php echo $data['cabang'];?></div></td>
      <td><div align="center"><?php echo $data['jabatan'];?></div></td>
      <td><div align="center"><?php echo $data['password'];?></div></td>
    </tr>
  <?php
    
    }
  ?>
</table>