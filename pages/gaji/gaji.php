<?php
include ('koneksi.php');
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page) {
case 'list':
?>
<h1> Data Gaji </h1>
<a href="index.php?p=gaji&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
<a href="index.php?p=gaji&page=cari" class="btn btn-success"><span class="glyphicon glyphicon-download-alt" target="_blank"> Slip Gaji</span></a>
<p>
<table width="492" border="1" class="table table-striped">
    <tr>
      <td width="21"><div align="center"><strong>NIK</strong></div></td>
      <td width="105"><div align="center"><strong>Nama</strong></div></td>
      <td width="120"><div align="center"><strong>Gaji Pokok </strong></div></td>
	  <td width="120"><div align="center"><strong>Lembur </strong></div></td>
      <td width="105"><div align="center"><strong>Uang Makan</strong></div></td>
	  <td width="105"><div align="center"><strong>Transport</strong></div></td>
      <td width="105"><div align="center"><strong>BPJS</strong></div></td>
      <td width="105"><div align="center"><strong>PPh 21</strong></div></td>
      <td width="105"><div align="center"><strong>Pinjaman</strong></div></td>
      <td width="107"><div align="center"><strong>Total Gaji</strong></div></td>
    </tr>
	<?php
		$tampil=mysql_query("select * from gaji");
		$no=1;
		while($data=mysql_fetch_array($tampil))
		{
	?>
    <tr>
      <td><div align="center"><?php echo $data['NIK'];?></div></td>
      <td><div align="left"><?php echo $data['nama'];?></div>
      <td><div align="center"><?php echo $data['gaji_pokok'];?></div></td>
      <td><div align="center"><?php echo $data['lembur'];?></div></td>
      <td><div align="center"><?php echo $data['Uang_Makan'];?></div></td>
	  <td><div align="center"><?php echo $data['Transport'];?></div></td>
      <td><div align="center"><?php echo $data['BPJS'];?></div></td>
	  <td><div align="center"><?php echo $data['pph_21'];?></div></td>
	  <td><div align="center"><?php echo $data['pinjaman'];?></div></td>
      <td><div align="center"><?php echo $data['Total_Gaji'];?></div></td>
      <td><div align="left"><a href="gaji/aksi_gaji.php?proses=hapus&NIK=<?php echo $data['NIK']?>"><span class="glyphicon glyphicon-floppy-remove"> Hapus</span></a><br />
	        <a href="index.php?p=gaji&page=edit&NIK=<?php echo $data['NIK']?>"><span class="glyphicon glyphicon-edit"> Edit</span></a></div></td>
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

<h1> Form Gaji </h1>
<form id="form1" name="form1" method="post" action="gaji/aksi_gaji.php?proses=entri">
  <table width="311" border="0">
    
    
      <td>NIK</td>
      <td><label>
        <select class="form-control" name="NIK">
                      <option value="<?php echo $data['NIK']; ?>"></option> 
                      <?php
                        $query=mysql_query("select NIK from pegawai");
                            while ($data=mysql_fetch_array($query)) {
                              echo "<option value=".$data['NIK'].">".$data['NIK']."</option>";
                        }

                      ?>
                   </select>
      </label></td>
    </tr>
	<tr>
	<td>Nama</td>
      <td><label>
        <input type="text" name="nama" />
      </label></td>
    </tr>
	<tr>
      <td>Gaji Pokok</td>
      <td><label>
        <input type="text" name="gaji_pokok" />
      </label></td>
    </tr>
	<tr>
      <td>Lembur</td>
      <td><label>
        <input type="text" name="lembur" />
      </label></td>
    </tr>
	<tr>
      <td>Uang Makan</td>
      <td><label>
        <input type="text" name="Uang_Makan" />
      </label></td>
    </tr>
	<tr>
      <td>Transport</td>
      <td><label>
        <input type="text" name="Transport" />
      </label></td>
    </tr>
	<tr>
      <td>BPJS</td>
      <td><label>
        <input type="text" name="BPJS" />
      </label></td>
    </tr>
	<tr>
	  <td>PPh 21</td>
      <td><label>
        <input type="text" name="pph_21" />
      </label></td>
    </tr>
	<tr>
	  <td>Pinjaman</td>
      <td><label>
        <input type="text" name="pinjaman" />
      </label></td>
    </tr>
      <td>Total Gaji</td>
      <td><label>
        <input type="text" name="Total_Gaji" />
      </label></td>
    </tr>
	
	
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <button name="simpan" type="submit" id="simpan" value="Simpan" class="btn btn-primary">
		    <span class="glyphicon glyphicon-floppy-disk">Simpan</span></button>
		
      </label></td>
    </tr>
  </table>
  <p><a href="index.php?p=gaji">Tampilkan Tabel Gaji </a>  </p>
</form>
<?php
break;
case 'edit':
$tampil = mysql_query("select * from gaji where NIK='$_GET[NIK]'");
$data=mysql_fetch_array($tampil);
?>
<form id="form1" name="form1" method="post" action="gaji/aksi_gaji.php?proses=edit">
  <table width="311" border="0">
    <tr>
      <td colspan="2"><div align="center"><strong>DATA GAJI </strong></div></td>
    </tr>
    <tr>
      <td width="94">NIK </td>
      <td width="207"><label>
        <input type="text" name="NIK" value = "<?php echo $data['NIK']?>" readonly/>
      </label></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><label>
        <input type="text" name="nama" value = "<?php echo $data['nama']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>Gaji Pokok</td>
      <td><label>
        <input type="text" name="gaji_pokok" value = "<?php echo $data['gaji_pokok']?>"/>
      </label></td>
    </tr>
	<tr>
	  <td>Lembur</td>
      <td><label>
        <input type="text" name="lembur" value = "<?php echo $data['lembur']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>Gaji Pokok</td>
      <td><label>
        <input type="text" name="gaji_pokok" value = "<?php echo $data['gaji_pokok']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>Uang Makan</td>
      <td><label>
        <input type="text" name="Uang_Makan" value = "<?php echo $data['Uang_Makan']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>Transport</td>
      <td><label>
        <input type="text" name="Transport" value = "<?php echo $data['Transport']?>"/>
      </label></td>
    </tr>
    <tr>
	 <td>BPJS</td>
      <td><label>
        <input type="text" name="BPJS" value = "<?php echo $data['BPJS']?>"/>
      </label></td>
    </tr>
    <tr>
	 <td>PPh 21</td>
      <td><label>
        <input type="text" name="pph_21" value = "<?php echo $data['pph_21']?>"/>
      </label></td>
    </tr>
    <tr>
	  <td>Pinjaman</td>
      <td><label>
        <input type="text" name="pinjaman" value = "<?php echo $data['pinjaman']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>Total Gaji</td>
      <td><label>
        <input type="text" name="total_gaji" value = "<?php echo $data['total_gaji']?>"/>
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
  case 'cari':
  ob_start();
  $cari = mysql_query("SELECT * FROM gaji where month(tgl_gaji)='$_POST[bulan]'");
  $data=mysql_fetch_array($cari); 
?>

<h1> Laporan Gaji Pegawai </h1>
<form id="form1" name="form1" method="post" action="">
<tr>
      <td width="94">Bulan</td>
      <select name="bulan">
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
      </select>

      <select name="tahun">
        <?php
            $mulai= date('Y') - 10;
            for($i = $mulai;$i<$mulai + 20;$i++){
                $sel = $i == date('Y') ? ' selected="selected"' : '';
                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
            }
            ?>
      </select>


    </tr>
<tr>
      <td>&nbsp;</td>
      <td><label>
        <button name="cari" type="submit" id="submit" value="submit" class="btn btn-primary">
    <span class="glyphicon glyphicon-find">Cari</span></button>
</label></td></tr>  
</form>

 <table width="492" border="1" class="table table-striped">
    <tr>
      <td width="21"><div align="center"><strong>NIK</strong></div></td>
      <td width="105"><div align="center"><strong>Nama  </strong></div></td>
      <td width="120"><div align="center"><strong>Gaji Pokok</strong></div></td>
	  <td width="120"><div align="center"><strong>Lembur </strong></div></td>
      <td width="105"><div align="center"><strong>Uang Makan</strong></div></td>
      <td width="105"><div align="center"><strong>Transport</strong></div></td>
      <td width="105"><div align="center"><strong>BPJS</strong></div></td>
      <td width="105"><div align="center"><strong>PPh 21</strong></div></td>
      <td width="107"><div align="center"><strong>Pinjaman</strong></div></td>
	  <td width="105"><div align="center"><strong>Total Gaji</strong></div></td>
    </tr>
  <?php
    $gji = mysql_query("select * from gaji,pegawai where month(tgl_gaji)='$_POST[bulan]' and year(tgl_gaji) = '$_POST[tahun]' and gaji.nip=pegawai.nip");
    $no=1;
    while($data=mysql_fetch_array($gji))
    {
  ?>
    <tr>
      <td><div align="center"><?php echo $data['NIK'];?></div></td>
      <td><div align="left"><?php echo $data['nama'];?></div>
      <td><div align="center"><?php echo $data['gaji_pokok'];?></div></td>
      <td><div align="center"><?php echo $data['lembur'];?></div></td>
      <td><div align="center"><?php echo $data['Uang_Makan'];?></div></td>
      <td><div align="center"><?php echo $data['Transport'];?></div></td>
      <td><div align="center"><?php echo $data['BPJS'];?></div></td>
	  <td><div align="center"><?php echo $data['pph_21'];?></div></td>
	  <td><div align="center"><?php echo $data['pinjaman'];?></div></td>
      <td><div align="center"><?php echo $data['Total_Gaji'];?></div></td>
      <td><div align="left"><a href="index.php?p=gaji&page=cetak&NIK=<?php echo $data['NIK']?>"><span class="glyphicon glyphicon-print"> Cetak</span></a><br />        
    </tr>
    </tr>
  <?php
    $no++;
    }
  ?>
</table>

<?php
break;
case 'cetak':
$tampil = mysql_query("SELECT * from gaji,pegawai where NIK='$_GET[NIK]' and gaji.nip=pegawai.nip");
$data=mysql_fetch_array($tampil);
?>
<h4> <B>SLIP GAJI </B></h4>
  <table width="311" border="0">
    
    <tr>
      <td width="150">Id Gaji</td>
      <td width="150"> : </td>
      <td width="160"><?php echo $data['NIK']?> </td>
      <td width="207"><label>
        </label></td>
    </tr>
    <tr>
      <td width="150">Tanggal Gaji </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['tgl_gaji']?> </td>
      <td width="207"><label>
    </tr>
    <tr>
      <td width="150">NIP </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['nip']?> </td>
      <td width="207"><label>
    </tr>
    <tr>
      <td width="150">Nama </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['Nama']?> </td>
      <td width="207"><label>
    </tr>
    <td width="150">Gaji Pokok </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['gaji_pokok']?> </td>
      <td width="207"><label>
    </tr>
  <tr>
      <td width="150">Lembur </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['Lembur']?> </td>
      <td width="207"><label>
  <tr>
      <td width="150">Uang Makan</td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['Uang_Makan']?> </td>
      <td width="207"><label>
    </tr>
  <tr>
      <td width="150">Transport </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['Transport']?> </td>
      <td width="207"><label>
  <tr>
      <td width="150">BPJS </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['BPJS']?> </td>
      <td width="207"><label>
    <tr>
      <td width="150">Total Gaji </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['total_gaji']?> </td>
      <td width="207"><label>
  </table>


<?php
break;
}
?>
