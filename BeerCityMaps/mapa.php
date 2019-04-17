<?php


// core configuration
include_once "config/core.php";
 
// set page title
$page_title="Map";
 
// include login checker
$require_login=false;
include_once "login_checker.php";
 
// include page header HTML
include_once 'layout_head.php';


        $uname="bvxwtrmy_bcmUser";
        $pass="password";
        $servername="localhost";
        $dbname="bvxwtrmy_bcm_0.2";

        $conn=new mysqli($servername,$uname,$pass) or die(mysql_error());
        mysqli_select_db($conn, $dbname) or die(mysqli_error());
?>


    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Google Maps</title>
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyA1KmJlsO5vJW0qXlKG1isCIKJqFHQ-ysw" type="text/javascript"></script>
        <script type="text/javascript">
            //Sample code written by August Li
            var icon = new google.maps.MarkerImage("/images/bcm-dropplet-sm.png",
                       new google.maps.Size(68, 68), new google.maps.Point(0, 0),
                       new google.maps.Point(16, 32));
            var center = null;
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
                    center: new google.maps.LatLng(0, 0),
                    zoom: 14,
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
<?php
$query = mysqli_query($conn, "SELECT * FROM breweries")or die(mysqli_error($conn));
while($row = mysqli_fetch_array($query))
{
  $name = $row['name'];
  $lat = $row['lat'];
  $lng = $row['lng'];
  $ad_text = $row['ad_text'];
  $link = $row['link'];



  echo("addMarker($lat, $lng, '<b>$name</b><br>$ad_text<br><a href=$link>$link</a>');\n");

}

?>
 center = bounds.getCenter();
     map.fitBounds(bounds);

     }
     </script>
     </head>
     <body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
     <div id="map"></div>
     </body>
     </html>
