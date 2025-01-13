<?php
include 'config.php';

// Periksa apakah parameter 'id' tersedia di URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data karakter berdasarkan ID
    $query = "SELECT * FROM characters WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Periksa apakah data karakter ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Character not found.");
    }
} else {
    die("Invalid ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Character</title>
</head>
<body>
    <h1>Edit Character</h1>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br>

        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" accept=".png" required><br>

        <label for="background">Background:</label>
        <input type="file" name="background" id="background" accept=".png" required><br>

        <label for="voice">Voice:</label>
        <input type="text" name="voice" id="voice" value="<?php echo htmlspecialchars($row['voice']); ?>" required><br>

        <button type="submit">Update Character</button>
    </form>
</body>
</html>
