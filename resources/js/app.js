import './bootstrap';
import Alpine from 'Alpinejs'; 

window.Alpine = Alpine;
Alpine.start();

async function realizarPeticion(url, opciones = {}) {
    try { // Tarea 55: Manejo asíncrono con try/catch
        const respuesta = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                ...opciones.headers
            },
            ...opciones
        });

        // Tarea 61: Avisar cuando la sesión expira (401 No autorizado, 419 Token/Sesión expirada)
        if (respuesta.status === 401 || respuesta.status === 419) {
            alert("Tu sesión expiró. Inicia sesión nuevamente.");
            window.location.href = '/login';
            return null;
        }

        // Tarea 54: Comprobar respuestas de error del servidor (500, 503, etc.)
        if (!respuesta.ok) {
            throw new Error("El servidor no respondió correctamente.");
        }

        return await respuesta.json();

    } catch (error) {
        // Tarea 54: Mensaje amigable cuando la petición falla o el servidor cae
        console.error("Error detectado:", error);

        const contenedorError = document.getElementById('mensaje-error');
        if (contenedorError) {
            contenedorError.innerText = "No pudimos cargar el menú. Intenta nuevamente más tarde.";
            contenedorError.style.display = 'block';
        } else {
            alert("No pudimos cargar el menú. Intenta nuevamente más tarde.");
        }
        return null;
    }
}

async function cargarDatosMenu() {
    const spinner = document.getElementById('loading-spinner');
    const contenido = document.getElementById('contenido-menu');

    if (spinner) spinner.style.display = 'block';
    if (contenido) contenido.style.display = 'none';

    const datos = await realizarPeticion('/api/menu');

    if (spinner) spinner.style.display = 'none';

    if (datos) {
        if (contenido) contenido.style.display = 'block';
        // Renderizar o procesar la información
    }
}

document.addEventListener('DOMContentLoaded', cargarDatosMenu);