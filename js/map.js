var map;
var infowindow;
var geocoder;

// Create map
function initialize() {
    geocoder = new google.maps.Geocoder();
    var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
    var mapOptions = {
        zoom: 4,
        center: myLatlng
    }

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    infowindow = new google.maps.InfoWindow();
}

// Create one marker
function createMarker(address,title) {
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(title);
                infowindow.open(map, this);
            });
        }
    });
}

// Set markers on map
function setAllMarkers() {
    var data = JSON.parse(usersRawData);
    for( index in data) {
        var adress = data[index].location;
        var title  = data[index].title;
        createMarker(adress, title);
    }
}

// Run
google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'load', setAllMarkers);