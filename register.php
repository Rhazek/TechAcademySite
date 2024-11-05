<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            include("php/config.php");
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];

                //Verificar se e-mail já existe
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                      <p>Este email já está sendo usado! Por favor, tente outro!</p>
                  </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar</button>";
                } else {
                    mysqli_query($con, "INSERT INTO users(Username,Email,Age,Password) 
                    VALUES('$username','$email','$age','$password')") or die("Erroe Occured");
                    echo "<div class='message'>
                      <p>Cadastro realizado com Sucesso!</p>
                  </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Entrar agora</button>";
                }

            } else {
                ?>
                <div class="logo-login">
                    <img src="assets/images/logo.svg" alt="Tech Academy Logo">
                </div>
                <header>Registro</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Nome de usuário</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="age">Idade</label>
                        <input type="number" name="age" id="age" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Registrar" required>
                    </div>
                    <div class="links">
                        Já é um membro? <a href="index.php" style="text-decoration: none;color: #006BFF;">Entre na sua
                            conta</a>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>