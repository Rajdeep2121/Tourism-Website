var index = 1;

      var map, infoWindow,pos;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 12.397, lng: 77.644},
          zoom: 10,
          mapTypeId: 'roadmap'
        });

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
          var  pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            var cityCircle = new google.maps.Circle({
            strokeColor: '#212F3C',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#F5B7B1',
            fillOpacity: 0.35,
            map: map,
            //center: citymap[city].center,
            center: pos,
            radius: 55000,
            editable: true,
            clickable: false
            //radius: Math.sqrt(citymap[city].population) * 100
          });


            infoWindow.setContent('You are here!');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        map.addListener('click', function(e)
        {
         placeMarkerAndPanTo(e.latLng, map);
       });

       //alert(pos);
     }

      function placeMarkerAndPanTo(latLng, map) {
        var marker = new google.maps.Marker({
          position: latLng,
          map: map,
          label: (index++).toString()
        });
        map.panTo(latLng);
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

