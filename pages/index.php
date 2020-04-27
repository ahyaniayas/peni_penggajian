<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php');
}

include '_part/header.php';
include '_part/menu.php';

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
                    <?php include '_part/main.php'; ?>
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
<?php include '_part/footer.php'; ?>



