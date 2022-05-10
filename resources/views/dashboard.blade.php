<x-app-layout>
    {{-- {{ dd(Auth::user()->roles()) }} --}}
    @livewire('navigation-menu')

<div class="infos">
    <h1>Où est mon carburant le moins cher ?</h1>
    <div id="infos__distance">
    </div>
</div>

<div id="mapid" class="center-block" style="width: 100%; height: 92vh;"></div>

@if (\Session::has('message'))
<div class="toast custom active">
    <div class="toast-content">
        <i class="fas fa-solid fa-check check"></i>

        <div class="message">
            <span class="text text-1">Information : </span>
            <span class="text text-2">{!! session('message') !!}</span>
        </div>
    </div>
    <i class="fa-solid fa-xmark close"></i>

    <div class="progress active"></div>
</div>
@endif

<script>
    let zones = [{
            distance: 1,
            color: "#00B790"
        },
        {
            distance: 5,
            color: "#ffb846"
        },
        {
            distance: 15,
            color: "#6B2737"
        },
    ];
    let content;
    let zoneIndex = 0;
    let mymap;
    let popup = L.popup();
    let marker;
    let gasoline_bdd = @json($pointers);
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
        navigator.permissions && navigator.permissions.query({name: 'geolocation'})
        .then(function(PermissionStatus) {
            if (PermissionStatus.state == 'granted') {
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
                    
                });  

                // Générer les bouttons de distanciations si la position de l'utilisateur est définie
                zones.forEach(function (element, index) {
                    content = "<button index='" + index + "' >" + element.distance + " km</button>";
                    document.querySelector('#infos__distance').insertAdjacentHTML('beforeend', content);
                });

                content = document.querySelectorAll('#infos__distance button');
                content.forEach(element => {
                    element.addEventListener('click', (e) => {
                        removeCircle();
                        zoneIndex = e.target.attributes.index.value;
                        addCircle();
                    });
                });
            } 
            else if (PermissionStatus.state == 'prompt') {
                setTimeout(() => {
                    window.location.reload();
                }, 5000); 
            } 
            else {
                // denied
            }
        })  

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

        console.log(gasoline_bdd);

        let customOptions = {
            'minWidth': '300',
            'className' : 'custom'
        };
    
        @foreach ($pointers as $item)
            L.marker([{{ $item->coordinate }}]).addTo(mymap).bindPopup("@include("pointer.popup", ["item" => $item])", customOptions),
        @endforeach

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

        // Gestion du click sur la map
        mymap.on('click', (e) => {

            popup
                .setLatLng(e.latlng)
                .setContent("<span class='d-block mt-3 text-center'>Souhaitez-vous ajouter une nouvelle station essence ?</span> <a href='{!! route('pointer.store') !!}/create?lat=" + e.latlng.lat.toString().substring(0, 15) + "&lont=" + e.latlng.lng.toString().substring(0, 15) + "' class='d-block btn btn-danger text-white mt-3'>Ajouter</a>")
                .openOn(mymap);

            if( !marker){
                addMarker(e.latlng);
                addCircle();

                setInterval(() => {
                    removeCircle();
                    removeMarker();
                    popup.remove();
                }, 10000);
            }
            else{
                // Le marqueur est déjà affiché, on le centre vers la nouvelle position
                removeCircle();
                marker.setLatLng(e.latlng);
                addCircle();
            }
        });

    }

    InitMap();

</script>

<script>
    // Notification TOAST
    const toast = document.querySelector(".toast") !== null;
    if(toast){
        const toast = document.querySelector(".toast"),
        closeIcon = document.querySelector(".close"),
        progress = document.querySelector(".progress");

        let timer1, timer2;

        timer1 = setTimeout(() => {
            toast.classList.remove("active");
        }, 5000); //1s = 1000 milliseconds

        timer2 = setTimeout(() => {
            progress.classList.remove("active");
        }, 5300);

        closeIcon.addEventListener("click", () => {
            toast.classList.remove("active");

            setTimeout(() => {
                progress.classList.remove("active");
            }, 300);

            clearTimeout(timer1);
            clearTimeout(timer2);
        });
    }

</script>

</x-app-layout>
