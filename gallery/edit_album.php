<?php
session_start();
if(!isset($_SESSION['userid'])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Edit Album</title>
</head>
<body>
	<h1>Halaman Edit Album</h1>
<p>selamat datang <b><?=$_SESSION['namalengkap']?></b></p>
<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="album.php">Album</a></li>
	<li><a href="foto.php">Foto</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>
<form action="update_album.php" method="POST">
	<?php
	include "koneksi.php";
	$albumid=$_GET['albumid'];
	$sql=mysqli_query($conn,"SELECT * FROM album WHERE albumid='$albumid'");
	while($data=mysqli_fetch_array($sql)){
	?>
	<input name="albumid" value="<?php echo $data['albumid']; ?>"  hidden />
	<table>
		<tr>
			<td>Nama Album</td>
			<td> <input type="text" name="namaalbum" value="<?=$data['namaalbum']?>"></td>
		</tr>
		<tr>
			<td>Deskripsi</td>
			<td> <input type="text" name="deskripsi" value="<?=$data['deskripsi']?>"></td>
		</tr>
		<tr>
 			<td></td>
			<td> <input type="submit" value="Ubah"></td>
		</tr>
	</table>
	<?php
	}
	?>
</form>
</body>
</html>