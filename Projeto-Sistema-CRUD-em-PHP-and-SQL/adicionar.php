<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $curso = $_POST['curso'];

    $db = new SQLite3('alunos.db');
    $stmt = $db->prepare('INSERT INTO alunos (nome, data_nascimento, endereco, curso) VALUES (?, ?, ?, ?)');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $data_nascimento);
    $stmt->bindValue(3, $endereco);
    $stmt->bindValue(4, $curso);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Aluno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff3e0;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h2 {
            color: #ff8c00;
        }
        form {
            background-color: #ffe4b5;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #ff8c00;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #e07b00;
        }
    </style>
</head>
<body>
    <h2>Adicionar Aluno</h2>
    <form method="post">
        <label>Nome: <input type="text" name="nome" required></label>
        <label>Data de Nascimento: <input type="date" name="data_nascimento" required></label>
        <label>Endereço: <input type="text" name="endereco" required></label>
        <label>Curso: <input type="text" name="curso" required></label>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
