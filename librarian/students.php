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
					<div class="table-responsive">
						<table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
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
									<th>Action</th>
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
										<!-- <?php 
										echo $rows['status']==1?"":"<a class='btn btn-wide btn-danger'>Inactive</a>";
										?> -->
										<a src='<?= $rows['id'];?>' class='btn btn-wide btn-success'>Active</a>

										
									</td>
									<td> Edit | Delete</td>
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