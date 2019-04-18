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
function mapsAPI(){
  console.log("stuff");

  
    }