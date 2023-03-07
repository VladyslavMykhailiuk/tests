<?php
require 'cors.php';
session_start();

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    echo json_encode(['authenticated' => true]);
} else {
    echo json_encode(['authenticated' => false]);
}