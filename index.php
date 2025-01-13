<?php
include 'config.php';

// Ambil ID karakter dari URL (misalnya, ?id=1)
$id = isset($_GET['id']) ? $_GET['id'] : 1;  // Default ID jika tidak ada di URL

// Query untuk mendapatkan karakter berdasarkan ID
$query = "SELECT * FROM characters WHERE id = $id";
$result = mysqli_query($conn, $query);
$character = mysqli_fetch_assoc($result);

// Menentukan ID karakter berikutnya dan sebelumnya
$prev_id_query = "
    SELECT id FROM characters 
    WHERE id < $id 
    ORDER BY id DESC LIMIT 1";
$next_id_query = "
    SELECT id FROM characters 
    WHERE id > $id 
    ORDER BY id ASC LIMIT 1";

// Jalankan query
$prev_result = mysqli_query($conn, $prev_id_query);
$next_result = mysqli_query($conn, $next_id_query);

// Jika tidak ada karakter sebelumnya, ambil karakter terakhir
if (mysqli_num_rows($prev_result) == 0) {
    $prev_result = mysqli_query($conn, "SELECT id FROM characters ORDER BY id DESC LIMIT 1");
}

// Jika tidak ada karakter berikutnya, ambil karakter pertama
if (mysqli_num_rows($next_result) == 0) {
    $next_result = mysqli_query($conn, "SELECT id FROM characters ORDER BY id ASC LIMIT 1");
}

// Ambil ID karakter sebelumnya dan berikutnya
$prev_id = mysqli_fetch_assoc($prev_result)['id'] ?? null;
$next_id = mysqli_fetch_assoc($next_result)['id'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Description</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .character-container {
            margin: 20px;
        }
        img {
            max-width: 300px;
            margin: 10px;
        }
        .actions {
            margin-top: 20px;
        }
        .actions a {
            padding: 10px;
            margin: 10px;
            color: white;
            background: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .actions a.disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="character-container">
        <h2><?php echo $character['name']; ?></h2>
        <p><strong>Description:</strong> <?php echo nl2br($character['description']); ?></p>
        <img src="uploads/<?php echo $character['photo']; ?>" alt="Character Photo">
        <img src="uploads/<?php echo $character['background']; ?>" alt="Character background">
        <p><strong>Voice:</strong> <?php echo $character['voice']; ?></p>
    </div>

    <div class="actions">
        <a href="?id=<?php echo $prev_id; ?>" class="<?php echo $prev_id ? '' : 'disabled'; ?>"><<</a>
        <a href="?id=<?php echo $next_id; ?>" class="<?php echo $next_id ? '' : 'disabled'; ?>">>></a>
    </div>
    <div class="actions">
    <a href="add.php">New Character</a>
    <a href="edit.php?id=<?php echo $id; ?>">Edit</a>
</div>
</body>
</html>
