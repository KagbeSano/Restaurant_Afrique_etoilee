<?php
session_start();
echo isset($_SESSION['client_id']) ? "Connecté, ID = " . $_SESSION['client_id'] : "Non connecté";
?>