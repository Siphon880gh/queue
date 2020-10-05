<?php
    if(isset($_POST["reference"])) {
        $wrapper = [];
        array_push($wrapper, $_POST["reference"]);
        @file_put_contents("../data/reference.json", json_encode($wrapper));
        echo json_encode(["post"=>true]);
    } else {
        echo json_encode(["post"=>false]);
    }

?>