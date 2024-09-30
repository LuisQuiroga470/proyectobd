<?php
$servername = "localhost";
$username = "root";
$password = "";

// Crear conexión inicial
$conn = new mysqli($servername, $username, $password);

// Verificar conexión inicial
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la base de datos 'proyectolandingpage' si no existe
$createDbSql = "CREATE DATABASE IF NOT EXISTS proyectolandingpage";
if ($conn->query($createDbSql) === TRUE) {
    echo "Base de datos 'proyectolandingpage' creada o ya existe.";
} else {
    die("Error creando la base de datos: " . $conn->error);
}

// Seleccionar la base de datos
$conn->select_db("proyectolandingpage");

// Crear la tabla 'comentarios' si no existe
$createTableSql = "CREATE TABLE IF NOT EXISTS comentarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rut VARCHAR(12) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(50),
    comentario TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($createTableSql) === TRUE) {
    echo "Tabla 'comentarios' creada o ya existe.";
} else {
    die("Error creando la tabla: " . $conn->error);
}

// Obtener datos del formulario
$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$comentario = $_POST['comentario'];

// Insertar los datos en la tabla 'comentarios'
$sql = "INSERT INTO comentarios (rut, nombre, correo, comentario) VALUES ('$rut', '$nombre', '$correo', '$comentario')";

if ($conn->query($sql) === TRUE) {
    header("Location: exito.html");  // Redirige a la página de éxito
    exit();
} else {
    echo "Error al insertar los datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

?>
