<?php 
session_start();
include("php/config.php");

if (!isset($_SESSION['valid']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $youtube_link = mysqli_real_escape_string($con, $_POST['youtube_link']);
    $hours = intval($_POST['hours']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $query = "INSERT INTO courses (title, youtube_link, hours, description) VALUES ('$title', '$youtube_link', '$hours', '$description')";
    
    if (mysqli_query($con, $query)) {
        echo "Course added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <a href="home.php"><img src="assets/images/logo.svg" alt="Tech Academy Logo"></a>
        </div>
        <div class="right-links">
            <a href="php/logout.php"><button class="btn">Sair</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Adicionar Curso</header>
            <form method="POST" action="add_course.php">
                <div class="field input">
                    <label for="title">Título do Curso:</label>
                    <input type="text" name="title" required>
                </div>
                    
                <div class="field input">
                    <label for="youtube_link">Link do YouTube:</label>
                    <input type="url" name="youtube_link" required>
                </div>
                    
                <div class="field input">
                    <label for="hours">Horas:</label>
                    <input type="number" name="hours" min="1" required>
                </div>
                    
                <div class="field input">
                    <label for="description">Descrição:</label>
                    <textarea name="description" required></textarea>
                </div>
        
                    <button type="submit" class="btn" href="home.php">Adicionar</button>
            </form>
        </div>
    </div>
</body>
</html>
