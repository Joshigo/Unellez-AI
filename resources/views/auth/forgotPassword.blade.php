<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon_blue.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary:#3a7bd5;
            --primary-hover:#2d62a9;
            --danger:#c0392b;
            --success:#2e7d32;
            --radius:14px;
            --bg:#f4f7f9;
        }
        body {
            margin:0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            display:flex;
            min-height:100vh;
            justify-content:center;
            align-items:center;
            color:#333;
            padding:20px;
        }
        .wrapper {
            width:100%;
            max-width:430px;
            background:#fff;
            padding:2rem 2.2rem 2.4rem;
            border-radius:var(--radius);
            box-shadow:0 10px 28px -8px rgba(0,0,0,.15);
            position:relative;
        }
        h1 {
            margin:0 0 1rem;
            font-size:1.55rem;
            color:var(--primary);
            text-align:center;
        }
        p.desc {
            font-size:.9rem;
            line-height:1.35rem;
            margin:0 0 1.3rem;
            text-align:center;
        }
        form {
            margin:0;
        }
        label {
            font-size:.75rem;
            font-weight:600;
            letter-spacing:.5px;
            text-transform:uppercase;
            display:block;
            margin-bottom:.35rem;
            color:#555;
        }
        input {
            width:100%;
            padding:.75rem .85rem;
            border:1px solid #cfd7df;
            border-radius:10px;
            font-size:.95rem;
            outline:none;
            transition:.25s;
            background:#fafbfc;
        }
        input:focus {
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(58,123,213,.15);
            background:#fff;
        }
        .row {
            margin-bottom:1rem;
        }
        button {
            width:100%;
            border:none;
            padding:.85rem 1rem;
            font-size:.95rem;
            font-weight:600;
            letter-spacing:.3px;
            border-radius:12px;
            cursor:pointer;
            background:var(--primary);
            color:#fff;
            display:inline-flex;
            justify-content:center;
            align-items:center;
            gap:.45rem;
            transition:.25s;
        }
        button:hover { background:var(--primary-hover); }
        .muted-link {
            display:block;
            margin-top:1.4rem;
            text-align:center;
            font-size:.8rem;
            text-decoration:none;
            color:var(--primary);
            font-weight:500;
        }
        .muted-link:hover { text-decoration:underline; }
        .alert {
            padding:.55rem .8rem;
            border-radius:10px;
            font-size:.75rem;
            line-height:1.05rem;
            margin-bottom:1rem;
            font-weight:500;
            letter-spacing:.25px;
        }
        .alert-success { background:#e7f6ed; color:var(--success); border:1px solid #b9e2c6; }
        .alert-error { background:#fdecea; color:var(--danger); border:1px solid #f5c3bd; }
        ul.errors { margin:.4rem 0 0; padding-left:1.05rem; }
        ul.errors li { font-size:.7rem; color:var(--danger); margin:.15rem 0; }
        .divider {
            text-align:center;
            margin:1.8rem 0 1.1rem;
            position:relative;
            font-size:.65rem;
            font-weight:600;
            text-transform:uppercase;
            letter-spacing:1px;
            color:#888;
        }
        .divider:before,
        .divider:after {
            content:'';
            position:absolute;
            top:50%;
            width:38%;
            height:1px;
            background:#e1e5ea;
        }
        .divider:before { left:0; }
        .divider:after { right:0; }
        .code-grid {
            display:flex;
            gap:.55rem;
        }
        .small-note {
            font-size:.63rem;
            margin-top:.35rem;
            color:#777;
            letter-spacing:.3px;
        }
        .fade {
            animation:fade .45s ease;
        }
        @keyframes fade {
            from { opacity:0; transform:translateY(4px);}
            to { opacity:1; transform:translateY(0);}
        }
        .back-link {
            position:absolute;
            left:1.1rem;
            top:1rem;
            font-size:.7rem;
            text-decoration:none;
            color:#666;
        }
        .back-link:hover { color:#000; }
    </style>
</head>
<body>
    <div class="wrapper fade">
        <a class="back-link" href="{{ route('indexLogin') }}">&larr; Volver</a>
        <h1>Recuperar contraseña</h1>
        <p class="desc">
            Ingresa tu correo para enviarte un código de verificación. Luego introduce el código y tu nueva contraseña.
        </p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Errores:</strong>
                <ul class="errors">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $codeSent = session('code_sent');
            $prefillEmail = old('email') ?? session('email_for_reset');
        @endphp

        @unless($codeSent)
            <form method="POST" action="{{ route('send.reset.code') }}" id="request-code-form">
                @csrf
                <div class="row">
                    <label for="email_request">Correo registrado</label>
                    <input type="email"
                           id="email_request"
                           name="email"
                           value="{{ $prefillEmail }}"
                           required
                           autocomplete="email"
                           placeholder="ejemplo@correo.com">
                    <div class="small-note">Te enviaremos un código de 6 dígitos si el correo existe.</div>
                </div>
                <button type="submit">
                    Enviar código
                </button>
            </form>
        @endunless

        {{-- Divisor --}}
        @if($codeSent)
            <div class="divider">Código enviado</div>
        @else
            <div class="divider">Después de recibir el código</div>
        @endif

        {{-- Paso 2: Reset (solo visible si ya se envió el código) --}}
        @if($codeSent)
            <form method="POST" action="{{ route('password.update') }}" id="reset-password-form">
                @csrf
                <div class="row">
                    <label for="email_reset">Correo</label>
                    <input type="email"
                           id="email_reset"
                           name="email"
                           value="{{ $prefillEmail }}"
                           required
                           autocomplete="email"
                           {{ $prefillEmail ? '' : '' }}
                           placeholder="ejemplo@correo.com">
                    <div class="small-note">Debe ser el mismo correo donde recibiste el código.</div>
                </div>

                <div class="row">
                    <label for="verification_code">Código de verificación</label>
                    <input type="text"
                           id="verification_code"
                           name="verification_code"
                           maxlength="6"
                           pattern="[0-9]{6}"
                           inputmode="numeric"
                           required
                           placeholder="123456"
                           value="{{ old('verification_code') }}">
                    <div class="small-note">Revisa tu bandeja de entrada y spam.</div>
                </div>

                <div class="row">
                    <label for="new_password">Nueva contraseña</label>
                    <input type="password"
                           id="new_password"
                           name="new_password"
                           minlength="8"
                           required
                           autocomplete="new-password"
                           placeholder="Mínimo 8 caracteres">
                </div>

                <div class="row">
                    <label for="new_password_confirmation">Confirmar nueva contraseña</label>
                    <input type="password"
                           id="new_password_confirmation"
                           name="new_password_confirmation"
                           minlength="8"
                           required
                           autocomplete="new-password"
                           placeholder="Repite la contraseña">
                </div>

                <button type="submit">
                    Restablecer contraseña
                </button>
            </form>
        @else
            <div class="alert alert-error" style="background:#fff5d9; border-color:#f5d7a3; color:#8a6d1f;">
                Aún no has solicitado el código o está pendiente de envío.
            </div>
        @endif

        <a class="muted-link" href="{{ route('indexLogin') }}">Iniciar sesión</a>
    </div>

    <script>
        // Auto focus logic
        (function(){
            const codeSent = {!! $codeSent ? 'true':'false' !!};
            if(!codeSent){
                const el = document.getElementById('email_request');
                if(el) el.focus();
            } else {
                const vc = document.getElementById('verification_code');
                if(vc) vc.focus();
            }
        })();
    </script>
</body>
</html>
