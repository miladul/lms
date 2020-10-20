<?php
require_once('../database.php');
if(isset($_POST['active'])){
	$id = $_POST['id'];
	$change_status = mysqli_query($link, "UPDATE `books` SET `status`='0' WHERE `id`='$id'");
	header('location: manage-book.php?active_status_change');
	/*echo '<pre>';
	print_r($_POST);*/
}


if(isset($_POST['inactive'])){
	$id = $_POST['id'];
	$change_status = mysqli_query($link, "UPDATE `books` SET `status`='1' WHERE `id`='$id'");
	header('location: manage-book.php?inactive_status_change');
	/*echo '<pre>';
	print_r($_POST);*/
}

if(isset($_POST['edit'])){
	echo $id = $_POST['id'];
}

?>