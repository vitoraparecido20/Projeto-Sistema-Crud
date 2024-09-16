<?php

$db = new SQLite3('alunos.db');

$query = "CREATE TABLE IF NOT EXISTS alunos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    data_nascimento TEXT NOT NULL,
    endereco TEXT NOT NULL,
    curso TEXT NOT NULL
)";
$db->exec($query);
?>
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$db = new SQLite3('alunos.db');
$result = $db->query('SELECT * FROM alunos');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        a {
            text-decoration: none;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .btn-add {
            background-color: pink; /* Cor rosa */
        }
        .btn-edit {
            background-color: green;
        }
        .btn-delete {
            background-color: black;
        }
        .btn:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Lista de Alunos</h2>
    <a href="adicionar.php" class="btn btn-add">Adicionar Aluno</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Endereço</th>
            <th>Curso</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetchArray()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['data_nascimento']; ?></td>
            <td><?php echo $row['endereco']; ?></td>
            <td><?php echo $row['curso']; ?></td>
            <td>
                <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Editar</a>
                <a href="deletar.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja deletar este aluno?');">Deletar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
