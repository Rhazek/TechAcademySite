<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
    $res_id = $result['Id'];
    $is_admin = $result['is_admin'];
}

$courses = mysqli_query($con, "SELECT * FROM courses"); // Recupera cursos adicionados
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>

<body>
    <div class="nav">
        <div class="logo">
            <a href="home.php"><img src="assets/images/logo.svg" alt="Tech Academy Logo"></a>
        </div>
        <div class="right-links">
            <a href='edit.php?Id=<?php echo $res_id; ?>' class="profile-icon"><svg xmlns="http://www.w3.org/2000/svg"
                    height="44px" viewBox="0 -960 960 960" width="44px" fill="#006BFF">
                    <path
                        d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                </svg></a>
            <a href="php/logout.php"><button class="btn">Sair</button></a>
        </div>
    </div>

    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Olá, <b><?php echo $res_Uname ?></b>👋<br>Bem-vindo(a) à Tech Academy.</p>
                </div>
                <?php if ($is_admin): ?>
                    <a href="add_course.php"><button class="btn add-course-btn">Adicionar Curso <svg
                                xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#e8eaed">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                            </svg></button></a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sessão de Cursos Adicionados -->
        <section class="courses-section">
            <h2>Cursos Adicionados</h2>
            <ul class="course-list">
                <?php while ($course = mysqli_fetch_assoc($courses)): ?>
                    <li class="course-item">
                        <div class="course-iten-details">
                            <iframe width="25%" height="90%" src="<?php echo $course['youtube_link']; ?>" frameborder="0"
                                allowfullscreen></iframe>
                            <div class="course-iten-desc">
                                <h3><?php echo $course['title']; ?></h3>
                                <p class="course-description"><?php echo $course['description']; ?></p>
                            </div>
                            <div class="hours-course">
                                <p><b>Horas:<b></p>
                                <?php echo $course['hours']; ?>
                            </div>
                        </div>
                        <div class="course-iten-btn">
                            <?php if ($is_admin): ?>
                                <div class="course-actions">
                                    <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="btn">Editar</a>
                                    <a href="delete_course.php?id=<?php echo $course['id']; ?>" class="btn">Excluir</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>
    </main>
</body>

</html>