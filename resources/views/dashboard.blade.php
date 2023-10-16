@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-6 col-12 col-lg-6">
                <a href="{{route('tontine.index')}}">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$user->count()}}</h3>

                            <p>Mes tontines</p>
                        </div>
                        
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>10</h3>

                            <p>Renouveller mon forfait</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
