$('document').ready(function() {
  zipcodeAPI();
  mapsAPI();
}); // end document ready

// zip code api
function zipcodeAPI () {
  // IMPORTANT: Fill in your client key
  var clientKey = "js-kpp9YtK16LkEN4C5ZfuTcXnaZWDdM7cphZUUEZGimrHWQx0a7UhhHu0yCOF12kF5";
  var cache = {};
  var container = $("#register");

console.log(container);

  var errorDiv = container.find("div.text-error");
  /** Handle successful response */
    function handleResp(data) {
      // Check for error
      if (data.error_msg)
        errorDiv.text(data.error_msg);
      else if ("city" in data) {
        // Set city and state
        container.find("input[name='city']").val(data.city);
        container.find("input[name='state']").val(data.state);
      }
    }
    // Set up event handlers
    container.find("input[name='zipcode']").on("keyup change", function() {
    // Get zip code
    var zipcode = $(this).val().substring(0, 5);
    if (zipcode.length == 5 && /^[0-9]+$/.test(zipcode))
    {
    // Clear error
    errorDiv.empty();
    // Check cache
    if (zipcode in cache) {
      handleResp(cache[zipcode]);
    } else {
    // Build url
    var url = "https://www.zipcodeapi.com/rest/"+clientKey+"/info.json/" + zipcode + "/radians";
    // Make AJAX request
    $.ajax({
      "url": url,
      "dataType": "json"
    }).done(function(data) {
      handleResp(data);
      // Store in cache
      cache[zipcode] = data;
    }).fail(function(data) {
      if (data.responseText && (json = $.parseJSON(data.responseText)))
      {
      // Store in cache
      cache[zipcode] = json;

      // Check for error
      if (json.error_msg)
        errorDiv.text(json.error_msg);
    } else
    errorDiv.text('Request failed.');
  });
  }
}
}).trigger("change");
}

// maps
function amapsAPI(){
  console.log("stuff");

      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 15
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    }