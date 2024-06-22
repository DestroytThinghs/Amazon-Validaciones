document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let valid = true;

    // Nombre
    const name = document.getElementById('nombre');
    if (name.value.trim() === '') {
        name.classList.add('invalid');
        valid = false;
    } else {
        name.classList.remove('invalid');
    }

    // Teléfono
    const phone = document.getElementById('phone');
    const phoneRegex = /^\d{9}$/;
    if (!phoneRegex.test(phone.value)) {
        phone.classList.add('invalid');
        valid = false;
    } else {
        phone.classList.remove('invalid');
    }

    // Correo electrónico
    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        email.classList.add('invalid');
        valid = false;
    } else {
        email.classList.remove('invalid');
    }

    // Contraseña
    const password = document.getElementById('contrasena');
    const confirmPassword = document.getElementById('confirmPassword');
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
    if (!passwordRegex.test(password.value)) {
        password.classList.add('invalid');
        valid = false;
    } else {
        password.classList.remove('invalid');
    }

    if (password.value !== confirmPassword.value) {
        confirmPassword.classList.add('invalid');
        valid = false;
    } else {
        confirmPassword.classList.remove('invalid');
    }

    // Edad
    const age = document.getElementById('age');
    if (age.value < 0 || age.value > 100) {
        age.classList.add('invalid');
        valid = false;
    } else {
        age.classList.remove('invalid');
    }

    if (valid) {
        // Preparar datos para enviar por AJAX a PHP
        const formData = new FormData();
        formData.append('nombre', name.value);
        formData.append('phone', phone.value);
        formData.append('email', email.value);
        formData.append('contrasena', password.value);
        formData.append('age', age.value);

        // Enviar datos por AJAX a register.php
        fetch('BaseDato/register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Muestra mensaje de éxito o error
            if (data === "Usuario registrado correctamente.") {
                window.location.href = 'login.html'; // Redirige si el registro fue exitoso
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

document.getElementById('showPassword').addEventListener('change', function() {
    const password = document.getElementById('contrasena');
    const confirmPassword = document.getElementById('confirmPassword');
    if (this.checked) {
        password.type = 'text';
        confirmPassword.type = 'text';
    } else {
        password.type = 'password';
        confirmPassword.type = 'password';
    }
});
