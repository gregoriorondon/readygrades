// Sidebar móvil
let overlay = document.querySelector('.sidebar-overlay');
let movilBtn = document.querySelector('.menu-hiden-button');
let sidebar = document.querySelector('.sidebar-movil');
let closeBar = document.querySelector('.close-sidebar-movil');

movilBtn.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-96');
    overlay.classList.remove('opacity-0', 'pointer-events-none');
    overlay.classList.add('opacity-50');
});

closeBar.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-96');
    overlay.classList.remove('opacity-50');
    overlay.classList.add('opacity-0', 'pointer-events-none');
});

overlay.addEventListener('click', () => {
    closeBar.click();
});

// Navegación entre vistas - Usar event delegation para manejar todos los botones
document.addEventListener('DOMContentLoaded', function() {
    // Secciones de la vista
    let basic = document.querySelector('.data-public-student-details');
    let notas = document.querySelector('.notas-students');
    let constanciaVista = document.querySelector('.generar-constancia-student-details');
    let inscripcion = document.querySelector('.inscripcion-vista');

    const switchView = (viewName) => {
        // Remover clase active de TODOS los botones
        document.querySelectorAll('.student-nav').forEach(btn => {
            btn.classList.remove('active-button');
            btn.classList.add('hover:!border-b-0');
        });

        // Ocultar todas las vistas
        if (basic) basic.classList.add('hidden');
        if (notas) notas.classList.add('hidden');
        if (constanciaVista) constanciaVista.classList.add('hidden');
        if (inscripcion) inscripcion.classList.add('hidden');

        // Mostrar la vista seleccionada
        switch (viewName) {
            case 'general':
                if (basic) {
                    basic.classList.remove('hidden');
                    basic.classList.add('data-public-student-details');
                }
                // Activar botones en ambos menús
                document.querySelectorAll('.student-nav.overview').forEach(btn => {
                    btn.classList.add('active-button');
                    btn.classList.remove('hover:!border-b-0');
                });
                break;
            case 'calificacion':
                if (notas) notas.classList.remove('hidden');
                document.querySelectorAll('.student-nav.score').forEach(btn => {
                    btn.classList.add('active-button');
                    btn.classList.remove('hover:!border-b-0');
                });
                break;
            case 'constancia':
                if (constanciaVista) constanciaVista.classList.remove('hidden');
                document.querySelectorAll('.student-nav.constancia').forEach(btn => {
                    btn.classList.add('active-button');
                    btn.classList.remove('hover:!border-b-0');
                });
                break;
            case 'inscripcion':
                if (inscripcion) inscripcion.classList.remove('hidden');
                document.querySelectorAll('.student-nav.inscripcion').forEach(btn => {
                    btn.classList.add('active-button');
                    btn.classList.remove('hover:!border-b-0');
                });
                break;
        }

        // Cerrar sidebar móvil si está abierto
        if (sidebar && !sidebar.classList.contains('-translate-x-96')) {
            sidebar.classList.add('-translate-x-96');
            if (overlay) {
                overlay.classList.remove('opacity-50');
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }
        }
    };

    // Event delegation para TODOS los botones de navegación
    document.addEventListener('click', (e) => {
        // Botones del menú principal y sidebar
        if (e.target.closest('.student-nav.overview') || e.target.closest('.datos-publico')) {
            e.preventDefault();
            switchView('general');
        }
        if (e.target.closest('.student-nav.score') || e.target.closest('.calificacion-publica')) {
            e.preventDefault();
            switchView('calificacion');
        }
        if (e.target.closest('.student-nav.constancia')) {
            e.preventDefault();
            switchView('constancia');
        }
        if (e.target.closest('.student-nav.inscripcion')) {
            e.preventDefault();
            switchView('inscripcion');
        }
    });
});
