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
                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
            </li>

            <?php if ($_SESSION['level']=='spv'){?>
            <li>
                <a href="?p=pegawai"><i class="fa fa-table fa-fw"></i> Pegawai</a>
            </li>
            <li>
                <a href="?p=gaji"><i class="fa fa-edit fa-fw"></i> Gaji</a>
            </li>

            <?php } if ($_SESSION['level']=='keu'){?>
            <li>
                <a href="?p=invoice"><i class="fa fa-edit fa-fw"></i> Invoice</a>
            </li>
            <?php } ?>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<?php } ?>