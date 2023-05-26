<?php

$nombre = isset($_POST['txt_usuario']) ? $_POST['txt_usuario'] : '';
$email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';

$email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "El correo electrónico no es válido";
}


$contraseña = isset($_POST['txt_pass']) ? $_POST['txt_pass'] : '';
$contraseña = hash('sha512',$contraseña);

try {
    $conexion = new PDO("mysql:host=localhost;port=3306;dbname=sportholter", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $pdo = $conexion->prepare('INSERT INTO usuarios(num_documento, nom_usuario, contraseña, correo, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, id_documento, ciudad_expedicion, fecha_nacimiento, telefono1, telefono2, id_genero, id_tipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    
    $pdo->bindValue(1, 1);
    $pdo->bindValue(2, $nombre);
    $pdo->bindValue(3, $contraseña);
    $pdo->bindValue(4, $email);
    $pdo->bindValue(5, "nn");
    $pdo->bindValue(6, "nn");
    $pdo->bindValue(7, "nn");
    $pdo->bindValue(8, "nn");
    $pdo->bindValue(9, "CC");
    $pdo->bindValue(10, "nn");
    $pdo->bindValue(11, "2023-05-25");
    $pdo->bindValue(12, 1);
    $pdo->bindValue(13, ""); 
    $pdo->bindValue(14, 1);
    $pdo->bindValue(15, 2);

    $pdo->execute() or die(print($pdo->errorInfo()));

    echo json_encode('true');
} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
