<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Buat Berita Anda</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Selamat Datang</a></p>
        </div>
        <div class="right-links">
            <a href="php/logout.php"><button class="btn">Log Out</button></a>
            <a href="home.php"><button class="btn">Home</button></a>
        </div>
    </div>
    <main>
        <h1>Buat Berita Anda</h1>
        <form class="edit-php" action="create_action.php" method="post" enctype="multipart/form-data">
            <label for="title">Judul Berita:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">Isi Berita:</label>
            <textarea id="content" name="content" rows="10" required></textarea>
            
            <label for="category">Penulis:</label>
            <input type="text" id="category" name="category" required>
            
            <label for="image">Unggah Gambar:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <button type="submit" class="btn">Submit</button>
        </form>
    </main>
    <script src="js/sweet-alert.js"></script>
</body>
</html>
