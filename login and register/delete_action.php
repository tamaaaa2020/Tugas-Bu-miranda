<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: home.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $username = $_SESSION['username'];

    // Pastikan berita ini dimiliki oleh pengguna yang login
    $query = "SELECT * FROM news WHERE id = $id AND username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Berita milik pengguna yang login, lanjutkan penghapusan
        $query = "DELETE FROM news WHERE id = $id AND username = '$username'";
        if (mysqli_query($con, $query)) {
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        // Berita tidak ditemukan atau bukan milik pengguna yang login
        header("Location: home.php");
        exit();
    }
} else {
    // Tidak ada ID yang diberikan
    header("Location: home.php");
    exit();
}
?>
