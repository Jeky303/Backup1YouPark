<?php
session_start();

// Connessione al database
include 'connDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $mail = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["pswd"], PASSWORD_DEFAULT);

    $cognome = strtolower(mysqli_real_escape_string($conn, $_POST["cognome"]));
    $nome = strtolower(mysqli_real_escape_string($conn, $_POST["nome"]));
    
    $domicilio = strtolower(mysqli_real_escape_string($conn, $_POST["domicilio"]));
	$residenza = strtolower(mysqli_real_escape_string($conn, $_POST["residenza"]));


    // Verifica se l'utente esiste già
    $checkUserQuery = "SELECT mail FROM utenti WHERE mail = '$mail'";
    $checkUserResult = $conn->query($checkUserQuery);

    if ($checkUserResult->num_rows > 0) {
        echo '<script>window.history.go(-1);</script>';
    }

    
        // Inserimento dell'utente nel database
        $insertUserQuery = "INSERT INTO utenti (mail, password, nome, cognome, domicilio, residenza) VALUES ('$mail', '$password', '$nome', '$cognome', '$domicilio', '$residenza')";

        if ($conn->query($insertUserQuery) === TRUE) {
            // Registrazione avvenuta con successo
            $_SESSION["mailUtente"] = $mail;
            $_SESSION["Ruolo"] = "utente";
            $_SESSION["Nome"] = $nome;
            $_SESSION["Cognome"] = $cognome;

            echo '<script>window.history.go(-2);</script>';
        }
    $checkUserResult->close();
}
$conn->close();
?>
