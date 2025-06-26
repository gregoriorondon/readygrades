const searchInput = document.getElementById("autocomplete");
const suggestionsDiv = document.getElementById("suggestions");
const selectedList = document.getElementById("selected-list");
const tableBody = document.querySelector("tbody");
let selectedMaterias = new Set();

// Función para actualizar la lista de seleccionados
function updateSelectedList() {
    selectedList.innerHTML = '';

    if (selectedMaterias.size === 0) {
        selectedList.innerHTML = '<div class="text-center py-4 text-gray-700 font-inter">No hay materias seleccionadas</div>';
        return;
    }

    selectedMaterias.forEach(id => {
        // Buscar la materia en la tabla
        const materiaRow = document.querySelector(`tr[data-id="${id}"]`);
        if (materiaRow) {
            const materiaName = materiaRow.querySelector('td:first-child label').textContent.trim();
            const materiaCode = materiaRow.querySelector('td:last-child').textContent.trim();

            const div = document.createElement('div');
            div.className = 'selected-item rounded-lg border my-1';
            div.innerHTML = `
                <button type="button" class="remove-item flex justify-between w-full p-2 items-center hover:bg-gray-400/20" data-id="${id}">
                    <span class="font-inter">${materiaName} ${materiaCode}</span>
                    <i class="fa-solid fa-trash text-red-500 hover:text-red-700"></i>
                </button>
            `;
            selectedList.appendChild(div);

            // Agregar evento al botón de eliminar
            div.querySelector('.remove-item').addEventListener('click', (e) => {
                const id = e.target.closest('button').dataset.id;
                selectedMaterias.delete(id);

                // Desmarcar checkbox en la tabla
                const checkbox = document.querySelector(`tr[data-id="${id}"] input[name="materias[]"]`);
                if (checkbox) checkbox.checked = false;

                // Actualizar lista
                updateSelectedList();
            });
        }
    });
}

// Event delegation para la tabla
tableBody.addEventListener('change', (e) => {
    if (e.target.matches('input[name="materias[]"]')) {
        const checkbox = e.target;
        const row = checkbox.closest('tr');
        const id = checkbox.value;

        if (checkbox.checked) {
            selectedMaterias.add(id);
            row.dataset.id = id; // Agregar identificador a la fila
        } else {
            selectedMaterias.delete(id);
            delete row.dataset.id;
        }

        updateSelectedList();
    }
});

// Evento para el buscador
searchInput.addEventListener("input", function(e) {
    const query = e.target.value.trim().toLowerCase();

    if (query.length < 2) {
        suggestionsDiv.innerHTML = "";
        return;
    }

    fetch(`/autocomplete/pensum?term=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            suggestionsDiv.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'suggestion-item cursor-pointer m-0';

                div.innerHTML = `
                    <div class="rounded-lg border my-1">
                        <button type="button" class="flex items-center justify-between w-full add-item hover:bg-gray-400/20 p-2" data-id="${item.id}">
                            <span class="font-inter">${item.materia} (${item.codigo})</span>
                            <i class="fa-solid fa-plus text-green-500"></i>
                        </button>
                    </div>
                `;
                suggestionsDiv.appendChild(div);

                // Agregar evento al botón de añadir
                div.querySelector('.add-item').addEventListener('click', (e) => {
                    const id = e.target.closest('button').dataset.id;

                    // Buscar el checkbox correspondiente en la tabla
                    const tableCheckbox = document.querySelector(`table input[value="${id}"]`);

                    if (tableCheckbox) {
                        tableCheckbox.checked = true;
                        const event = new Event('change', { bubbles: true });
                        tableCheckbox.dispatchEvent(event);
                    }
                });
            });
        })
        .catch(error => {
            console.error("Error:", error);
            suggestionsDiv.innerHTML = "<div class='p-2 text-red-500'>Error al cargar datos</div>";
        });
});

// Inicializar
document.addEventListener('DOMContentLoaded', () => {
    // Marcar inicialmente los checkboxes seleccionados
    document.querySelectorAll('table input[name="materias[]"]:checked').forEach(checkbox => {
        const id = checkbox.value;
        selectedMaterias.add(id);
        checkbox.closest('tr').dataset.id = id;
    });
    updateSelectedList();

    // Cerrar modal y mantener selecciones
    document.getElementById('cerrarmodal').addEventListener('click', () => {
        document.getElementById('modal').close();
    });
});
