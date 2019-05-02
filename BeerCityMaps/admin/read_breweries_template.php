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
    echo "<tr>
          <td><img src='$image_dir/{$logo}' height=75px></td>
          <td><a href={$link} target='_blank'>{$name}</a><p>{$address}<br>{$city}, {$state} {$zip}<br>{$contact_number}</p></td>
          <td>{$name}</td>
          </tr>";
  }

  echo "</table>";

  $page_url="read_breweries.php?";
  $total_rows = $user->countAll();

  include_once 'paging.php';
}

else{
  echo "<div class='alert alert-danger'>
  <strong>No breweries found.</strong>
  </div>";
}
?>