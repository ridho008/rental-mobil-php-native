<?php  
$id_user = $_GET['id'];

$query = $conn->query("DELETE FROM tb_user WHERE id_user = $id_user") or die(mysqli_error($conn));
if($query) {
	echo "<script>alert('Data User Berhasil dihapus.');window.location='?p=user';</script>";
} else {
	echo "<script>alert('Data User Gagal dihapus.');window.location='?p=user';</script>";
}

?>