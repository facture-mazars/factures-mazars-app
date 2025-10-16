
    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionne le formulaire
        const form = document.querySelector('form');

        // Ajoute un écouteur d'événements pour les touches appuyées dans le formulaire
        form.addEventListener('keydown', function(event) {
            // Vérifie si la touche pressée est "Entrée" (code 13)
            if (event.key === 'Enter') {
                // Empêche l'action par défaut (soumission du formulaire)
                event.preventDefault();
            }
        });
    });
