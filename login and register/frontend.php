<?php
include("php/config.php");


$query = "SELECT * FROM news";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
<div class="header">
       <img src="images/header.jpg" alt="backround">
        <p>Selamat Datang</p>
        <div class="right-links">
            <a href="register.php"><button class="btn">Ingin Buat Berita Anda?</button></a>
        </div>
    </div>
    <main>
        <h1>Berita</h1>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="news-item">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                <p>Kategori: <?php echo htmlspecialchars($row['category']); ?></p>
                <?php if (!empty($row['image'])): ?>
                    <p><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image" width="200"></p>
                <?php endif; ?>
                <p>Dibuat pada: <?php echo htmlspecialchars($row['created_at']); ?></p>
            </div>
        <?php endwhile; ?>
    </main>
</body>
</html>
