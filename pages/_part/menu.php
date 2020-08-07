<?php
include "_part/koneksi.php";

if(!isset($_SESSION['username'])){
    header('location:../index.php');
}else{
?>

<div class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu" style="padding-top: 0;">

            <li class="sidebar-search" style="margin-top: 0;">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="?p=beranda"><i class="fa fa-dashboard fa-fw"></i>Beranda</a>
            </li>

            <li>
                <a href="?p=artikel"><i class="fa fa-file-text fa-fw"></i>Artikel</a>
            </li>

            <?php if ($_SESSION['level']=='spv' || $_SESSION['level']=='super'){?>
            <li>
                <small style="padding-left: 15px;">Perusahaan</small>
            </li>
            <li>
                <a href="?p=perusahaan"><i class="fa fa-building-o fa-fw"></i> Data Perusahaan</a>
            </li>
            <li>
                <a href="?p=pegawai"><i class="fa fa-table fa-fw"></i> Data Pegawai</a>
            </li>
            <li>
                <small style="padding-left: 15px;">Gaji</small>
            </li>
            <li>
                <a href="?p=gaji"><i class="fa fa-edit fa-fw"></i> Data Gaji</a>
            </li>
            <li>
                <a href="?p=cetak_slipgaji"><i class="fa fa-file-o fa-fw"></i> Cetak Slip Gaji</a>
            </li>

            <?php } if ($_SESSION['level']=='keu' || $_SESSION['level']=='super'){?>
            <li>
                <small style="padding-left: 15px;">Invoice</small>
            </li>
            <li>
                <a href="?p=invoice"><i class="fa fa-edit fa-fw"></i> Data Invoice</a>
            </li>
            <li>
                <a href="?p=cetak_invoice"><i class="fa fa-edit fa-fw"></i> Cetak Invoice</a>
            </li>
            <li>
                <a href="?p=invoice&page=laporan"><i class="fa fa-edit fa-fw"></i> Laporan Invoice</a>
            </li>
            <li>
                <small style="padding-left: 15px;">Pembayaran</small>
            </li>
            <li>
                <a href="?p=pembayaran"><i class="fa fa-edit fa-fw"></i> Data Pembayaran</a>
            </li>

            <?php } if ($_SESSION['level']=='super'){?>
            <li>
                <small style="padding-left: 15px;">User</small>
            </li>
            <li>
                <a href="?p=user"><i class="fa fa-edit fa-fw"></i> Data User</a>
            </li>
            <?php } ?>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<?php } ?>