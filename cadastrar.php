<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Upload da foto
    $foto = $_FILES['foto']['name'];
    $temp = $_FILES['foto']['tmp_name'];
    $pasta = "uploads/";

    // Move a foto para a pasta /uploads
    move_uploaded_file($temp, $pasta . $foto);

    $sql = "INSERT INTO estudantes (nome, email, telefone, foto) VALUES ('$nome', '$email', '$telefone', '$foto')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Estudante</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Cadastrar Novo Estudante</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone"><br><br>

        <label>Foto:</label><br>
        <input type="file" name="foto" accept="image/*" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
