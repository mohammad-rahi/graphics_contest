<?php

include_once "config.php";

$id = $_REQUEST["user_id"];
$vote = $_REQUEST["vote"];

if (mysqli_query($conn, "UPDATE voted_info SET vote_count = vote_count + 1 WHERE id = '$id'")) {
  echo $vote + 1;
}

?>