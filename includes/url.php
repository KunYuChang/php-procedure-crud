<?php

/**
 * 轉址到同個網站的其他網址 * 
 *
 * @param string $path 
 * @return void
 */
function redirect($path)
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }

    header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
    exit;
}
