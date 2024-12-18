<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITRE -->
    <title>Tournoi de Football - Accueil</title>
    
    <!-- MANIFEST ET FAVICON -->
    <link rel="manifest" href="manifest.json">
    <link id="favicon" rel="icon" type="image/png" href="asset/img/ballon-de-foot.png">
    
    <!-- STYLES -->
    <link rel="stylesheet" href="styles/style.css">
    
    <!-- SCRIPTS EXTERNES -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- POLICES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- STYLES PERSONNALISÉS -->
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Roboto", sans-serif;
        min-height: 100vh;
        display: flex;
		flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: black;
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
		padding-bottom: 10rem;
        background: rgba(0, 0, 0, 0.3);
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

      .team-name {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
        font-family: "Permanent Marker", cursive;
        color: white;
        text-transform: uppercase;
        text-shadow: 0 0 20px rgba(0, 191, 255, 0.4);
      }

      .team-score {
        font-size: 6rem;
        font-weight: 900;
        color: white;
        text-shadow: 0 0 20px rgba(0, 191, 255, 0.4);
        margin: 1rem 0;
        transition: all 0.3s ease;
      }

      .score-controls {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1.5rem;
      }

      .score-btn {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 1.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: "Orbitron", sans-serif;
        text-transform: uppercase;
      }

      .score-btn:hover {
        background: rgba(255, 255, 255, 0.2);
      }

      .match-center {
        text-align: center;
        z-index: 1;
      }

      .timer {
        font-size: 5rem;
        font-weight: 900;
        font-family: "Orbitron", sans-serif;
        color: white;
        margin: 2rem 0;
        text-shadow: 0 0 20px rgba(0, 191, 255, 0.4);
        background: rgba(0, 0, 0, 0.3);
        padding: 1rem 2rem;
        border-radius: 15px;
        display: inline-block;
      }

      .controls {
        display: flex;
        flex-direction: column;
        gap: 1rem;
      }

      .control-btn {
        padding: 1rem 2rem;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50px;
        cursor: pointer;
        font-family: "Orbitron", sans-serif;
        text-transform: uppercase;
		text-decoration: none;
        transition: background 0.3s ease;
      }

      .control-btn:hover {
        background: rgba(255, 255, 255, 0.2);
      }

      .match-navigation {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
      }

      .status-indicator {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        font-family: "Orbitron", sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      .status-active {
        background: #4caf50;
        color: white;
      }

      .status-completed {
        background: #f44336;
        color: white;
      }

      .navigation-buttons {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
      }

      .nav-button {
        background-color: #fdbb2d;
        color: #1a2a6c;
        border: none;
        padding: 1rem 2rem;
        font-size: 1.2rem;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        margin: 0 1rem;
      }

      .nav-button:hover {
        background-color: #b21f1f;
        transform: translateY(-3px);
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

        .control-btn {
          padding: 0.8rem 1.5rem;
          font-size: 1.1rem;
        }

        .match-navigation {
          flex-direction: column;
          gap: 1rem;
        }
      }
    </style>
  </head>
  <body>


	<!-- CONTENU PRINCIPAL -->
    <div class="container">
      <div class="match-header">
        <div class="match-number">
          Match <span id="currentMatchNumber">1</span>/12
        </div>
        <h1 class="match-title">Tournoi 2e Edition</h1>
        <div id="matchStatus" class="status-indicator"></div>
      </div>

      <div class="match-content">
        <div class="team">
          <div class="team-name" id="team1">Équipe A</div>
          <div class="team-score" id="score1">0</div>
          <div class="score-controls">
            <button class="score-btn" onclick="updateScore(1, 1)">+</button>
            <button class="score-btn" onclick="updateScore(1, -1)">−</button>
          </div>
        </div>

        <div class="match-center">
          <div class="timer" id="timer">10:00</div>
          <div class="controls">
            <button
              class="control-btn"
              id="timerButton"
              onclick="toggleTimer()"
            >
              Démarrer
            </button>
            <button class="control-btn" onclick="resetMatch()">
              Réinitialiser
            </button>
          </div>
        </div>

        <div class="team">
          <div class="team-name" id="team2">Équipe B</div>
          <div class="team-score" id="score2">0</div>
          <div class="score-controls">
            <button class="score-btn" onclick="updateScore(2, 1)">+</button>
            <button class="score-btn" onclick="updateScore(2, -1)">−</button>
          </div>
        </div>
      </div>

      <div class="match-navigation">
        <a class="control-btn" href="user_view.php" target="_blank">Vue Debut</a>
        <a class="control-btn" href="classement_admin.php" target="_blank">Adm Class</a>
        <button class="control-btn" onclick="previousMatch()">Match Précéd</button>
        <button class="control-btn" onclick="nextMatch()">Match Suivant</button>
        

        <button class="control-btn" onclick="triggerClickOnPageA()">Vue User</button>
        <button class="control-btn" onclick="triggerClickOnPageB()">Vue Plan</button>
      </div>
    </div>

	<!-- CLASSEMENT ADMIN -->
	<div id="classementContainer">
		<?php include 'classement_admin.php'; ?>
	</div>

    
    <!-- SCRIPTS -->
	<script src="app.js"></script>
    <script>
        function triggerClickOnPageA() {
            // Déclencher l'événement dans le localStorage
            localStorage.setItem('simulate_click', 'true');
        }
        function triggerClickOnPageB() {
            // Déclencher l'événement dans le localStorage
            localStorage.setItem('simulate_click1', 'true');
        }
    </script>
  </body>
</html>
