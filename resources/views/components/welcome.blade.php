<style>
.add-car{
    color: #fff;
    background-color: #4272d8;
    float: right;
    margin-right: 14px;
    padding: 4px 7px;
    border-radius: 7px;
}
.add-car:hover{
    background-color: #0f2167;
}
</style>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">
            <h1 class="px-4 py-2">Lista de Carreras o PNFs</h1>
            <a class="add-car" href="#"><button>Añadir Carrera <i class="fa-solid fa-plus"></i></button></a>
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre de la Carrera
                </th>
                <th scope="col" class="px-6 py-3">
                    Profesor(a) de Guia
                </th>
                <th scope="col" class="px-6 py-3">
                    Cantidad Total de Estudiantes
                </th>
                <th scope="col" class="px-6 py-3">
                    Editar el Profesor Guia
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <a href="/administracion" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Administración <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </th>
                <td class="px-6 py-4">
                    Mauricia <i class="fa-solid fa-chalkboard-user"></i>
                </td>
                <td class="px-6 py-4">
                    300 <i class="fa-solid fa-graduation-cap"></i>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Informática <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </th>
                <td class="px-6 py-4">
                    Marcos <i class="fa-solid fa-chalkboard-user"></i>
                </td>
                <td class="px-6 py-4">
                    342 <i class="fa-solid fa-graduation-cap"></i>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
            <tr class="bg-white">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Maquinaria Pesada <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </th>
                <td class="px-6 py-4">
                    Benjamin <i class="fa-solid fa-chalkboard-user"></i>
                </td>
                <td class="px-6 py-4">
                    296 <i class="fa-solid fa-graduation-cap"></i>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

