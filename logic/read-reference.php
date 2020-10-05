<?php
    $wrapper = @file_get_contents("../data/reference.json");
    $wrapper = json_decode($wrapper);
    echo $wrapper[0];
?>