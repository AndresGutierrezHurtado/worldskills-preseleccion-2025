<?php

function custom_response($msg, $to = "/") {
    echo "
    <script>
        alert('$msg');
        window.location.href = '$to';
    </script>
    ";
}