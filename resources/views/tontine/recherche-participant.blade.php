<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
    Ajouter un nouveau
</button>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rechercher Participation(s)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="searchText">Recherche Participant:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nom ou prénom"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2" id="searchText">
                                {{-- <div class="input-group-append">
                                    <button class="btn btn-success" type="button">Rechercher</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="searchResults">Résultats de la recherche:</label>
                    <input type="text" class="form-control" id="searchResults" readonly>
                </div>
                <table class="table" id="resultsTable">
                    <thead>
                        <tr>
                            <th>Nom (s)</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
