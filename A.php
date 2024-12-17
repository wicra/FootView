
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

    <!-- Bouton qui peut être cliqué automatiquement -->
    <button id="monBouton" onclick='window.location.href="loading.php";'>
        Cliquez-moi
    </button>
</body>
</html>
