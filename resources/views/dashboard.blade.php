<x-app-layout>

<div class="infos">
    <h1>Où est mon carburant le moins cher ?</h1>
    <div id="infos__distance">
    </div>
</div>

<div id="mapid" class="center-block" style="width: 100%; height: 100vh;"></div>
    
<script>
    let zones = [{
            distance: 1,
            color: "#00B790"
        },
        {
            distance: 15,
            color: "#ffb846"
        },
        {
            distance: 30,
            color: "#6B2737"
        },
    ];
    let content;
    let zoneIndex = 0;
    let mymap;
    let popup;
    let marker;
    let gasoline_marker;
    let circle;

    function addMarker(latlng, me = "") {
        marker = L.marker(latlng, {
            draggable: true
        }).addTo(mymap);
        marker.on('dragstart', removeCircle); // Remove circle on drag start
        marker.on('dragend', addCircle); // Add circle on drag end
    }

    function removeMarker() {
        marker.remove();
        marker = null;
    }

    function addCircle() {
        circle = L.circle(marker.getLatLng(), {
            color: zones[zoneIndex].color,
            fillColor: zones[zoneIndex].color,
            fillOPacity: 0.15,
            // Pour avoir une distance en mètres, je multiplie par 1000
            radius: zones[zoneIndex].distance * 1000,
        }).addTo(mymap);
    }

    function removeCircle() {
        circle.remove();
        circle = null;
    }

    function InitMap() {
        mymap = L.map('mapid').setView([50.437616, 2.809546], 10);
        var icon = L.icon({
            iconUrl: "{{asset('/images/vendor/leaflet/dist/marker-icon.png') }}"
        });
        //  icon.options.shadowSize = [0,0];

        // Est-ce-que la localisation est possible avec le navigateur ?
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latlng = [
                    position.coords.latitude,
                    position.coords.longitude
                ];
                mymap.panTo(latlng);
                addMarker(latlng);
                addCircle();
                // Show your emplacement
                const popup = marker.bindPopup("<b>Votre position</b><br>Déplacer moi ci-besoin")
                .openPopup();
                
                
                // Générer les bouttons de distanciations si la position de l'utilisateur est définie
                zones.forEach(function (element, index) {
                    content = "<button index='" + index + "' >" + element.distance + " km</button>";
                    document.querySelector('#infos__distance').insertAdjacentHTML('beforeend', content);
                });
            });


            
        }

        // L.Marker.prototype.options.icon = L.icon({
        //     iconUrl:  "{{asset('/images/vendor/leaflet/dist/marker-icon.png') }}",
        //     iconAnchor:   [12, -2]
        // });

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibG91YmFsNzAiLCJhIjoiY2wxZ3BkcjJuMHgxcjNkcnQ5dHZibW16bCJ9.BnfMu_LwhSHuyNrE699gMQ'
        }).addTo(mymap);
        gasoline_marker = [
            L.marker([51.5, -0.09]).addTo(mymap).bindPopup("<b>Prix Essence :</b> 15,90€ / L").openPopup(),
            L.marker([52.5, -0.07]).addTo(mymap).bindPopup("<b>Prix Essssssence :</b> 15,90€ / L").openPopup()
        ];

        // Gestion du click sur la map
        // map.on('click', (e) => {
        //     if( !marker){
        //         addMarker(e.latlng);
        //         addCircle();
        //     }
        //     else{
        //         // Le marqueur est déjà affiché, on le centre vers la nouvelle position
        //         removeCircle();
        //         marker.setLatLng(e.latlng);
        //         addCircle();
        //     }
        // });

        document.addEventListener('keydown', (e) => {
            if (!marker) {
                return;
            }
            switch (e.key) {
                case " ": // Touche appuyé est espace
                    removeCircle();
                    zoneIndex ^= 2;
                    addCircle();
                    break;
                case "Escape":
                    removeCircle();
                    removeMarker();
                    break;
            }
        })
        content = document.querySelectorAll('#infos__distance button');
        content.forEach(element => {
            element.addEventListener('click', (e) => {
                removeCircle();
                zoneIndex = e.target.attributes.index.value;
                addCircle();
            });
        });

    }

    InitMap();

</script>

</x-app-layout>
