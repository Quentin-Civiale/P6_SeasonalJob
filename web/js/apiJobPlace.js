(function() {
    var placesAutocomplete = places({
        appId: 'pl6WPML0UZSG',
        apiKey: '379fe70edff1d8c526fa76f3dae8a240',
        container: document.querySelector('#input-map')
    }).configure({
        // indication permettant de chercher uniquement les communes françaises (métropole et DOM-TOM)
        countries: ['fr']
    });

    var map = L.map('map-example-container', {
        scrollWheelZoom: false,
        zoomControl: true
    });

    var osmLayer = new L.TileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            minZoom: 1,
            maxZoom: 13,
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }
    );

    // var $address = document.querySelector('#address-city-map');
    // placesAutocomplete.on('change', function(e) {
    //     $address.textContent = e.suggestion.value
    // });
    // placesAutocomplete.on('clear', function() {
    //     $address.textContent = 'aucune';
    // });

    var $cityField = document.querySelector('#p6_generalbundle_advert_place');
    placesAutocomplete.on('change', function(e) {
        $cityField.textContent = e.suggestion.value
    });
    placesAutocomplete.on('clear', function() {
        $cityField.textContent = 'aucune';
    });

    var markers = [];

    // mise en avant de la vue sur la France sur la map principale
    map.setView(new L.LatLng(46.5, 2), 4.5);
    map.addLayer(osmLayer);

    placesAutocomplete.on('suggestions', handleOnSuggestions);
    placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
    placesAutocomplete.on('change', handleOnChange);
    placesAutocomplete.on('clear', handleOnClear);

    function handleOnSuggestions(e) {
        markers.forEach(removeMarker);
        markers = [];

        if (e.suggestions.length === 0) {
            map.setView(new L.LatLng(46.5, 2), 4.5);
            return;
        }

        e.suggestions.forEach(addMarker);
        findBestZoom();
    }

    function handleOnChange(e) {
        markers
            .forEach(function(marker, markerIndex) {
                if (markerIndex === e.suggestionIndex) {
                    markers = [marker];
                    marker.setOpacity(1);
                    findBestZoom();
                } else {
                    removeMarker(marker);
                }
            });
    }

    function handleOnClear() {
        map.setView(new L.LatLng(46.5, 2), 4.5);
        markers.forEach(removeMarker);
    }

    function handleOnCursorchanged(e) {
        markers
            .forEach(function(marker, markerIndex) {
                if (markerIndex === e.suggestionIndex) {
                    marker.setOpacity(1);
                    marker.setZIndexOffset(1000);
                } else {
                    marker.setZIndexOffset(0);
                    marker.setOpacity(0.5);
                }
            });
    }

    function addMarker(suggestion) {
        var marker = L.marker(suggestion.latlng, {opacity: .4});
        marker.addTo(map);
        markers.push(marker);
    }

    function removeMarker(marker) {
        map.removeLayer(marker);
    }

    function findBestZoom() {
        var featureGroup = L.featureGroup(markers);
        map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
    }
})();