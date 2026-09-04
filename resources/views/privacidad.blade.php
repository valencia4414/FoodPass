<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FoodPass - Política de privacidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f0ffd8] text-[#121f05]">
    <main class="mx-auto max-w-3xl px-6 py-12">
        <a href="{{ auth()->check() ? route('perfil') : route('login') }}" class="text-sm font-semibold text-[#d85f18]">Volver</a>
        <h1 class="mt-6 text-4xl font-extrabold">Política de privacidad</h1>
        <p class="mt-3 text-sm text-[#574237]">FoodPass protege el tratamiento de tus datos personales conforme a la Ley 1581 de 2012 y sus normas reglamentarias.</p>

        <section class="mt-8 space-y-4 rounded-2xl bg-white p-7 shadow-sm">
            <h2 class="text-xl font-bold">Tratamiento y finalidad</h2>
            <p class="text-sm leading-6">Usamos nombre, correo y la información necesaria de pedidos, canjes y pagos para prestar el servicio, validar beneficios, atender solicitudes y mantener la seguridad de la plataforma. No vendemos datos personales.</p>
            <h2 class="pt-3 text-xl font-bold">Tus derechos</h2>
            <p class="text-sm leading-6">Puedes conocer, actualizar, rectificar y solicitar la supresión de tus datos, así como retirar autorizaciones y presentar consultas o reclamos. Responderemos dentro de los términos legales aplicables.</p>
            <h2 class="pt-3 text-xl font-bold">Cómo ejercerlos</h2>
            <p class="text-sm leading-6">Para eliminar tu cuenta, inicia sesión, ve a <strong>Perfil</strong> y confirma la opción “Eliminar mi cuenta”. La solicitud elimina tu usuario y los datos personales relacionados que la base de datos permite eliminar en cascada. Para una consulta o reclamo distinto, usa el módulo de soporte.</p>
            <p class="text-sm leading-6">Responsable: FoodPass. La política puede actualizarse cuando cambien las finalidades o las obligaciones legales; publicaremos aquí la versión vigente.</p>
        </section>
    </main>
</body>
</html>