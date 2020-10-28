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
							<?php
							if(isset($_GET['issued-book'])){ ?>
								<div class="alert alert-success alert-dismissable">
									<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">×</a>
									<strong>Book issued successfully </strong>
								</div>
							<?php } ?>
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

										<div class="panel">
											<div class="panel-content">
												<div class="row">
													<div class="col-md-12">
														<form action="" method="POST">
															<div class="form-group">
																<input type="hidden" name="student_id" value="<?=$row['id']?>">
																<label for="name">Student Name</label>
																<input type="text" readonly="" class="form-control" id="book_name" name="name" value="<?=$row['name']?>">
															</div>
															<div class="form-group">
																<label for="name">Book Name</label>
																<select name="book_id" class="form-control">
																	<option value="0">Choose a book</option>
																	<?php
																	$books = mysqli_query($link, "SELECT * FROM `books` WHERE `status`=1");
																	while($rows = mysqli_fetch_assoc($books)){ ?>
																		<option value="<?= $rows['id']?>"><?= $rows['book_name']?></option>
																	<?php } ?>
																</select>
															</div>
															<div class="form-group">
																<label for="book_issue_date">Book Issue Date</label>
																<input type="date" readonly="" class="form-control" id="book_issue_date" name="book_issue_date" value="<?= date("Y-m-d") ?>">
															</div>
															<div class="form-group">
																<button type="submit" name="issue_book" class="btn btn-primary">Issue Book</button>
															</div>

														</form>
													</div>
												</div>
											</div>
										</div>
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
									<div class="alert alert-warning alert-dismissable">
										<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">×</a>
										<strong><?= $error ?></strong>
									</div>
								<?php } ?>
							<?php } ?>

						</div>
					</div>
					<?php
					if(isset($_POST['issue_book'])){
						

						$student_id = $_POST['student_id'];
						$book_id = $_POST['book_id'];
						$book_issue_date = $_POST['book_issue_date'];

						$check_already_issued = mysqli_query($link, "SELECT * FROM `issue_books` WHERE `student_id`='$student_id' AND `book_id`='$book_id' ");
						$count_issue_book = mysqli_num_rows($check_already_issued);
						if($count_issue_book==0){
							$inser_book_issue = mysqli_query($link, "INSERT INTO `issue_books`(`student_id`, `book_id`, `book_issue_date`) VALUES ('$student_id','$book_id','$book_issue_date')");
							if($inser_book_issue){
								header('location: issue-book.php?issued-book');
							}
						}else{
							$already_issued_error = "Already issued this book for this student";
						}
					}

					?>

					<?php
					if(isset($already_issued_error)){ ?>
						<div class="alert alert-warning alert-dismissable">
							<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">×</a>
							<strong><?= $already_issued_error ?></strong>
						</div>
					<?php } ?>

				</div>
			</div> 
		</div>
	</div>







</div>

<?php require_once('footer.php'); ?>