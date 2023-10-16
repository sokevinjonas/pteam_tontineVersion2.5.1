
        $(document).ready(function() {
            // Désactiver le bouton "Enregistrer" par défaut
            $('#save-button').prop('disabled', true);

            // Écouter les événements de saisie dans les champs requis
            $('.required-field').on('input', function() {
                // Vérifier si tous les champs requis (sauf Description) sont remplis ou saisis
                var allFieldsFilled = true;

                $('.required-field').each(function() {
                    if ($(this).val().trim() === '') {
                        allFieldsFilled = false;
                        return false; // Sortir de la boucle each si un champ est vide
                    }
                });

                // Activer ou désactiver le bouton "Enregistrer" en fonction de l'état des champs
                $('#save-button').prop('disabled', !allFieldsFilled);
            });
            // Récupère les éléments d'entrée
            const number_of_members = document.getElementById('number_of_members');
            // Génère les options du menu déroulant avec JavaScript
            for (let i = 1; i <= 10; i += 1) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                number_of_members.appendChild(option);
            }
            // Récupère les éléments d'entrée
            const profitSelect = document.getElementById('profit');
            // Génère les options du menu déroulant avec JavaScript
            for (let i = 1; i <= 5; i += 0.5) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i + '%';
                profitSelect.appendChild(option);
            }

            const amountInput = document.getElementById('amountInput');
            const amountOutput = document.getElementById('amountOutput');
            // Désactive #amountInput par défaut
            amountInput.disabled = true;
            // Désactive #amountInput lorsque #profit est vide
            profitSelect.addEventListener('input', function() {
                if (profitSelect.value === '') {
                    amountInput.disabled = true;
                } else {
                    amountInput.disabled = false;
                }
            });

            // Ajoute un écouteur d'événements pour le changement de la valeur d'entrée de #amountInput
            amountInput.addEventListener('input', function() {
                // Vérifie si #amountInput est vide
                if (amountInput.value === '') {
                    amountOutput.value = '0';
                } else {
                    // Récupère la valeur saisie dans le champ montant
                    const montant = parseFloat(amountInput.value);

                    // Récupère le pourcentage sélectionné dans le champ profit
                    const profitPercentage = parseFloat(profitSelect.value);

                    // Vérifie si le pourcentage est un nombre valide
                    if (!isNaN(profitPercentage)) {
                        // Calcule le montant à payer en ajoutant le profit au montant initial
                        const montantAPayer = montant + (montant * (profitPercentage / 100));

                        // Convertit le montant à payer en nombre entier (arrondi)
                        const montantAPayerEntier = Math.round(montantAPayer);

                        // Affiche le montant à payer dans le champ Montant à Payer
                        amountOutput.value = montantAPayerEntier
                            .toString(); // Convertit en chaîne de caractères avant de l'assigner
                    } else {
                        // Si le pourcentage n'est pas un nombre valide, affiche un message d'erreur ou une valeur par défaut
                        amountOutput.value = 0;
                    }
                }
            });
        });