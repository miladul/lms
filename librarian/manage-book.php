
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
				<li><a href="javascript:void(0)">Manage Book</a></li>
			</ul>
		</div>
	</div>
	<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
	<div class="row animated fadeInRight">
		<div class="col-sm-12">
			<h4 class="section-subtitle"><b>All Books</b></h4>
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
									<th>BookName</th>
									<th>Price</th>
									<th>Book Qty</th>
									<th>Available Qty</th>
									<th>Added By</th>
									<th>P. Date</th>
									<th>Photo</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$books = mysqli_query($link, "SELECT * FROM `books` ORDER BY `id` DESC");
								$sl =0;
								while($rows = mysqli_fetch_assoc($books)){
									/*echo '<pre>';
									print_r($rows);*/
									$sl++;
									
									?>
									<tr>
										<td><?= $sl;?></td>
										<td><?= $rows['book_name'];?></td>
										<td><?= $rows['book_price'];?></td>
										<td><?= $rows['book_qty'];?></td>
										<td><?= $rows['book_available_qty'];?></td>
										<td><?= $rows['librarian_username'];?></td>
										<td><?= date('d-M-y',strtotime($rows['date_time']));?></td>
										<td><img style="height: 40px; width: 40px" src="../book_img/<?= $rows['book_image'];?>"></td>
										
										<td>
											<?php
											if($rows['status']==1){ ?>
												<form method="POST" action="change-book-status.php">
													<input type="hidden" name="id" value="<?= $rows['id'];?>">
													<input type="submit" name="active" value="Active" class='btn btn-wide btn-success'>
												</form>
												<?php

											}else{ ?>
												<form method="POST" action="change-book-status.php">
													<input type="hidden" name="id" value="<?= $rows['id'];?>">
													<input type="submit" name="inactive" value="Inactive" class='btn btn-wide btn-warning'>
												</form>
											<?php } ?>
										</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#book-id-<?= $rows['id'];?>"><i class="fa fa-eye"></i> </a>
											<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#info-modal"><i class="fa fa-pencil"></i> </a>
											<a href="" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
											
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

<?php 
$books = mysqli_query($link, "SELECT * FROM `books` ORDER BY `id` DESC");
while($rows = mysqli_fetch_assoc($books)){ ?>

<div class="modal fade" id="book-id-<?= $rows['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header state modal-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Information</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bodered table-hover">
					<tr>
						<th>Book Name: </th>
						<td><?= $rows['book_name'];?></td>
					</tr>
					<tr>
						<th>Author Name: </th>
						<td><?= $rows['book_author_name'];?></td>
					</tr>
					<tr>
						<th>Pubication: </th>
						<td><?= $rows['book_publication_name'];?></td>
					</tr>
					<tr>
						<th>Price: </th>
						<td><?= $rows['book_price'];?></td>
					</tr>
					<tr>
						<th>Quantity: </th>
						<td><?= $rows['book_qty'];?></td>
					</tr>
					<tr>
						<th>Available Quantity: </th>
						<td><?= $rows['book_available_qty'];?></td>
					</tr>
					<tr>
						<th>Added By: </th>
						<td><?= $rows['librarian_username'];?></td>
					</tr>
					<tr>
						<th>Status: </th>
						<td><?= $rows['status']==1?'Active':'Inactive';?></td>
					</tr>
					<tr>
						<th>Purchase Date: </th>
						<td><?= date('d-M-y',strtotime($rows['date_time']));?></td>
					</tr>

					<tr>
						<th>Photo: </th>
						<td><img style="height: 100px;" src="../book_img/<?= $rows['book_image'];?>"></td>
					</tr>
					
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php require_once('footer.php'); ?>