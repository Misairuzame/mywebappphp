<?php
function test_input($d): string {
    $d = trim($d);
    $d = stripslashes($d);
    return htmlspecialchars($d);
}