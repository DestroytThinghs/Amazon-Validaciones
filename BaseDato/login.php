<?php
session_start();

// Definir variables de sesión si no existen
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (!isset($_SESSION['last_attempt_time'])) {
    $_SESSION['last_attempt_time'] = time();
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar límite de intentos
    if ($_SESSION['login_attempts'] >= 3) {
        // Verificar si ha pasado 1 minuto desde el último intento fallido
        $timeSinceLastAttempt = time() - $_SESSION['last_attempt_time'];
        if ($timeSinceLastAttempt < 60) { // 60 segundos = 1 minuto
            echo "Has excedido el número de intentos permitidos. Inténtalo de nuevo en " . (60 - $timeSinceLastAttempt) . " segundos.";
            exit;
        } else {
            // Reiniciar contador de intentos y tiempo de último intento
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = time();
        }
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd_user";

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión a la base de datos
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Obtener los datos del formulario de inicio de sesión
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe y la contraseña es correcta
    $sql = "SELECT id, nombre, contrasena FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña usando password_verify
        if (password_verify($password, $user['contrasena'])) {
            // Iniciar sesión y almacenar el ID de usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];

            // Reiniciar contador de intentos y tiempo de último intento
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = time();

            // Redirigir al Home.php después de iniciar sesión correctamente
            header("Location: ../Home.php");
            exit;
        } else {
            // Contraseña incorrecta
            $_SESSION['login_attempts']++;
            echo "Contraseña incorrecta. Intento $_SESSION[login_attempts] de 3.";
        }
    } else {
        // Usuario no encontrado
        $_SESSION['login_attempts']++;
        echo "Usuario no encontrado. Intento $_SESSION[login_attempts] de 3.";
    }

    $stmt->close();
    $conn->close();
}
?>
