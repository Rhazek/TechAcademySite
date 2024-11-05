<?php
session_start();
include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
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
            <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];
                $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id ") or die("error occurred");
            }

            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id ");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
            }
            ?>

            <header>Atualizar Perfil</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Nome de usuário</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($res_Uname); ?>"
                        autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($res_Email); ?>"
                        autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Idade</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($res_Age); ?>"
                        autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Atualizar">
                </div>

                <!-- Exibe a mensagem de sucesso aqui -->
                <?php if (isset($_POST['submit']) && $edit_query): ?>
                    <div class="message">
                        <p>Perfil Atualizado!</p>
                    </div>
                    <a href='home.php'><button type="button" class="btn">Voltar para o Início</button></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>