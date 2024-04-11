<?php
session_start();

// Verifica se l'utente è loggato
$isLogged = isset($_SESSION["mailUtente"]);

// Se l'utente è loggato, recupera Ruolo, Nome e Cognome
if ($isLogged) {
    $ruolo = $_SESSION["Ruolo"];
    $nome = $_SESSION["Nome"];
    $cognome = $_SESSION["Cognome"];
}

?>
