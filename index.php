<?php
include 'conexao.php';

$sql = "SELECT * FROM estudantes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Estudantes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Estudantes Cadastrados</h2>
    <a href="cadastrar.php">Novo Cadastro</a><br><br>
    <table border="1">
        <tr>
            <th>Foto</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="uploads/<?= $row['foto'] ?>" width="50"></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['telefone'] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
                <a href="deletar.php?id=<?= $row['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
