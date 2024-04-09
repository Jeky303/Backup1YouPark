<?php
session_start();

// Connessione al database
include 'connDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mail = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = $_POST["pswd"];

	// Utilizza una prepared statement per la sicurezza
	$stmt = $conn->prepare("SELECT ruolo, nome, cognome, Password FROM utenti WHERE mail = ?");
	$stmt->bind_param("s", $mail);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result( $ruolo, $nome, $cognome, $hashed_password);
		$stmt->fetch();

		// Verifica la password utilizzando password_verify
		if (password_verify($password, $hashed_password)) {
			// Login avvenuto con successo, reindirizza alla pagina successiva
			$_SESSION["mailUtente"] = $mail;
            $_SESSION["Ruolo"] = $ruolo;
            $_SESSION["Nome"] = $nome;
            $_SESSION["Cognome"] = $cognome;
			
			$_SESSION['LogError']=null;

			unset($_SESSION['SignError']);
			unset($_SESSION['LogError']);
			echo '<script>window.history.go(-2);</script>'; // Reindirizza alla pagina di successo
			exit(); // Assicura che lo script termini dopo il reindirizzamento
		} else {
			// Credenziali non valide, mostra un messaggio di errore
			$loginError = "Credenziali non valide";
			$_SESSION['LogError']= $loginError;
			unset($_SESSION['SignError']);
			echo '<script>window.history.go(-1);</script>';
		}
	} else {
		// Credenziali non valide, mostra un messaggio di errore
		$loginError = "Credenziali non valide";
		unset($_SESSION['SignError']);
		$_SESSION['LogError']= $loginError;
		echo '<script>window.history.go(-1);</script>';
	}

	$stmt->close();
}

$conn->close();
?>
