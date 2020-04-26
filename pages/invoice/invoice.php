<?php
include ('koneksi.php');
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page) {
case 'list':
?>
<h1> Input Invoice </h1>
<a href="index.php?p=invoice&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
<a href="index.php?p=invoice&page=cari" class="btn btn-success"><span class="glyphicon glyphicon-download-alt" target="_blank"> Laporan</span></a>
<p>
<table width="492" border="1" class="table table-striped">
    <tr>
	  <td width="21"><div align="center"><strong>No Inv</strong></div></td>
      <td width="21"><div align="center"><strong>Total Gaji</strong></div></td>
      <td width="105"><div align="center"><strong>Management fee</strong></div></td>
      <td width="120"><div align="center"><strong>PPN </strong></div></td>
      <td width="105"><div align="center"><strong>PPH 23</strong></div></td>
      <td width="105"><div align="center"><strong>Total Invoice</strong></div></td>
	  <td width="105"><div align="center"><strong>Pembayaran</strong></div></td>
	  <td width="105"><div align="center"><strong>Saldo Akhir</strong></div></td>
    </tr>
	<?php
		$tampil=mysql_query("select * from invoice");
		$no=1;
		while($data=mysql_fetch_array($tampil))
		{
	?>
    <tr>
	  <td><div align="center"><?php echo $data['no_inv'];?></div></td>
      <td><div align="center"><?php echo $data['Total_Gaji'];?></div></td>
      <td><div align="left"><?php echo $data['Management_Fee'];?></div>
      <td><div align="center"><?php echo $data['PPN'];?></div></td>
      <td><div align="center"><?php echo $data['PPH_23'];?></div></td>
      <td><div align="center"><?php echo $data['Total_Invoice'];?></div></td>
	  <td><div align="center"><?php echo $data['Pembayaran'];?></div></td>
	  <td><div align="center"><?php echo $data['Saldo_Akhir'];?></div></td>
      <td><div align="left"><a href="invoice/aksi_invoice.php?proses=hapus&no_inv=<?php echo $data['no_inv']?>"><span class="glyphicon glyphicon-floppy-remove"> Hapus</span></a><br />
	        <a href="index.php?p=gaji&page=edit&no_inv=<?php echo $data['no_inv']?>"><span class="glyphicon glyphicon-edit"> Edit</span></a></div></td>
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

<h1> Form Invoice </h1>
<form id="form1" name="form1" method="post" action="invoice/aksi_invoice.php?proses=entri">
  <table width="311" border="0">
    
    <tr>
      <td>Total Gaji</td>
      <td><label>
        <input type="text" name="total_gaji" />
      </label></td>
    </tr>
    <tr>
      <td>Management fee</td>
      <td><label>
        <select class="form-control" name="Management_fee">
                      <option value="<?php echo $data['Management_fee']; ?>"></option> 
                      <?php
                        $query=mysql_query("select Management_fee from pegawai");
                            while ($data=mysql_fetch_array($query)) {
                              echo "<option value=".$data['Management_fee'].">".$data['Management_fee']."</option>";
                        }

                      ?>
                   </select>
      </label></td>
    </tr>
	<tr>
      <td>PPN</td>
      <td><label>
        <input type="text" name="PPN" />
      </label></td>
    </tr>
	<tr>
      <td>PPH 23</td>
      <td><label>
        <input type="text" name="PPH_23" />
      </label></td>
    </tr>
	<tr>  <td>Total Invoice</td>
      <td><label>
        <input type="text" name="PPH_23" />
      </label></td>
    </tr>
	<tr>
    <tr>  <td>Pembayaran</td>
      <td><label>
        <input type="text" name="PPH_23" />
      </label></td>
    </tr>
	<tr>
	<tr>  <td>Saldo Akhir</td>
      <td><label>
        <input type="text" name="PPH_23" />
      </label></td>
    </tr>
	<tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <button name="simpan" type="submit" id="simpan" value="Simpan" class="btn btn-primary">
		    <span class="glyphicon glyphicon-floppy-disk">Simpan</span></button>
		
      </label></td>
    </tr>
  </table>
  <p><a href="index.php?p=invoice">Tampilkan Invoice </a>  </p>
</form>
<?php
break;
case 'edit':
$tampil = mysql_query("select * from invoice where no_inv='$_GET[no_inv]'");
$data=mysql_fetch_array($tampil);
?>
<form id="form1" name="form1" method="post" action="invoice/aksi_invoice.php?proses=edit">
  <table width="311" border="0">
    <tr>
      <td colspan="2"><div align="center"><strong>DATA INVOICE </strong></div></td>
    </tr>
    <tr>
      <td width="94">No Inv </td>
      <td width="207"><label>
        <input type="text" name="no_inv" value = "<?php echo $data['no_inv']?>" readonly/>
      </label></td>
    </tr>
    <tr>
      <td>Total Gaji</td>
      <td><label>
        <input type="text" name="Total_Gaji" value = "<?php echo $data['Total_Gaji']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>Management_fee</td>
      <td><label>
        <input type="text" name="Management_fee" value = "<?php echo $data['Management_fee']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>PPN</td>
      <td><label>
        <input type="text" name="PPN" value = "<?php echo $data['PPN']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>PPH 23</td>
      <td><label>
        <input type="text" name="PPH_23" value = "<?php echo $data['PPH_23']?>"/>
      </label></td>
    </tr>
	<tr>
      <td>Total INVOICE</td>
      <td><label>
        <input type="text" name="Total_Invoice" value = "<?php echo $data['Total_Invoice']?>"/>
      </label></td>
    </tr>
	<tr>
	<td>Pembayaran</td>
      <td><label>
        <input type="text" name="Pembayaran" value = "<?php echo $data['Pembayaran']?>"/>
      </label></td>
    </tr>
	<tr>
	<td>Saldo Akhir</td>
      <td><label>
        <input type="text" name="Saldo_Akhir" value = "<?php echo $data['Saldo_Akhir']?>"/>
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

<h1> Laporan Invoice </h1>
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
      <td width="21"><div align="center"><strong>No Inv</strong></div></td>
      <td width="21"><div align="center"><strong>Total Gaji</strong></div></td>
      <td width="105"><div align="center"><strong>Management fee</strong></div></td>
      <td width="120"><div align="center"><strong>PPN </strong></div></td>
      <td width="105"><div align="center"><strong>PPH 23</strong></div></td>
      <td width="105"><div align="center"><strong>Total Invoice</strong></div></td>
      <td width="105"><div align="center"><strong>Pembayaran</strong></div></td>
      <td width="105"><div align="center"><strong>Saldo Akhir</strong></div></td>
    </tr>
  <?php
    $gji = mysql_query("select * from gaji,pegawai,invoice where month(no_inv)='$_POST[bulan]' and year(no_inv) = '$_POST[tahun]' and gaji.nip=pegawai.nip");
    $no=1;
    while($data=mysql_fetch_array($gji))
    {
  ?>
    <tr>
      <td><div align="center"><?php echo $data['no_inv'];?></div></td>
      <td><div align="left"><?php echo $data['Total_Gaji'];?></div>
      <td><div align="center"><?php echo $data['Management_fee'];?></div></td>
      <td><div align="center"><?php echo $data['PPN'];?></div></td>
      <td><div align="center"><?php echo $data['PPH_23'];?></div></td>
      <td><div align="center"><?php echo $data['Total_Invoice'];?></div></td>
      <td><div align="center"><?php echo $data['Pembayaran'];?></div></td>
      <td><div align="center"><?php echo $data['Saldo_Akhir'];?></div></td>
      <td><div align="left"><a href="index.php?p=gaji&page=cetak&no_inv=<?php echo $data['no_inv']?>"><span class="glyphicon glyphicon-print"> Cetak</span></a><br />        
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
$tampil = mysql_query("SELECT * from gaji,pegawai where no_inv='$_GET[no_inv]' and gaji.Management_fee=pegawai.Management_fee");
$data=mysql_fetch_array($tampil);
?>
<h4> <B>INVOICE </B></h4>
  <table width="311" border="0">
    
    <tr>
      <td width="150">Id Gaji</td>
      <td width="150"> : </td>
      <td width="160"><?php echo $data['no_inv']?> </td>
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
      <td width="150">Management_fee </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['Management_fee']?> </td>
      <td width="207"><label>
    </tr>
    <tr>
      <td width="150">Nama </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['nama']?> </td>
      <td width="207"><label>
    </tr>
    <td width="150">No Hp </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['nohp']?> </td>
      <td width="207"><label>
    </tr>
  <tr>
      <td width="150">Alamat </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['alamat']?> </td>
      <td width="207"><label>
  <tr>
      <td width="150">Gaji Pokok</td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['gaji_pokok']?> </td>
      <td width="207"><label>
    </tr>
  <tr>
      <td width="150">Tunjangan </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['tunjangan']?> </td>
      <td width="207"><label>
  <tr>
      <td width="150">Potongan </td>
      <td width="150"> : </td>
      <td width="150"><?php echo $data['potongan']?> </td>
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
