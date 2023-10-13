
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner les éléments du formulaire
        const numberOfMembersInput = document.getElementById('number_of_members');
        const delayInput = document.getElementById('delay');
        const periodeInput = document.getElementById('periode');
        const dateDebutInput = document.getElementById('date_debut');
        const dateFinInput = document.getElementById('date_fin');

        // Ajouter un écouteur d'événement pour le changement des champs de formulaire
        numberOfMembersInput.addEventListener('change', calculateEndDate);
        delayInput.addEventListener('input', calculateEndDate);
        periodeInput.addEventListener('change', calculateEndDate);
        dateDebutInput.addEventListener('change', calculateEndDate);

        // Fonction pour calculer la date de fin
        function calculateEndDate() {
            const numberOfMembers = parseInt(numberOfMembersInput.value);
            const delay = parseInt(delayInput.value);
            const periode = periodeInput.value;
            const dateDebut = new Date(dateDebutInput.value);
            const millisecondsInDay = 24 * 60 * 60 * 1000;

            let totalDays = 0;

if (periode === 'day') {
    totalDays = numberOfMembers * delay;
} else if (periode === 'week') {
    totalDays = numberOfMembers * 7 * delay;
} else if (periode === 'month') {
    const currentMonth = dateDebut.getMonth(); // Mois de la date de début (0-indexed)
    const currentYear = dateDebut.getFullYear();
    
    // Calculer le dernier jour du mois de la date de début
    const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    
    // Nombre de jours restants dans le mois de la date de début
    const remainingDaysInMonth = lastDayOfMonth - dateDebut.getDate();
    
    // Calculer le nombre total de jours dans les mois suivants
    const totalDaysInNextMonths = (numberOfMembers - 1) * delay;

    // Si le nombre de membres est supérieur aux jours restants dans le mois,
    // ajouter les jours restants dans le mois de la date de début et calculer les mois suivants
    if (totalDaysInNextMonths > remainingDaysInMonth) {
        totalDays = remainingDaysInMonth + totalDaysInNextMonths;
    } else {
        totalDays = remainingDaysInMonth;
    }

} else if (periode === 'year') {
    const currentYear = dateDebut.getFullYear();
    
    // Vérifier si l'année de début est bissextile
    const isLeapYear = (currentYear % 400 === 0) || ((currentYear % 4 === 0) && (currentYear % 100 !== 0));
    
    // Nombre de jours dans une année (365 ou 366 pour une année bissextile)
    const daysInYear = isLeapYear ? 366 : 365;
    
    // Calculer le nombre de jours pour le nombre de membres et le délai spécifié
    totalDays = numberOfMembers * delay * daysInYear;
}
            const dateFin = new Date(dateDebut.getTime() + totalDays * millisecondsInDay);
            const formattedDateFin =
                `${dateFin.getFullYear()}-${(dateFin.getMonth() + 1).toString().padStart(2, '0')}-${dateFin.getDate().toString().padStart(2, '0')}`;

            dateFinInput.value = formattedDateFin;
        }
        calculateEndDate();

    });
