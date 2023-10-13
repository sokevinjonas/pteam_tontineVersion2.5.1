@extends('layout')
@section('title', 'MES PARTICIPANTS')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center justify-content-xs-center justify-content-lg-end">
            <div class="col-sm-6 col-md-4 text-center">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Ajouter un nouveau participant
                </button>
                @include('user.create')
            </div>
        </div>
        <div class="row mt-3">
            <!-- Profile Image -->
            @forelse ($users as $user)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                    <div class="card" style="background: chartreuse; color: #050303">
                        <div class="card-body d-flex flex-column justify-content-between align-items-center">
                            <div class="text-center mb-3">
                                <b class="profile-username mb-1" style="font-size: 16px">Nom (s): {{ $user->last_name . ' ' . $user->first_name }}
                                </b> <br>
                                <strong class="text-muted">Tel: {{ $user->phone_number }}</strong>
                                <h6 class="text-muted">Tontines:<span style="color: red"> {{ $user->participants->count() }}</h6>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary btn-sm"><b>Voir</b></a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            @empty
                <div class="card">
                    <h2 class="text-center text-warning">Aucun utilisateur (s)</h2>
                </div>
            @endforelse
            <!-- /.card -->
        </div>
    </div>
    <!-- Vérifiez s'il y a un message SweetAlert dans la session -->

    @include('user.create')
@endsection

@section('script')
    {{-- @if (session('sweet_alert'))
        <script>
            Swal.fire({
                icon: '{{ session('sweet_alert.icon') }}',
                title: '{{ session('sweet_alert.title') }}',
                text: '{{ session('sweet_alert.text') }}',
            });
        </script>
    @endif --}}
@endsection
