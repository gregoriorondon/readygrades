{{-- Desktop, Laptop and Tablet version --}}
<div class="menu-float">
    <nav class="menu-float2">
        <a href="/" class="{{ request()->is('/') ? 'underline underline-offset-8 decoration-4' : 'no-underline' }}"><i class="fa-solid fa-house"></i>Inicio</a>
        <a href="/organigrama" class="{{ request()->is('organigrama') ? 'underline underline-offset-8 decoration-4' : 'no-underline' }}"><i class="fa-solid fa-sitemap"></i>Organigrama</a>
        <a href="/student" class="{{ request()->is('student') ? 'underline underline-offset-8 decoration-4' : 'no-underline' }}"><i class="fa-solid fa-user-graduate"></i>Estudiante</a>
        <a href="/login" class="{{ request()->is('login-profesor') ? 'underline underline-offset-8 decoration-4' : 'no-underline' }}"><i class="fa-solid fa-right-to-bracket"></i>Iniciar Sesión</a>
    </nav>
</div>

{{-- Movile version --}}
<div class="menu-float-movile">
    <nav class="menu-float2">
        <a href="/"><i class="fa-solid fa-house"></i>Inicio</a>
        <span class="openmenu"><i class="fa-solid fa-bars"></i></span>
    </nav>
</div>
<div class="movile-menu-open-open">
    <span class="closebtn"><i class="fa-regular fa-circle-xmark"></i></span>
    <nav class="movile-menu-open-nav">
        <a href="/"><i class="fa-solid fa-house"></i>Inicio</a>
        <a href="/organigrama"><i class="fa-solid fa-sitemap"></i>Organigrama</a>
        <a href="/student"><i class="fa-solid fa-user-graduate"></i>Estudiante</a>
        <a href="/login"><i class="fa-solid fa-right-to-bracket"></i>Iniciar Sesión</a>
    </nav>
</div>
<script src="{{ Vite::asset('resources/js/closemenuhome.js') }}"></script>
