<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <style>
        .image {
            width: 360px;
            filter: drop-shadow(0px 0px 7px #4272d869);
            user-select: none;
        }
    </style>
    @vite(['resources/css/estilos.css', 'resources/css/fonts.css', 'resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-white teme">
    <div class="relative flex justify-center min-h-screen items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center items-center pt-8">
                <div class="text-2xl text-center uppercase tracking-wider font-inter">
                    <div class="text-[100px] tracking-wider text-center font-inter text-green-500 font-bold select-none">
                        @yield('code')
                    </div>
                    <div class="tracking-wider text-center font-inter mt-7 mx-4 border-t select-none">
                        @yield('message')
                    </div>
                    @yield('button')
                </div>

                <div>
                    <div class="hidden sm:block">
                        @yield('image')
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
        let cuerpo = document.querySelector('.teme');
        if (localStorage.getItem('theme') !== 'dark') {
            cuerpo.classList.remove('dark:bg-[radial-gradient(ellipse_at_bottom_right,_var(--tw-gradient-stops))]');
            cuerpo.classList.remove('dark:from-blue-950');
            cuerpo.classList.remove('dark:via-gray-950');
            cuerpo.classList.remove('dark:to-gray-950');
            cuerpo.classList.remove('dark:text-white');
        } else {
            cuerpo.classList.add('dark:bg-[radial-gradient(ellipse_at_bottom_right,_var(--tw-gradient-stops))]');
            cuerpo.classList.add('dark:from-blue-950');
            cuerpo.classList.add('dark:via-gray-950');
            cuerpo.classList.add('dark:to-gray-950');
            cuerpo.classList.add('dark:text-white');
        }
    </script>
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', function(event) {
            if (
                event.key === 'F12' ||
                (event.ctrlKey && event.shiftKey && (event.key === 'I' || event.key === 'J')) ||
                (event.ctrlKey && event.key === 'U')
            ) {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>
