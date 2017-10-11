var map;
var marker;
var cAddress;

//Get map
function map(){
  var lat=30.2161374;
  var lng=74.9515867;
  var latlng = {lat: lat, lng: lng};
  var myOptions={
    center: latlng,
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:true,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
}

//Get address from latlong
function address(lat,lng){
  var latlng = {lat: lat, lng: lng};
  var geocoder = new google.maps.Geocoder;

  geocoder.geocode({'location': latlng}, function(results,status){
    //console.log(results[0].formatted_address);
    if(status === 'OK'){
      if(results[0]){        
        console.log(results[0].formatted_address);
        return String(results[0].formatted_address);
      }else{
        snackbar("No address found!");
      }
    }
  });
}

//Get current location in map
function currentLocation()
{
  if (navigator.geolocation)
  {
    navigator.geolocation.getCurrentPosition(showMap,showError);
  }
  else{
    snackbar("Geolocation not supported.");
  }
}

//Show Position in Map with position
function showMap(position)
{
  mapUsingLatLng(position.coords.latitude,position.coords.longitude);
}

//Show Position in Map with latitude and longitude
function mapUsingLatLng(latitude,longitude)
{
  var latlng=new google.maps.LatLng(latitude, longitude);
  var myOptions={
    center: latlng,
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:true,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
  marker=new google.maps.Marker({position:latlng,map:map,title:"You are here!"});
}

//Get Distance using addresses
function distance(origin,destination)
{
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
  {
    origins: [origin],
    destinations: [destination],
    travelMode: 'DRIVING',
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    avoidHighways: true,
    avoidTolls: true,
  }, callback);
}

//Function when distance response comes
function callback(response, status)
{
  console.log("Distance: "+response.rows[0].elements[0].distance.value/1000 +" KM");
}

//Show direction in between two places
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

function mapDirection() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var myOptions={
    zoom: 7,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:true,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  };
  map=new google.maps.Map(document.getElementById("mapholder"),myOptions);
  directionsDisplay.setMap(map);
}

function direction(origin,destination)
{
  var request = {
    origin: origin,
    destination: destination,
    travelMode: 'DRIVING'
  };
  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
  });
  mapDirection();
}

//Show any error
function showError(error)
{
  switch(error.code) 
  {
    case error.PERMISSION_DENIED:
    snackbar("User denied the request for Geolocation.");
    break;
    case error.POSITION_UNAVAILABLE:
    snackbar("Location information is unavailable.");
    break;
    case error.TIMEOUT:
    snackbar("The request to get user location timed out.");
    break;
    case error.UNKNOWN_ERROR:
    snackbar("An unknown error occurred.");
    break;
  }
}