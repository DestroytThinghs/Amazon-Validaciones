<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de los datos del formulario
    $errors = [];

    if (isset($_POST["nombre"])) {
        $nombre = trim($_POST["nombre"]);
        if ($nombre === '') {
            $errors[] = "El nombre es obligatorio.";
        }
    } else {
        $errors[] = "El nombre no fue enviado.";
    }

    if (isset($_POST["phone"])) {
        $phone = $_POST["phone"];
        if (!preg_match('/^\d{9}$/', $phone)) {
            $errors[] = "El teléfono debe tener 9 dígitos válidos.";
        }
    } else {
        $errors[] = "El teléfono no fue enviado.";
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "El correo electrónico no es válido.";
        }
    } else {
        $errors[] = "El correo electrónico no fue enviado.";
    }

    if (isset($_POST["contrasena"])) {
        $contrasena = $_POST["contrasena"];
        // Realiza la validación de la contraseña si es necesario
    } else {
        $errors[] = "La contraseña no fue enviada.";
    }

    if (isset($_POST["age"])) {
        $age = $_POST["age"];
        if ($age < 0 || $age > 100) {
            $errors[] = "La edad debe estar entre 0 y 100 años.";
        }
    } else {
        $errors[] = "La edad no fue enviada.";
    }

    // Si hay errores, mostrarlos y terminar el script
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }

    // Conexión a la base de datos y manejo de la inserción
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

    // Preparar los datos para la inserción segura
    $nombre = $conn->real_escape_string($nombre);
    $phone = $conn->real_escape_string($phone);
    $email = $conn->real_escape_string($email);
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $age = $conn->real_escape_string($age);

    // Insertar el registro en la tabla de usuarios
    $sql = "INSERT INTO users (nombre, phone, email, contrasena, age) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $phone, $email, $contrasena_hash, $age);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
