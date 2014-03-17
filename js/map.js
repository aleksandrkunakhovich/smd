var map;
var infowindow;
var geocoder;
var markers = [];

// Create map
function initialize() {
    geocoder = new google.maps.Geocoder();
    var myLatlng = new google.maps.LatLng(40.10,12.40);
    var mapOptions = {
        zoom: 1,
        center: myLatlng
    }

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    infowindow = new google.maps.InfoWindow();
}

// Create one marker
function createMarker(latitude, longitude, title) {

    var position = new google.maps.LatLng(latitude, longitude);
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

// Set markers on map
function setAllMarkers() {
    for( index in usersData) {
        var latitude = usersData[index].latitude;
        var longitude = usersData[index].longitude;
        var title  = usersData[index].name;
        createMarker(latitude, longitude, title);
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