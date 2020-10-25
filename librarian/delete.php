<?php
require_once('../database.php');
if(isset($_GET['delete'])){
	$id = base64_decode($_GET['delete']);//this is now md5 encoded value

	$books = mysqli_query($link, "SELECT * FROM `books`");
	while($rows = mysqli_fetch_assoc($books)){
		if($id == md5($rows['id'])){
			$id = $rows['id'];
			$delete_book = mysqli_query($link, "DELETE FROM `books` WHERE `id`='$id' ");
			if($delete_book){
				header('location: manage-book.php?delete-book');
			}
		}
	}
}

?>


