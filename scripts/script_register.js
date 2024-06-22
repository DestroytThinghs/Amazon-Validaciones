document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let valid = true;

    // Nombre
    const name = document.getElementById('name');
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
    const password = document.getElementById('password');
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
        window.location.href = 'about:blank'; // Redirige a una página en blanco
    }
});

document.getElementById('showPassword').addEventListener('change', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    if (this.checked) {
        password.type = 'text';
        confirmPassword.type = 'text';
    } else {
        password.type = 'password';
        confirmPassword.type = 'password';
    }
});