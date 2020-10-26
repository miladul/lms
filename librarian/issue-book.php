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
				<li><a href="javascript:void(0)">Issue Book</a></li>
			</ul>
		</div>
	</div>
	<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
	<div class="row animated fadeInDown">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel">
				<div class="panel-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-inline" method="POST" action="">
								<h5>Issue Book</h5>
								<div class="form-group">
									<input type="text" name="roll" class="form-control" placeholder="Roll">
									<input type="text" name="reg" class="form-control" placeholder="Registration">
								</div>
								<div class="form-group">
									<button class="btn btn-primary" name="serch_book">Search</button>
									<!-- <input type="submit" name="issue-book" value="Issue Book" class="form-control  btn btn-primary"> -->
								</div>
							</form>
							<hr/>
							<?php
							if(isset($_POST['serch_book'])){
								$roll = $_POST['roll'];
								$reg = $_POST['reg'];
								$student = mysqli_query($link, "SELECT * FROM `students` WHERE `roll`='$roll' AND `reg`='$reg' ");
								$count_student = mysqli_num_rows($student);
								$row = mysqli_fetch_assoc($student);

								if($count_student==1){
									if($row['status']==1){ ?>
										<form class="form-inline" method="POST" action="">
											<table class="table table-bodered">
												<tr>
													<th>Student Name: </th>
													<td><?=$row['name']?></td>
												</tr>
												<tr>
													<th>Student Roll: </th>
													<td><?=$row['roll']?></td>
												</tr>
												<tr>
													<th>Registration No: </th>
													<td><?=$row['reg']?></td>
												</tr>
												<tr>
													<th>Select a Book: </th>
													<td>
														<select name="book_id" class="form-control">
															<option>Choose a book</option>
															<?php
															$books = mysqli_query($link, "SELECT * FROM `books` WHERE `status`=1");
															while($rows = mysqli_fetch_assoc($books)){ ?>
																<option value="<?= $rows['id']?>"><?= $rows['book_name']?></option>
															<?php } ?>
														</select>

													</td>
												</tr>
											</table>
											<div class="row">
												<div class="col-sm-6 col-sm-offset-6">
													<div class="form-group">
													<div class="">
														<button class="btn btn-primary" name="issue_book"><i class="fa fa-send"></i>&nbsp; Issue Book</button>
													</div>
												</div>
												</div>
											</div>
										</form>
										<?php

									}else{
										$error = "This student is inactive";
									} ?>

									

									<?php

								}else{
									$error = "Student not found";
								}
								?>

								<?php
								if(isset($error)){ ?>
									<div class="alert alert-danger alert-dismissable">
										<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">×</a>
										<strong><?= $error ?></strong>
									</div>
									
								<?php } ?>
							<?php } ?>

						</div> 

					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>