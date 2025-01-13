<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $voice = $_POST['voice'];

    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $target = "uploads/" . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        $sql = "UPDATE characters SET name='$name', description='$description', photo='$photo', background='$background', voice='$voice' WHERE id=$id";
    } else {
        $sql = "UPDATE characters SET name='$name', description='$description', voice='$voice' WHERE id=$id";
    }
    if (!empty($_FILES['background']['name'])) {
        $background = $_FILES['background']['name'];
        $target = "uploads/" . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        $sql = "UPDATE characters SET name='$name', description='$description', background='$background', voice='$voice' WHERE id=$id";
    } else {
        $sql = "UPDATE characters SET name='$name', description='$description', voice='$voice' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    }
}
?>
