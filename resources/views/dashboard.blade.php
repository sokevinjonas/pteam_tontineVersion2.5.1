@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>0</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>100</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
