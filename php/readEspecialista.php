<?php
session_start();
require_once 'conexion.php';

$email = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';

try {
    $pdo = $conexion->prepare('SELECT * FROM usuarios WHERE correo = ?');
    $pdo->bindValue(1, $email);
    $pdo->execute();

    $result = $pdo->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
?>
