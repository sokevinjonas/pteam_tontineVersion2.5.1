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

<div class="modal fade" id="modal-cotiser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payer ma cotisation </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="text-center">Veuillez selectionnez une periode pour payer</span>
            <div class="modal-body">
                <div class="row">
                    @foreach ($prises as $date)
                            <div class="card">
                                <div class="card-body text-start d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-column align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-x-octagon-fill me-2" viewBox="0 0 16 16">
                                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                        </svg>
                                        <span class="mb-2">Preneur: So kevin</span>
                                    </div>
                                        <span class="text-warning">{{ $date }}</span>
                                    <div class="d-flex flex-column align-items-end">
                                        <a href="#" class="btn btn-danger" style="border-radius: 10px">Non payer</a>
                                    </div>
                                </div>
                            </div>                            
                    @endforeach
                    <p>Veuillez selectionnez une periode pour payer</p>
                </div>
            </div>                
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
