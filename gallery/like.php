<?php
include "koneksi.php";
session_start();

if(!isset($_SESSION['userid'])){
	//Untuk like harus login dulu
	header("location:index.php");
}else
{
	$fotoid=$_GET['fotoid'];
	$userid=$_SESSION['userid'];
	//cek apakah user sudah pernah like foto ini apa blum
	$sql=mysqli_query($conn,"SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
	if(mysqli_num_rows($sql)==1){
		//user sudah pernah like foto ini\
		header("location:index.php");
	}
	else{
		$tanggallike=date("Y-m-d");
		mysqli_query($conn,"INSERT INTO likefoto values('','$fotoid','$userid','$tanggallike')");
		header("location:index.php");
	} 
}