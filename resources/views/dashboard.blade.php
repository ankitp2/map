@include('frontend.header')
<div class="map-container">
    <nav class="nav">
        <div class="btn-group" id="menu">
            <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-bs-haspopup="true" aria-bs-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </nav>
    <div id="content">
        @session('success')
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endsession
        @session('error')
            <div class="alert alert-error" id="error-alert">
                {{ session('error') }}
            </div>
        @endsession
        <form action="" method="POST">
            @csrf
            <div class="mapform">
                <div class="row">
                    <div class="col-5">
                        <input type="text" id="name" name="name" placeholder="name" class="form-control">
                    </div>
                    <div class="col-5">
                        <input type="text" id="email" name="email" placeholder="email" class="form-control">
                    </div>
                    <div class="col-5">
                        <input type="text" id="lat" name="latitude" placeholder="latitude"
                            class="form-control">
                    </div>
                    <div class="col-5">
                        <input type="text" id="lng" name="longitude" placeholder="longitude"
                            class="form-control">
                    </div>
                </div>
                <div id="map" style="height:400px; width: 800px;" class="my-3"></div>
                <script>
                    let map;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: {
                                lat: 28.632985015488888,
                                lng: 77.38909897702374
                            },
                            zoom: 8,
                            scrollwheel: true,
                        });

                        const lcn = {
                            lat: 28.598012688650396,
                            lng: 77.20333685333932
                        };
                        let marker = new google.maps.Marker({
                            position: lcn,
                            map: map,
                            draggable: true
                        });
                        google.maps.event.addListener(marker, 'position_changed',
                            function() {
                                let lat = marker.position.lat();
                                let lng = marker.position.lng();
                                $('#lat').val(lat);
                                $('#lng').val(lng);
                            })
                        google.maps.event.addListener(map, 'click',
                            function(event) {
                                pos = event.latLng
                                marker.setPosition(pos)
                            })
                    }
                    try{
                    function showMap(lat, lng) {
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: {
                                lat: lat,
                                lng: lng
                            },
                            zoom: 8,
                            scrollwheel: true,
                        });
                        var coord = {
                            lat: lat,
                            lng: lng
                        };
                        console.log(coord);
                        let marker = new google.maps.Marker({
                            position: coord,
                            map: map,
                            draggable: true
                        });
                        google.maps.event.addListener(marker, 'position_changed',
                            function() {
                                let lat = marker.position.lat();
                                let lng = marker.position.lng();
                                $('#lat').val(lat);
                                $('#lng').val(lng);
                            })
                        google.maps.event.addListener(map, 'click',
                            function(event) {
                                pos = event.latLng
                                marker.setPosition(pos)
                            })
                    };
                }catch(err){
                    console.log(err);
                }
                    $('#lng').keyup(function() {
                        var lngg = $('#lng').val();
                        var latt = $('#lat').val();
                        showMap(latt, lngg);
                    });
                    $('#lat').keyup(function() {
                        var lngg = parseFloat($('#lng').val());
                        var latt = parseFloat($('#lat').val());
                        showMap(latt, lngg);
                        //20.48248965084514,86.12043829813763
                    })
                </script>
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMmTPhJB2VEZHTfOcazmowBHb5d2HxNSo&callback=initMap"
                    type="text/javascript"></script>
            </div>
            <input type="submit" class="btn btn-danger">
        </form>
    </div>
</div>
@include('frontend.footer')
