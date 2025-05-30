<?php
include 'conexao.php';

$id = $_GET['id'];

// Buscar a foto atual
$sql = "SELECT foto FROM estudantes WHERE id = $id";
$result = $conn->query($sql);
$dados = $result->fetch_assoc();

// Deletar a foto do servidor
if (!empty($dados['foto']) && file_exists("uploads/" . $dados['foto'])) {
    unlink("uploads/" . $dados['foto']);
}

// Deletar o estudante
$sql = "DELETE FROM estudantes WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>
