
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
    <div class="row animated fadeInRight">
        <div class="col-sm-12">
            <h4 class="section-subtitle"><b>All Issue Book</b></h4>
            <div class="panel">
                <div class="panel-content">
                    <?php 
                    if(isset($_GET['active_status_change'])){ ?>
                        <div class="alert alert-warning alert-dismissable">
                           <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                           <strong>Student status is now Inactive</strong>
                       </div>
                   <?php } ?>
                   <?php 
                   if(isset($_GET['inactive_status_change'])){ ?>
                    <div class="alert alert-success alert-dismissable">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                       <strong>Student status is now Acctive</strong>
                   </div>
               <?php } ?>
               <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Book Name</th>
                            <th>Book Image</th>
                            <th>Book Issue Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $student_id =$_SESSION['id'];
                        $sl=0;
                        $student_book = mysqli_query($link, "
                            SELECT books.book_name, books.book_image, issue_books.book_issue_date
                            FROM books
                            INNER JOIN issue_books
                            ON books.id=issue_books.book_id WHERE issue_books.student_id='$student_id';
                            ");
                        while($row = mysqli_fetch_assoc($student_book)){ ?>

                        <tr>
                            <td><?= ++$sl ?></td>
                            <td><?= $row['book_name']?></td>
                            <td><img style="height: 40px; width: 40px" src="../book_img/<?= $row['book_image']?>"></td>
                            <td><?= $row['book_issue_date']?></td>
                            
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php require_once('footer.php'); ?>