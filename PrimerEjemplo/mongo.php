<?php
require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Conectar a MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la base de datos
$database = $client->mitabla;

// Seleccionar la colección
$collection = $database->miregistro;

// Insertar un documento
$document = [
    'id' => '001',
    'nombre' => 'Pedro',

];

$result = $collection->insertOne($document);
echo "Documento insertado con el ID: " . $result->getInsertedId() . "\n";

// Recuperar documentos
$cursor = $collection->find();

foreach ($cursor as $doc) {
    echo "ID: " . $doc['id'] . ", Nombre: " . $doc['nombre'] . "\n";
}
?>