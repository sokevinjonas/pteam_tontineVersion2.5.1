<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nouveau Participation(s)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('tontine.addParticipant', $tontine) }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom:</label>
                                <input type="text" class="form-control" name="last_name" id="exampleInputEmail1"
                                    placeholder="Entrer un prenom" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Prenom (s) :</label>
                                <input type="text" class="form-control" name="first_name" id="exampleInputPassword1"
                                    placeholder="Entrer un prenom" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputFile1"> CNIB Recto
                                </label>
                                <input class="form-control" type="file" name="identity_document_front"
                                    id="exampleInputFile1" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputFile1"> CNIB Verso</label>
                                <input class="form-control" type="file" name="identity_document_back"
                                    id="exampleInputFile1" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de bras (Nombre de place occupé)</label>
                                <input type="number" name="nombre_bras" class="form-control" id="exampleInputEmail1"
                                     value="1" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Téléphone</label>
                                <input type="number" name="phone_number" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter le tel" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="reset" class="btn btn-default">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistré</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>