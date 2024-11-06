<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-login {
            max-width: 400px;
            width: 100%;
            margin: auto;
            border: none;
        }

        .card-header {
            text-align: center;
        }

        .logo_title {
            color: #fff;
            font-size: 1.5rem;
            margin-top: 20px;
        }

        .input-group-prepend .input-group-text {
            background-color: #fff;
        }

        .login_btn {
            background-color: #dc3545;
            color: #fff;
        }

        .login_btn:hover {
            background-color: #c82333;
        }

        .error {
            color: red;
            text-align: center;
        }

        .btn-custom {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #45a049;
        }

        .btn-outline-custom {
            color: #4CAF50;
            border-color: #4CAF50;
        }

        .btn-outline-custom:hover {
            color: white;
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span class="logo_title mt-5">Login de Administrador</span>
        </div>
        <div class="card-body">
            <!-- Exibe a mensagem de erro se houver -->
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
            <form action="processa_login.php" method="POST">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Entrar" class="btn btn-outline-danger float-right login_btn">
                </div>

                <div class="form-group">
                    <a href="index.html" class="btn btn-outline-light float-left">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
