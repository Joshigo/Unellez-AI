<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body>
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('logo_blue.png') }}" alt="UNELLEZ AI Logo" style="max-width: 200px;">
    </div>

    <h2 style="text-align: center; color: #2c3e50;">¡Bienvenido a UNELLEZ AI!</h2>
    <p style="font-size: 16px; color: #333;">
        Nos complace darte la bienvenida a nuestra plataforma. A continuación encontrarás tu contraseña de acceso:
    </p>

    <div style="background: #f4f4f4; padding: 20px; border-radius: 8px; text-align: center; margin: 20px 0;">
        <strong style="font-size: 20px; color: #1a73e8;">{{ $password }}</strong>
    </div>

    <p style="font-size: 16px; color: #333;">
        Por favor, utiliza esta contraseña para iniciar sesión. Te recomendamos cambiarla después de tu primer acceso por motivos de seguridad.
    </p>

    <p style="font-size: 16px; color: #333;">
        ¡Gracias por confiar en nosotros!<br>
        <strong>El equipo de UNELLEZ AI</strong>
    </p>
</body>
</html>
