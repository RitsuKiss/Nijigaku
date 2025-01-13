<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $voice = $_POST['voice'];

    $background = $_FILES['background']['name'];
    $target = "uploads/" . basename($background);
    
    $photo = $_FILES['photo']['name'];
    $target = "uploads/" . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        $sql = "INSERT INTO characters (name, description, photo, background, voice) VALUES ('$name', '$description', '$photo', '$background', '$voice')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Character</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background: #333;
            color: white;
            padding: 10px;
        }
        form {
            width: 80%;
            margin: 20px auto;
        }
        form input, form textarea {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        form button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add New Character</h1>
    </header>
    
    <form action="add.php" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Character Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="file" name="photo" accept=".png" required>
        <input type="file" name="background" accept=".png" required>
        <input type="text" name="voice" placeholder="Voice Actor" required>
        <button type="submit">Add Character</button>
    </form>
</body>
</html>
