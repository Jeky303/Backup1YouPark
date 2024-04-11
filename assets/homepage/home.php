<?php
include '../check_login_status.php';
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
							<a href="home.php">Home</a>
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

        <div class="button-container">
            <button onclick="<?php if ($isLogged == false) { echo 'location.href=\'../logpage/login.php\''; } else { echo 'location.href=\'../services/services.php?servizio=1\''; } ?>">
                <img src="../icon/subscription.png" alt="Immagine 1">
                <span>Abbonamento</span>
            </button>
            <button onclick="<?php if ($isLogged == false) { echo 'location.href=\'../logpage/login.php\''; } else { echo 'location.href=\'../services/services.php?servizio=2\''; } ?>">
                <img src="../icon/online.png" alt="Immagine 2">
                <span>Prenota parcheggio</span>
            </button>
            <button onclick="<?php if ($isLogged == false) { echo 'location.href=\'../logpage/login.php\''; } else { echo 'location.href=\'../services/services.php?servizio=3\''; } ?>">
                <img src="../icon/transport.png" alt="Immagine 3">
                <span>Trova la tua auto</span>
            </button>

            <?php
                if ($isLogged && ($ruolo == "staff")) {
                    echo '<button onclick="location.href=\'../services/administration.php\';">
                            <img src="../icon/transport.png" alt="Immagine 3">
                            <span>Multe e comunicazioni</span>
                        </button>';
                }
				else if ($isLogged && ($ruolo == "gestore")) {
                    echo '<button onclick="location.href=\'../services/administration.php\';">
                            <img src="../icon/transport.png" alt="Immagine 3">
                            <span>Gestione parcheggi</span>
                        </button>';
                }

                else if ($isLogged && ($ruolo == "admin")) {
                    echo '<button onclick="location.href=\'../services/administration.php\';">
                            <img src="../icon/transport.png" alt="Immagine 3">
                            <span>Multe e comunicazioni</span>
                        </button>';
                    echo '<button onclick="location.href=\'../services/administration.php\';">
                            <img src="../icon/transport.png" alt="Immagine 3">
                            <span>Gestione parcheggi</span>
                        </button>';
                    echo '<button onclick="location.href=\'../services/administration.php\';">
                            <img src="../icon/transport.png" alt="Immagine 3">
                            <span>Amministrazione</span>
                        </button>';
                }
            ?>
                           
                                 
        </div>

		<footer>
            <div class="footer-container">
                <div class="vertical-menu-left">
                    <h3>Contact</h3>
                    <p>Cel: 3519***399</p>
                    <p>pec: YouPark@Pec.com</p>
                    <p>Mail: YouPark@genovayoupark.com</p>
                </div>
            </div>

            <div class="footer-container">
                <div class="footer-icons">
                    <a href="#" class="icon facebook"><img src="../png/facebook.png" alt="Facebook" width="35px" height="35px"></a>
                    <a href="#" class="icon twitter"><img src="../png/twitter.png" alt="Twitter" width="35px" height="35px"></a>
                    <a href="#" class="icon instagram"><img src="../png/instagram.png" alt="Instagram" width="35px" height="35px"></a>
                    <a href="#" class="icon linkedin"><img src="../png/linkedin.png" alt="LinkedIn" width="35px" height="35px"></a>
                </div>
                <p>&copy; 2024 Sito Web. Tutti i diritti riservati.</p>
            </div>

            <div class="footer-container">
                <div class="vertical-menu-left">
                    <h3>Contact</h3>
                    <p>P.IVA: 01225308554</p>
                    <p>Codice SDI SUBM70N</p>
                    <p>Indirizzo: Via Borzoli 46R</p>
                </div>
            </div>
        </footer>
        </div>


    </section>
</main>

</body>

</html>



