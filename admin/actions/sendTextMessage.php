<?php 
	include "../../dbConnect.php";
	$id = $_GET['id'];
	$pdo = new dbConnect();
	$sendText = $pdo->sendMessage($id);
	echo "<script>alert('Reminders are sent to clients Registered');window.location.href='../StudioClass-Schedule.php?id=".$id."';</script>";
?>