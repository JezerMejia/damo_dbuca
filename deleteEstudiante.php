<?php
include_once "conexion.php";

function delete_estudiante(
  mysqli $mysql,
  int $id
) {
  $query =
    "DELETE FROM estudiante WHERE id = ?";

  $result = $mysql->execute_query($query, [
    $id
  ]);

  if ($result) {
    echo "Registro eliminado";
  } else {
    echo "Error al eliminar el registro: {$mysql->error}";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
  $conn = Connection::get_instance();
  $mysql = $conn->connect();

  $data = file_get_contents("php://input");
  $request_vars = array();
  parse_str($data, $request_vars );

  $id = $request_vars["id"];

  delete_estudiante($mysql, $id);

  $conn->disconnect();
} else {
  echo "No se realizó una solicitud DELETE";
}
