<?php
include '../check_login_status.php';

// Recupera il parametro "servizio" dalla query string dell'URL
$servizio = isset($_GET['servizio']) ? $_GET['servizio'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../icona.png" type="image/x-icon"/>
    <link rel="stylesheet" href="../general.css">
    <link rel="stylesheet" href="style.css">
    <title>Home di YouPark</title>
</head>

<body>
<header>
		<div class="container">
			<input type="checkbox" name="" id="check">

			<div class="logo-container" style="cursor:default">
				<h3 class="logo">You<span>Park</span></h3>
			</div>

			<div class="nav-btn">
				<div class="nav-links">
					<ul>
						<li class="nav-link" style="--i: .6s">
							<a href="../homepage/home.php">Home</a>
						</li>

						<li class="nav-link" style="--i: .85s">
							<a href="#">Servizi<i class="fas fa-caret-down"></i></a>
							<div class="dropdown">
								<ul>
									<li class="dropdown-link">
										<a href="<?php
										if ($isLogged==false) {
											echo '../logpage/login.php';
										}else{echo '../services/services.php?servizio=1';}
									?>">Abbonamento</a>
									</li>
									<li class="dropdown-link">
										<a href="<?php
										if ($isLogged==false) {
											echo '../logpage/login.php';
										}else{echo '../services/services.php?servizio=2';}
									?>">Prenota parcheggio</a>
									</li>
									<li class="dropdown-link">
										<a href="<?php
										if ($isLogged==false) {
											echo '../logpage/login.php';
										}else{echo '../services/services.php?servizio=3';}
									?>">Trova la tua auto</a>
									</li>
									<?php
									if ($isLogged && ($ruolo == "staff")) {
										echo '<li class="dropdown-link">
											<a href="../services/administration.php">Multe e comunicazioni</a>
										</li>';
									}
									if ($isLogged && ($ruolo == "gestore")) {
										echo '<li class="dropdown-link">
											<a href="../services/administration.php">Gestione parcheggi</a>
										</li>';
									}
									if ($isLogged && ($ruolo == "admin")) {
										echo '<li class="dropdown-link">
											<a href="../services/administration.php">Multe e comunicazioni</a>
										</li>';
										echo '<li class="dropdown-link">
											<a href="../services/administration.php">Gestione parcheggi</a>
										</li>';
										echo '<li class="dropdown-link">
											<a href="../services/administration.php">Amministrazione</a>
										</li>';
									}
										
									?>
								   
									<div class="arrow"></div>
								</ul>
							</div>
						</li>


						<li class="nav-link" style="--i: 1.35s">
							<a href="#">Chi siamo</a>
						</li>
					</ul>
				</div>

				<div class="log-sign" style="--i: 1.8s">
				<a href="<?php if($isLogged) { echo '../logout.php'; }
				else{echo'../logpage/login.php';} ?>" class="btn transparent">
			<?php if($isLogged) { echo "$nome $cognome </br> LOGOUT"; }
				else{echo"Log in";}
			?>
	</a>
					<!--<a href="#" class="btn solid">Sign up</a>-->
				</div>
			</div>

			<div class="hamburger-menu-container">
				<div class="hamburger-menu">
					<div></div>
				</div>
			</div>
		</div>
	</header>
    <main>
        <section>
        <div class="overlay">
    <div class="serviceLayout">
        <div class="top-row">
            <div class="service-item <?php if($servizio==0||$servizio==1){echo ' active';} ?>" onclick="location.href='services.php?servizio=1'">Abbonamenti</div>
            <div class="service-item <?php if($servizio==2){echo ' active';} ?>" onclick="location.href='services.php?servizio=2'">Prenotazione</div>
        </div>
        <div class="bottom-row">
            <div class="service-item <?php if($servizio==3){echo ' active';} ?>" onclick="location.href='services.php?servizio=3'">Trova</div>
            <div class="service-item <?php if($servizio==4){echo ' active';} ?>" onclick="location.href='services.php?servizio=4'">Utente</div>
        </div>
        <?php if($servizio==0||$servizio==1){echo '<div id="abbonamento">
			<div>
				<h1>I tuoi abbonamenti:</h1>';
					include "../connDB.php";
				
				
				$query = "SELECT targa, tipoAbbonamento, dataInizio, dataFine FROM abbonamenti WHERE mail = ?";
				$stmt = $conn->prepare($query);
				
				
				$stmt->bind_param("s", $_SESSION["mailUtente"]);
				$stmt->execute();
				$result = $stmt->get_result();
				
				
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
        
        $dataInizio = strtotime($row["dataInizio"]);
        $dataFine = strtotime($row["dataFine"]);
        $differenzaTempo = $dataFine - $dataInizio;
        $giorniRimasti = floor($differenzaTempo / (60 * 60 * 24));

        echo '<div class="card">';
        echo '<div class="card-header">' . $row["targa"] . '</div>';
        echo '<div class="card-info">';
        echo '<p><strong>Tipo abbonamento:</strong> ' . $row["tipoAbbonamento"] . '</p>';
        echo '<p><strong>Data inizio:</strong> <span class="center">' . $row["dataInizio"] . '</span></p>';
        echo '<p><strong>Data fine:</strong> <span class="right">' . $row["dataFine"] . '</span></p>';
        echo '<p><strong>Giorni rimasti:</strong> ' . $giorniRimasti . '</p>';
        echo '</div>';
        echo '</div>';
    }
				} else {
					echo "<p>Non hai abbonamenti attivi.</p>";
				}
				
				$stmt->close();
				$conn->close();
				echo '</div>
		<div>';
				
				echo '<form id="formAbbonamento" method="POST" action="newSubscription.php">
				<h1>Nuovo abbonamento:</h1>
    <label for="targa">Targa:</label>
    <input type="text" id="targa" name="targa" required><br>

    <label for="tipoAbbonamento">Tipo Abbonamento:</label>
    <select id="tipoAbbonamento" name="tipoAbbonamento" required>
        <option value="giornaliero">Giornaliero</option>
        <option value="settimanale">Settimanale</option>
        <option value="mensile">Mensile</option>
        <option value="annuale">Annuale</option>
    </select><br>

    <label for="dataFine">Data Fine:</label>
    <input type="date" id="dataFine" name="dataFine" required><br>

    <input type="checkbox" id="autoRinnovamento" name="autoRinnovamento">
    <label for="autoRinnovamento">Auto Rinnovamento</label><br>

    <input type="submit" value="Invia">
</form>';
			echo '</div>
		</div>';}?>
		<?php if($servizio==2){echo '';}?>
		<?php if($servizio==3){echo '';}?>
		<?php if($servizio==4){echo '';}?>
		
		
    </div>
</div>

        </section>
    </main>

</body>

</html>



