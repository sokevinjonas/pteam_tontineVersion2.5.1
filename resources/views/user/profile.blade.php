@extends('layout')
@section('title', 'Mon compte')
@section('css')
{{-- <script defer src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
{{-- <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('profile.css') }}">
@endsection
@section('content')
        <div class=" container bg-white shadow rounded d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <div class="p-4">
                    <div class="img-circle text-center mb-3">
                        <img src="../dist/img/user2-160x160.jpg" alt="Image" class="shadow">
                    </div>
                    <h4 class="text-center">{{$user->last_name . ' ' . $user->first_name}}</h4>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"
                    style="width: 20rem">
                    <a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab"
                        aria-controls="account" aria-selected="true">
                        <i class="fa fa-home text-center mr-1"></i>
                        Infos Personnel
                    </a>
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                        aria-controls="password" aria-selected="false">
                        <i class="fa fa-key text-center mr-1"></i>
                        Changer de mot de passe
                    </a>
                    <a class="nav-link" id="faq-tab" data-toggle="pill" href="#faq" role="tab"
                        aria-controls="password" aria-selected="false">
                        <i class="fa fa-key text-center mr-1"></i>
                        Foire Aux Questions (FAQ)
                    </a>
                </div>
            </div>
            <div class="tab-content p-md-5" id="v-pills-tabContent">
                <div class="tab-pane fade container " id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom :</label>
                                <input type="text" class="form-control" value="{{ $user->last_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prenom (s):</label>
                                <input type="text" class="form-control" value="{{ $user->first_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Téléphone:</label>
                                <input type="text" class="form-control disabled" value="{{ $user->phone_number }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type compte:</label>
                                <input type="text" class="form-control disabled" value="{{ $user->role }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Modifier</button>
                    </div>
                </div>
                <div class="tab-pane fade container" id="password" role="tabpanel" aria-labelledby="password-tab">
                    {{-- <h3 class="mb-4 mt-2 text-center">Changer de mot de passe</h3> --}}
                    <form action="{{ route('user.update_password') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ancier mot de passe:</label>
                                    <input type="password" name="old_password" class="form-control"
                                        value="********">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nouveau mot de passe:</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirmer le mot de passe:</label>
                                    <input type="password" name="new_password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                            <button type="reset" class="btn btn-light">Annuler</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade container" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    <h3 class="mb-4 mt-2 text-center">Foire aux questions</h3>
                
                    <div class="accordion" id="faqAccordion">
                        <!-- Question 1 -->
                        <div class="card">
                            <div class="card-header" id="question1">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#answer1"
                                        aria-expanded="true" aria-controls="answer1">
                                        Question 1 : Quel est le but de notre service ?
                                    </button>
                                </h2>
                            </div>
                
                            <div id="answer1" class="collapse show" aria-labelledby="question1" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Réponse à la question 1.
                                </div>
                            </div>
                        </div>
                
                        <!-- Question 2 -->
                        <div class="card">
                            <div class="card-header" id="question2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#answer2" aria-expanded="false" aria-controls="answer2">
                                        Question 2 : Comment puis-je contacter le support ?
                                    </button>
                                </h2>
                            </div>
                
                            <div id="answer2" class="collapse" aria-labelledby="question2" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Réponse à la question 2.
                                </div>
                            </div>
                        </div>
                        <!-- Question 3 -->
                        <div class="card">
                            <div class="card-header" id="question2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#answer2" aria-expanded="false" aria-controls="answer2">
                                        Question 3 : Comment puis-je contacter le support ?
                                    </button>
                                </h2>
                            </div>
                
                            <div id="answer2" class="collapse" aria-labelledby="question2" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Réponse à la question 3.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="question2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#answer2" aria-expanded="false" aria-controls="answer2">
                                        Question 4 : Comment puis-je contacter le support ?
                                    </button>
                                </h2>
                            </div>
                
                            <div id="answer2" class="collapse" aria-labelledby="question2" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Réponse à la question 4.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="question2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#answer2" aria-expanded="false" aria-controls="answer2">
                                        Question 5 : Comment puis-je contacter le support ?
                                    </button>
                                </h2>
                            </div>
                
                            <div id="answer2" class="collapse" aria-labelledby="question2" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Réponse à la question 5.
                                </div>
                            </div>
                        </div>
                
                        <!-- Ajoutez plus de questions et réponses ici si nécessaire -->
                
                    </div>
                </div>
                
            </div>
        </div>

@endsection