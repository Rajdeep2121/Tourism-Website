var map, infoWindow;
      var index = 1;


      
      var firebaseConfig = {
        apiKey: "AIzaSyBvKqHhpd1lwthcDeJ6KVtQXM6GhvTlBQ0",
        authDomain: "saki-bb7e8.firebaseapp.com",
        databaseURL: "https://saki-bb7e8.firebaseio.com",
        projectId: "saki-bb7e8",
        storageBucket: "saki-bb7e8.appspot.com",
        messagingSenderId: "473923008294",
        appId: "1:473923008294:web:8cbbb24061454f2e9bf3e7",
        measurementId: "G-FNW4BD06PM"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      //firebase.analytics();
      
      var username=location.search.split('username=')[1];
      console.log(username);
      var firereff=firebase.database().ref().child('skete');



      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {

          center: {lat: 12.9716, lng: 77.5946},
          zoom: 10
        });
        infoWindow = new google.maps.InfoWindow;

        map.addListener('click', function(e)
        {
          var time;
          placeMarkerAndPanTo(e.latLng, map);
          
          //alert(e.latLng);
          geocoder.geocode({'location':e.latLng},function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                if (results[1])
                {
                  
                  while(!time){
                    var date_1= prompt("Date :","dd/mm/yyyy");
                    var time=prompt('When do you want to visit this place?',"09:30 am");

                };
                
                  var address= date_1 + " : " + time + " : " + results[1].formatted_address ;
                  
                  firebase.database().ref().child("skete/itinerary/custom/title/").push(address);
              
                  var node = document.createElement("p");
                  var textnode = document.createTextNode(address); 
                  node.appendChild(textnode);      
                  document.getElementById("place").appendChild(node);
                  //console.log(time);
                  console.log(results[1].formatted_address);
                }
               else
               {
                 alert('No results found');
               }
             }
             else
             {
               alert('Geocoder failed due to: ' + status);
             }
           });

        });

        var geocoder = new google.maps.Geocoder;

        var input = document.getElementById('pac-input');
        var latlngStr;

        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          var markers = [];
          var adds = [];

        searchBox.addListener('places_changed', function()
        {
          var places = searchBox.getPlaces();

          if (places.length == 0)
          {
            return;
          }

          else
          {
              var x = places[0].geometry.location;
              map.setCenter(places[0].geometry.location);
              //alert(places[0].geometry.location);
          }


          markers.forEach(function(marker)
          {
            marker.setMap(null);
          });
          markers = [];
        });


        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            infoWindow.setPosition(pos);
            infoWindow.setContent('You are here\!');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        }
        else
        {
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }


      function handleLocationError(browserHasGeolocation, infoWindow, pos)
      {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation. Try using Chrome to fix this.');
      }


      function placeMarkerAndPanTo(latLng, map) {
        var marker = new google.maps.Marker({
          position: latLng,
          map: map,
          label: (index++).toString()
        });
        map.panTo(latLng);


      }

      document.getElementById("sub").addEventListener("click",nameIten,"false");
      function nameIten()
      {
        var title = prompt("Enter the Name of this Trip");
        firebase.database().ref().child("skete/itinerary/custom/").set(title);
      
        window.location.href='../itinerary.php';
      }

      
      
      