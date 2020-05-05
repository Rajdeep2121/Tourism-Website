<!DOCTYPE html>
<html>
  <head>
    <title>Custom Itinerary</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <meta charset="utf-8">
    <link href="index.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin&display=swap" rel="stylesheet">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>

  </head>
  <body>
    

      <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-database.js"></script>
      <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-auth.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <input id="pac-input" class="controls" type="text" placeholder="Where do you want to go next?">

    <div id="map"></div>
    <p id = "place"></p>
      <input type="submit" id="sub" value="CONFIRM ITINERARY" >
    <!-- <script src="index.js"></script> -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=xxxx&libraries=places,geometry&callback=initMap">
    </script>

<script>
var map, infoWindow;
      var index = 1;


      
      var firebaseConfig = {
        apiKey: "xxxxxx",
        authDomain: "xxxx",
        databaseURL: "xxxx",
        projectId: "xxxx",
        storageBucket: "xxxx",
        messagingSenderId: "xxxx",
        appId: "xxxx",
        measurementId: "xxxx"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
      //firebase.analytics();

        
 

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {

          center: {lat: 12.9716, lng: 77.5946},
          zoom: 10
        });
        infoWindow = new google.maps.InfoWindow;
        var title = prompt("Enter the Name of this Trip:=");
        //firebase.database().ref().child("skete/itinerary/custom/title/").push(title);

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
                  var root_ref= "<?php echo $_GET["username"]?>/itinerary/custom/title/"+title;
                  firebase.database().ref().child(root_ref).push(address);
              
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
        window.location.href='../itinerary.php?username=<?php echo $_GET["username"]?>';
      }

      

</script>

</body>

</html>
