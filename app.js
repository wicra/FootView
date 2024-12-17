let timerInterval;
let running = false;
let timeLeft = 240; // 4 minutes in seconds
let matches = [];
let currentMatchIndex = 0;

// Charger les données des matches
async function loadMatches() {
  try {
    const response = await fetch("matches.json");
    const data = await response.json();

    const storedMatches = localStorage.getItem("matches");
    const storedCurrentMatch = localStorage.getItem("currentMatch");

    if (storedMatches && storedCurrentMatch) {
      const parsedStoredMatches = JSON.parse(storedMatches);

      // Fusionner les données du JSON avec les matchs sauvegardés
      matches = data.matches.map((match) => {
        const storedMatch = parsedStoredMatches.find((m) => m.id === match.id);

        // Conserver les scores et le statut du match sauvegardé
        if (storedMatch) {
          return {
            ...match,
            score1: storedMatch.score1,
            score2: storedMatch.score2,
            played: storedMatch.played,
          };
        }

        return match;
      });

      currentMatchIndex = parseInt(storedCurrentMatch) - 1;
    } else {
      matches = data.matches;
      currentMatchIndex = data.currentMatch - 1;
    }

    displayCurrentMatch();

    // Toujours sauvegarder les matchs
    localStorage.setItem("matches", JSON.stringify(matches));
    localStorage.setItem("currentMatch", currentMatchIndex + 1);
  } catch (error) {
    console.error("Erreur lors du chargement des matches:", error);
  }
}

// Sauvegarder les données des matches
function saveMatches() {
  localStorage.setItem("matches", JSON.stringify(matches));
  localStorage.setItem("currentMatch", currentMatchIndex + 1);
  localStorage.setItem("timeLeft", timeLeft);
  localStorage.setItem("running", running);
  window.dispatchEvent(new Event("storage")); // Notify other tabs

  saveMatchesToServer();
}

function formatTime(seconds) {
  const minutes = Math.floor(seconds / 60);
  const remainingSeconds = seconds % 60;
  return `${minutes.toString().padStart(2, "0")}:${remainingSeconds
    .toString()
    .padStart(2, "0")}`;
}

function updateTimer() {
  if (timeLeft > 0) {
    timeLeft--;
    document.getElementById("timer").textContent = formatTime(timeLeft);
    saveMatches();
  } else {
    clearInterval(timerInterval);
    running = false;
    document.getElementById("timerButton").textContent = "Démarrer";
    // Marquer le match comme joué
    matches[currentMatchIndex].played = true;
    matches[currentMatchIndex].score1 = parseInt(
      document.getElementById("score1").textContent
    );
    matches[currentMatchIndex].score2 = parseInt(
      document.getElementById("score2").textContent
    );
    saveMatches();
  }
}

function startTimer() {
  timerInterval = setInterval(updateTimer, 1000);
  document.getElementById("timerButton").textContent = "Pause";
  running = true;
  saveMatches();
}

function toggleTimer() {
  const button = document.getElementById("timerButton");
  if (running) {
    clearInterval(timerInterval);
    button.textContent = "Démarrer";
    running = false;
  } else {
    if (timeLeft > 0) {
      startTimer();
      button.textContent = "Pause";
      running = true;
    }
  }
  saveMatches();
}

function resetMatch() {
  clearInterval(timerInterval);
  timeLeft = 240;
  document.getElementById("timer").textContent = formatTime(timeLeft);
  document.getElementById("timerButton").textContent = "Démarrer";

  const currentMatch = matches[currentMatchIndex];

  // Ne réinitialise pas les scores, les conserver tels quels
  running = false;
  currentMatch.played = false;
  saveMatches();
}

function updateScore(team, change) {
  const scoreElement = document.getElementById(`score${team}`);
  let newScore = Math.max(0, parseInt(scoreElement.textContent) + change);
  scoreElement.textContent = newScore;
  matches[currentMatchIndex][`score${team}`] = newScore;
  saveMatches();
}

function displayCurrentMatch() {
  const match = matches[currentMatchIndex];
  document.getElementById("currentMatchNumber").textContent =
    currentMatchIndex + 1;
  document.getElementById("team1").textContent = match.team1;
  document.getElementById("team2").textContent = match.team2;

  // Toujours afficher les scores du match, même s'il a été joué
  document.getElementById("score1").textContent = match.score1;
  document.getElementById("score2").textContent = match.score2;

  document.getElementById("timer").textContent = formatTime(timeLeft);

  // Réinitialiser le timer si le match n'a pas été joué
  if (!match.played) {
    resetMatch();
  } else {
    timeLeft = 0;
    document.getElementById("timer").textContent = "00:00";
    document.getElementById("timerButton").textContent = "Terminé";
  }
}

function nextMatch() {
  if (currentMatchIndex < matches.length - 1) {
    currentMatchIndex++;
    displayCurrentMatch();
    saveMatches();
  } else {
    // Si on est au dernier match, vérifier et générer les quarts de finale
    generateQuarterFinalMatches();
  }
}

function previousMatch() {
  if (currentMatchIndex > 0) {
    currentMatchIndex--;
    displayCurrentMatch();
    saveMatches();
  }
}

async function saveMatchesToServer() {
  try {
    const response = await fetch("save_matches.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        matches: matches,
        currentMatch: currentMatchIndex + 1,
      }),
    });
    const result = await response.json();
    if (result.status === "success") {
      console.log("Matches sauvegardés avec succès");
    }
  } catch (error) {
    console.error("Erreur lors de la sauvegarde des matches:", error);
  }
}

// Synchroniser les données entre les onglets
window.addEventListener("storage", function (event) {
  if (
    event.key === "matches" ||
    event.key === "currentMatch" ||
    event.key === "timeLeft" ||
    event.key === "running"
  ) {
    const storedMatches = localStorage.getItem("matches");
    const storedCurrentMatch = localStorage.getItem("currentMatch");
    const storedTimeLeft = localStorage.getItem("timeLeft");
    const storedRunning = localStorage.getItem("running");
    if (storedMatches && storedCurrentMatch) {
      matches = JSON.parse(storedMatches);
      currentMatchIndex = parseInt(storedCurrentMatch) - 1;
      timeLeft = storedTimeLeft ? parseInt(storedTimeLeft) : 240;
      const wasRunning = running;
      running = storedRunning === "true";
      displayCurrentMatch();
      if (running && !wasRunning) {
        clearInterval(timerInterval);
        startTimer();
      } else if (!running && wasRunning) {
        clearInterval(timerInterval);
      }
    }
  }
});

// Fonction pour générer les matchs des quarts de finale
async function generateQuarterFinalMatches() {
  // Vérifier si tous les matchs ont été joués
  const allMatchesPlayed = matches.every((match) => match.played);

  if (allMatchesPlayed) {
    // Trier les équipes par leurs performances
    const teamPerformances = {};

    matches.forEach((match) => {
      // Calculer les points pour chaque équipe
      const updateTeamPoints = (team, score, opponentScore) => {
        if (!teamPerformances[team]) {
          teamPerformances[team] = {
            points: 0,
            goalsScored: 0,
            goalsConceded: 0,
          };
        }

        if (score > opponentScore) {
          teamPerformances[team].points += 3; // Victoire
        } else if (score === opponentScore) {
          teamPerformances[team].points += 1; // Égalité
        }

        teamPerformances[team].goalsScored += score;
        teamPerformances[team].goalsConceded += opponentScore;
      };

      updateTeamPoints(match.team1, match.score1, match.score2);
      updateTeamPoints(match.team2, match.score2, match.score1);
    });

    // Trier les équipes par points, puis par différence de buts
    const sortedTeams = Object.entries(teamPerformances)
      .sort((a, b) => {
        if (b[1].points !== a[1].points) {
          return b[1].points - a[1].points;
        }
        return (
          b[1].goalsScored -
          b[1].goalsConceded -
          (a[1].goalsScored - a[1].goalsConceded)
        );
      })
      .slice(0, 4)
      .map((entry) => entry[0]);

    // Créer les matchs des quarts de finale
    const quarterFinalMatches = [
      {
        id: 1,
        team1: sortedTeams[0],
        team2: sortedTeams[3],
        score1: 0,
        score2: 0,
        played: false,
      },
      {
        id: 2,
        team1: sortedTeams[1],
        team2: sortedTeams[2],
        score1: 0,
        score2: 0,
        played: false,
      },
    ];

    // Sauvegarder les matchs des quarts de finale dans un nouveau fichier
    try {
      const response = await fetch("save_quarter_finals.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          matches: quarterFinalMatches,
          currentMatch: 1,
        }),
      });

      const result = await response.json();
      if (result.status === "success") {
        console.log("Matchs des quarts de finale générés avec succès");
        // Optionnel : afficher une notification à l'utilisateur
        alert("Les matchs des quarts de finale ont été générés !");
      }
    } catch (error) {
      console.error(
        "Erreur lors de la génération des quarts de finale:",
        error
      );
    }
  }
}

// Charger les matches au démarrage
window.addEventListener("load", loadMatches);
