<?php
include_once "database.php";

$conn = new Database();

$sql = "SELECT * FROM Alumnos";
$result = $conn->get_data($sql);

echo json_encode($result['DATA']);
?>
