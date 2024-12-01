<?php 
include '../config.php';

$kode = @$_GET['kode'];
$delete = $koneksi->query("DELETE FROM tb_user_follow WHERE FOLLOWING = '$kode'");

if ($delete) {
    echo "<script>location='index.php';</script>";
}else {
    echo "<script>location='index.php';</script>";
}
?>