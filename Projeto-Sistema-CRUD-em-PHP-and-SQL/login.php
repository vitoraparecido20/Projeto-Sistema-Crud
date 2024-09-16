<?php
session_start();
$db = new SQLite3('alunos.db');

$usuario_bd = "vitorcosta2024";
$senha_bd = "vitor23456789";
1
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($usuario === $usuario_bd && $senha === $senha_bd) {
        $_SESSION['logged_in'] = true;
        header("Location: ../index.php"); // Certifique-se de que o caminho esteja correto
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .login-container input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .triangle-button {
            width: 0;
            height: 0;
            border-left: 30px solid transparent;
            border-right: 30px solid transparent;
            border-bottom: 60px solid #007BFF; /* Cor do botão */
            background: none;
            cursor: pointer;
            display: inline-block;
            margin-top: 20px;
        }
        .triangle-button:hover {
            border-bottom-color: #0056b3; /* Cor do botão ao passar o mouse */
        }
        .triangle-button:focus {
            outline: none;
        }
        .error {
            color: #ff8080;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label>Usuário: <input type="text" name="usuario" required></label>
            <label>Senha: <input type="password" name="senha" required></label>
            <button type="submit" class="triangle-button"></button>
        </form>
        <?php if (isset($erro)) { echo "<p class='error'>$erro</p>"; } ?>
    </div>
</body>
</html>
