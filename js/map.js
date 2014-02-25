var map;
var infowindow;
var geocoder;
var markers = [];

// Create map
function initialize() {
    geocoder = new google.maps.Geocoder();
    var myLatlng = new google.maps.LatLng(40.10,12.40);
    var mapOptions = {
        zoom: 2,
        center: myLatlng
    }

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    infowindow = new google.maps.InfoWindow();
}

// Create one marker
function createMarker(address,title) {
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            var position = results[0].geometry.location;
            var marker = new google.maps.Marker({
                position: position,
                map: map
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(title);
                infowindow.open(map, this);
            });

            markers.push(position);
        }
    });
}

// Set markers on map
function setAllMarkers() {

    // Add all markers
    var data = JSON.parse(usersRawData);
    for( index in data) {
        var address = data[index].location;
        var title  = data[index].title;
        createMarker(address, title);
    }

    // set map center
    /*var markersBounds = new google.maps.LatLngBounds();
    for(var i = 0; i < markers.length; i++)
        markersBounds.extend(markers[i]);
    map.setCenter(markersBounds.getCenter(), map.fitBounds(markersBounds));*/
}

// Run
google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'load', setAllMarkers);