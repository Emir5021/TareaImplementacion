<?php
include_once "database.php";

// Obtener los datos del formulario
$id = $_POST["id"];
$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Email = $_POST["Email"];
$Telefono = $_POST["Telefono"];
$Edad = $_POST["Edad"];

// Conectar a la base de datos
$conn = new Database();

// Preparar la consulta SQL
$sql = "UPDATE Alumnos SET Nombre = ?, Apellido = ?, Email = ?, Telefono = ?, Edad = ? WHERE id = ?";
$stmt = $conn->getConnection()->prepare($sql);

if ($stmt) {
    // Vincular los parámetros
    $stmt->bind_param("sssssi", $Nombre, $Apellido, $Email, $Telefono, $Edad, $id);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Alumno actualizado correctamente.";
    } else {
        echo "Error al actualizar el alumno: " . $stmt->error;
    }
    
    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->getConnection()->error;
}
?>
