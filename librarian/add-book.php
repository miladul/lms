
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
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                            <li><a href="javascript:void(0)">Add Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInDown">
                	<div class="col-sm-6 col-sm-offset-3">
                    <h4 class="section-subtitle"><i class="fa fa-book"></i> <b>Add</b> New Book</h4>
	                    <div class="panel">
	                        <div class="panel-content">
	                            <div class="row">
	                                <div class="col-md-12">
	                                	
	                                	<?php
										if(isset($_POST['save_book'])){
											/*echo '<pre>';
											print_r($_POST);*/
											$book_name = $_POST['book_name'];
											$book_author_name = $_POST['book_author_name'];
											$book_publication_name = $_POST['book_publication_name'];
											$book_price = $_POST['book_price'];
											$book_qty = $_POST['book_qty'];
											$book_available_qty = $_POST['book_available_qty'];

											//echo $_FILES['book_image']['name'];
										    $photo = explode('.', $_FILES['book_image']['name']);
										    $photo_end = end($photo);
										    $photo_name = $book_name.'_'.$book_author_name.'.'.$photo_end;
											//$book_image = $_POST['book_image'];

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
											 if(empty($photo_end)){
											 	$inpur_error['photo_end']="Please choose a book photo";
											 }
											 
											 $input_error_count = count($inpur_error);
											 if($input_error_count==0){
											 	$librarian_username = $_SESSION['librarian_username'];
											 	$insert_book = mysqli_query($link, "INSERT INTO `books`(`book_name`, `book_image`, `book_author_name`, `book_publication_name`, `book_price`, `book_qty`, `book_available_qty`, `librarian_username`,`status`) VALUES ('$book_name','$photo_name','$book_author_name','$book_publication_name','$book_price','$book_qty','$book_available_qty','$librarian_username','1')");
											 	move_uploaded_file($_FILES['book_image']['tmp_name'], '../book_img/'.$photo_name);
											 	if($insert_book){
											 		$book_added = "Book successfully Added";
											 		header('location: manage-book.php?added-book');
											 	}
											 }else{
											 	echo "Please input all field";
											 }
											}
										?>

										<?php
										if(isset($book_added)){
											?>
											<div class="alert alert-success alert-dismissable">
					                           <a href="javascript:history.go(-1)" class="close" data-dismiss="alert" aria-label="close">×</a>
					                           <strong><?=$book_added?></strong>
					                        </div>

											<?php
										}

										?>

	                                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
	                                    	<div class="form-group">
	                                            <label for="book_name" class="col-sm-4 control-label">Book Name: </label>
	                                            <div class="col-sm-8">
	                                                <input type="text" class="form-control" id="book_name" name="book_name" placeholder="Book Name" value="<?php if(isset($book_name)){echo $book_name;}?>">
	                                                <span class="text-danger"><?php if(isset($inpur_error['book_name'])){echo $inpur_error['book_name'];}?></span>
	                                            </div>
	                                        </div>
	                                        
	                                        <div class="form-group">
	                                            <label for="book_author_name" class="col-sm-4 control-label">Book Author Name: </label>
	                                            <div class="col-sm-8">
	                                                <input type="text" class="form-control" id="book_author_name" name="book_author_name"  placeholder="Book Author Name" value="<?php if(isset($book_author_name)){echo $book_author_name;}?>">
	                                                <span class="text-danger"><?php if(isset($inpur_error['book_author_name'])){echo $inpur_error['book_author_name'];}?></span>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="book_publication_name" class="col-sm-4 control-label">Book Publication Name: </label>
	                                            <div class="col-sm-8">
	                                                <input type="text" class="form-control" id="book_publication_name" name="book_publication_name"  placeholder="Book Publication Name" value="<?php if(isset($book_publication_name)){echo $book_publication_name;}?>">
	                                                <span class="text-danger"><?php if(isset($inpur_error['book_publication_name'])){echo $inpur_error['book_publication_name'];}?></span>
	                                            </div>
	                                        </div>
	                                         <div class="form-group">
	                                            <label for="book_price" class="col-sm-4 control-label">Book Price: </label>
	                                            <div class="col-sm-8">
	                                                <input type="number" class="form-control" id="book_price" name="book_price"  placeholder="Book Price" value="<?php if(isset($book_price)){echo $book_price;}?>">
	                                                <span class="text-danger"><?php if(isset($inpur_error['book_price'])){echo $inpur_error['book_price'];}?></span>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="book_qty" class="col-sm-4 control-label">Book Qty: </label>
	                                            <div class="col-sm-8">
	                                                <input type="number" class="form-control" id="book_qty" name="book_qty"  placeholder="Book Qty" value="<?php if(isset($book_qty)){echo $book_qty;}?>">
	                                                <span class="text-danger"><?php if(isset($inpur_error['book_qty'])){echo $inpur_error['book_qty'];}?></span>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="book_available_qty" class="col-sm-4 control-label">Book Available Qty: </label>
	                                            <div class="col-sm-8">
	                                                <input type="number" class="form-control" id="book_available_qty" name="book_available_qty"  placeholder="Book Available Qty" value="<?php if(isset($book_available_qty)){echo $book_available_qty;}?>">
	                                                <span class="text-danger"><?php if(isset($inpur_error['book_available_qty'])){echo $inpur_error['book_available_qty'];}?></span>
	                                            </div>
	                                        </div>
	                                        <div class="form-group">
	                                            <label for="book_image" class="col-sm-4 control-label">Book Image: </label>
	                                            <div class="col-sm-8">
	                                                <input type="file" class="form-control" id="book_image" name="book_image" >
	                                                <span class="text-danger"><?php if(isset($inpur_error['photo_end'])){echo $inpur_error['photo_end'];}?></span>
	                                            </div>
	                                        </div>
	                                        
	                                        <div class="form-group">
	                                            <div class="col-sm-offset-4 col-sm-8">
	                                                <button type="submit" class="btn btn-primary" name="save_book"><i class="fa fa-save"></i> Save Book</button>
	                                            </div>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </div>
            </div>

<?php require_once('footer.php'); ?>