@extends('layout')
@section('title', 'Tontine')
@section('css')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@endsection
@section('content')
<div class="container-fluid">
    <!-- Widget: user widget style 2 -->
    <div class="row">
        <div class="col">
                <a href="{{route('tontine.index')}}" class="btn btn-primary mb-4">Retour</a>
                <div class="widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-secondary">
                        <h2 class="widget-user-username">{{ $tontine->name }}</h2>
                        <h5 class="widget-user-desc">Créé le {{ $tontine->created_at->isoFormat('Do MMMM YYYY') }}</h5>
                        @if ($tontine->status == 'inactif')
                        <button class="btn btn-danger">Pas lancé</button>
                        @else
                        <button class="btn btn-success">En cours</button>
                        @endif
                    </div>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="" class="nav-link text-secondary">
                                Debute le <span
                                    class="float-right badge bg-primary">{{ $tontine->date_debut->isoFormat('Do MMMM YYYY') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-secondary">
                                Cotisation <span class="float-right badge bg-info">{{ $tontine->amount_payer }} FCFA</span>
                            </a>
                        </li>
                        <div hidden id="tontineId" data-id="{{ $tontine->id }}"></div>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-secondary">
                                Adhérants <span
                                    class="float-right badge bg-danger">{{ $tontine->currentMembersNumber() }}/{{ $tontine->number_of_members }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-secondary">
                                Période <span class="float-right badge bg-danger"> Chaque
                                    {{ $tontine->delay . ' ' . $tontine->periode }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-secondary">
                                Date de Fin <span class="float-right badge bg-info">{{ $tontine->date_fin }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /.widget-user -->
    <div class="container-fluid">
        {{-- <marquee behavior="left" direction="right"><b>La prochain prise est le <span class="text-warning">
                {{$dateSuivante}}</span></b></marquee> --}}
        <div class="row justify-content-center align-items-center d-flex mt-5">
            <div class="d-flex justify-content-between align-items-center col-sm-12 col-md-12 col-lg-5 text-end mt-2">
                <a href="$" class="btn btn-primary">
                    Modifier
                </a>
                <a href="" class="btn btn-warning cotiser-btn" data-toggle="modal"
                    data-target="#modal-cotiser">Cotisations</a>
                @if (!$tontine->isFull())
                    <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                        Ajouter
                    </button>
                    @include('tontine.ajout-participant')
                @else
                    @unless ($tontine->isStart())
                        <form action="{{ route('tontine.start', $tontine) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Commencé la tontine
                            </button>
                        </form>
                    @endunless
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            @forelse ($participation as $t)
            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="card bg-info mb-3" style="max-width: 25rem;">
                    <div class=" btn btn-warning">Rang: {{ $t->rank }}</div>
                    <div class="card-body">
                        <h5 class="card-text text-start">{{ $t->user->last_name . ' ' . $t->user->first_name }}</h5>
                        <p class="card-text">Tél: {{ $t->user->phone_number }}</p>
                        <p class="card-text">Prise : <span class="text-warning">Non</span></p>
                        <p class="card-text">Nombre cotisation : <span class="text">0/{{ $tontine->number_of_members }}</span></p>
                        <a href="#" class="btn btn-danger">Cotiser</a>
                    </div>
                </div>
            </div>                       
            @empty
                <h1 class="text-center">Aucun participants</h1>
            @endforelse
        </div>
    </div>
    {{-- <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table id="example1" class="table responsive ">
                            <thead>
                                <tr>
                                    <th>Nom (s)</th>
                                    <th>Bras</th>
                                    <th>Rang</th>
                                    <th>Cotisation</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tontine->participation as $participation)
                                    <tr>
                                        <td>
                                            <a
                                                href="">{{ $participation->user->last_name . ' ' . $participation->user->first_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">{{ $participation->nombre_bras }}
                                            </a>
                                        </td>
                                        <td> {{ $participation->rank }} </td>
                                        <td> {{ $participation->cotisations->count() }}
                                            / {{ $tontine->number_of_members }}
                                        <td>
                                            <a href="" class="btn btn-warning cotiser-btn" data-toggle="modal" data-target="#modal-cotiser">Cotiser</a>
                                            <a href="" class="btn btn-success cotiser-btn">Prise</a>
                                        </td>
                                    </tr>
                                @empty
                                    <b class="text-warning">Aucun participant n'a été ajouté </b>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.col -->
            </div> --}}
    <div class="modal fade" id="modal-cotiser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Liste des Preneurs</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <span class="text-center">Veuillez selectionnez une periode pour payer</span> --}}
                <div class="modal-body">
                    <div class="row">
                        @foreach ($prises as $key => $date)
                            @if (isset($participation[$key]))
                                <div class="card">
                                    <div class="card-body text-start d-flex align-items-center justify-content-between">
                                        <div class="d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                fill="red" class="bi bi-x-octagon-fill me-2" viewBox="0 0 16 16">
                                                <!-- ... Le reste du code SVG ... -->
                                            </svg>
                                            <span class="mb-2">Preneur:
                                                {{ $participation[$key]->user->last_name . ' ' . $participation[$key]->user->first_name }}</span>
                                        </div>
                                        <span class="text-warning">{{ $date }}</span>
                                        <div class="d-flex flex-column align-items-end">
                                            <a href="#" class="btn btn-danger" style="border-radius: 10px">Pas encore pris</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Gérer le cas où il n'y a pas assez de participants pour toutes les prises -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    @include('tontine.requete-ajax')
@endsection
