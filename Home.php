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
            <h1>Regalos geniales para ti mi Rey</h1>
        </section>
        <section class="offers">
            <div class="offer-item">
                <h2>Envío gratis a Perú</h2>
                <img src="https://scontent.fjau1-1.fna.fbcdn.net/v/t39.30808-6/398445253_970412717779026_5999055602071107571_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeHGFCGx88bZ-i5hduRjSXqAgpZKkH4gyj2ClkqQfiDKPfuIctJpdklKAuHsOShusTjzlc5nyC1gvKXx5MFxTVhp&_nc_ohc=JkqepnpwMN4Q7kNvgFyxk-2&_nc_ht=scontent.fjau1-1.fna&cb_e2o_trans=t&oh=00_AYBE8smRO8NAKXo6KdnndTMws90NJ_NsYJjLF91Akhv2xg&oe=667DB134" alt="Envío gratis a Perú">
            </div>
            <div class="offer-item">
                <h2>Renueva tu espacio</h2>
                <div class="sub-items">
                <div>Comedor
                        <img src="https://cdnx.jumpseller.com/formashome/image/49319696/resize/640/640?1717195145" alt="Envío gratis a Perú">
                    </div>
                    <div>Inicio
                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg1wX-FdRvFca6TRloTtnypl8RDkAZ7x19z8D60CmSVSTjC1KS9tByW3_P5BPMyepvCDYJh2TQtba0sn7ti528DZYoydbLa-JBRHOPJmCm_HV8v4E80yXpVy7NSZXUtg7b46hB5hFJ85Trb_Quu1ujrmuolPdZM6nDy6YpFnhxFIMYYSsVU7LeFXbD40w/w1064-h598/LA%20HISTORIA%20DE%20AMAZON%20DE%20UNA%20PEQUE%C3%91A%20LIBRER%C3%8DA%20EN%20L%C3%8DNEA%20A%20UN%20GIGANTE%20DEL%20COMERCIO%20ELECTR%C3%93NICO.png" alt="Envío gratis a Perú">
                    </div>
                    <div>Cocina
                        <img src="https://cdnx.jumpseller.com/formashome/image/49319696/resize/640/640?1717195145" alt="Envío gratis a Perú">
                    </div>
                    <div>Salud y Belleza
                        <img src="https://peruretail.sfo3.cdn.digitaloceanspaces.com/wp-content/uploads/Amazon-ampli%C3%B3-oferta-online-en-cosm%C3%A9tica-y-cuidado-personal.jpg" alt="Envío gratis a Perú">
                    </div>
                </div>
            </div>
            <div class="offer-item">
                <h2>Ofertas en Equipos</h2>
                <img src="https://i.blogs.es/9580c5/ofertas-del-dia/1366_2000.webp" alt="Ofertas en Equipos">
            </div>
        </section>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
