const searchInput = document.getElementById('autocomplete');
const suggestionsDiv = document.getElementById('suggestions');

searchInput.addEventListener('input', function(e) {
    const query = e.target.value;
    
    if (query.length < 2) {
        suggestionsDiv.innerHTML = '';
        return;
    }

    fetch(`/autocomplete?term=${encodeURIComponent(query)}`)
        .then(response => {
                if (!response.ok) throw new Error('Error en la respuesta');
                return response.json();
            })        .then(data => {
            suggestionsDiv.innerHTML = '';
            data.forEach(item => {
                const div = document.createElement('div');
                // div.innerHTML = 'Hola';
                div.className = 'suggestion-item';
                div.innerHTML = '<span class="font-bold pr-1 pl-1 rounded-sm text-red-700 bg-yellow-300">Ya Existe:</span>'+ ' ' + item.carrera;
                // div.textContent = item.carrera;
                // div.onclick = () => {
                //     searchInput.value = item.carrera;
                //     suggestionsDiv.innerHTML = '';
                // };
                suggestionsDiv.appendChild(div);
            });
        })
        .catch(error => {
                console.error('Error:', error);
                suggestionsDiv.innerHTML = '';
        });
});
//alert('hola mundo');
