<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITRE -->
    <title>Pause Midi - Tournoi de Football</title>
    
    <!-- FAVICON -->
    <link id="favicon" rel="icon" type="image/png" href="asset/img/ballon-de-foot.png">
    
    <!-- POLICES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    
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
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .pause-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .pause-subtitle {
            font-size: 8.4rem;
            font-family: "Orbitron", sans-serif;
            color: #ffffff;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: glow-blue 2s ease-in-out infinite;
        }

        @keyframes glow-blue {
            0%, 100% { text-shadow: 0 0 5px rgba(0, 191, 255, 0.5); }
            50% { text-shadow: 0 0 20px rgba(0, 191, 255, 0.8); }
        }

        .pause-title {
            font-size: 4rem;
            font-weight: 900;
            font-family: "Permanent Marker", cursive;
            text-transform: uppercase;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 69, 0, 0.3);
            margin-bottom: 1rem;
        }

        .pause-content {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .pause-animation {
            text-align: center;
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to {
              opacity: 1;
              transform: translateY(0);
            }
        }

        .pause-animation:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 69, 0, 0.2);
        }

        .pause-loader {
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
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

        @media (max-width: 768px) {
            .pause-title {
                font-size: 2.5rem;
            }
            .pause-subtitle {
                font-size: 1.8rem;
            }
        }
        
        .panWrapper {
            width: 400px;
            height: fit-content;
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            flex-direction: column;
            gap: 40px;
        }

        .pan {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            width: 100%;
            height: fit-content;
            animation: cooking 1.7s infinite;
        }
        @keyframes cooking {
            0% { transform: rotate(0deg); transform-origin: top right; }
            10% { transform: rotate(-4deg); transform-origin: top right; }
            50% { transform: rotate(20deg); }
            100% { transform: rotate(0deg); }
        }

        .food {
            position: absolute;
            width: 100px;
            height: 100px;
            left: 20px;
            top: -58px;
            z-index: 2;
            animation: flip 1.7s infinite;
        }

        .food svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 0 5px rgba(0,0,0,0.3));
        }

        @keyframes flip {
            0% { 
                transform: translateY(0px) rotate(0deg); 
            }
            50% { 
                transform: translateY(-150px) rotate(720deg);
            }
            100% { 
                transform: translateY(0px) rotate(0deg);
            }
        }
        .panBase {
            z-index: 3;
            width: 50%;
            height: 44px;
            border-bottom-left-radius: 80px;
            border-bottom-right-radius: 80px;
            background: linear-gradient(to top, rgb(3, 156, 156), rgb(10, 191, 191));
        }
        .panHandle {
            width: 40%;
            background: linear-gradient(to bottom, rgb(18, 18, 18), rgb(74, 74, 74));
            height: 20px;
            border-radius: 20px;
        }
        .panShadow {
            width: 140px;
            height: 16px;
            background-color: rgba(0, 0, 0, 0.21);
            margin-left: 30px;
            border-radius: 20px;
            animation: shadow 1.7s infinite;
            filter: blur(5px);
        }
        @keyframes shadow {
            0% { transform: scaleX(0.7); }
            50% { transform: scaleX(1); }
            100% { transform: scaleX(0.7); }
        }
    </style>
</head>
<body>

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
        <div class="pause-header">
            <div class="pause-subtitle">Pause Midi</div>
            <h1 class="pause-title">Reprise à 13h30</h1>
        </div>

        <div class="pause-content">
            <div class="pause-animation">
                <div class="pause-loader">
                    <div class="panWrapper">
                        <div class="pan">
                            <div class="food">
                                <svg fill="#FFFFFF" width="800px" height="800px" viewBox="0 0 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve">
                                    <style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style>
                                    <g>
                                        <path class="st0" d="M61.44,0c16.97,0,32.33,6.88,43.44,18c11.12,11.12,18,26.48,18,43.44c0,16.97-6.88,32.33-18,43.44 c-11.12,11.12-26.48,18-43.44,18S29.11,116,18,104.88C6.88,93.77,0,78.41,0,61.44C0,44.47,6.88,29.11,18,18 C29.11,6.88,44.47,0,61.44,0L61.44,0z M76.85,117.08L76.73,117l6.89-23.09L69.41,78.15L52.66,78L39.38,94.62l6.66,22.32l-0.15,0.1 c4.95,1.38,10.16,2.12,15.55,2.12C66.78,119.16,71.95,118.44,76.85,117.08L76.85,117.08z M12.22,91.61l24.34,0.12L49.28,75.8 l-5.26-16.12l-21.42-9.3L3.78,64.08C4.23,74.14,7.26,83.53,12.22,91.61L12.22,91.61z M16.77,24.88l7.4,22.14l19.98,8.68 l15.44-11.97V20.94L40.51,7.63c-7.52,2.93-14.28,7.39-19.89,13C19.27,21.98,17.98,23.4,16.77,24.88L16.77,24.88z M81.7,7.37 L63.3,20.77V43.7L77.8,54.91l20.81-8.92l7.18-21.49c-1.12-1.35-2.3-2.64-3.54-3.88C96.48,14.85,89.49,10.29,81.7,7.37L81.7,7.37z M119.09,64.36l-0.02,0.01L99.09,49.82l-19.81,8.49l-6.08,18.03l13.73,15.23c0.06,0.06,0.09,0.13,0.11,0.21l23.6-0.11 C115.56,83.65,118.59,74.34,119.09,64.36L119.09,64.36z"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="panBase"></div>
                            <div class="panHandle"></div>
                        </div>
                        <div class="panShadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- CHAMPS POUR SIMULER LES CLICS DE CHANGEMENT DE PAGE  -->
    <script>
        // Détecter un changement dans le localStorage
        window.addEventListener('storage', function(event) {
            if (event.key === 'simulate_click' && event.newValue === 'true') {
                simulateClick('monBouton');
                localStorage.setItem('simulate_click', 'false'); // Réinitialiser
            }
            if (event.key === 'simulate_click1' && event.newValue === 'true') {
                simulateClick('monBouton1');
                localStorage.setItem('simulate_click1', 'false'); // Réinitialiser
            }
            if (event.key === 'simulate_click2' && event.newValue === 'true') {
                simulateClick('monBouton2');
                localStorage.setItem('simulate_click2', 'false'); // Réinitialiser
            }
        });

        // Fonction pour simuler le clic
        function simulateClick(buttonId) {
            const button = document.getElementById(buttonId);
            if (button) {
                console.log(`Clic simulé sur le bouton : ${buttonId}`);
                button.click(); // Simule le clic sur le bouton
            } else {
                console.error(`Bouton avec l'ID '${buttonId}' non trouvé !`);
            }
        }

        // Vérifier si un clic doit être simulé au chargement
        document.addEventListener("DOMContentLoaded", function() {
            if (localStorage.getItem('simulate_click') === 'true') {
                simulateClick('monBouton');
                localStorage.setItem('simulate_click', 'false'); // Réinitialiser
            }
            if (localStorage.getItem('simulate_click1') === 'true') {
                simulateClick('monBouton1');
                localStorage.setItem('simulate_click1', 'false'); // Réinitialiser
            }
            if (localStorage.getItem('simulate_click2') === 'true') {
                simulateClick('monBouton2');
                localStorage.setItem('simulate_click2', 'false'); // Réinitialiser
            }
        });
    </script>

    <!-- BOUTONS POUR SIMULER LES CLICS -->
    <button id="monBouton" onclick='window.location.href="loading.php";'>
        Redirection vers Loading
    </button>
    <button id="monBouton1" onclick='window.location.href="loading1.php";'>
        Redirection vers Loading 1
    </button>
    <button id="monBouton2" onclick='window.location.href="loading2.php";'>
        Redirection vers Loading 2
    </button>

    <style>
        /* Cache les boutons mais les rend interactifs */
        #monBouton, #monBouton1, #monBouton2 {
            visibility: hidden;
            width: 0;       
            height: 0;      
            padding: 0;       
            border: none;       
        }
    </style>


    <h4 class="signature">Organisation B2CIEL 23-25</h4>
</body>
</html>