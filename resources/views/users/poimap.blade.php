<!DOCTYPE html>
<html>
  <head>
    <title>Last Seen POI Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
    
      #map {
        height: 100%;
      }
      
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: new google.maps.LatLng(-31.438941, 25.111680),
         

        });

         @foreach ($poi_travements as $poi_travement)

         	@if($poi_travement->gps_lat)

        		var latLng        = new google.maps.LatLng({{$poi_travement->gps_lat}},{{$poi_travement->gps_lng}})   		
          		var contentString = "<div><p>Last Seen: {{$poi_travement->date_seen}}</p><p>{{$poi_travement->name}}</p></div>";
          		
        		
          		var myinfowindow = new google.maps.InfoWindow({
    				content: contentString
				});

        		var marker = new google.maps.Marker({
            			position: latLng,
            			map: map,
            			clickable: true,
            			infowindow: myinfowindow
          		});

          	
        		google.maps.event.addListener(marker, 'click', function() {
  					this.infowindow.open(map, this);
				});


	    	@endif
	    
	    @endforeach


      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&callback=initMap"
    async defer></script>
  </body>
</html>