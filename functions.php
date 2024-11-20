<?php
function readConfig($filePath) {
    if (!file_exists($filePath)) {
        return [];
    }
    return parse_ini_file($filePath, true);
}

function checkServerStatus($url) {
    $headers = @get_headers($url);
    if (!$headers) {
        return "Offline";
    }
    return str_contains($headers[0], "200") ? "Online" : "Offline";
}
?>
