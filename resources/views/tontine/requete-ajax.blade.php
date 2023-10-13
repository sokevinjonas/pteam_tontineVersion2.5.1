   <script>
       $(document).ready(function() {
           // var csrfToken = $('meta[name="csrf-token"]').attr('content');
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           $('#searchText').on('input', function() {
               var term = $(this).val();

               // Vérifiez si le terme de recherche est vide
               if (term.trim() === '') {
                   // Le terme de recherche est vide, donc ne faites pas de requête AJAX
                   // ou videz la liste des participants si vous voulez le faire côté client
                   var tbody = $('#resultsTable tbody');
                   tbody.empty();
                   var searchResultsInput = $('#searchResults');
                   searchResultsInput.val('Aucun résultat trouvé');
                   return; // Sortez de la fonction
               }

               $.ajax({
                   url: '{{ route('tontine.rechercheParticipant') }}',
                   type: 'POST',
                   data: {
                       term: term,
                       // '_token': csrfToken
                   },
                   success: function(response) {
                       var tbody = $('#resultsTable tbody');
                       tbody.empty();

                       response.resultats.forEach(function(participant) {
                           var row = `<tr>
                       <td>${participant.last_name} ${participant.first_name}</td>
                       <td>${participant.phone_number}</td>
                       <td><button type="button" class="btn btn-success" data-user-id="${participant.id}">Ajouter</button></td>
                   </tr>`;
                           tbody.append(row);
                       });

                       $('body').on('click', '.btn-success', function() {
                           var userId = $(this).data('user-id');
                           var tontineId = $('#tontineId').data('id');
                           $(this).attr('disabled', 'disabled');

                           $.ajax({
                               url: '{{ route('tontine.ajaxnewParticipant') }}',
                               type: 'POST',
                               data: {
                                   user_id: userId,
                                   tontine_id: tontineId, // Envoyez l'ID de la tontine dans la requête AJAX
                                   // _token: '{{ csrf_token() }}'
                               },
                               success: function(response) {
                                //    if (response.msg) {
                                //        swal("Succès!", response.message,
                                //            "success");
                                //    } else {
                                //        swal("Erreur!", response.message,
                                //            "error");
                                //    }
                                //    console.log(response.message);

                                   // Rechargez la page automatiquement après avoir traité la réponse
                                   location.reload(true);
                               },

                           });
                       });

                       var searchResultsInput = $('#searchResults');
                       searchResultsInput.val(response.resultats.length +
                           ' résultat(s) trouvé(s)');
                   }
               });
           });

           // requte pour gerer cotisation 
           $('.cotiser-btn').on('click', function() {
               // Récupérez l'ID de la participation à partir de l'attribut de données
               var participationId = $(this).data('participation-id');

               // Envoyez une requête AJAX au serveur
               $.ajax({
                   url: '/cotiser/{participation}',
                   type: 'POST', // Ou 'GET', en fonction de votre logique Laravel
                   dataType: 'json',
                   success: function(data) {
                       // Mettez à jour l'interface utilisateur si nécessaire
                       console.log(data);
                   },
                   error: function(error) {
                       // Gérez les erreurs si nécessaire
                       console.error(error);
                   }
               });
           });
       });
   </script>
