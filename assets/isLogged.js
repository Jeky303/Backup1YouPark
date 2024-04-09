document.addEventListener("DOMContentLoaded", function () {

    // Chiamata alla funzione checkLoginStatus
    checkLoginStatus(function (isLoggedIn, ruolo, nome, cognome) {
        console.log("Utente loggato: " + isLoggedIn + ", Ruolo: " + ruolo + ", nome: " + nome + ", cognome: " + cognome);
        if (isLoggedIn == true) {
            // Resto del tuo codice per utenti loggati
            document.getElementById('loggedUserName').innerHTML = nome + " " + cognome;
            const openPopupButton = document.getElementById("openPopup");
            const closePopupButton = document.getElementById("closePopup");
            const bookingPopup = document.getElementById("bookingPopup");

            openPopupButton.addEventListener("click", function () {
                bookingPopup.style.display = "flex";
            });

            closePopupButton.addEventListener("click", function () {
                bookingPopup.style.display = "none";
            });


            document.getElementById('logButton').innerHTML = "LOG OUT";
            document.getElementById('logButton').addEventListener('click', function (event) {
                event.preventDefault();

                fetch('../logout.php', { method: 'GET' })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Errore nella richiesta di logout');
                        }
                        return response.json();
                    })
                    .then(data => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Errore durante il logout:', error);
                    });
            });

        } else {
            // Resto del tuo codice per utenti non loggati
            const openPopupButton = document.getElementById("openPopup");

            openPopupButton.addEventListener("click", function () {
                window.location.href = "../logsign/index.html";
            });

            const newPostButton = document.getElementById('new-post-button');
            newPostButton.style.display = "none"; // Nascondi il bottone se l'utente non è loggato

        }
    });

    function checkLoginStatus(callback) {
        fetch('../check_login_status.php', { method: 'GET' })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Errore nella richiesta AJAX');
                }
                return response.json();
            })
            .then(data => {
                const isLoggedIn = data.isLogged;
                const ruolo = data.ruolo;
                const nome = data.nome;
                const cognome = data.cognome;

                callback(isLoggedIn, ruolo, nome, cognome);
            })
            .catch(error => {
                //console.error('Errore durante la verifica dello stato di login:', error);
                callback(false, null);
            });
    }

});