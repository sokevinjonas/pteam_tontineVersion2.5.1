@extends('layout')
@section('title', 'Tontine')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Widget: user widget style 2 -->
        <div class="row">
            <div class="col">
                <div class="widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-secondary">
                        <h2 class="widget-user-username">{{ $tontine->name }}</h2>
                        <h5 class="widget-user-desc">Créé le {{ $tontine->created_at->isoFormat('Do MMMM YYYY') }}</h5>
                        <button class="text-danger">Status : {{ $tontine->status }}</button>
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
            <div class="row justify-content-center align-items-center d-flex">
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <h1>Liste des Participants</h1>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5 text-end mt-2">
                    @if (!$tontine->isFull())
                        @include('tontine.recherche-participant')
                    @else
                        @unless ($tontine->isStart())
                            <form action="{{ route('tontine.start', $tontine) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Lancer la tontine
                                </button>
                            </form>
                        @endunless
                    @endif
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    <div class="row">
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
                            {{-- {{dd($tontine,$tontine->participation,$tontine->number_of_members)}} --}}
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
    </div>

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    @include('tontine.requete-ajax')
@endsection
