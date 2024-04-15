@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Configuration Profil Vendeur</h3>
                  <h6 class="mb-0 font-weight-normal">Mettre a jour votre profil vendeur</h6>
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

        @if($slug === 'personal')
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informations personnelle</h4>

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


                        <form class="forms-sample" method='POST' action=' {{ url('admin/update-vendor-details/personal') }} ' name='updatevendorDetailsForm' id='updatevendorDetailsForm' enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label for=email>Email</label>
                                <input type="email" class="form-control" id="email" name='email' value='{{ $vendorDetails['email'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendorName">Nom complète</label>
                                <input type="text" class="form-control" id="vendorName" name="vendorName" value='{{ $vendorDetails['name'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="vendorAddress">Adresse</label>
                                <input type="address" class="form-control" id="vendorAddress" name='vendorAddress' value='{{ $vendorDetails['address'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="vendorCity">Ville</label>
                                <input type="text" class="form-control" id="vendorCity" name='vendorCity' value='{{ $vendorDetails['city'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="vendorState">Departement</label>
                                <input type="text" class="form-control" id="vendorState" name='vendorState' value='{{ $vendorDetails['state'] }}'>
                            </div>

                            <div class="form-group">
                                <label for="vendorCountry">Pays</label>
                                <select class="form-control" id="vendorCountry" name="vendorCountry" style="color:#495057;">
                                    <option value="selecte country" selected>Choisir un pays</option>
                                    @foreach ($countries as  $country)
                                    <option value="{{$country['country_name']}}" {{ $vendorDetails['country'] == $country['country_name']? 'selected' : '' }}>{{$country['country_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pinCode">Code postal</label>
                                <input type="text" class="form-control" id="pinCode" name='pinCode' value='{{ $vendorDetails['pin_code'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="mobile" class="form-control" id="mobile" name='mobile' value='{{ $vendorDetails['mobile'] }}'>
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
                                    <input type="hidden" id='vendorCurrentImage' name='vendorCurrentImage' value='{{ $adminDetails['image'] }}'>
                                @endif
                            </div>

                            <button type="submit" class="mr-2 btn btn-primary">Soumettre</button>
                            <button class="btn btn-light">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($slug === 'business')
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informations professionnelles</h4>

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


                        <form class="forms-sample" method='POST' action=' {{ url('admin/update-vendor-details/business') }} ' name='updatevendorDetailsForm' id='updatevendorDetailsForm' enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label for=shopName>Nom de boutique</label>
                                <input type="text" class="form-control" id="shopName" name='shopName' value='{{ $vendorDetails['shop_name'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="shopAdresse">Adresse professionnelle</label>
                                <input type="address" class="form-control" id="shopAdresse" name="shopAdresse" value='{{ $vendorDetails['shop_address'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="shopCity">Ville d'activité</label>
                                <input type="text" class="form-control" id="shopCity" name='shopCity' value='{{ $vendorDetails['shop_city'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="shopState">Departement d'activité</label>
                                <input type="text" class="form-control" id="shopState" name='shopState' value='{{ $vendorDetails['shop_state'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="shopCountry">Pays</label>
                                <select class="form-control" id="shopCountry" name="shopCountry" style="color:#495057;">
                                    <option value="selecte country" selected>Choisir un pays</option>
                                    @foreach ($countries as  $country)
                                    <option value="{{ $country['country_name'] }}" {{ $vendorDetails['shop_country'] == $country['country_name'] ? 'selected' : '' }}>{{ $country['country_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="shopPinCode">Code postal professionnel</label>
                                <input type="text" class="form-control" id="shopPinCode" name='shopPinCode' value='{{ $vendorDetails['shop_pinCode'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="shopMobile">Telephone professionnel</label>
                                <input type="mobile" class="form-control" id="shopMobile" name='shopMobile' value='{{ $vendorDetails['shop_mobile'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="shopWebsite">Mobile</label>
                                <input type="url" class="form-control" id="shopWebsite" name='shopWebsite' value='{{ $vendorDetails['shop_website'] }}'>
                            </div>



                            <div class="form-group">
                                <label for="addressProof">Type de preuve d'identité</label>
                                <select class="form-control" id="addressProof" name="addressProof" style="color:#495057;">
                                    <option value="passport" {{ $vendorDetails['address_proof'] == 'passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="ID card" {{ $vendorDetails['address_proof'] == 'ID card' ? 'selected' : '' }}>ID card</option>
                                    <option value="registre ID" {{ $vendorDetails['address_proof'] == 'registre ID' ? 'selected' : '' }}>Registre de commerce</option>
                                    <option value="ifu" {{ $vendorDetails['address_proof'] == 'ifu' ? 'selected' : '' }}>Numero IFU</option>
                                </select>
                            </div>

                            <div class="form-group" id="registreIdField" style="{{ $vendorDetails['address_proof'] == 'registre ID' ? '' : 'display: none;' }}">
                                <label for="businessLicenceNumber">Registre de commerce</label>
                                <input type="text" class="form-control" id="businessLicenceNumber" name='businessLicenceNumber' value='{{ $vendorDetails['business_licence_number'] }}'>
                            </div>
                            <div class="form-group" style="{{ $vendorDetails['address_proof'] == 'ifu' ? '' : 'display: none;' }}" id="ifuField">
                                <label for="ifuNumer">Numero IFU</label>
                                <input type="text" class="form-control" id="ifuNumer" name='ifuNumer' value='{{ $vendorDetails['business_registration_number'] }}'>
                            </div>
                            <div class="form-group" style="{{ $vendorDetails['address_proof'] == 'ID card' || $vendorDetails['address_proof'] == 'passport' ? '' : 'display: none;' }}" id="panNumberField">
                                <label for="panNumber">Numero de carte ID ou de passport</label>
                                <input type="text" class="form-control" id="panNumber" name='panNumber' value='{{ $vendorDetails['pan_number'] }}'>
                            </div>


                            <div class="form-group">
                                <label>Preuve d'identité</label>
                                <input type="file" name="adddressProofImage" id='adddressProofImage' class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" disabled>
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Telecharger</button>
                                  </span>
                                </div>
                                @if($vendorDetails['address_proof_image'])
                                    <a target="blank" href="{{ url('admin/images/photos/'.$vendorDetails['address_proof_image'])}}">Voir image de profil</a>
                                    <input type="hidden" id='currentProofImage' name='currentProofImage' value='{{ $vendorDetails['address_proof_image'] }}'>
                                @endif
                            </div>

                            <button type="submit" class="mr-2 btn btn-primary">Soumettre</button>
                            <button class="btn btn-light">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif ($slug === 'bank')
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informations bancaire</h4>

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


                        <form class="forms-sample" method='POST' action=' {{ url('admin/update-vendor-details/bank') }} ' name='updatevendorDetailsForm' id='updatevendorDetailsForm' enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group">
                                <label for=bankName>Nom de la banque</label>
                                <input type="text" class="form-control" id="bankName" name='bankName' value='{{ $vendorDetails['bank_name'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="bankIfscCode">Code UBAN</label>
                                <input type="text" class="form-control" id="bankIfscCode" name="bankIfscCode" value='{{ $vendorDetails['bank_ifsc_code'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="AccountHolderName">Non du compte</label>
                                <input type="text" class="form-control" id="AccountHolderName" name='AccountHolderName' value='{{ $vendorDetails['account_holder_name'] }}'>
                            </div>
                            <div class="form-group">
                                <label for="accountNumber">Numero de compte</label>
                                <input type="text" class="form-control" id="accountNumber" name='accountNumber' value='{{ $vendorDetails['account_number'] }}'>
                            </div>
                            <button type="submit" class="mr-2 btn btn-primary">Soumettre</button>
                            <button class="btn btn-light">Annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addressProofSelect = document.getElementById('addressProof');
        var registreIdField = document.getElementById('registreIdField');
        var ifuField = document.getElementById('ifuField');
        var panNumberField = document.getElementById('panNumberField');

        // Hide all input fields initially except the one selected
        toggleInputFields();

        // Add event listener to addressProof select element
        addressProofSelect.addEventListener('change', function() {
            toggleInputFields();
        });

        function toggleInputFields() {
            var selectedOption = addressProofSelect.value;
            registreIdField.style.display = selectedOption == 'registre ID' ? '' : 'none';
            ifuField.style.display = selectedOption == 'ifu' ? '' : 'none';
            panNumberField.style.display = selectedOption == 'ID card' || selectedOption == 'passport' ? '' : 'none';
        }
    });
</script>


@endsection
