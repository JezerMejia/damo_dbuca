<?php
include_once "conexion.php";

function insert_estudiante(
  mysqli $mysql,
  string $nombres,
  string $apellidos,
  string $carrera,
  string $año,
) {
  $query =
    "INSERT INTO empleado (nombres, apellidos, carrera, año) VALUES(?, ?, ?, ?);";

  $result = $mysql->execute_query($query, [
    $nombres,
    $apellidos,
    $carrera,
    $año,
  ]);

  if ($result) {
    echo "Registro guardado";
  } else {
    echo "Error al guardar el registro: {$mysql->error}";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = Connection::get_instance();
  $mysql = $conn->connect();

  $nombres = $_POST["nombres"];
  $apellidos = $_POST["apellidos"];
  $carrera = $_POST["carrera"];
  $año = $_POST["año"];

  insert_estudiante($mysql, $nombres, $apellidos, $carrera, $año);

  $conn->disconnect();
} else {
  echo "No se realizó una solicitud POST";
}
