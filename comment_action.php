<?php
include_once("config.php");

$id = $_REQUEST["designerId"];
$comment = $_REQUEST["comment"];

if (mysqli_query($conn, "INSERT INTO comments (designer_id, comments) VALUES ('$id', '$comment')")) {
  echo($comment);
}

?>