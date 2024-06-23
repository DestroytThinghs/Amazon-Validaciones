document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('pass').value;

    // Validación simple del email y la contraseña
    if (email.trim() === '') {
        alert('Por favor ingresa un email válido.');
        return;
    }

    if (password.trim() === '') {
        alert('Por favor ingresa tu contraseña.');
        return;
    }

    // Si todo está correcto, enviar el formulario
    this.submit();
});
