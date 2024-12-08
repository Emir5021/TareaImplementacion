<?php

include_once "database.php";

// Obtener los datos del formulario
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Email = $_POST["Email"];
$Telefono = $_POST["Telefono"];
$Edad = $_POST["Edad"];

// Conectar a la base de datos
$conn = new Database();

// Preparar la consulta SQL
$sql = "INSERT INTO Alumnos (Nombre, Apellido, Email, Telefono, Edad) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->getConnection()->prepare($sql);

if ($stmt) {
    // Vincular los parámetros
    $stmt->bind_param("sssss", $Nombre, $Apellido, $Email, $Telefono, $Edad);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Se agregó el alumno correctamente.";
    } else {
        echo "Error al insertar el alumno: " . $stmt->error;
    }
    
    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->getConnection()->error;
}
?>
