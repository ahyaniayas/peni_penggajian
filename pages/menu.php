          <?php
error_reporting(0);
include "pages/koneksi.php";

 session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}else{

?>
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
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
                        <?php if ($_SESSION['level']=='admin'){?>
                            <li>
                            <a href="?p=pegawai"><i class="fa fa-table fa-fw"></i> Pegawai</a>
                        </li>
                        <li>
                            <a href="?p=gaji"><i class="fa fa-edit fa-fw"></i> Gaji</a>
                        </li>
						<li>
							<a href="?p=invoice"><i class="fa fa-edit fa-fw"></i> Invoice</a>
                        </li>
                    <?php } if ($_SESSION['level']=='pegawai'){?>
                        
                        
                        
                       
                        <li>
                            <a href="?p=datapegawai&username=<?php echo $_GET['username']; ?>"><i class="fa fa-table fa-fw"></i>Data Diri</a>
                        </li>
                        <li>
                            <a href="?p=datagaji&username=<?php echo $_GET['username']; ?>"><i class="fa fa-edit fa-fw"></i> Data Gaji</a>
                        </li>
						<li>
							<a href="?p=datagaji&username=<?php echo $_GET['username']; ?>"><i class="fa fa-edit fa-fw"></i> Data Invoice</a>
                        </li>
						<li>
                        <?php
                    }

                        ?>
                        
                        

                       
                       
                        
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
         <?php
                    }

                        ?>