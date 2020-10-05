<?php
    if(isset($_POST["checkmarks"])) {
        $checkmarks = $_POST["checkmarks"];
        @file_put_contents("../data/checkmarks.json", $checkmarks);
        echo json_encode(["post"=>true]);
    } else {
        echo json_encode(["post"=>false]);
    }

?>