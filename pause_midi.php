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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Roboto", sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
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
            0%, 100% { text-shadow: 0 0 5px rgba(0, 191, 255, 0.5); }
            50% { text-shadow: 0 0 20px rgba(0, 191, 255, 0.8); }
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
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 3rem;
            position: relative;
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
            font-size: 2.4rem;
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
            font-family: "Orbitron", sans-serif;
            color: #00ff00;
            text-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
        }

        .loader {
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signature {
            position: fixed;
            z-index: 20;
            bottom: 2%;
            right: 2%;
            font-family: "Orbitron", sans-serif;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        @media (max-width: 768px) {
            .match-title {
                font-size: 2.5rem;
            }
            .team-name {
                font-size: 1.8rem;
            }
            .team-score {
                font-size: 4rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="match-header">
            <div class="match-number">Pause Midi</div>
            <h1 class="match-title">Reprise à 13h30</h1>
        </div>

        <div class="match-content">
            <div class="team">
                <div class="loader">
                    <div class="panWrapper">
                        <div class="pan">
                            <div class="food"></div>
                            <div class="panBase"></div>
                            <div class="panHandle"></div>
                        </div>
                        <div class="panShadow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="signature">Organisation B2CIEL 23-25</h4>

    <style>
        /* Styles de l'animation de base conservés */
        .panWrapper {
            width: 200px;
            height: fit-content;
            position: relative;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            flex-direction: column;
            gap: 20px;
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
            width: 40%;
            height: 6px;
            background: linear-gradient(to bottom, rgb(82, 33, 33), rgb(200, 106, 106));
            left: 10px;
            border-radius: 50%;
            animation: flip 1.7s infinite;
            z-index: 2;
        }
        @keyframes flip {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-100px) rotate(180deg); }
            100% { transform: translateY(0px) rotate(360deg); }
        }
        .panBase {
            z-index: 3;
            width: 50%;
            height: 22px;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            background: linear-gradient(to top, rgb(3, 156, 156), rgb(10, 191, 191));
        }
        .panHandle {
            width: 40%;
            background: linear-gradient(to bottom, rgb(18, 18, 18), rgb(74, 74, 74));
            height: 10px;
            border-radius: 10px;
        }
        .panShadow {
            width: 70px;
            height: 8px;
            background-color: rgba(0, 0, 0, 0.21);
            margin-left: 15px;
            border-radius: 10px;
            animation: shadow 1.7s infinite;
            filter: blur(5px);
        }
        @keyframes shadow {
            0% { transform: scaleX(0.7); }
            50% { transform: scaleX(1); }
            100% { transform: scaleX(0.7); }
        }
    </style>
</body>
</html>