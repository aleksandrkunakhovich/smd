var map;
var infowindow;

function initialize() {
    var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
    var mapOptions = {
        zoom: 4,
        center: myLatlng
    }

    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    infowindow = new google.maps.InfoWindow();
}

function createMarker(lat,lng,title) {
    var position = new google.maps.LatLng(lat,lng);
    var marker = new google.maps.Marker({
        position: position,
        map: map
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(title);
        infowindow.open(map, this);
    });
}

function setAllMarkers() {
    var data = JSON.parse(usersRawData);
    for( index in data) {
        var lat = parseFloat(data[index].lat);
        var lng = parseFloat(data[index].lng);
        var title = data[index].title;
        createMarker(lat, lng, title);
    }
}

google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'load', setAllMarkers);