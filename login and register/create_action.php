<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $username = $_SESSION['username']; // Mengambil username dari sesi

    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target_path = "uploads/" . $image;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            echo "Failed to upload file.";
            exit();
        }
    }

    $query = "INSERT INTO news (title, content, category, username, image, created_at) VALUES ('$title', '$content', '$category', '$username', '$image', NOW())";
    if (mysqli_query($con, $query)) {
        $_SESSION['success'] = 1;
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
