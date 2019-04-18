<?php
// display if the number of breweries is greater than zero
if($num>0){

  echo "<table class='table table-hover table-responsive table-bordered'>";

  // table headers
  echo "<tr>";
  echo "<th></th>";
  echo "<th>Name</th>";
  echo "<th>Map</th>";
  echo "</tr>";

  // loop through the brewery records
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    // display brewery details
    echo "<tr>";


    echo "<td><img src='$image_dir/{$logo}' height=75px></td>";


    echo "<td><a href=http://{$link} target='_blank'>{$name}</a><p>{$address}<br>{$city}, {$state} {$zip}<br>{$contact_number}</p></td>";
    echo "<td>{$name}</td>";
    echo "</tr>";
  }

  echo "</table>";

  $page_url="breweries_template.php?";
  $total_rows = $user->countAll();

}

else{
  echo "<div class='alert alert-danger'>
  <strong>No breweries found.</strong>
  </div>";
}
?>