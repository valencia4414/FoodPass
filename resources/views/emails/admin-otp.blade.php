<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Código OTP — FoodPass</title>
</head>
<body style="margin:0;padding:0;background:#f0ffd8;font-family:Inter,Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f0ffd8;padding:40px 16px;">
        <tr>
            <td align="center">
                <table width="100%" style="max-width:480px;background:#ffffff;border-radius:24px;padding:32px;box-shadow:0 8px 24px rgba(0,0,0,0.08);">
                    <tr>
                        <td align="center" style="padding-bottom:16px;">
                            <div style="width:64px;height:64px;border-radius:32px;background:#e8facd;line-height:64px;font-size:28px;">🔐</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom:8px;">
                            <h1 style="margin:0;font-size:22px;color:#121f05;font-weight:800;">Código de verificación</h1>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom:24px;">
                            <p style="margin:0;font-size:14px;color:#574237;line-height:1.5;">
                                Hola {{ $userName }}, usa este código para completar el acceso de administrador:
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom:24px;">
                            <div style="display:inline-block;letter-spacing:12px;font-size:32px;font-weight:800;color:#9b4500;background:#e8facd;padding:16px 24px;border-radius:16px;">
                                {{ $code }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <p style="margin:0;font-size:12px;color:#574237;">
                                Válido por <strong>10 minutos</strong>. No lo compartas con nadie.<br>
                                Si no solicitaste este código, ignora este correo.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-top:24px;">
                            <p style="margin:0;font-size:11px;color:#8b7265;">FoodPass — Autenticación multifactor</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html> 