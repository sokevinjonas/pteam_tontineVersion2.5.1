@extends('layout')
@section('title', 'MES TONTINES')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center justify-content-xs-center justify-content-lg-end">
            <div class="col-sm-6 col-md-4 text-center">
                @include('tontine.create')
            </div>
        </div>
        <div class="row mt-5">
            @forelse($tontines as $tontine)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('tontine.show', ['tontine'=>$tontine->id]) }}" class="text-decoration-none">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <div class="d-flex justify-content-between ">
                                    <h4 class="text-start">{{ $tontine->name }} </h4> 
                                    {{-- <a href="" style="text-decoration: none"> --}}
                                    {{-- </a> --}}
                                </div>
                                <h5 class="text-start">Participants: {{ $tontine->number_of_members }}</h5>
                                <h5 class="text-start">Participations : {{ $tontine->amount_payer }}fcfa</h5>
                            </div>
                            <div class="icon">
                                {{-- <i class="fas fa-delete"></i> --}}
                            </div>
                        </div>
                    </a>
                </div>
                @empty 
                    <h5 class="alert alert-info text-center">Aucune Tontine disponibles !</h5>
            @endforelse
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('script/montant.js') }}"></script>
    <script defer src="{{ asset('script/js-date.js') }}"></script>
    <script>
        document.getElementById('tontine-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche la soumission du formulaire par défaut

            // Récupérez les données du formulaire
            const formData = new FormData(this);

            // Effectuez la requête AJAX
            fetch('{{ route('tontine.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Traitez la réponse du serveur ici si nécessaire
                    console.log(data);
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
        });
    </script>
@endsection
