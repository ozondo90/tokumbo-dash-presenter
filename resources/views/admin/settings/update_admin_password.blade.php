@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Configuration</h3>
                  <h6 class="mb-0 font-weight-normal">Mettre a jour son mot de passe </h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="bg-white btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Aujourd'hui (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">Janvier - Mars</a>
                      <a class="dropdown-item" href="#">Mars - Juin</a>
                      <a class="dropdown-item" href="#">Juin - Aout</a>
                      <a class="dropdown-item" href="#">Aout - Novembre</a>
                    </div>
                  </div>
                 </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mise à jour mot de passe</h4>

                        @if(Session::has('current_password_error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> Erreur : </strong> {{ Session::get('current_password_error') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::has('password_update_failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> Erreur : </strong> {{ Session::get('password_update_failed') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ( $errors->all() as $error)
                                    <li><strong> Erreur : </strong> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::has('password_update_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> Success : </strong> {{ Session::get('password_update_success') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form class="forms-sample" method='POST' action=' {{ url('admin/update-password') }} ' name='updatePasswordForm' id='updatePasswordForm'>
                            @csrf
                            <div class="form-group">
                                <label for="email">Nom utilisateur (Email)</label>
                                <input type="text" class="form-control" name='email' id="email" value='{{ $adminDetails['email'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="accountType">Type de compte</label>
                                <input type="text" class="form-control" id="accountType" name="accountType" value='{{ $adminDetails['type'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="currentPassword">Mot de passe actuel</label>
                                <input type="password" class="form-control" id="currentPassword" name='currentPassword' placeholder="Entrer votre mot de passe actuel" required>
                                <span id='passwordCheckMessage'></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Nouveau Mot de passe</label>
                                <input type="password" class="form-control" id="password" name='password' placeholder="Entrer le nouveau mot de passe" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmer mot de passe</label>
                                <input type="password" class="form-control" id="password_confirmation" name='password_confirmation' placeholder="confirmer le nouveau mot de passe" required>
                            </div>
                            <button type="submit" class="mr-2 btn btn-primary">Soumettre</button>
                            <button class="btn btn-light">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
