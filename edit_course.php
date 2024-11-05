<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid']) || !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']);

    $query = mysqli_query($con, "SELECT * FROM courses WHERE id = $course_id");
    $course = mysqli_fetch_assoc($query);

    if (!$course) {
        echo "<p>Curso não encontrado!</p>";
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $youtube_link = mysqli_real_escape_string($con, $_POST['youtube_link']);
    $hours = intval($_POST['hours']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $update_query = mysqli_query($con, "UPDATE courses SET title = '$title', youtube_link = '$youtube_link', hours = $hours, description = '$description' WHERE id = $course_id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Editar Curso</title>
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
            <header>Editar Curso</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="title">Título do Curso</label>
                    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($course['title']); ?>"
                        required>
                </div>

                <div class="field input">
                    <label for="youtube_link">Link do YouTube</label>
                    <input type="url" name="youtube_link" id="youtube_link"
                        value="<?php echo htmlspecialchars($course['youtube_link']); ?>" required>
                </div>

                <div class="field input">
                    <label for="hours">Horas</label>
                    <input type="number" name="hours" id="hours"
                        value="<?php echo htmlspecialchars($course['hours']); ?>" min="1" required>
                </div>

                <div class="field input">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description"
                        required><?php echo htmlspecialchars($course['description']); ?></textarea>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Atualizar Curso">
                </div>

                <?php if (isset($_POST['submit']) && $update_query): ?>
                    <div class="message">
                        <p>Curso atualizado com sucesso!</p>
                    </div>
                    <a href='home.php'><button type="button" class="btn">Voltar para Home</button></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>