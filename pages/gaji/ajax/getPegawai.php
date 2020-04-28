<?php
include_once '../../_part/koneksi.php';

$id_perusahaan = $_GET['id_perusahaan'];
?>

<option value="">--- Pilih Pegawai ---</option>
<?php
$sqlPegawai = "SELECT * FROM pegawai WHERE id_perusahaan='$id_perusahaan' ORDER BY nama ASC";
$rowPegawai = $koneksi->prepare($sqlPegawai);
$rowPegawai->execute();
$hasilPegawai = $rowPegawai->fetchAll(PDO::FETCH_OBJ);

foreach($hasilPegawai as $isiPegawai){
?>
<option value="<?= $isiPegawai->nip ?>"><?= $isiPegawai->nip." - ".$isiPegawai->nama ?></option>
<?php } ?>