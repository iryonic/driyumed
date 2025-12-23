<?php
// includes/functions.php

function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function format_date($date_string, $format = 'F j, Y') {
    return date($format, strtotime($date_string));
}

function redirect($url) {
    header("Location: $url");
    exit;
}