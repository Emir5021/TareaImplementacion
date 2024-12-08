<?php
include_once "database.php";

// Obtener el id del alumno a eliminar
$id = $_POST["id"];

// Conectar a la base de datos
$conn = new Database();

// Preparar la consulta SQL
$sql = "DELETE FROM Alumnos WHERE id = ?";
$stmt = $conn->getConnection()->prepare($sql);

if ($stmt) {
    // Vincular el parámetro
    $stmt->bind_param("i", $id);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Alumno eliminado correctamente.";
    } else {
        echo "Error al eliminar el alumno: " . $stmt->error;
    }
    
    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->getConnection()->error;
}
?>
