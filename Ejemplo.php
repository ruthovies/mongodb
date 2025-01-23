<?php
require 'vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Conectar a MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la base de datos
$database = $client->mi_base_de_datos;

// Seleccionar la colección
$collection = $database->mi_coleccion;

// Insertar un documento
$document = [
    'nombre' => 'Juan',
    'edad' => 30,
    'ciudad' => 'Madrid'
];

$result = $collection->insertOne($document);
echo "Documento insertado con el ID: " . $result->getInsertedId() . "\n";

// Recuperar documentos
$cursor = $collection->find();

foreach ($cursor as $doc) {
    echo "Nombre: " . $doc['nombre'] . ", Edad: " . $doc['edad'] . ", Ciudad: " . $doc['ciudad'] . "\n";
}
?>