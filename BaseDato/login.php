<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Cambia esto si tienes un nombre de usuario diferente
    $password = ""; // Cambia esto si has configurado una contraseña
    $database = "bd_user"; // Cambia esto si tu base de datos tiene un nombre diferente

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar si el usuario existe
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // La contraseña es correcta, iniciar sesión o redirigir a la página de inicio
            echo "Login exitoso. Redirigiendo...";
            // Aquí puedes iniciar sesión y redirigir al usuario
            header("Location: index.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>
