<?php

session_start();

function clean($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function setFlash($message)
{
    $_SESSION['flash'] = $message;
}

function showFlash()
{
    if (isset($_SESSION['flash'])) {
        echo "<p class='success'>" . clean($_SESSION['flash']) . "</p>";
        unset($_SESSION['flash']);
    }
}