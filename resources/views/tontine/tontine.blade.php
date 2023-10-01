@extends('layout')
@section('title', 'MES TONTINES')

@section('css')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-md-center justify-content-xs-center justify-content-lg-end">
            <div class="col-sm-6 col-md-4 text-center">
                @include('tontine.create')
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($tontines as $tontine)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <a href="{{ route('tontine.show', $tontine->id) }}" class="text-decoration-none">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{ $tontine->name }}</h4>
                                <h5>Participants: {{ $tontine->number_of_members }}</h5>
                                <b>Participations : {{ $tontine->amount_payer }}fcfa</b>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
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
