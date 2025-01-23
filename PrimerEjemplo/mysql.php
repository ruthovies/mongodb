<?php
// Parámetros de conexión a la base de datos
$servidor = "localhost:3307"; // o la dirección de tu servidor
$usuario = "root"; // usuario de MySQL
$clave = ""; // clave del usuario

// Crear conexión
$conn = new mysqli($servidor, $usuario, $clave);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS mi_base_de_datos";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada exitosamente.<br>";
} else {
    echo "Error al crear la base de datos: " . $conn->error . "<br>";
}

// Seleccionar la base de datos
$conn->select_db("mi_base_de_datos");

// Crear la tabla si no existe
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla creada exitosamente.<br>";
} else {
    echo "Error al crear la tabla: " . $conn->error . "<br>";
}

// Insertar algunos datos de ejemplo si la tabla está vacía
$sql = "SELECT COUNT(*) AS count FROM usuarios";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    $insert_sql = "INSERT INTO usuarios (nombre) VALUES ('Juan'), ('Ana'), ('Carlos')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Datos de ejemplo insertados correctamente.<br>";
    } else {
        echo "Error al insertar datos: " . $conn->error . "<br>";
    }
}

// Realizar la consulta SELECT para mostrar los datos
$sql = "SELECT id, nombre FROM usuarios";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<h3>Usuarios:</h3>";
    echo "<table border='1'><tr><th>ID</th><th>Nombre</th></tr>";
    // Mostrar los datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>
