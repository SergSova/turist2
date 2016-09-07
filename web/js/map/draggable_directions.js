function init2() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: coord[0],
        mapTypeId: google.maps.MapTypeId.TERRAIN
    });

    var flightPath = new google.maps.Polyline({
        path: coord,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });

    flightPath.setMap(map);
}


