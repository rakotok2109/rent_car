// Assurez-vous que ce code s'exécute après que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded');
    console.log(errorElementId)
    if (typeof errorElementId !== 'undefined') {
       
        var element = document.getElementById(errorElementId);
        if (element) {
            element.classList.add('input-erreur'); // Remplacez 'error-class' par la classe que vous souhaitez ajouter
        }
    }
});