// Script de recherche de ville dans la recherche d'annonce
(function() {
    var placesAutocomplete = places({
        appId: 'pl6WPML0UZSG',
        apiKey: '379fe70edff1d8c526fa76f3dae8a240',
        container: document.querySelector('#citySearch')
    }).configure({
        // indication permettant de chercher uniquement les communes françaises (métropole et DOM-TOM)
        countries: ['fr']
    });

    var $address = document.querySelector('#place');
    placesAutocomplete.on('change', function(e) {
        $address.textContent = e.suggestion.value
    });

    placesAutocomplete.on('clear', function() {
        $address.textContent = '';
    });

})();