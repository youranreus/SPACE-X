<?php
//
//  inside-world
//  status.php
//  2018-1-13
//  YOURAN
//

$sql = "SELECT api,times FROM status";
$status_times = array();
$apiname = basename(dirname(__FILE__));

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($row["api"] == $apiname)
      $status_times = $row["times"];
    }
}

$update = $status_times + 1;

 mysqli_query($conn,"UPDATE status SET times=".$update." WHERE api='".$apiname."'");

$conn->close();
