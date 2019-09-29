<?php
date_default_timezone_set("Africa/Lagos");
function greetings() {
  $time=date("H");
  if ($time<"12") {
    echo "Good Morning";
  }
  elseif ($time>="12" && $time<"17") {
    echo "Good Afternoon";
  }
  elseif ($time>="17" && $time < "19" ) {
    echo "Good Evening";
  }
  elseif ($time >= "19") {
    echo "Good Night";
  }
}


 ?>
