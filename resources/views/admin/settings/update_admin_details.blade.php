@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Configuration</h3>
                  <h6 class="mb-0 font-weight-normal">Mettre a jour ses informations </h6>
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
                        <h4 class="card-title">Mise à jour des informations</h4>

                        @if(Session::has('current_password_error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> Erreur : </strong> {{ Session::get('current_password_error') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if(Session::has('details_update_failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> Erreur : </strong> {{ Session::get('details_update_failed') }}
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

                        @if(Session::has('details_update_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> Success : </strong> {{ Session::get('details_update_success') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <form class="forms-sample" method='POST' action=' {{ url('admin/update-details') }} ' name='updateDetailsForm' id='updateDetailsForm' enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label for="accountType">Type de compte</label>
                                <input type="text" class="form-control" id="accountType" name="accountType" value='{{ $adminDetails['type'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="newEmail">Nouveau email</label>
                                <input type="email" class="form-control" id="email" name='email' value='{{ $adminDetails['email'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">Non d'utilisateur</label>
                                <input type="text" class="form-control" id="username" name='username' value='{{ $adminDetails['name'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="mobile" class="form-control" id="mobile" name='mobile' value='{{ $adminDetails['mobile'] }}'>
                            </div>
                            <div class="form-group">
                                <label>Photo de profil</label>
                                <input type="file" name="imageProfil" id='imageProfil' class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled>
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Telecharger</button>
                                  </span>
                                </div>
                                @if($adminDetails['image'])
                                    <a target="blank" href="{{ url('admin/images/photos/'.$adminDetails['image'])}}">Voir image de profil</a>
                                    <input type="hidden" id='adminCurrentImage' name='adminCurrentImage' value='{{ $adminDetails['image'] }}'>
                                @endif
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
