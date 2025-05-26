<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/public/favicon_emi.png" type="image/x-icon">
     <meta property="og:image" content="https://my.emiassistant.com/public/favicon_emi.png">

    <title>Inciar sesión | Unellez AI</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .left-side {
            width: 100%;
            height: 100%;

            background: #e6e6e6;

            display: flex;

            justify-content: start;
            align-items: center;

            flex: 1;
            flex-direction: column;

            box-sizing: border-box;
        }

        header {
            width: 100%;

            display: flex;

            justify-content: start;
            align-items: center;

            flex-direction: column;

            box-sizing: content-box;

        }
        .header-container-icon {
            margin-top: 15px;

            width: 100%;
            height: 120px;

            display: flex;

            justify-content: center;
            align-items: center;

            box-sizing: border-box;
        }

        .header-container-icon img {
            height: 100%;

            aspect-ratio: 1 / 1;

            object-fit: contain;
        }

        .header-container-text {
            width: 100%;

            display: flex;

            justify-content: center;
            align-items: center;

            flex-direction: column;

            box-sizing: content-box;
        }

        .header-text {
            width: 100%;

            box-sizing: content-box;

            font-size: 16px;

            text-align: center;
        }

        .title-color {
            color: #3793f6;
        }

        .normal-color {
            color: #6a86a2;
        }

        .carousel {
            margin-top: 10px;
            padding: 10px;

            width: 100%;

            position: relative;

            display: flex;

            justify-content: start;
            align-items: center;

            flex: 1;
            flex-direction: column;

            box-sizing: border-box;
        }

        .carousel-container-img {
            width: 100%;

            display: flex;

            justify-content: center;
            align-items: center;

            flex: 1;
        }

        .carousel-img {
            width: 100%;
            height: 100%;

            display: flex;

            justify-content: center;
            align-items: center;

            object-fit: contain;
        }

        .carousel-container-dots {
            margin-bottom: 10px;

            width: calc(100% - 20px);

            min-height: 50px;

            position: absolute;

            bottom: 0px;
            left: 20px;

            display: flex;

            justify-content: center;
            align-items: center;

            gap: 8px;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;

            background: transparent;

            border: 2.5px solid #3793F6;
            border-radius: 14px;

            transition: width 0.3s ease-in-out background-color 0.3s ease-in-out;
        }

        .carousel-dot:hover {
            cursor: pointer;
        }

        .dot-active {
            width: 30px;

            background: #3793F6;
        }

        .dot-active:hover {
            cursor: default;
        }

        :root {
            --color-negro: #364E65;
            --color-texto: #727C77;
            --color-rojo: #ED0722;
            --color-rgba-rojo: rgba(237, 7, 34, .21);
            --color-rgba-celeste: rgba(55, 147, 246, .27);
            --color-celeste: #3793F6;
            --color-input: #EEF5F9;
        }

        .input-error {
            border: 1px solid var(--color-rojo) !important;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            width: 100vw;
            height: 100vh;

            display: flex;

            justify-content: center;
            align-items: center;
        }
        body {
            width: 100%;
            height: 100%;

            background: #f7f9fd;

            display: flex;

            justify-content: center;
            align-items: center;

            font-family: 'Lato', sans-serif;
            font-size: 15px;
        }

        a {
            text-decoration: none;
        }

        ul,
        ol {
            list-style: none;
        }

        .contenedor-login {
            width: 100%;
            height: 100%;

            display: flex;

            justify-content: start;
            align-items: center;

            flex: 1;

            overflow: hidden;
        }

        .contenedor-slider {
            height: 100%;

            display: flex;

            flex: 1;

            overflow: hidden;
            position: relative;
        }

        .slider {
            width: 100%;
            height: 100%;

            position: relative;

            display: flex;
        }

        .slide {
            min-width: 100%;
            min-height: 100%;
            height: auto;
            display: none;
            position: relative;
            justify-content: center;
        }

        .slide.active {
            display: flex;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;

        }

        .contenido-slider {
            position: absolute;
            top: 20px;
            width: 600px;
            text-align: center;
        }

        .contenido-slider .logo {
            margin-top: 0px;
            margin-bottom: 5px;
        }

        .contenido-slider .logo img {
            width: 200px;
        }

        .contenido-slider .slider-texto {
            color: #6a86a2;
            font-size: 16px;
        }

        /* Animacion slide */
        .fade {
            animation: fade 1.5s ease-in-out;
            -webkit-animation: fade 1.5s ease-in-out;
        }

        @-webkit-keyframes fade {
            from {
                opacity: 0.4;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade {
            from {
                opacity: 0.4;
            }

            to {
                opacity: 1;
            }
        }

        /* botones next y prev */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            background: var(--color-celeste);
            margin-top: -22px;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            transition: all .6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            outline: 0;
        }

        .next {
            right: 0;
            border-radius: 3px 0px 0px 3px;
        }

        .prev:hover,
        .next:hover {
            background: var(--color-negro);
        }

        /* puntos */
        .dots {
            position: absolute;
            width: 100%;
            text-align: center;
            bottom: 10px;
        }

        .dots .dot {
            outline: 0;
            cursor: pointer;
            height: 8px;
            width: 8px;
            margin: 0 2px;
            border: 1px solid var(--color-celeste);
            border-radius: 4px;
            display: inline-block;
            transition: all .6s ease-in-out;
        }

        .dots .dot.active {
            background: var(--color-celeste);
            width: 30px;
        }

        .contenedor-texto {
            --real-width: 450px;

            min-width: var(--real-width);
            max-width: var(--real-width);

            height: 100vh;

            background: #fff;

            overflow: hidden;
            overflow-y: auto;
        }

        /* --- Scroll bar --- */
        .contenedor-texto::-webkit-scrollbar {
            width: 5px;
        }

        .contenedor-texto::-webkit-scrollbar-track {
            background: #a0a0a0;
        }

        .contenedor-texto::-webkit-scrollbar-thumb {
            background: #ebebeb;
        }

        .contenedor-texto::-webkit-scrollbar-thumb:hover {
            background: #d3d3d3;

            cursor: pointer;
        }

        .contenedor-form {
            width: 100%;
            padding: 100px 50px 50px 50px;
        }

        .contenedor-form .titulo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--color-negro);
        }

        .contenedor-form .descripcion {
            font-size: 15px;
            color: var(--color-texto);
        }

        .tabs-links {
            margin-top: 70px;
            display: flex;
            width: 100%;
            border-bottom: 1px solid #f2f2f2;
            padding-bottom: 10px;
        }

        .tabs-links .tab-link {
            font-size: 15px;
            margin-right: 30px;
            color: var(--color-texto);
            cursor: pointer;
            position: relative;
        }

        .tabs-links .tab-link.active {
            color: var(--color-celeste);
            font-weight: 700;
        }

        .tabs-links .tab-link.active::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: var(--color-celeste);
            left: 0;
            bottom: -10px;
        }

        .formulario {
            display: none;
            margin-top: 30px;
        }

        .formulario.active {
            display: block;
        }

        .formulario .input-text {
            padding: 14px 20px;
            border: 1px solid transparent;
            background: var(--color-input);
            margin-bottom: 20px;
            border-radius: 3px;
            width: 100%;
            outline: 0;
            font-size: 14px;
            color: var(--color-texto);
        }

        .formulario .grupo-input {
            display: flex;
            width: 100%;
            position: relative;
            margin-bottom: 20px;
        }

        .formulario .grupo-input .input-text {
            padding-right: 60px;
            margin-bottom: 0px;
        }

        .formulario .grupo-input .icono {
            position: absolute;
            width: 60px;
            height: 100%;
            border: none;
            cursor: pointer;
            background: none;
            font-size: 18px;
            color: var(--color-texto);
            right: 0;
            outline: 0;
        }

        .formulario .grupo-input .icono.active {
            color: var(--color-celeste);
        }

        .formulario .input-text:focus {
            border: 1px solid green;
        }

        .link {
            font-size: 14px;
            color: var(--color-celeste);
        }

        .link:hover {
            text-decoration: underline;
        }

        .formulario .btn {
            width: 100%;
            padding: 14px;
            border: none;
            background: var(--color-celeste);
            color: #fff;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 4px;
            margin-top: 30px;
            outline: 0;
            cursor: pointer;
            display: block;
        }

        .formulario .btn:hover {
            background: #3285dd;
        }

        .contenedor-cbx {
            display: inline-block;
            position: relative;
            padding-left: 28px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 14px;
            color: var(--color-texto);
            user-select: none;
        }

        .police {
            display: flex;
            margin-top: 20px;
            justify-content: center;
            gap: 20px;
            /* Ajusta la separación entre los enlaces */
        }

        .social-login {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .social-btn img {
            width: 24px;
            height: 24px;
        }

        .contenedor-cbx input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .contenedor-cbx .cbx-marca {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background: transparent;
            border: 1px solid var(--color-texto);
            border-radius: 2px;
            transition: all .8s ease;
        }

        .contenedor-cbx:hover input~.cbx-marca {
            border: 1px solid var(--color-celeste);
        }

        .contenedor-cbx .cbx-marca::after {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            content: '\f00c';
            font-size: 13px;
            position: absolute;
            display: none;
            left: 3px;
            top: 3px;
            color: #fff;
        }

        .contenedor-cbx input:checked~.cbx-marca::after {
            display: block;
        }


        .contenedor-cbx input:checked~.cbx-marca {
            background: var(--color-celeste) !important;
            border: 1px solid var(--color-celeste) !important;
        }

        .contenedor-cbx.animate input:checked~.cbx-marca {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }

        .error-text {
            background: var(--color-rgba-rojo);
            border-radius: 4px;
            padding: 8px 20px;
            margin-bottom: 10px;
            display: none;
        }

        .error-text p {
            font-size: 13px;
            color: var(--color-rojo);
        }


        .error-text.active {
            display: block;
        }

        .cbx-error .cbx-marca {
            -webkit-animation: cbx_error .2s ease-in-out infinite;
            animation: cbx_error .2s ease-in-out infinite;
            border: 1px solid var(--color-rojo);

        }

        @keyframes cbx_error {

            0% {
                -webkit-transform: rotateX(-5deg);
                transform: rotateX(-5deg);

            }

            50% {
                -webkit-transform: rotateX(0deg) scale(.8);
                transform: rotateX(0deg) scale(.8);
            }

            100% {
                -webkit-transform: rotateX(5deg);
                transform: rotateX(5deg);
            }
        }


        @media screen and (max-width: 468px) {
            .active-img {
                display: none;
            }

            .slide img {
                margin-top: 20px;
            }

            .contenedor-slider {
                display: none;
            }

            .contenedor-login {
                margin-top: 0px;
                overflow: none;
            }
        }

        }

        @media screen and (max-width: 768px) {

            .contenedor-login {
                flex-direction: column;
                height: 100%;
            }

            .contenedor-slider {
                width: 100%;
                height: 400px;
                position: relative;
            }

            .contenido-slider {
                top: 30px;
                width: 100%;
            }



            .dots {
                display: none;
            }



            .contenedor-texto {
                width: calc(100% - 30px);
                position: relative;
                background: #fff;
                box-shadow: 0px 3px 6px rgba(0, 0, 0, .08);
                margin: auto;
                margin-top: -50px;
                border-radius: 7px;
                margin-bottom: 40px;
            }

            .contenedor-form {
                padding: 20px !important;
            }

            .contenedor-form .titulo {
                font-size: 20px;
            }

            .contenedor-form .tabs-links {
                margin-top: 40px;
            }


        }



        @media screen and (max-width: 812px) {
            .contenido-slider .slider-texto {
                display: none;
            }
        }

        @media screen and (max-width: 1024px) {
            .contenedor-form {
                padding: 50px;
            }

            .prev,
            .next {
                display: none;
            }

            .contenido-slider {
                width: 100%;
                top: 30px;
            }

            .contenido-slider .slider-texto {
                padding: 0px 30px;
            }

            .slide img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
     @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: '¡Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif
    <div class="contenedor-login">
        <div class="contenedor-slider">
            <div class="left-side">
                <header>
                    <div class="header-container-icon">
                        <img src="/logo_blue.png" alt="Unellez AI Logo">
                    </div>
                    <section class="header-container-text">
                        <h1 class="header-text title-color">Título</h1>
                        <h2 class="header-text normal-color">Subtítulo</h2>
                    </section>
                </header>

                <div class="carousel">
                    <div class="carousel-container-img">
                        <img class="carousel-img" src="banner_2.png">
                    </div>

                    <div class="carousel-container-dots">
                        <span class="carousel-dot dot-active"></span>
                        <span class="carousel-dot"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenedor-texto">

            <div class="contenedor-form">

                <h1 class="titulo" style="text-align:center;">¡Bienvenido a Unellez AI!</h1>
                <p class="descripcion" style="text-align:center;">
                    Inicia sesión para acceder a todas las funcionalidades de nuestra plataforma.
                </p>

                <!-- Tabs -->
                <ul class="tabs-links">
                    <li class="tab-link active">Iniciar sesión</li>
                    <li class="tab-link ">Registrarse</li>
                </ul>

                <!--========================================
                    Formulario logue
                ==========================================-->
                <form action="{{ url('/login') }}" method="post" id="formLogin" class="formulario active">
                    @csrf
                    <div class="error-text">
                        <p>aqui los errores del formualrio</p>
                    </div>

                    <input type="email" placeholder="Email" class="input-text" id="email" name="email" autocomplete="off">
                    <div class="grupo-input">

                        <input type="password" placeholder="Contraseña" id="password" name="password" class="input-text clave">
                        <button type="button" class="icono fas fa-eye mostrarClave"></button>

                    </div>
                    <a href="{{route('password.forgot')}}" class="link">¿Olvidaste tu contraseña?</a>
                    <button class="btn" id="btnLogin" type="submit">Iniciar sesión</button>


                    <div class="police">
                        <a href="https://my.emiassistant.com/privacy-policy" class="link">Políticas de privacidad</a>
                        <a href="https://my.emiassistant.com/terms" class="link">Términos y condiciones</a>
                    </div>

                </form>

                <!--========================================
                    Formulario de Registro
                ==========================================-->
                <form action="{{ url('/register') }}" method="post" id="formRegistro" class="formulario ">
                    @csrf
                    <div class="error-text ">

                    </div>
                    <input type="text" placeholder="Nombre completo" class="input-text" id="name" name="name" autocomplete="off">
                    <input type="text" placeholder="Cédula" class="input-text" id="ci" name="ci" autocomplete="off">
                    <select name="program_id" id="program_id" class="input-text">
                        <option value="">Seleccione un programa</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                    <input type="email" placeholder="Email" class="input-text" name="email" id="email" autocomplete="off">
                    <div class="grupo-input">
                        <input type="password" placeholder="Password" name="password" class="input-text clave">
                        <button type="submit" class="icono fas fa-eye mostrarClave"></button>
                    </div>


                    <!-- Checkbox Personalizados -->
                    <label class="contenedor-cbx animate">
                        I would like to receive notifications about products
                        <input type="checkbox" name="cbx_notificaciones" checked>
                        <span class="cbx-marca"></span>
                    </label>

                    <label class="contenedor-cbx animate">
                        I have read and accept the
                        <a href="https://my.emiassistant.com/terms" class="link">Terms and Conditions</a>
                        <a href="https://my.emiassistant.com/privacy-policy" class="link">and Privacy Policy</a>

                        <input type="checkbox" name="cbx_terminos">
                        <span class="cbx-marca"></span>

                    </label>

                    <button class="btn" id="btnRegistro" type="button">Create Account</button>


                </form>


            </div>

        </div>

    </div>

    <script>

        const tabLink = document.querySelectorAll('.tab-link');
        const formularios = document.querySelectorAll('.formulario');
        for (let x = 0; x < tabLink.length; x++) {

            tabLink[x].addEventListener('click', () => {
                tabLink.forEach((tab) => tab.classList.remove('active'));
                tabLink[x].classList.add('active');
                formularios.forEach((form) => form.classList.remove('active'));
                formularios[x].classList.add('active');

            })
        }
        const mostrarClave = document.querySelectorAll('.mostrarClave');
        const inputPass = document.querySelectorAll('.clave');
        for (let i = 0; i < mostrarClave.length; i++) {
            mostrarClave[i].addEventListener('click', () => {
                if (inputPass[i].type === "password") {
                    inputPass[i].setAttribute('type', 'text');
                    mostrarClave[i].classList.remove('fa-eye');
                    mostrarClave[i].classList.add('fa-eye-slash');
                    mostrarClave[i].classList.add('active');
                } else {
                    inputPass[i].setAttribute('type', 'password');
                    mostrarClave[i].classList.remove('fa-eye-slash');
                    mostrarClave[i].classList.add('fa-eye');
                    mostrarClave[i].classList.remove('active');

                }
            });
        }
        let name, email, password, business, cbx_notificaciones, cbx_terminos;

        if (document.getElementById('btnRegistro')) {

            const btnRegistro = document.getElementById('btnRegistro');
            btnRegistro.addEventListener('click', (e) => {
                e.preventDefault();
                const msError = document.querySelector('#formRegistro .error-text');
                msError.innerHTML = "";
                msError.classList.remove('active');
                name = formRegistro.name.value.trim();
                email = formRegistro.email.value.trim();
                password = formRegistro.password.value.trim();
                cbx_notificaciones = formRegistro.cbx_notificaciones;
                cbx_terminos = formRegistro.cbx_terminos;
                if (name == "" && email == "" && password == "") {
                    mostrarError('Todos los campos son obligatorios', msError);
                    inputError([formRegistro.name, formRegistro.email, formRegistro.password]);
                    return false;

                } else {
                    inputErrorRemove([formRegistro.name, formRegistro.email, formRegistro.password]);
                }
                if (name == "" || name == null) {
                    mostrarError('Por favor ingrese su nombre', msError);
                    inputError([formRegistro.name]);
                    formRegistro.name.focus();
                    return false;
                } else {
                    if (!validarSoloLetras(name)) {
                        mostrarError('Ingrese un nombre válido, no se permiten caracteres especiales', msError);
                        inputError([formRegistro.name]);
                        formRegistro.name.focus();
                        return false;
                    }
                }
                if (email == null || email == "") {
                    mostrarError('Por favor ingrese su correo', msError);
                    inputError([formRegistro.email]);
                    formRegistro.email.focus();

                    return false;
                } else {

                    if (!validarCorreo(email)) {
                        mostrarError('Por favor ingrese un correo válido', msError);
                        inputError([formRegistro.email]);
                        formRegistro.email.focus();
                        return false;
                    }
                }
                if (password == "" || password == null) {
                    mostrarError('Por favor ingrese una contraseña', msError);
                    inputError([formRegistro.password]);
                    formRegistro.password.focus();
                    return false;
                } else {
                    if (password.length <= 4) {
                        mostrarError('Contraseña débil, min.5 carácteres', msError);
                        inputError([formRegistro.password]);
                        formRegistro.password.focus();
                        return false;
                    }
                }




                if (cbx_terminos.checked == false) {
                    mostrarError('Por favor aceptar Términos y condiciones', msError);
                    formRegistro.cbx_terminos.parentNode.classList.add('cbx-error');
                    return false;
                } else {
                    formRegistro.cbx_terminos.parentNode.classList.remove('cbx-error');
                }
                formRegistro.submit();
                return true;

            });

            formRegistro.cbx_terminos.addEventListener('change', (e) => {
                if (e.target.checked) {
                    formRegistro.cbx_terminos.parentNode.classList.remove('cbx-error');
                }
            })


        }
        if (document.getElementById('btnLogin')) {

            const btnLogin = document.getElementById('btnLogin');

            btnLogin.addEventListener('click', (e) => {

                e.preventDefault();

                const msError = document.querySelector('#formLogin .error-text');
                msError.innerHTML = "";
                msError.classList.remove('active');

                email = formLogin.email.value.trim();
                password = formLogin.password.value.trim();

                if (email == "" && password == "") {
                    mostrarError('Por favor ingrese su usuario/contraseña', msError);
                    inputError([formLogin.email, formLogin.password]);
                    return false;
                } else {
                    inputErrorRemove([formLogin.email, formLogin.password]);
                }

                if (email == "" || email == null) {
                    mostrarError('Por favor ingrese su email', msError);
                    inputError([formLogin.email]);
                    formLogin.email.focus();
                    return false;
                }

                if (password == "" || password == null) {
                    mostrarError('Por favor ingrese su contraseña', msError);
                    inputError([formLogin.password]);
                    formLogin.password.focus();
                    return false;
                }
                formLogin.submit();
                return true;

            })
        }
        function mostrarError(mensaje, msError) {
            msError.classList.add('active');
            msError.innerHTML = '<p>' + mensaje + '</p>';
        }
        function inputError(datos) {
            for (let i = 0; i < datos.length; i++) {
                datos[i].classList.add('input-error');

            }

        }

        function inputErrorRemove(datos) {
            for (let i = 0; i < datos.length; i++) {
                //removemos la clase
                datos[i].classList.remove('input-error');

            }

        }
        function validarLetrasNumeros(valor) {
            if (!/^[a-zA-Z0-9]+$/.test(valor)) {
                return false;
            }
            return true;
        }
        function validarSoloLetras(valor) {
            if (!/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/.test(valor)) {
                return false;
            }
            return true;
        }
        function validarCorreo(valor) {
            if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) {
                return false;
            }

            return true;
        }

        function validarSoloNumeros(valor) {
            if (!/^([0-9]{8})*$/.test(valor)) {
                return false;
            }
            return true;
        }


    </script>
</body>

</html>
