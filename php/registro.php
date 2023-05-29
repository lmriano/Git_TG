<?php

require_once 'conexion.php';

$nombre = isset($_POST['txt_usuario']) ? $_POST['txt_usuario'] : '';
$email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';
$contraseña = isset($_POST['txt_pass']) ? $_POST['txt_pass'] : '';
$hashContraseña = password_hash($contraseña, PASSWORD_DEFAULT);

try {

    $consulta = $conexion->prepare("SELECT correo FROM registro WHERE correo = :email");
    $consulta->bindParam(':email', $email);
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        echo json_encode('Correo existente');
    } else {
        $pdo = $conexion->prepare('INSERT INTO registro(correo, nom_usuario, contraseña) VALUES(?,?,?)');
        $pdo->bindValue(1, $email);
        $pdo->bindValue(2, $nombre);
        $pdo->bindValue(3, $hashContraseña);

        $pdo->execute() or die(print($pdo->errorInfo()));
        echo json_encode('true');
    }
} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
?>
