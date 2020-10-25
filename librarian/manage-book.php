
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
					if(isset($_GET['book-updated'])){ ?>
						<div class="alert alert-success alert-dismissable">
							<a href="javascript:history.go(-1)" class="close" data-dismiss="alert" aria-label="close">×</a>
							<strong>Book has been updated</strong>
						</div>
					<?php } ?>
					<?php 
					if(isset($_GET['added-book'])){ ?>
						<div class="alert alert-success alert-dismissable">
							<a href="javascript:history.go(-1)" class="close" data-dismiss="alert" aria-label="close">×</a>
							<strong>Book has been added</strong>
						</div>
					<?php } ?>
					<?php 
					if(isset($_GET['delete-book'])){ ?>
						<div class="alert alert-danger alert-dismissable">
							<a href="javascript:history.go(-1)" class="close" data-dismiss="alert" aria-label="close">×</a>
							<strong>Book has been deleted</strong>
						</div>
					<?php } ?>
					
					<?php 
					if(isset($_GET['active_status_change'])){ ?>
						<div class="alert alert-warning alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							<strong>Book status is now Inactive</strong>
						</div>
					<?php } ?>
					<?php 
					if(isset($_GET['inactive_status_change'])){ ?>
						<div class="alert alert-success alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							<strong>Book status is now Acctive</strong>
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
											<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#book-edit-<?= $rows['id'];?>"><i class="fa fa-pencil"></i> </a>

											<a href="delete.php?delete=<?= base64_encode(md5($rows['id']))?>" class="btn btn-danger" onclick="return confirm('Are you want to delete?')"><i class="fa fa-trash"></i></a>
											
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

<!-- Book view modal -->
<?php 
$books = mysqli_query($link, "SELECT * FROM `books` ORDER BY `id` DESC");
while($rows = mysqli_fetch_assoc($books)){ ?>

	<div class="modal fade" id="book-id-<?= $rows['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header state modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Information of <strong><?= $rows['book_name'];?></strong></h4>
				</div>
				<div class="modal-body">
					<table class="table table-bodered">
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
<!-- End view modal -->


<!-- Book edit modal -->
<?php 
$books = mysqli_query($link, "SELECT * FROM `books` ORDER BY `id` DESC");
while($rows = mysqli_fetch_assoc($books)){ ?>

	<div class="modal fade" id="book-edit-<?= $rows['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header state modal-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Edit Book of <strong><?= $rows['book_name'];?></strong> </h4>
				</div>
				<div class="modal-body">
					<?php
					if(isset($_POST['edit_book'])){
						$id = $_POST['id'];
						$book_name = $_POST['book_name'];
						$book_author_name = $_POST['book_author_name'];
						$book_publication_name = $_POST['book_publication_name'];
						$book_price = $_POST['book_price'];
						$book_qty = $_POST['book_qty'];
						$book_available_qty = $_POST['book_available_qty'];
						$librarian_username = $_SESSION['librarian_username'];
						

						/*$photo_name = $_POST['photo_old'];

						$photo = explode('.', $_FILES['book_image']['name']);
						$photo_end = end($photo);
						$photo_name = $book_name.'_'.$book_author_name.'.'.$photo_end;*/
										

						$inpur_error = array();

						if(empty($book_name)){
							$inpur_error['book_name']="Please enter a book name";
						}
						if(empty($book_author_name)){
							$inpur_error['book_author_name']="Please enter a book author name";
						}
						if(empty($book_publication_name)){
							$inpur_error['book_publication_name']="Please enter a book_publication name";
						}
						if(empty($book_price)){
							$inpur_error['book_price']="Please enter book price";
						}
						if(empty($book_qty)){
							$inpur_error['book_qty']="Please enter book_qty number";
						}
						if(empty($book_available_qty)){
							$inpur_error['book_available_qty']="Please enter book available qty number";
						}
						/*if(empty($photo_end)){
							$inpur_error['photo_end']="Please choose a book photo";
						}*/

						$input_error_count = count($inpur_error);
						if($input_error_count==0){
							$update_book = mysqli_query($link, "UPDATE `books` SET `book_name`='$book_name',`book_author_name`='$book_author_name',`book_publication_name`='$book_publication_name',`book_price`='$book_price',`book_qty`='$book_qty',`book_available_qty`='$book_available_qty',`librarian_username`='$librarian_username' WHERE `id`='$id'");
							if($update_book){
								header('location: manage-book.php?book-updated');
							}
						}

					}

					?>
					<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="book_name" class="col-sm-4 control-label">Book Name: </label>
							<div class="col-sm-8">
								<input type="hidden" name="id" value="<?= $rows['id'];?>">
								<input type="text" class="form-control" id="book_name" name="book_name" placeholder="Book Name" value="<?= $rows['book_name'];?>">
								<span class="text-danger"><?php if(isset($inpur_error['book_name'])){echo $inpur_error['book_name'];}?></span>
							</div>
						</div>

						<div class="form-group">
							<label for="book_author_name" class="col-sm-4 control-label">Book Author Name: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="book_author_name" name="book_author_name"  placeholder="Book Author Name" value="<?= $rows['book_author_name'] ?>">
								<span class="text-danger"><?php if(isset($inpur_error['book_author_name'])){echo $inpur_error['book_author_name'];}?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="book_publication_name" class="col-sm-4 control-label">Book Publication Name: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="book_publication_name" name="book_publication_name"  placeholder="Book Publication Name" value="<?= $rows['book_publication_name'];?>">
								<span class="text-danger"><?php if(isset($inpur_error['book_publication_name'])){echo $inpur_error['book_publication_name'];}?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="book_price" class="col-sm-4 control-label">Book Price: </label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="book_price" name="book_price"  placeholder="Book Price" value="<?= $rows['book_price'];?>">
								<span class="text-danger"><?php if(isset($inpur_error['book_price'])){echo $inpur_error['book_price'];}?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="book_qty" class="col-sm-4 control-label">Book Qty: </label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="book_qty" name="book_qty"  placeholder="Book Qty" value="<?= $rows['book_qty'];?>">
								<span class="text-danger"><?php if(isset($inpur_error['book_qty'])){echo $inpur_error['book_qty'];}?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="book_available_qty" class="col-sm-4 control-label">Book Available Qty: </label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="book_available_qty" name="book_available_qty"  placeholder="Book Available Qty" value="<?= $rows['book_available_qty'];?>">
								<span class="text-danger"><?php if(isset($inpur_error['book_available_qty'])){echo $inpur_error['book_available_qty'];}?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="book_image" class="col-sm-4 control-label">Book Image: </label>
							<div class="col-sm-8">
								<input type="hidden" name="photo_old" value="<?= $rows['book_image'];?>">
								<img width="50px" src="../book_img/<?= $rows['book_image'];?>">
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="book_image" class="col-sm-4 control-label">Change Book Image: </label>
							<div class="col-sm-8">
								<input type="file" class="form-control" id="book_image" name="book_image" >
								<span class="text-danger"><?php if(isset($inpur_error['photo_end'])){echo $inpur_error['photo_end'];}?></span>
							</div>
						</div> -->

						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-8">
								<button type="submit" class="btn btn-primary" name="edit_book"><i class="fa fa-save"></i> Update Book</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- End Book edit modal -->

<?php require_once('footer.php'); ?>