<?php
session_start();
require_once 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$p_nombre = isset($data['primer-nombre']) ? $data['primer-nombre'] : '';
$s_nombre = isset($data['segundo-nombre']) ? $data['segundo-nombre'] : '';
$p_apellido = isset($data['primer-apellido']) ? $data['primer-apellido'] : '';
$s_apellido = isset($data['segundo-apellido']) ? $data['segundo-apellido'] : '';
$t_documento = isset($data['tipo-documento']) ? $data['tipo-documento'] : '';
$n_documento = isset($data['numero-documento']) ? $data['numero-documento'] : '';
$c_expedicion = isset($data['ciudad-expedicion']) ? $data['ciudad-expedicion'] : '';
$f_nacimiento = isset($data['fecha-nacimiento']) ? $data['fecha-nacimiento'] : '';
$genero = isset($data['genero']) ? $data['genero'] : '';
$telefono1 = isset($data['telefono1']) ? $data['telefono1'] : '';
$telefono2 = isset($data['telefono2']) ? $data['telefono2'] : '';

$email = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';

try {
    $pdo = $conexion->prepare('INSERT INTO usuarios(num_documento, correo, primer_nombre, segundo_nombre,
    primer_apellido, segundo_apellido, id_documento, ciudad_expedicion, fecha_nacimiento, telefono1,
    telefono2, id_genero, id_tipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $pdo->bindValue(1, $n_documento);
    $pdo->bindValue(2, $email); 
    $pdo->bindValue(3, $p_nombre);
    $pdo->bindValue(4, $s_nombre);
    $pdo->bindValue(5, $p_apellido);
    $pdo->bindValue(6, $s_apellido);
    $pdo->bindValue(7, $t_documento);
    $pdo->bindValue(8, $c_expedicion);
    $pdo->bindValue(9, $f_nacimiento);
    $pdo->bindValue(10, $telefono1);
    $pdo->bindValue(11, $telefono2);
    $pdo->bindValue(12, $genero);
    $pdo->bindValue(13, 2); 

    $pdo->execute() or die(print($pdo->errorInfo()));
    echo json_encode('true');
} catch(PDOException $error) {
    echo $error->getMessage();
    die();
}
?>
