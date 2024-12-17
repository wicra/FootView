<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITRE -->
    <title>Vue Utilisateur - Tournoi de Football</title>
    
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
        /* Styles spécifiques à la page */
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
            font-family: "Roboto", sans-serif;
            min-height: 100vh;
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        
        @keyframes gradient {
            0% {
              background-position: 0% 50%;
            }
            50% {
              background-position: 100% 50%;
            }
            100% {
              background-position: 0% 50%;
            }
        }

        .container {
            width: 95%;
            max-width: 1200px;
            background: rgba(0, 0, 0, 0.3);
            padding: 3rem;
            border-radius: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .match-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .match-number {
            font-size: 1.4rem;
            font-family: "Orbitron", sans-serif;

            color: #ffffff;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: glow-blue 2s ease-in-out infinite;
        }

        @keyframes glow-blue {
            0%,
            100% {
              text-shadow: 0 0 5px rgba(0, 191, 255, 0.5);
            }
            50% {
              text-shadow: 0 0 20px rgba(0, 191, 255, 0.8);
            }
        }

        .match-title {
            font-size: 4rem;
            font-weight: 900;
            font-family: "Permanent Marker", cursive;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 69, 0, 0.3);
            margin-bottom: 1rem;
        }

        .match-content {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 3rem;
            align-items: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .match-content::before {
            content: "VS";
            font-family: "Orbitron", sans-serif;

            position: absolute;
            left: 50%;
            top: 15%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            font-weight: 900;
            color: #ffffff;
            z-index: 1;
        }

        .team {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 0.6s ease forwards;
        }

        .team:nth-child(1) {
            animation-delay: 0.2s;
        }

        .team:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes fadeIn {
            to {
              opacity: 1;
              transform: translateY(0);
            }
        }

        .team:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 69, 0, 0.2);
        }

        .team-name1 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            font-family: "Permanent Marker", cursive;

            color: white;
            text-transform: uppercase;
            text-shadow: 0 0 20px rgba(0, 191, 255, 0.4);
        }

        .team-name2 {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1.5rem;
            font-family: "Permanent Marker", cursive;

            color: white;
            text-transform: uppercase;

            text-shadow: 0 0 10px rgba(255, 69, 0, 0.3);
        }

        .team-score2 {
            font-size: 6rem;
            font-weight: 900;
            font-family: "Orbitron", sans-serif;

            color: #ff4500;
            text-shadow: 0 0 20px rgba(255, 69, 0, 0.4);
            margin: 1rem 0;
            transition: all 0.3s ease;
        }
        .team-score1 {
            font-size: 6rem;
            font-weight: 900;
            font-family: "Orbitron", sans-serif;

            color: #00bfff;
            text-shadow: 0 0 20px rgba(0, 102, 255, 0.4);
            margin: 1rem 0;
            transition: all 0.3s ease;
        }

        .match-center {
            text-align: center;
            z-index: 1;
        }

        .timer {
            font-size: 5rem;
            font-weight: 900;
            font-family: "Orbitron", sans-serif;

            color: #ffffff;
            margin: 2rem 0;
            text-shadow: 0 0 20px rgba(0, 191, 255, 0.4);
            background: rgba(0, 0, 0, 0.3);
            padding: 1rem 2rem;
            border-radius: 15px;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .container {
              padding: 1.5rem;
              width: 98%;
            }

            .match-content {
              grid-template-columns: 1fr;
              gap: 2rem;
            }

            .match-content::before {
              display: none;
            }

            .team-name {
              font-size: 2rem;
            }

            .team-score {
              font-size: 4rem;
            }

            .timer {
              font-size: 3.5rem;
            }
        }

		/* Styles pour la signature */
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

    <!-- CONTENU PRINCIPAL -->
    <div class="container">
        <!-- EN-TÊTE DU MATCH -->
        <div class="match-header">
            <div class="match-number">
                Match <span id="currentMatchNumber">1</span>/12
            </div>
            <h1 class="match-title">Tournoi 2e Edition</h1>
            <div id="matchStatus" class="status-indicator"></div>
        </div>

        <!-- CONTENU DU MATCH -->
        <div class="match-content">
            <!-- ÉQUIPE 1 -->
            <div class="team">
                <div class="team-name1" id="team1">Équipe Rouge</div>
                <div class="team-score1" id="score1">0</div>
            </div>

            <!-- CENTRE DU MATCH -->
            <div class="match-center">
                <div class="timer" id="timer">10:00</div>
            </div>

            <!-- ÉQUIPE 2 -->
            <div class="team">
                <div class="team-name2" id="team2">Équipe Bleue</div>
                <div class="team-score2" id="score2">0</div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Détecter un changement dans le localStorage
        window.addEventListener('storage', function(event) {
            if (event.key === 'simulate_click1' && event.newValue === 'true') {
                simulateClick();
                localStorage.setItem('simulate_click1', 'false'); // Réinitialiser
            }
        });

        // Fonction pour simuler le clic
        function simulateClick() {
            const button = document.getElementById('monBouton1');
            if (button) {
                button.click(); // Simule le clic sur le bouton
            }
        }

        // Vérifier si un clic doit être simulé au chargement
        document.addEventListener("DOMContentLoaded", function() {
            if (localStorage.getItem('simulate_click1') === 'true') {
                simulateClick();
                localStorage.setItem('simulate_click1', 'false'); // Réinitialiser
            }
        });
    </script>

    <!-- BOUTON POUR SIMULER LE CLIC -->
    <button id="monBouton1" onclick='window.location.href="loading.php";'>
        Cliquez-moi
    </button>
    <style>
        /* Lien discret en bas au centre */
        #monBouton1 {
          visibility: hidden; /* Rend le bouton invisible mais garde son emplacement */
          width: 0;           /* Optionnel : réduire la largeur */
          height: 0;          /* Optionnel : réduire la hauteur */
          padding: 0;         /* Optionnel : supprimer le padding */
          border: none;       /* Optionnel : supprimer les bordures */
        }
    </style>

    <script>
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, "0")}:${remainingSeconds
              .toString()
              .padStart(2, "0")}`;
        }

        function updateDisplay() {
            const storedMatches = localStorage.getItem("matches");
            const storedCurrentMatch = localStorage.getItem("currentMatch");
            const storedTimeLeft = localStorage.getItem("timeLeft");
            if (storedMatches && storedCurrentMatch) {
                const matches = JSON.parse(storedMatches);
                const currentMatchIndex = parseInt(storedCurrentMatch) - 1;
                const timeLeft = storedTimeLeft ? parseInt(storedTimeLeft) : 600;
                const match = matches[currentMatchIndex];

                document.getElementById("currentMatchNumber").textContent =
                  currentMatchIndex + 1;
                document.getElementById("team1").textContent = match.team1;
                document.getElementById("team2").textContent = match.team2;
                document.getElementById("score1").textContent = match.score1;
                document.getElementById("score2").textContent = match.score2;
                document.getElementById("timer").textContent = formatTime(timeLeft);
            }
        }

        window.addEventListener("storage", updateDisplay);
        window.addEventListener("load", updateDisplay);
    </script>
</body>
</html>
