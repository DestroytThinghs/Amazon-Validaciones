<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos (ajusta los valores de acuerdo a tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_user";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtiene la información del usuario activo
$user_id = $_SESSION['user_id'];
$query = "SELECT nombre, email FROM users WHERE id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nombre = $user['nombre'];
    $email = $user['email'];
} else {
    // Manejo de error si no se encuentra al usuario
    // Puedes redirigir o mostrar un mensaje de error
    echo "Error: Usuario no encontrado.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Amazon</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="top-nav">
            <div class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Amazon Logo">
            </div>
            <div class="location">
                <span>Enviar a</span>
                <span>Perú</span>
            </div>
            <div class="search-bar">
                <select id="category-select">
                    <option value="all">Todos</option>
                    <!-- Add other options here -->
                </select>
                <input type="text" placeholder="Buscar Amazon">
                <button type="button">🔍</button>
            </div>
            <div class="account-section">
                <span>ES</span>
                <span><p><strong>Bienvenido, </strong> <?php echo $nombre; ?></p></span>
                <span>Cuenta y Listas</span>
                <span>Devoluciones y Pedidos</span>
                <span>Carrito</span>
            </div>
        </div>
        <div class="bottom-nav">
            <span>Todo</span>
            <span>Ofertas del Día</span>
            <span>Servicio al Cliente</span>
            <span>Listas</span>
            <span>Tarjetas de Regalo</span>
            <span>Vender</span>
            <span>Obtén envío gratis a Perú</span>
        </div>
    </header>
    <main>
        <section class="banner">
            <h1>Regalos geniales para cada papá</h1>
        </section>
        <section class="offers">
            <div class="offer-item">
                <h2>Envío gratis a Perú</h2>
                <img src="envio-gratis.png" alt="Envío gratis a Perú">
            </div>
            <div class="offer-item">
                <h2>Renueva tu espacio</h2>
                <div class="sub-items">
                    <div>Comedor</div>
                    <div>Inicio</div>
                    <div>Cocina</div>
                    <div>Salud y Belleza</div>
                </div>
            </div>
            <div class="offer-item">
                <h2>Ofertas en Equipos</h2>
                <img src="ofertas-equipos.png" alt="Ofertas en Equipos">
            </div>
        </section>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
