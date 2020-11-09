<?php require_once('header.php'); ?>


?>
<!-- CONTENT -->
<!-- ========================================================= -->
<div class="content">
	<!-- content HEADER -->
	<!-- ========================================================= -->
	<div class="content-header">
		<!-- leftside content header -->
		<div class="leftside-content-header">
			<ul class="breadcrumbs">
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
				<li><a href="javascript:void(0)">Students</a></li>

			</ul>
		</div>
	</div>
	<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->


	<!--SEARCHING, ORDENING & PAGING-->
	<div class="row animated fadeInRight">
		<div class="col-sm-12">
			<h4 class="section-subtitle"><b>All Students</b></h4>
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
									<th>Name</th>
									<th>Roll</th>
									<th>Reg</th>
									<th>Email</th>
									<th>Username</th>
									<th>Photo</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$students = mysqli_query($link, "SELECT * FROM `students` ORDER BY `id` DESC");
								$sl =0;
								while($rows = mysqli_fetch_assoc($students)){
									/*echo '<pre>';
									print_r($rows);*/
									$sl++;
									
									?>
									<tr>
									<td><?= $sl;?></td>
									<td><?= $rows['name'];?></td>
									<td><?= $rows['roll'];?></td>
									<td><?= $rows['reg'];?></td>
									<td><?= $rows['email'];?></td>
									<td><?= $rows['username'];?></td> 
									<td><img style="height: 40px; width: 40px" src="../student/img/<?= $rows['photo'];?>"></td>
									<td>
										<?php
										if($rows['status']==1){ ?>
											<form method="POST" action="change-status.php">
												<input type="hidden" name="id" value="<?= $rows['id'];?>">
												<input type="submit" name="active" value="Active" class='btn btn-wide btn-success'>
											</form>
										<?php

										}else{ ?>
											<form method="POST" action="change-status.php">
												<input type="hidden" name="id" value="<?= $rows['id'];?>">
												<input type="submit" name="inactive" value="Inactive" class='btn btn-wide btn-warning'>
											</form>
										<?php } ?>
									</td>
								</tr>
								<?php  } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>




</div>

<?php require_once('footer.php'); ?>