<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo mensaje de la web</title>
</head>
<body style="margin:0; padding:0; background-color:#f0e6dd; font-family:Arial, Helvetica, sans-serif; color:#393c25;">
	<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0e6dd; padding:40px 0;">
		<tr>
			<td align="center">
				<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:12px; overflow:hidden;">
					<tr>
						<td style="background-color:#393c25; padding:24px 32px;">
							<p style="margin:0; color:#f0e6dd; font-size:18px; font-weight:bold;">Nuevo mensaje de la web Espacio Transformarte</p>
						</td>
					</tr>
					<tr>
						<td style="padding:32px;">
							<table role="presentation" width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td style="padding:8px 0; font-size:14px;"><strong>Nombre:</strong></td>
									<td style="padding:8px 0; font-size:14px;">{{ $mensaje->nombre }} {{ $mensaje->apellido }}</td>
								</tr>
								<tr>
									<td style="padding:8px 0; font-size:14px;"><strong>Email:</strong></td>
									<td style="padding:8px 0; font-size:14px;"><a href="mailto:{{ $mensaje->email }}" style="color:#71815c;">{{ $mensaje->email }}</a></td>
								</tr>
								@if ($mensaje->telefono)
								<tr>
									<td style="padding:8px 0; font-size:14px;"><strong>Teléfono:</strong></td>
									<td style="padding:8px 0; font-size:14px;">{{ $mensaje->telefono }}</td>
								</tr>
								@endif
								<tr>
									<td style="padding:8px 0; font-size:14px;"><strong>Le interesa:</strong></td>
									<td style="padding:8px 0; font-size:14px;">{{ $mensaje->sesion }}</td>
								</tr>
								<tr>
									<td style="padding:8px 0; font-size:14px;"><strong>Recibido:</strong></td>
									<td style="padding:8px 0; font-size:14px;">{{ $mensaje->created_at->format('d/m/Y H:i') }}</td>
								</tr>
							</table>

							<hr style="border:none; border-top:1px solid #e2d3c4; margin:24px 0;">

							<p style="margin:0 0 8px; font-size:14px;"><strong>Mensaje:</strong></p>
							<p style="margin:0; font-size:14px; line-height:1.6; white-space:pre-line;">{{ $mensaje->mensaje }}</p>
						</td>
					</tr>
					<tr>
						<td style="padding:16px 32px; background-color:#f7f0e8;">
							<p style="margin:0; font-size:12px; color:#826f62;">Este mensaje fue enviado desde el formulario de contacto de espaciotransformarte.com</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
