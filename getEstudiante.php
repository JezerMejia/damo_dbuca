<?php
include_once "conexion.php";

function get_estudiante_by_id(mysqli $mysql, string $id): string {
  $result = $mysql->execute_query("SELECT * FROM estudiante WHERE id = ?", [
    $id,
  ]);

  $estudiante = $result->fetch_assoc();
  $estudiante = json_encode($estudiante);
  $estudiante = trim($estudiante);

  $result->close();
  return $estudiante;
}

function get_all_estudiantes(mysqli $mysql): string {
  $result = $mysql->query("SELECT * FROM estudiante;");

  $estudiantes = "";
  if ($mysql->affected_rows > 0) {
    $estudiantes = "{\"data\": [";
    while ($row = $result->fetch_assoc()) {
      $estudiantes = $estudiantes . json_encode($row);
      $estudiantes = $estudiantes . ",";
    }

    $estudiantes = trim($estudiantes);
    $estudiantes = $estudiantes . "]}";
  }

  $result->close();
  return $estudiantes;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $conn = Connection::get_instance();
  $mysql = $conn->connect();

  if (isset($_GET["id"])) {
    $id_estudiante = $_GET["id"];
    $estudiante = get_estudiante_by_id($mysql, $id_estudiante);
    echo $estudiante;
    return;
  }

  $estudiantes = get_all_estudiantes($mysql);
  echo $estudiantes;

  $conn->disconnect();
}
