
function initMap() {
   
    var mapId = document.getElementById('map');
     var dataLag = mapId.getAttribute('data-lag');
     var dataloge = mapId.getAttribute('data-loge');
    var map = new google.maps.Map(mapId, {
        zoom: 20,
        center: new google.maps.LatLng(dataLag, dataloge),
        disableDefaultUI: true,
        styles: [
            {
                elementType: 'labels',
                stylers: [{
                    visibility: 'on'
                }]
            },
            {
                elementType: 'geometry',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#333333'
                }]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{
                    color: '#eeeeee'
                }]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{
                    color: '#eeeeee'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{
                    color: '#eeeeee'
                }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#000000'
                }]
            },
            {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [
                    { "visibility": "off" }
                ]
            }
        ]
    });
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(dataLag, dataloge),
        map: map,
        icon: 'assets/images/location.png',
        animation: google.maps.Animation.DROP,
    });

}
