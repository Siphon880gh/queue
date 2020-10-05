<?php
    $wrapper = @file_get_contents("../data/notes.json");
    $wrapper = json_decode($wrapper);
    echo $wrapper[0];
?>