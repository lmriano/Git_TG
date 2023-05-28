<?php

$nombre = isset($_POST['txt_usuario']) ? $_POST['txt_usuario'] : '';
$email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';
$contraseña = isset($_POST['txt_pass']) ? $_POST['txt_pass'] : '';
$contraseña = hash('sha512',$contraseña);

try {
    $conexion = new PDO("mysql:host=localhost;port=3306;dbname=sportholter", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $pdo = $conexion->prepare('INSERT INTO registro(correo, nom_usuario, contraseña) VALUES(?,?,?)');
    $pdo->bindValue(1, $email);
    $pdo->bindValue(2, $nombre);
    $pdo->bindValue(3, $contraseña);

    $pdo->execute() or die(print($pdo->errorInfo()));
    echo json_encode('true');

} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
