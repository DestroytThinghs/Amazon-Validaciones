<?php
session_start();

// Verificar si ya hay una sesión iniciada
if (isset($_SESSION['user_id'])) {
    // Si hay sesión iniciada, redirigir al Home.php o a la página principal del usuario
    header("Location: ../Home.php");
    exit;
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Redirigir al Home.php después de iniciar sesión correctamente
            header("Location: ../Home.php");
            exit;
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta. Inténtalo de nuevo.";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado. Inténtalo de nuevo.";
    }

    $stmt->close();
    $conn->close();
}
?>