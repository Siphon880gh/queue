<?php
    $checkmarks = @file_get_contents("../data/checkmarks.json");
    if($checkmarks===false || $checkmarks==="") $checkmarks = [];
    echo json_encode($checkmarks);
?>