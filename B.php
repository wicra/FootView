
    <script>
        function triggerClickOnPageA() {
            // Déclencher l'événement dans le localStorage
            localStorage.setItem('simulate_click', 'true');
            alert("Le bouton sera cliqué sur la Page A !");
        }
    </script>

    <!-- Bouton pour déclencher le clic sur Page A -->
    <button onclick="triggerClickOnPageA()">un clic sur Page A</button>

