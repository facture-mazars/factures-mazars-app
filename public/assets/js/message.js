
    // Masquer le message de succès après 8 secondes (8000 millisecondes)
    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 3000); // 8 secondes
        }
    });
