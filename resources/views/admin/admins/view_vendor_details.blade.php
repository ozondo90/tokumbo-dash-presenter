@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Details vendeur</h3>
                  <h6 class="mb-0 font-weight-normal"> <a href="{{ url('admin/admins/vendor') }}"> Retour à la page précédent </a> </h6>
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
                            <h4 class="card-title">Informations personnelles</h4>

                            <div class="form-group">
                                <label for=email>Email</label>
                                <input type="email" class="form-control" id="email" name='email' value='{{ $vendorDetails['vendor_personal']['email']}}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendorName">Nom complète</label>
                                <input type="text" class="form-control" id="vendorName" name="vendorName" value='{{ $vendorDetails['vendor_personal']['name'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendorAddress">Adresse</label>
                                <input type="address" class="form-control" id="vendorAddress" name='vendorAddress' value='{{ $vendorDetails['vendor_personal']['address'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendorCity">Ville</label>
                                <input type="text" class="form-control" id="vendorCity" name='vendorCity' value='{{ $vendorDetails['vendor_personal']['city'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendorState">Departement</label>
                                <input type="text" class="form-control" id="vendorState" name='vendorState' value='{{ $vendorDetails['vendor_personal']['state'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendorCountry">Pays</label>
                                <input type="text" class="form-control" id="vendorCountry" name='vendorCountry' value='{{ $vendorDetails['vendor_personal']['country'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="pinCode">Code postal</label>
                                <input type="text" class="form-control" id="pinCode" name='pinCode' value='{{ $vendorDetails['vendor_personal']['pin_code'] }}' readonly>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="mobile" class="form-control" id="mobile" name='mobile' value='{{ $vendorDetails['vendor_personal']['mobile'] }}' readonly>
                            </div>
                            @if (isset($vendorDetails['image']))
                            <div class="form-group">
                                <label>Photo de profil</label> <br>
                                <img style="width:100px;" src="{{ asset('admin/images/photos/'.$vendorDetails['image']) }}" alt="Photo de profil">
                            </div>
                            @endif

                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informations professionnelles</h4>
                        <div class="form-group">
                            <label for=shopName>Nom de boutique</label>
                            <input type="text" class="form-control" id="shopName" name='shopName' value='{{ $vendorDetails['vendor_business']['shop_name'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopAdresse">Adresse professionnelle</label>
                            <input type="address" class="form-control" id="shopAdresse" name="shopAdresse" value='{{ $vendorDetails['vendor_business']['shop_address'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopCity">Ville d'activité</label>
                            <input type="text" class="form-control" id="shopCity" name='shopCity' value='{{ $vendorDetails['vendor_business']['shop_city'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopState">Departement d'activité</label>
                            <input type="text" class="form-control" id="shopState" name='shopState' value='{{ $vendorDetails['vendor_business']['shop_state'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopCountry">Pays d'activité</label>
                            <input type="text" class="form-control" id="shopCountry" name='shopCountry' value='{{ $vendorDetails['vendor_business']['shop_country'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopPinCode">Code postal professionnel</label>
                            <input type="text" class="form-control" id="shopPinCode" name='shopPinCode' value='{{ $vendorDetails['vendor_business']['shop_pinCode'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopMobile">Telephone professionnel</label>
                            <input type="mobile" class="form-control" id="shopMobile" name='shopMobile' value='{{ $vendorDetails['vendor_business']['shop_mobile'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="shopWebsite">Mobile</label>
                            <input type="url" class="form-control" id="shopWebsite" name='shopWebsite' value='{{ $vendorDetails['vendor_business']['shop_website'] }}' readonly>
                        </div>

                        <div class="form-group">
                            <label for="addressProof">Type de preuve d'identité</label>
                            <select class="form-control" id="addressProof" name="addressProof" readonly>
                                <option value="passport" {{ $vendorDetails['vendor_business']['address_proof'] == 'passport' ? 'selected' : '' }} readonly>Passport</option>
                                <option value="ID card" {{ $vendorDetails['vendor_business']['address_proof'] == 'ID card' ? 'selected' : '' }} readonly>ID card</option>
                                <option value="registre ID" {{ $vendorDetails['vendor_business']['address_proof'] == 'registre ID' ? 'selected' : '' }} readonly>Registre de commerce</option>
                                <option value="ifu" {{ $vendorDetails['vendor_business']['address_proof'] == 'ifu' ? 'selected' : '' }}>Numero IFU</option readonly>
                            </select>
                        </div>

                        <div class="form-group" id="registreIdField" style="{{ $vendorDetails['vendor_business']['address_proof'] == 'registre ID' ? '' : 'display: none;' }}">
                            <label for="businessLicenceNumber">Registre de commerce</label>
                            <input type="text" class="form-control" id="businessLicenceNumber" name='businessLicenceNumber' value='{{ $vendorDetails['vendor_business']['business_licence_number'] }}' readonly>
                        </div>
                        <div class="form-group" style="{{ $vendorDetails['vendor_business']['address_proof'] == 'ifu' ? '' : 'display: none;' }}" id="ifuField">
                            <label for="ifuNumer">Numero IFU</label>
                            <input type="text" class="form-control" id="ifuNumer" name='ifuNumer' value='{{ $vendorDetails['vendor_business']['business_registration_number'] }}' readonly>
                        </div>
                        <div class="form-group" style="{{ $vendorDetails['vendor_business']['address_proof'] == 'ID card' || $vendorDetails['vendor_business']['address_proof'] == 'passport' ? '' : 'display: none;' }}" id="panNumberField">
                            <label for="panNumber">Numero de carte ou de passport</label>
                            <input type="text" class="form-control" id="panNumber" name='panNumber' value='{{ $vendorDetails['vendor_business']['pan_number'] }}' readonly>
                        </div>

                        @if($vendorDetails['vendor_business']['address_proof_image'])
                        <div class="form-group">
                            <label>Preuve d'identité</label> <br>
                            <img style="width:200px;" src="{{ asset('admin/images/photos/'.$vendorDetails['vendor_business']['address_proof_image'])}}">
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informations bancaires</h4>
                        <div class="form-group">
                            <label for=bankName>Nom de la banque</label>
                            <input type="text" class="form-control" id="bankName" name='bankName' value='{{ $vendorDetails['vendor_bank']['bank_name'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="bankIfscCode">Code UBAN</label>
                            <input type="text" class="form-control" id="bankIfscCode" name="bankIfscCode" value='{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="AccountHolderName">Non du compte</label>
                            <input type="text" class="form-control" id="AccountHolderName" name='AccountHolderName' value='{{ $vendorDetails['vendor_bank']['account_holder_name'] }}' readonly>
                        </div>
                        <div class="form-group">
                            <label for="accountNumber">Numero de compte</label>
                            <input type="text" class="form-control" id="accountNumber" name='accountNumber' value='{{ $vendorDetails['vendor_bank']['account_number'] }}' readonly>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>

{{--
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
</script> --}}



@endsection
