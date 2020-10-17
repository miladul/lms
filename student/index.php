
<?php require_once('header.php'); ?>
            <!-- CONTENT -->
            <!-- ========================================================= -->
            <div class="content">
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">

                    <?php 
                    if(isset($_GET['success'])){
                        ?>
                        <div class="alert alert-success alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                           <strong>Your login successfully</strong>
                        </div>

                    <?php } ?>
                </div>
            </div>

<?php require_once('footer.php'); ?>