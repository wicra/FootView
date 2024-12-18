<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITRE -->
    <title>Classement</title>
    
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
			0% {
			transform: rotate(40deg);
			}
			100% {
			transform: rotate(-40deg);
			}
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

		.match-title {
			font-size: 4rem;
			font-weight: 900;
			font-family: "Permanent Marker", cursive;
			text-transform: uppercase;
			color: #ffffff;
			text-shadow: 0 0 10px rgba(255, 69, 0, 0.3);
			margin-bottom: 1rem;
		}

		table {
			width: 100%;
			border-collapse: separate;
			border-spacing: 0;
			background: rgba(255, 255, 255, 0.05);
			border-radius: 20px;
			overflow: hidden;
		}

		th,
		td {
			padding: 1rem;
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

		#monBouton {
			visibility: hidden; 
			width: 0; 
			height: 0;    
			padding: 0;
			border: none; 
		}
		
   		/* Styles pour la signature 
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
		}	*/
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

	<!-- 
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

    
    <button id="monBouton" onclick='window.location.href="loading1.php";'></button>
	-->

    <div class="container">
      <div class="match-header">
        <h1 class="match-title">Classement Tournoi</h1>
      </div>

      <div id="classementContainer"></div>
    </div>

    <script>
      // Charger et afficher le classement depuis localStorage
      function chargerClassement() {
        const classement = JSON.parse(
          localStorage.getItem("classement") || "[]"
        );
        const container = document.getElementById("classementContainer");
        container.innerHTML = "";

        // Créer le tableau de classement
        const table = document.createElement("table");
        table.innerHTML = `
                <thead>
                    <tr>
                        <th>Club</th>
                        <th>Matchs Joués</th>
                        <th>Victoires</th>
                        <th>Matchs Nuls</th>
                        <th>Défaites</th>
                        <th>Buts Pour</th>
                        <th>Buts Contre</th>
                        <th>Différence de Buts</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody id="classementBody"></tbody>
            `;

        const tbody = table.querySelector("tbody");

        // Vérifier si le classement est déjà trié
        const classementTrie =
          classement.length > 0 && classement[0].pts !== undefined
            ? classement
            : calculerClassement(classement);

        classementTrie.forEach((club) => {
          const ligne = document.createElement("tr");
          ligne.innerHTML = `
                    <td>${club.club}</td>
                    <td>${club.mj}</td>
                    <td>${club.g}</td>
                    <td>${club.n}</td>
                    <td>${club.p}</td>
                    <td>${club.bp}</td>
                    <td>${club.bc}</td>
                    <td>${club.db}</td>
                    <td>${club.pts}</td>
                `;
          tbody.appendChild(ligne);
        });

        container.appendChild(table);
      }

      // Fonction pour calculer le classement si nécessaire
      function calculerClassement(clubs) {
        return clubs
          .map((club) => {
            const mj = club.mj || 0;
            const g = club.g || 0;
            const n = club.n || 0;
            const p = club.p || 0;
            const bp = club.bp || 0;
            const bc = club.bc || 0;

            // Calcul automatique des points et différence de buts
            const pts = g * 3 + n;
            const db = bp - bc;

            return {
              club: club.club,
              mj: mj,
              g: g,
              n: n,
              p: p,
              bp: bp,
              bc: bc,
              db: db,
              pts: pts,
            };
          })
          .sort((a, b) => {
            // Trier par points (descendant), puis par différence de buts
            if (b.pts !== a.pts) return b.pts - a.pts;
            return b.db - a.db;
          });
      }

      // Écouter les mises à jour du classement
      window.addEventListener("classementUpdated", chargerClassement);

      // Charger le classement au chargement de la page
      document.addEventListener("DOMContentLoaded", chargerClassement);

	  // Actualiser automatiquement les informations du classement toutes les 10 secondes
	setInterval(chargerClassement, 2000);

    </script>
  </body>
</html>
