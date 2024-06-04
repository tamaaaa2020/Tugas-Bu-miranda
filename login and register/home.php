<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: home.php");
    exit();
}


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
            <a class="btn" href="php/logout.php">Log Out</a>
            <a class="btn" href="create.php">Buat Berita Anda</a>
        </div>
    </div>
    <main>
        <h1>Berita</h1>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="news-item">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <?php if (!empty($row['image'])): ?>
                    <p><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="News Image" width="200"></p>
                <?php endif; ?>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                <p>penulis: <?php echo htmlspecialchars($row['category']); ?></p>
                
                <p>Dibuat pada: <?php echo htmlspecialchars($row['created_at']); ?></p>
                <?php if ($row['username'] == $_SESSION['username']): ?> <div class="cont-btn">
                    <a href="edit.php?id=<?php echo $row['id']; ?>"><button class="btn">Edit</button></a>
                    <a href="delete_action.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus berita ini?');"><button class="btn">Hapus</button></a></div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            <?php
                if (isset($_SESSION['success'])) {
                    if ($_SESSION['success'] == 1) {
                    
                    
            ?>
                Swal.fire({
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success"
                });

            <?php
            $_SESSION['success'] = 0;
                }
            }
            ?>
        </script>
    </main>
</body>
</html>
