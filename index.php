<!-- archivo: index.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="img/landingpage.jpg" alt="Imagen Principal" class="imagen-header">
        <h1>Bienvenido a Nuestra Landing Page</h1>
        <p>Deja tus comentarios abajo</p>
    </header>

    <section>
        <!-- Formulario para ingresar los comentarios -->
        <form action="enviar_formulario.php" method="POST">
            <label for="rut">RUT:</label>
            <input type="text" id="rut" name="rut" required><br><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br><br>

            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario" rows="4" required></textarea><br><br>

            <button type="submit">Enviar</button>
        </form>

        <!-- Botón para mostrar los comentarios ingresados -->
        <form action="" method="POST">
            <button type="submit" name="mostrar_datos">Mostrar registros</button>
        </form>

        <!-- Sección para mostrar los comentarios recuperados de la base de datos -->
        <section>
            <?php
            if (isset($_POST['mostrar_datos'])) {
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "proyectolandingpage";

                // Crear conexión
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verificar conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consultar los datos de la tabla 'comentarios'
                $sql = "SELECT rut, nombre, correo, comentario, fecha FROM comentarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>Comentarios Ingresados:</h2>";
                    echo "<table border='1'>";
                    echo "<tr><th>RUT</th><th>Nombre</th><th>Correo</th><th>Comentario</th><th>Fecha</th></tr>";
                    // Mostrar los datos recuperados
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['rut'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['correo'] . "</td>";
                        echo "<td>" . $row['comentario'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No hay comentarios registrados.";
                }

                // Cerrar la conexión
                $conn->close();
            }
            ?>
        </section>
    </section>
</body>
</html>
