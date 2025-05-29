<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
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
        max-width: 400px;
        width: 100%;
    }

    form {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
    }


    button {
        padding: 0.8rem;
        background: var(--primary-color, #3a7bd5);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    button i {
        font-size: 1rem;
        vertical-align: middle;
    }

    button:hover {
        background: var(--button-hover, #2d62a9);
    }

    input[type="text"] {
        flex: 1;
        padding: 0.8rem;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="text"]:focus {
        border-color: var(--primary-color, #3a7bd5);
        box-shadow: 0 0 8px rgba(58, 123, 213, 0.4);
        outline: none;
    }

    input[type="text"]::placeholder {
        color: #aaa;
        font-style: italic;
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
        margin-top: 1.5rem;
        max-width: 100%;
    }

    #resend-code {
    margin-top: 1rem;
    padding: 0.8rem;
    background: var(--primary-color, #3a7bd5);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

#resend-code:hover {
    background: var(--button-hover, #2d62a9);
}

.spaces {
    display: flex;
    align-items: center; /* Alinea los elementos en la misma línea */
    gap: 1rem; /* Espacio entre el botón y el enlace */
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<div class="success-container">
    <h1>Verifica tu correo electrónico</h1>
    <p>Ya has recibido un código de verificación por correo electrónico. Para disfrutar de todos los beneficios y funcionalidades de nuestra plataforma, por favor ingresa este código en el formulario de inicio de sesión.

        Si tienes algún problema para encontrar el código o acceder al sistema, no dudes en contactar a nuestro equipo de soporte.

        ¡Disfruta UNELLEZ AI!</p>
    <div class="card-body pb-0 px-0 px-md-4">
        <img
            src="{{ asset('/sneat/assets/img/illustrations/man-with-laptop-light.png') }}"
            height="140"
            alt="User with laptop"
            data-app-dark-img="illustrations/man-with-laptop-dark.png"
            data-app-light-img="illustrations/man-with-laptop-light.png" />
    </div>

        <form action="{{route('user.verify')}}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
        <input type="text" placeholder="Enter verification code" id="verification_code" name="verification_code">
            <button type="submit">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

        <form action="{{route('resend.code')}}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
            <div class="spaces">
                <button type="submit">
                    Reenviar código
                    <i class="fa-solid fa-rotate-right" style="margin-left:5px;"></i>
                </button>
            </div>
        </form>


</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if (session('success'))
            Swal.fire({
                title: '¡Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: '¡Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        @endif
</script>

</body>
</html>
