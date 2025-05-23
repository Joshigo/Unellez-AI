<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restablecimiento de Contraseña</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333333; background-color: #f4f4f4;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td align="center" style="padding: 30px;">
                            {{-- <img src="/logo-email.png" alt="Logo" width="100" style="display: block; margin: 0 auto 20px;" /> --}}

                            <h1 style="font-size: 20px; color:#007bff; ">Emi-Assistant IA</h1>

                            <h1 style="margin: 0 0 20px; font-size: 24px; color: #333333; text-align: center;">Restablecimiento de Contraseña</h1>
                            <p style="margin: 0 0 20px; text-align: center;">
                                Recibimos una solicitud para restablecer la contraseña de tu cuenta. Si no solicitaste este cambio, por favor ignora este mensaje.
                            </p>
                            <p style="margin: 0 0 20px; text-align: center;">
                                Para restablecer tu contraseña, haz clic en el siguiente botón:
                            </p>
                            <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                                <tr>
                                    <td align="center" bgcolor="#007bff" style="border-radius: 5px;">
                                        <a href="{{ url('password/reset/'.$token.'?email='.$email) }}" target="_blank" style="display: inline-block; padding: 12px 24px; font-size: 16px; color: #ffffff; text-decoration: none;">Restablecer Contraseña</a>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin: 20px 0 0; text-align: center;">
                                Este enlace expirará en 60 minutos.
                            </p>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                                <tr>
                                    <td style="border-top: 1px solid #dddddd; padding-top: 20px; text-align: center; font-size: 14px; color: #777777;">
                                        <p style="margin: 0 0 10px;">
                                            Saludos,<br />El equipo de Emi Assistant IA
                                        </p>
                                        <p style="margin: 0; font-size: 12px;">
                                            Si tienes problemas para hacer clic en el botón, copia y pega este enlace en tu navegador:<br />
                                            <a href="{{ url('password/reset/'.$token.'?email='.$email) }}" style="color: #007bff; text-decoration: underline;">{{ url('password/reset/'.$token.'?email='.$email) }}</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
