<?php

// core configuration
include_once "config/core.php";
$page_title="Map";
 
// include login checker
$require_login=true;
include_once "login_checker.php";

// include classes
include_once 'config/database.php';
include_once 'objects/brewery.php';

// include page header HTML
include_once 'layout_head.php';
echo "<div class='col-md-12'>";


?>
     <div id="map"></div>


        <script src="https://maps.google.com/maps/api/js?key=<?php echo $mapsAPI;?> " type="text/javascript"></script>
        <script type="text/javascript">
            //Sample code written by August Li
            var icon = new google.maps.MarkerImage("/images/bcm-dropplet-sm.png",
                       new google.maps.Size(68, 68), new google.maps.Point(0, 0),
                       new google.maps.Point(16, 32));
            var map, infoWindow;
            var currentPopup;
            var bounds = new google.maps.LatLngBounds();

            function addMarker(lat, lng, info) {
                var pt = new google.maps.LatLng(lat, lng);
                bounds.extend(pt);
                var marker = new google.maps.Marker({
                    position: pt,
                    icon: icon,
                    map: map
                });

                var popup = new google.maps.InfoWindow({
                    content: info,
                    maxWidth: 300
                });
                google.maps.event.addListener(marker, "click", function() {
                    if (currentPopup != null) {
                        currentPopup.close();
                        currentPopup = null;
                    }
                    popup.open(map, marker);
                    currentPopup = popup;
                });
                google.maps.event.addListener(popup, "closeclick", function() {
                    map.panTo(center);
                    currentPopup = null;
                });
            }
                    
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                    },
                    navigationControl: true,
                    navigationControlOptions: {
                        style: google.maps.NavigationControlStyle.ZOOM_PAN
                    }
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
            infoWindow.setContent('<?php echo $_SESSION['firstname']; ?> <br>You are here!');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

// pull brewery information from the database

<?php

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new Brewery($db);

// read all breweries from the database
$stmt = $user->readAll($from_record_num, $records_per_page);

// count retrieved breweries
$num = $stmt->rowCount();

// loop through the brewery records
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    echo("addMarker({$lat}, {$lng}, '<b>{$name}</b><br>{$ad_text}<br><a href={$link}>{$link}</a>');\n");
  }
?>

 center = bounds.getCenter();
     map.fitBounds(bounds);
     map.panToBounds(bounds);

     }
     </script>
     <body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
     </body>

<?php echo "</div></div>";
include_once "layout_foot.php"; ?>