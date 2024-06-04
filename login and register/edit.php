<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: home.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];
$username = $_SESSION['username'];

$query = "SELECT * FROM news WHERE id = $id AND username = '$username'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: home.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Edit Berita Anda</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
        </div>
        <div class="right-links">
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
            <a href="home.php"><button class="btn">Home</button></a>
        </div>
    </div>
    <main>
        <h1>Edit Berita Anda</h1>
        <form class="edit-php" action="edit_action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="title">Judul Berita:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
            
            <label for="content">Isi Berita:</label>
            <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($row['content']); ?></textarea>
            
            <label for="category">Penulis:</label>
            <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required>
            
            <label for="image">Unggah Gambar:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if (!empty($row['image'])): ?>
                <p>Gambar saat ini: <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image" width="100"></p>
            <?php endif; ?>
            
            <button type="submit" class="btn">Update</button>
        </form>
    </main>
</body>
</html>
