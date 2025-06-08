<?php
session_start();
echo json_encode([
    'connecte' => isset($_SESSION['client_id']),
    'nom' => $_SESSION['client_nom'] ?? null
]);
