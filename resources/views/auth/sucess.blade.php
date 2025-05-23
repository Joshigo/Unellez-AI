<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f4f7f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        text-align: center;
    }
    .success-container {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 400px; /* Limitar el ancho para una mejor presentación */
        width: 100%;
    }
    h1 {
        color: var(--primary-color, #3a7bd5);
        font-size: 1.8rem;
    }
    p {
        margin-top: 1rem;
        font-size: 1rem;
    }
    a {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.8rem 1.5rem;
        background: var(--primary-color, #3a7bd5);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: background 0.3s;
    }
    a:hover {
        background: var(--button-hover, #2d62a9);
    }
    .card-body img {
        margin-top: 1.5rem; /* Separación de la imagen y el texto */
        max-width: 100%; /* Asegura que la imagen sea responsive */
        height: auto; /* Mantiene la proporción de la imagen */
    }
</style>
</head>
<body>
<div class="success-container">
    <h1>Registration Successful!</h1>
    <p>Thank you for you registration. We´ve sent you an email with more information. Please check your inbox to verify your email before logging in.</p>
    <div class="card-body pb-0 px-0 px-md-4">
        <img
            src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}"
            height="140"
            alt="User with laptop"
            data-app-dark-img="illustrations/man-with-laptop-dark.png"
            data-app-light-img="illustrations/man-with-laptop-light.png" />
    </div>
    <a href="/">Go back to Login page</a>
</div>
</body>
</html>
