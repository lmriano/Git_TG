<?php
session_start();
require_once 'conexion.php';

$email = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';

$query = "SELECT u.num_documento FROM usuarios u JOIN registro r ON u.correo = r.correo
WHERE r.correo = :email";

$stmt = $conexion->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $url = 'modificarEspecialista.php';
} else {
    $url = 'confUsuario.php';
}

header("Location: $url");
exit();
?>
