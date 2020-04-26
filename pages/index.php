<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}

include 'header.php';
include 'menu.php';

?>
<div id="page-wrapper">
    <br />
    <div class="row">
     
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php include 'main.php'; ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../sjs/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Page-Level Plugin Scripts - Dashboard -->
<script src="../js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="../js/plugins/morris/morris.js"></script>

<!-- SB Admin Scripts - Include with every page -->
<script src="../js/sb-admin.js"></script>

<!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
<script src="../js/demo/dashboard-demo.js"></script>

</body>

</html>


