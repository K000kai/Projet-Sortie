/*
document.addEventListener('DOMContentLoaded', function() {
    let citySelect = document.getElementById('outing_city');
    let locationSelect = document.getElementById('outing_location');

    citySelect.addEventListener('change', function() {
        let cityId= citySelect.value;

        // Envoyer une requête AJAX pour récupérer les lieux associés à la ville sélectionnée
        fetch('/Projet Sortir/public/locations/'+cityId)
            .then(response => response.json())
            .then(data => {
                console.log(data)

                locationSelect.innerHTML = '';

                // Ajouter les nouvelles options basées sur les données de la réponse
                data.forEach(function(location) {
                    let option = document.createElement('option');
                    option.value = location.id;
                    option.textContent = location.name;
                    locationSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des lieux :', error);
            });
    });
});
*/
