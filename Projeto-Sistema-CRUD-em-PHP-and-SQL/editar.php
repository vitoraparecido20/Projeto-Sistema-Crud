<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$db = new SQLite3('alunos.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];
    $curso = $_POST['curso'];

    $stmt = $db->prepare('UPDATE alunos SET nome = ?, data_nascimento = ?, endereco = ?, curso = ? WHERE id = ?');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $data_nascimento);
    $stmt->bindValue(3, $endereco);
    $stmt->bindValue(4, $curso);
    $stmt->bindValue(5, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

$result = $db->query("SELECT * FROM alunos WHERE id = $id");
$aluno = $result->fetchArray();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Aluno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5dc; /* Background color: beige */
            margin: 0;
            padding: 20px;
            color: #5d4037; /* Text color: brown */
        }
        h2 {
            color: #4e342e; /* Heading color: dark brown */
        }
        form {
            background-color: #d7ccc8; /* Form background color: light brown */
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
            border: 1px solid #8d6e63; /* Border color: brown */
            border-radius: 5px;
        }
        button {
            background-color: #795548; /* Button color: brown */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #6d4c41; /* Button hover color: dark brown */
        }
    </style>
</head>
<body>
    <h2>Editar Aluno</h2>
    <form method="post">
        <label>Nome: <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>" required></label>
        <label>Data de Nascimento: <input type="date" name="data_nascimento" value="<?php echo $aluno['data_nascimento']; ?>" required></label>
        <label>Endereço: <input type="text" name="endereco" value="<?php echo $aluno['endereco']; ?>" required></label>
        <label>Curso: <input type="text" name="curso" value="<?php echo $aluno['curso']; ?>" required></label>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
