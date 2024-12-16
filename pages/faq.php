<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/5563162149.js" crossorigin="anonymous"></script>
    <title>Car Showcase - Faq</title>
</head>
<body class="faqpage">
       <!-- Header -->
       <?php include '../pages/struct/header.php'; ?>

         <!-- Section FAQ -->
          <section class="faq">
            <div class="container">
                <div class="zoneTitre">
                    <h1>FAQ</h1>
                    <div class="line"></div>
                    <p>
                    Les questions les plus fréquemment posées.
                    </p>
                </div>
                <div class="questions-container">
                    <div class="question">
                        <button id="questionButton">
                            <em>Quelles sont les exigences générales pour la location d'une voiture?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            Les exigences générales pour la location d'une voiture comprennent un numéro de téléphone valide, une carte d'identité valide et
                            Age minimum de 18 ans.
                        </p>
                    </div>
                    <div class="question">
                        <button id="questionButton">
                        <em>Puis-je annuler ma commande après qu'elle ait été vérifiée?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            Désolé, c'est dommage, vous ne pouvez pas annuler votre commande après la vérification de la commande.
                        </p>
                    </div>
                    <div class="question">
                        <button id="questionButton">
                        <em>Quelles méthodes de paiements sont disponibles?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            Lorsque votre commande a été vérifiée, vous pouvez d'abord effectuer des paiements à travers
                            transfert bancaire au numéro de compte qui a été répertorié.
                        </p>
                    </div>
                    <div class="question">
                        <button id="questionButton">
                        <em> Y a-t-il des frais supplémentaires que je dois payer autres que le prix de location?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            Oui, il y a des frais supplémentaires que vous devrez peut-être payer, comme les frais de dommage et les frais
                            de retour en retard.
                        </p>
                    </div>
                    <div class="question">
                        <button id="questionButton">
                        <em>Y a-t-il une limite de temps pour la location de voitures?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            Le temps de location de voiture a un tarif quotidien, calculé à partir du jour où la voiture vous est remise.
                        </p>
                    </div>
                    <div class="question">
                        <button id="questionButton">
                        <em>Quelle est la procédure de prise et de retour de la voiture?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            1. Vous devez commander la voiture que vous souhaitez louer en premier via la demande <br>
                            2. Une fois la commande vérifiée, rendez-vous sur le lieu de location avec les documents requis
                            et signer le contrat de location.<br>
                            3. Après avoir rencontré notre équipe, vous pouvez apporter la voiture qui a été commandée. <br>
                            4. Lorsque vous retournez, vous retournerez la voiture à l'emplacement de location.À votre retour,
                            nous vérifierons l'état de la voiture et la durée du retour.S'il y a un retard ou
                            Dommages à la voiture, vous devez alors payer des frais supplémentaires.
                        </p>
                    </div>
                    <div class="question">
                        <button id="questionButton">
                        <em>Dois-je faire le plein de mon propre carburant?</em>
                            <i class="fas fa-chevron-down d-arrow"></i>
                        </button>
                        <p>
                            Oui, nous nous attendons à ce que vous remplissiez votre propre carburant avant de retourner la voiture.S'assurer
                            de retourner la voiture avec le même niveau de carburant que lorsque vous l'acceptez.
                        </p>
                    </div>
                </div>
            </div>
          </section>

          
    <!-- Footer -->
    <?php include '../pages/struct/footer.php'; ?>

    <script>
        const buttons = document.querySelectorAll("#questionButton");
        buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const faq = button.nextElementSibling;
    const icon = button.children[1];

    faq.classList.toggle("show");
    icon.classList.toggle("rotate");
  });
});
    </script>
</html>
    
</body>
</html>