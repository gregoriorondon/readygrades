<!--botton con la opcion de regresar a pa pagina anteriormente visitada-->

{{-- <nav class="menu"> --}}
{{-- <a href="/"><button class="home"><img src="/logouptt.png" alt="" style="width: 25px; display: inline-block; vertical-align: middle;">Inicio</button></a> --}}

{{-- <a href="/estudent" class="m-student"><i class="fa-solid fa-graduation-cap"></i>Estudiante</a> --}}

{{-- <a href="/lo" class="m-teacher"><i class="fa-solid fa-chalkboard-user"></i>Profesor</a> --}}

{{-- {{-1- <script src="./js/links.js"></script> -1-}} --}}
{{-- </nav> --}}

{{-- Desktop, Laptop and Tablet version --}}
<div class="menu-float">
    <nav class="menu-float2">
        <a href="/"><i class="fa-solid fa-house"></i>Inicio</a>
        <a href="/organigrama"><i class="fa-solid fa-sitemap"></i>Organigrama</a>
        <a href="/estudent"><i class="fa-solid fa-user-graduate"></i>Estudiante</a>
        <a href="/lo"><i class="fa-solid fa-person-chalkboard"></i>Profesor</a>
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
        <a href="/estudent"><i class="fa-solid fa-user-graduate"></i>Estudiante</a>
        <a href="/lo"><i class="fa-solid fa-person-chalkboard"></i>Profesor</a>
    </nav>
</div>
<script src="{{ Vite::asset('resources/js/closemenuhome.js') }}"></script>
