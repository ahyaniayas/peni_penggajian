<?php
include ('koneksi.php');
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page) {
case 'list':
?>
<h1> Data Pegawai </h1>
<a href="index.php?p=pegawai&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
<p>
<table width="492" border="1" class="table table-striped">
    <tr>
      <td width="21"><div align="center"><strong>NIK</strong></div></td>
      <td width="105"><div align="center"><strong>Nama  </strong></div></td>
      <td width="105"><div align="center"><strong>cabang</strong></div></td>
      <td width="105"><div align="center"><strong>Jabatan</strong></div></td>
    </tr>
	<?php
		$tampil=mysql_query("select * from pegawai ");
		$no=1;
		while($data=mysql_fetch_array($tampil))
		{
	?>
    <tr>
      <td><div align="center"><?php echo $data['NIK'];?></div></td>
      <td><div align="center"><?php echo $data['nama'];?></div>
      <td><div align="center"><?php echo $data['cabang'];?></div></td>
      <td><div align="center"><?php echo $data['jabatan'];?></div></td>
      <td><div align="left"><a href="pegawai/aksi_pegawai.php?proses=hapus&NIK=<?php echo $data['NIK']?>"><span class="glyphicon glyphicon-floppy-remove"> Hapus</span></a><br />
	        <a href="index.php?p=pegawai&page=edit&NIK=<?php echo $data['NIK']?>"><span class="glyphicon glyphicon-edit"> Edit</span></a></div></td>
    </tr>
	<?php
		$no++;
		}
	?>
</table>
<?php
break;
case 'entri':
?>
<h1> Form Pegawai </h1>
<form id="form1" name="form1" method="post" action="pegawai/aksi_pegawai.php?proses=entri">
  <table width="311" border="0">
    <input type="hidden" name="level" value="pegawai" />
    <tr>
      <td width="94">NIK </td>
      <td width="207"><label>
        <input type="text" name="NIK" />
      </label></td>
    </tr>
    <tr>
      <td>Nama </td>
      <td><label>
        <input type="text" name="nama" />
      </label></td>
    </tr>
    <tr>
      <td>Cabang</td>
      <td><label>
        <input type="text" name="cabang" />
      </label></td>
    </tr>
	<tr>
      <td>Jabatan</td>
      <td><label>
        <input type="text" name="jabatan" />
      </label></td>
    </tr>
    <tr>

      <td>&nbsp;</td>
      <td><label>
        <button name="simpan" type="submit" id="simpan" value="Simpan" class="btn btn-primary">
		<span class="glyphicon glyphicon-floppy-disk">Simpan</span>		</button>
		
      </label></td>
    </tr>
  </table>
  <p><a href="index.php?p=pegawai">Tampilkan Tabel Pegawai </a>  </p>
</form>
<?php
break;
case 'edit':
$tampil = mysql_query("select * from pegawai where NIK='$_GET[NIK]'");
$data=mysql_fetch_array($tampil);
?>
<form id="form1" name="form1" method="post" action="pegawai/aksi_pegawai.php?proses=edit">
  <table width="311" border="0">
    <tr>
      <td colspan="2"><div align="center"><strong>DATA PEGAWAI </strong></div></td>
    </tr>
    <tr>
      <td width="94">NIK </td>
      <td width="207"><label>
        <input type="text" name="NIK" value = "<?php echo $data['NIK']?>" readonly/>
      </label></td>
    </tr>
    <tr>
      <td>Nama </td>
      <td><label>
        <input type="text" name="nama" value = "<?php echo $data['nama']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>Cabang</td>
      <td><label>
        <input type="text" name="cabang" value = "<?php echo $data['cabang']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>Jabatan</td>
      <td><label>
        <input type="text" name="jabatan" value = "<?php echo $data['jabatan']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="simpan" type="submit" id="simpan" value="Simpan" class="btn btn-primary" />
      </label></td>
    </tr>
  </table>
</form>

<?php
break;
}
?>
