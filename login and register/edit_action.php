<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $username = $_SESSION['username']; 


    $query = "SELECT * FROM news WHERE id = $id AND username = '$username'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        header("Location: home.php");
        exit();
    }

    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target_path = "uploads/" . $image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $query = "UPDATE news SET title='$title', content='$content', category='$category', image='$image' WHERE id=$id AND username='$username'";
        } else {
            echo "Failed to upload file.";
            exit();
        }
    } else {
        $query = "UPDATE news SET title='$title', content='$content', category='$category' WHERE id=$id AND username='$username'";
    }

    if (mysqli_query($con, $query)) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
