<?php
include 'conexion.php';

$email = $_POST['txt_email'];
$contraseña = $_POST['txt_pass'];

try {
    $consulta = $conexion->prepare("SELECT * FROM registro WHERE correo = :email");
    $consulta->bindParam(':email', $email);
    $consulta->execute();

    if ($consulta->rowCount() > 0) {
        $registro = $consulta->fetch(PDO::FETCH_ASSOC);
        $hashContraseña = $registro['contraseña'];

        if (password_verify($contraseña, $hashContraseña)) {
            echo json_encode('true');
        } else {
            echo json_encode('false');
        }
    } else {
        echo json_encode('false');
    }
} catch(PDOException $error) {
    echo json_encode('false');
    die();
}
?>




