<?php
require 'database.php';
require 'destinos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["ubicacion"]) && !empty($_POST["precio_estimado"])) {
            createDestino($_POST["nombre"], $_POST["descripcion"], $_POST["ubicacion"], $_POST["precio_estimado"]);
        } else {
            echo "<script>alert('Todos los campos son requeridos para agregar un destino');</script>";
        }
    } elseif (isset($_POST["delete"])) {
        if (!empty($_POST["id"])) {
            deleteDestino($_POST["id"]);
        } else {
            echo "<script>alert('El ID es requerido para eliminar un destino');</script>";
        }
    }
}

$destinos = getDestinos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YucAventuraTour</title>
    <style>
        body {
            font-family: serif, monospace;
            background-color: #4bc22e;
            color: #63c046;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #a3ce3e;
        }
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: #007acc;
            font-weight: bold;
            cursor: pointer;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .section {
            display: none;
            margin: 20px 0;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
        }
    </style>
</head>
<body>

    <h1>Organiza tu viaje feliz y despreocupado</h1>

    <nav>
        <ul>
            <li><a onclick="showSection('inicio')">Inicio</a></li>
            <li><a onclick="showSection('reservas')">Reservas</a></li>
            <li><a onclick="showSection('hoteles')">Hoteles</a></li>
            <li><a onclick="showSection('guias')">Guías</a></li>
            <li><a onclick="showSection('contacto')">Contáctanos</a></li>
            <li><a onclick="showSection('destinos')">Gestión de Destinos</a></li>
        </ul>
    </nav>

    <div id="inicio" class="section" style="display: block;">
        <h2>Bienvenido a YucAventuraTour</h2>
        <p>Encuentra los mejores destinos turísticos, hospedaje y guías para tu próxima aventura.</p>
    </div>

    <div id="reservas" class="section">
        <h2>Reservas</h2>
        <p>Aquí puedes hacer tus reservas para los mejores destinos turísticos.</p>
    </div>

    <div id="hoteles" class="section">
        <h2>Hoteles Recomendados</h2>
        <p>Aquí puedes encontrar una lista de hoteles recomendados para tu estancia en cada destino.</p>
    </div>

    <div id="guias" class="section">
        <h2>Guías Turísticas</h2>
        <p>Contrata guías expertos que te ayudarán a explorar los destinos más fascinantes.</p>
    </div>

    <div id="contacto" class="section">
        <h2>Contáctanos</h2>
        <form action="enviar_contacto.php" method="post">
            <p>Nombre: <input type="text" name="nombre" required></p>
            <p>Email: <input type="email" name="email" required></p>
            <p>Mensaje: <textarea name="mensaje" rows="4" required></textarea></p>
            <p><input type="submit" value="Enviar"></p>
        </form>
    </div>

    <div id="destinos" class="section">
        <h2>Gestión de Destinos</h2>
        <form method="post">
            <h3>Agregar Destino</h3>
            <div>
                <label>Nombre: <input type="text" name="nombre" required></label>
            </div>
            <div>
                <label>Descripción: <input type="text" name="descripcion" required></label>
            </div>
            <div>
                <label>Ubicación: <input type="text" name="ubicacion" required></label>
            </div>
            <div>
                <label>Precio Estimado: <input type="number" step="0.01" name="precio_estimado" required></label>
            </div>
            <button type="submit" name="create">Agregar Destino</button>
        </form>

        <h3>Eliminar Destino</h3>
        <form method="post">
            <div>
                <label>ID del Destino: <input type="number" name="id" required></label>
            </div>
            <button type="submit" name="delete">Eliminar Destino</button>
        </form>

        <h3>Lista de Destinos</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Precio Estimado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinos as $destino): ?>
                <tr>
                    <td><?php echo $destino["id"]; ?></td>
                    <td><?php echo $destino["nombre"]; ?></td>
                    <td><?php echo $destino["descripcion"]; ?></td>
                    <td><?php echo $destino["ubicacion"]; ?></td>
                    <td><?php echo $destino["precio_estimado"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function showSection(sectionId) {
            // Ocultar todas las secciones
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.style.display = 'none');

            // Mostrar la sección seleccionada
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>

</body>
</html>
