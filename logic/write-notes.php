<?php
    if(isset($_POST["notes"])) {
        $wrapper = [];
        array_push($wrapper, $_POST["notes"]);
        @file_put_contents("../data/notes.json", json_encode($wrapper));
        echo json_encode(["post"=>true]);
    } else {
        echo json_encode(["post"=>false]);
    }

?>