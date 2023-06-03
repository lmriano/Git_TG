<?php
session_start();
require_once 'conexion.php';

$documento = isset($_POST['documento']) ? $_POST['documento'] : '';

try {
    $pdo = $conexion->prepare('SELECT COUNT(*) FROM usuarios WHERE num_documento = :documento');
    $pdo->bindValue(':documento', $documento);
    $pdo->execute();

    $result = $pdo->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo 'encontrado';
    } else {
        echo 'no encontrado';
    }
} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
?>
