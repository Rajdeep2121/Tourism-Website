var geocoder;
//var res;

function initMap() {
    var directionsRenderer = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      //centred roughly in Bangalore
      center: {lat: 12.85, lng: 77.65}
    });
    directionsRenderer.setMap(map);
    directionsRenderer.setPanel(document.getElementById('right-panel'));
    //directionsRenderer.setPanel(document.getElementById('mode-panel'));
	geocoder = new google.maps.Geocoder();


    var control = document.getElementById('floating-panel');
    control.style.display = 'block';
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

    var control = document.getElementById('mode-panel');
    control.style.display = 'block';
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(control);

    var onChangeHandler = function() {
      calculateAndDisplayRoute(directionsService, directionsRenderer);
    };
    document.getElementById('start').addEventListener('change', onChangeHandler);
    document.getElementById('end').addEventListener('change', onChangeHandler);
  }

  var waypoints = [];

  waypoints.push({location: "bangalore palace, bangalore",stopover: true},{location: "mg road,bangalore",stopover: true});

  function calculateAndDisplayRoute(directionsService, directionsRenderer) {
    var start = document.getElementById('start').value;
    var end = document.getElementById('end').value;
	var l1,l2;

    
	 geocoder.geocode( { 'address': start}, function(results, status) {
      if (status == 'OK') { 
	l1 = results[0].geometry.location.lat();
	l2 = results[0].geometry.location.lng();

	 }});

	
    directionsService.route({
      //origin: {lat: 12.9763,lng: 77.5929},   
	origin: start,  
	destination: end,
      waypoints: waypoints,
      optimizeWaypoints: true,
      //travelMode: 'DRIVING'
      travelMode: google.maps.TravelMode[document.getElementById('mode').value]
    }, function(response, status) {
      if (status === 'OK') {
        directionsRenderer.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

