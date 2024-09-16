<?php
$id = intval($_GET['id']);
$db = new SQLite3('alunos.db');


$stmt = $db->prepare('DELETE FROM alunos WHERE id = ?');
$stmt->bindValue(1, $id, SQLITE3_INTEGER);
$stmt->execute();


$stmt = $db->prepare('UPDATE alunos SET id = id - 1 WHERE id > ?');
$stmt->bindValue(1, $id, SQLITE3_INTEGER);
$stmt->execute();


$db->exec('UPDATE sqlite_sequence SET seq = (SELECT MAX(id) FROM alunos) WHERE name="alunos"');

header("Location: index.php");
exit();
?>
