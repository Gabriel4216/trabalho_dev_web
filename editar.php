<?php
include 'conexao.php';

$id = $_GET['id'];

// Buscar dados do estudante
$sql = "SELECT * FROM estudantes WHERE id = $id";
$result = $conn->query($sql);
$estudante = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Verificar se uma nova foto foi enviada
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $temp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($temp, "uploads/" . $foto);

        // Deletar a foto antiga
        if (!empty($estudante['foto']) && file_exists("uploads/" . $estudante['foto'])) {
            unlink("uploads/" . $estudante['foto']);
        }

        $sql = "UPDATE estudantes SET nome='$nome', email='$email', telefone='$telefone', foto='$foto' WHERE id=$id";
    } else {
        $sql = "UPDATE estudantes SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Estudante</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Editar Estudante</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $estudante['nome'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $estudante['email'] ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= $estudante['telefone'] ?>"><br><br>

        <label>Foto atual:</label><br>
        <img src="uploads/<?= $estudante['foto'] ?>" width="80"><br><br>

        <label>Nova foto (opcional):</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>

        <input type="submit" value="Atualizar">
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
