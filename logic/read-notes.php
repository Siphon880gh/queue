<?php
    /* If you see this message in the textarea, then your server does not support PHP. For eaxmple, Githug Pages does not support PHP. Deploy on a PHP server to save notes and order of checked off items. */

    
    $wrapper = @file_get_contents("../data/notes.json");
    $wrapper = json_decode($wrapper);
    echo $wrapper[0];
?>