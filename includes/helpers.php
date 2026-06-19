<?php
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    if (function_exists('iconv')) {
        $converted = @iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        if ($converted !== false) $text = $converted;
    }
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    return empty($text) ? 'tema-' . time() : $text;
}

function timeAgo($datetime) {
    $diff = time() - strtotime($datetime);
    if ($diff < 60) return 'hace un momento';
    if ($diff < 3600) return 'hace ' . floor($diff / 60) . ' min';
    if ($diff < 86400) return 'hace ' . floor($diff / 3600) . ' h';
    if ($diff < 2592000) return 'hace ' . floor($diff / 86400) . ' días';
    return date('d/m/Y', strtotime($datetime));
}

function bbToHtml($text) {
    /* Convierte saltos de línea a <br> de forma segura, después de escapar todo. */
    return nl2br(htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
}