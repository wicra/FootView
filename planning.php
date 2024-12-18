<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITRE -->
    <title>Planning des Matchs</title>
    
    <!-- FAVICON -->
    <link id="favicon" rel="icon" type="image/png" href="asset/img/ballon-de-foot.png">
    
    <!-- STYLES -->
    <link rel="stylesheet" href="styles/style.css">
    
    <!-- POLICES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- STYLES PERSONNALISÉS -->
    <style>
        path {
            transform-origin: 50% 0%;
        }
        .background--custom {
            background-color: #d63a3a;
            position: absolute;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            top: 0;
            left: 0;
        }
        @keyframes path0 {
            0% { transform: rotate(40deg); }
            100% { transform: rotate(-40deg); }
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "orbitron", sans-serif;
            min-height: 100vh;
            background-size: 400% 400%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .container {
        display: flex;
        align-items: stretch;
        width: 95%;
        max-width: 1200px;
        background: rgba(0, 0, 0, 0.3);
        padding: 2vh 2vw 2vh 0;
        border-radius: 30px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .vertical-title-container {
        display: flex;
        align-items: center;
        justify-content: center;
        writing-mode: vertical-rl;
        text-orientation: mixed;
        transform: rotate(180deg);
        background: rgba(0, 0, 0, 0.2);
        padding: 20px 10px;
        margin: 0px 21px;
        min-width: 80px;
        border-radius: 20px;
    }

    .match-title {
        font-size: 2rem;
        font-weight: 900;
        font-family: "Permanent Marker", cursive;
        text-transform: uppercase;
        color: white;
        letter-spacing: 2px;
        white-space: nowrap;
    }

    .table-container {
        flex-grow: 1;
        overflow-x: auto;
    }

    #matchTable {
        width: 100%;
        border-collapse: collapse;
    }
        .container:hover {
            transform: translateY(-5px);
        }
        .match-header {
            text-align: center;
            margin-bottom: 2px;
            position: relative;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        th {
            background: rgba(0, 0, 0, 0.2);
            font-family: "Orbitron", sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        tr:hover {
            background: rgba(255, 255, 255, 0.1);
            transition: background 0.3s ease;
        }
        tr:last-child td {
            border-bottom: none;
        }
        
        .match-en-cours {
        background-color: rgba(255, 165, 0, 0.2) !important; /* Orange transparent */
        transform: scale(1.05);
        transition: transform 0.3s ease;
        box-shadow: 0 0 15px rgba(255, 165, 0, 0.5);
        animation: pulse-orange 1.5s infinite;
    }

    @keyframes pulse-orange {
        0% {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 165, 0, 0.5);
        }
        50% {
            transform: scale(1.07);
            box-shadow: 0 0 25px rgba(255, 165, 0, 0.7);
        }
        100% {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 165, 0, 0.5);
        }
    }

    /* Modification des styles de score */
    .score-gagnant {
        color: #2ecc71 !important; /* Vert pour le gagnant */
        font-weight: bold;
    }

    .score-perdant {
        color: #e74c3c !important; /* Rouge pour le perdant */
        font-weight: normal;
    }
        
        .signature {
            position: fixed;
            z-index: 20;
            bottom: 2%;
            left: 50%; 
            transform: translate(-50%, 50%); 
            color: #ffffff;
            font-family: "Orbitron", sans-serif;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- SIGNATURE -->
    <h4 class="signature">Organisation B2CIEL 23-25</h4>

    <!-- ARRIÈRE-PLAN PERSONNALISÉ -->
    <svg class="background--custom" id="demo" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path 
            fill="#4F4FF0"
            fill-opacity="0.9"
            d="M-100 -100L200 -100L200 50L-100 50Z"
            style="animation: path0 12.195121951219512s linear infinite alternate"
        ></path>
    </svg>

    <div class="container">
        <div class="vertical-title-container">
            <h1 class="match-title">Planning des Matchs</h1>
        </div>

        <table id="matchTable">
            <thead>
                <tr>
                    <th>Match</th>
                    <th>Équipe 1</th>
                    <th>Score Équipe 1</th>
                    <th>Score Équipe 2</th>
                    <th>Équipe 2</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody id="matchTableBody">
                <!-- Les matchs seront générés dynamiquement ici -->
            </tbody>
        </table>
    </div>


    <!-- BOUTON POUR SIMULER LE CLIC -->
    <script>
        // Détecter un changement dans le localStorage
        window.addEventListener('storage', function(event) {
            if (event.key === 'simulate_click' && event.newValue === 'true') {
                simulateClick();
                localStorage.setItem('simulate_click', 'false'); // Réinitialiser
            }
        });

        // Fonction pour simuler le clic
        function simulateClick() {
            const button = document.getElementById('monBouton');
            if (button) {
                button.click(); // Simule le clic sur le bouton
            }
        }

        // Vérifier si un clic doit être simulé au chargement
        document.addEventListener("DOMContentLoaded", function() {
            if (localStorage.getItem('simulate_click') === 'true') {
                simulateClick();
                localStorage.setItem('simulate_click', 'false'); // Réinitialiser
            }
        });


    </script>

    <!-- BOUTON POUR SIMULER LE CLIC -->
    <button id="monBouton" onclick='window.location.href="loading1.php";'></button>
    <style>
        #monBouton {
          visibility: hidden; 
          width: 0;     
          height: 0;         
          padding: 0;      
          border: none;   
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const matchTableBody = document.getElementById('matchTableBody');

        function updateMatchesJSON(matches, currentMatch) {
            fetch('save_matches.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    matches: matches,
                    currentMatch: currentMatch
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status !== 'success') {
                    console.error('Erreur lors de la sauvegarde des matchs');
                }
            })
            .catch(error => console.error('Erreur:', error));
        }

        function renderMatches() {
            fetch('matches.json?_=' + new Date().getTime())
                .then(response => response.json())
                .then(data => {
                    const matches = data.matches;
                    const currentMatchIndex = data.currentMatch - 1;

                    // Vider le tableau existant
                    matchTableBody.innerHTML = '';

                    // Mettre à jour les statuts des matchs
                    matches.forEach((match, index) => {
                        if (index < currentMatchIndex) {
                            match.played = true;
                        } else if (index === currentMatchIndex) {
                            match.played = false; // Match en cours
                        } else {
                            match.played = false; // Matchs à venir
                        }
                    });

                    matches.forEach((match, index) => {
                        const row = document.createElement('tr');
                        
                        // Déterminer le statut et le style du match
                        let statusText = '';
                        if (index < currentMatchIndex) {
                            statusText = 'Joué';
                        } else if (index === currentMatchIndex) {
                            statusText = 'En cours';
                            row.classList.add('match-en-cours');
                        } else {
                            statusText = 'En attente';
                        }

                        // Gérer le style des scores pour les matchs terminés
                        let score1Class = '';
                        let score2Class = '';
                        if (index < currentMatchIndex) {
                            if (match.score1 > match.score2) {
                                score1Class = 'score-gagnant';
                                score2Class = 'score-perdant';
                            } else if (match.score1 < match.score2) {
                                score1Class = 'score-perdant';
                                score2Class = 'score-gagnant';
                            }
                        }

                        row.innerHTML = `
                            <td>${match.id}</td>
                            <td>${match.team1}</td>
                            <td class="${score1Class}">${match.score1}</td>
                            <td class="${score2Class}">${match.score2}</td>
                            <td>${match.team2}</td>
                            <td data-status="${statusText}">${statusText}</td>
                        `;

                        // Ajouter un écouteur d'événements pour mettre à jour le match
                        row.addEventListener('click', function() {
                            // Autoriser la modification uniquement pour les matchs terminés
                            if (index < currentMatchIndex) {
                                const newScore1 = prompt(`Nouveau score pour ${match.team1}:`, match.score1);
                                const newScore2 = prompt(`Nouveau score pour ${match.team2}:`, match.score2);
                                
                                if (newScore1 !== null && newScore2 !== null) {
                                    match.score1 = parseInt(newScore1);
                                    match.score2 = parseInt(newScore2);

                                    // Sauvegarder les modifications
                                    updateMatchesJSON(matches, currentMatchIndex + 1);
                                }
                            }
                        });

                        matchTableBody.appendChild(row);
                    });

                    // Sauvegarder les modifications des statuts
                    updateMatchesJSON(matches, currentMatchIndex + 1);
                })
                .catch(error => console.error('Erreur de chargement:', error));
        }

        // Première initialisation
        renderMatches();

        // Rafraîchissement toutes les 5 secondes
        setInterval(renderMatches, 5000);

        // Écouter les changements du localStorage (communication inter-onglets)
        window.addEventListener('storage', function(event) {
            if (event.key === 'matches') {
                renderMatches();
            }
        });
    });
</script>

</body>
</html>