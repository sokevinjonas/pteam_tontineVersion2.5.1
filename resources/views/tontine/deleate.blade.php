<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nouvelle tontine</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> 
            <form id="" action="{{route('tontine.destroy')}}" method="POST">
                @csrf

                <div class="row row-cols-2">
                <div class="col mb-2">
                    <input name="name" type="text" placeholder="nom" class="form-control">
                </div>
             </div>
             <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </div>
        </form>    
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->