<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITRE -->
    <title>Administration du Classement</title>
    
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
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Roboto", sans-serif;
        min-height: 100vh;
       
        display: flex;
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
        width: 100%;
        max-width: 1200px;
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

      input {
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: white;
        text-align: center;
        padding: 0.5rem;
        border-radius: 5px;
      }

      .calculate-button ,.add-button {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        margin: 1rem 0.5rem;
        border-radius: 20px;
        font-family: "Orbitron", sans-serif;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.3s ease;
      }

      .calculate-button:hover ,.add-button:hover  {
        background: rgba(255, 255, 255, 0.2);
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="match-header">
        <h1 class="match-title">Admin Classement</h1>
      </div>

      <table id="classementTable">
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
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="classementBody">
          <!-- Les lignes seront générées dynamiquement -->
        </tbody>
      </table>

      <div style="text-align: center">
        <button class="add-button" onclick="ajouterLigne()">Ajouter un Club</button>
        <button class="calculate-button" onclick="calculerClassement()">Calculer Classement</button>
      </div>
    </div>

    <script>
      // Charger le classement depuis localStorage
      function chargerClassement() {
        const classement = JSON.parse(
          localStorage.getItem("classement") || "[]"
        );
        const tbody = document.getElementById("classementBody");
        tbody.innerHTML = "";

        classement.forEach((club) => {
          const ligne = document.createElement("tr");
          ligne.innerHTML = `
                    <td><input type="text" value="${
                      club.club || ""
                    }" class="club" placeholder="Nom du club"></td>
                    <td><input type="number" value="${
                      club.mj || 0
                    }" class="mj" min="0"></td>
                    <td><input type="number" value="${
                      club.g || 0
                    }" class="g" min="0"></td>
                    <td><input type="number" value="${
                      club.n || 0
                    }" class="n" min="0"></td>
                    <td><input type="number" value="${
                      club.p || 0
                    }" class="p" min="0"></td>
                    <td><input type="number" value="${
                      club.bp || 0
                    }" class="bp" min="0"></td>
                    <td><input type="number" value="${
                      club.bc || 0
                    }" class="bc" min="0"></td>
                    <td><input type="number" value="${
                      club.db || 0
                    }" class="db"></td>
                    <td><input type="number" value="${
                      club.pts || 0
                    }" class="pts" min="0"></td>
                    <td><button onclick="supprimerLigne(this)">Supprimer</button></td>
                `;
          tbody.appendChild(ligne);
        });
      }

      // Ajouter une nouvelle ligne
      function ajouterLigne() {
        const tbody = document.getElementById("classementBody");
        const ligne = document.createElement("tr");
        ligne.innerHTML = `
                <td><input type="text" class="club" placeholder="Nom du club"></td>
                <td><input type="number" value="0" class="mj" min="0"></td>
                <td><input type="number" value="0" class="g" min="0"></td>
                <td><input type="number" value="0" class="n" min="0"></td>
                <td><input type="number" value="0" class="p" min="0"></td>
                <td><input type="number" value="0" class="bp" min="0"></td>
                <td><input type="number" value="0" class="bc" min="0"></td>
                <td><input type="number" value="0" class="db"></td>
                <td><input type="number" value="0" class="pts" min="0"></td>
                <td><button onclick="supprimerLigne(this)">Supprimer</button></td>
            `;
        tbody.appendChild(ligne);
        sauvegarderClassement();
      }

      // Supprimer une ligne
      function supprimerLigne(bouton) {
        const ligne = bouton.closest("tr");
        ligne.remove();
        sauvegarderClassement();
      }

      // Sauvegarder le classement
      function sauvegarderClassement() {
        const lignes = document.querySelectorAll("#classementBody tr");
        const classement = Array.from(lignes).map((ligne) => ({
          club: ligne.querySelector(".club").value,
          mj: parseInt(ligne.querySelector(".mj").value),
          g: parseInt(ligne.querySelector(".g").value),
          n: parseInt(ligne.querySelector(".n").value),
          p: parseInt(ligne.querySelector(".p").value),
          bp: parseInt(ligne.querySelector(".bp").value),
          bc: parseInt(ligne.querySelector(".bc").value),
          db: parseInt(ligne.querySelector(".db").value),
          pts: parseInt(ligne.querySelector(".pts").value),
        }));

        localStorage.setItem("classement", JSON.stringify(classement));

        // Déclencher l'événement de mise à jour pour la page de classement
        window.dispatchEvent(new Event("classementUpdated"));
      }

      // Calculer le classement automatiquement
      function calculerClassement() {
        const lignes = document.querySelectorAll("#classementBody tr");
        const classement = Array.from(lignes).map((ligne) => {
          const mj = parseInt(ligne.querySelector(".mj").value);
          const g = parseInt(ligne.querySelector(".g").value);
          const n = parseInt(ligne.querySelector(".n").value);
          const p = parseInt(ligne.querySelector(".p").value);
          const bp = parseInt(ligne.querySelector(".bp").value);
          const bc = parseInt(ligne.querySelector(".bc").value);

          // Calcul automatique des points et différence de buts
          const pts = g * 3 + n;
          const db = bp - bc;

          return {
            club: ligne.querySelector(".club").value,
            mj: mj,
            g: g,
            n: n,
            p: p,
            bp: bp,
            bc: bc,
            db: db,
            pts: pts,
          };
        });

        // Trier par points (descendant), puis par différence de buts
        const classementTrie = classement.sort((a, b) => {
          if (b.pts !== a.pts) return b.pts - a.pts;
          return b.db - a.db;
        });

        // Mettre à jour les valeurs dans le tableau
        const tbody = document.getElementById("classementBody");
        tbody.innerHTML = "";
        classementTrie.forEach((club) => {
          const ligne = document.createElement("tr");
          ligne.innerHTML = `
                    <td><input type="text" value="${club.club}" class="club" placeholder="Nom du club"></td>
                    <td><input type="number" value="${club.mj}" class="mj" min="0"></td>
                    <td><input type="number" value="${club.g}" class="g" min="0"></td>
                    <td><input type="number" value="${club.n}" class="n" min="0"></td>
                    <td><input type="number" value="${club.p}" class="p" min="0"></td>
                    <td><input type="number" value="${club.bp}" class="bp" min="0"></td>
                    <td><input type="number" value="${club.bc}" class="bc" min="0"></td>
                    <td><input type="number" value="${club.db}" class="db"></td>
                    <td><input type="number" value="${club.pts}" class="pts" min="0"></td>
                    <td><button onclick="supprimerLigne(this)">Supprimer</button></td>
                `;
          tbody.appendChild(ligne);
        });

        // Sauvegarder le classement calculé
        localStorage.setItem("classement", JSON.stringify(classementTrie));

        // Déclencher l'événement de mise à jour pour la page de classement
        window.dispatchEvent(new Event("classementUpdated"));

        alert("Classement calculé et sauvegardé !");
      }

      // Ajouter des écouteurs d'événements pour les modifications
      document
        .getElementById("classementBody")
        .addEventListener("change", sauvegarderClassement);

      // Charger le classement au chargement de la page
      document.addEventListener("DOMContentLoaded", chargerClassement);
    </script>
  </body>
</html>
