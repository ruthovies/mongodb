<?php
// Datos de conexión
$servidor = "localhost:27017";
$usuario = "root";
$password = "";
$db = "gijon";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

require '../vendor/autoload.php';

use MongoDB\Client;

// Conectar a MongoDB
$client = new Client("mongodb://localhost:27017");
$collection = $client->gijon->eventos;

// Consultar la colección
$cursor = $collection->find();

// Iterar sobre los resultados
foreach ($cursor as $document) {
    $titulo = $document['titulo'];
    $enlace = $document['enlace'];
    $id = $document['id'];
    $organismo = $document['organismo'];
    $imagen = $document['imagen'];
    $alias = $document['alias'];
    $etiquetas = $document['etiquetas'];
    $fecha = $document['fecha'];
    $field_peso_value = $document['field_peso_value'];
    $descripcion = $document['descripcion'];
    $field_area = $document['field_area'];

    // Insertar en MySQL

    /* $sql = "INSERT INTO noticias (titulo, enlace, id, organismo, imagen, alias, etiquetas, fecha, field_peso_value, descripcion, field_area) VALUES ('$titulo', '$enlace', '$id', '$organismo', '$imagen', '$alias', '$etiquetas', '$fecha', '$field_peso_value', '$descripcion', '$field_area')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado exitosamente.<br>";
    } else {
        echo "Error al insertar el registro: " . $conn->error . "<br>";
    } */

    $stmt = $conn->prepare("INSERT INTO noticias (titulo, enlace, id, organismo, imagen, alias, etiquetas, fecha, field_peso_value, descripcion, field_area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $titulo, $enlace, $id, $organismo, $imagen, $alias, $etiquetas, $fecha, $field_peso_value, $descripcion, $field_area);

    if ($stmt->execute()) {
        echo "Registro insertado exitosamente.<br>";
    } else {
        echo "Error al insertar el registro: " . $stmt->error . "<br>";
    }
}

?>