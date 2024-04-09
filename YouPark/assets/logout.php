<?php
// Inizializza la sessione, se non già inizializzata
session_start();

// Effettua il logout distruggendo tutte le variabili di sessione
session_destroy();

// Restituisci una risposta JSON indicando il successo del logout
echo json_encode(array('success' => true));
?>
