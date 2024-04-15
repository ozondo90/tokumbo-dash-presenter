@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Gestion des sections</h3>
                  <h6 class="font-weight-light" style="font-size: 14px;">
                    <a href="{{ url('admin/sections') }}" class="text-decoration-none">Retour à la liste de sections</a>
                </h6>
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
                        <h4 class="card-title"> {{ $title }} </h4>

                        @if(Session::has('failed_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong> Erreur : </strong> {{ Session::get('failed_message') }}
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

                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> Success : </strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <form class="forms-sample" method="POST" action="{{ empty($section['id']) ? url('admin/edit-section/') : url('admin/edit-section/'.$section['id']) }}" name="editSectionForm" id="editSectionForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom de section</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder='Nom de la section' @if(!empty($section['name'])) value='{{ $section['name'] }}' @else value='{{ old('name') }}' @endif required>
                            </div>

                            <input type="hidden" name="id" value="{{ $section['id'] }}">

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name='description' placeholder='Description de section' @if(!empty($section['name'])) value='{{ $section['description'] }}' @else value='{{ old('description') }}'  @endif aria-label="Placeholder" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" style="color:#495057;" required>
                                    <option value="1" {{ $section['status'] == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $section['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Icon section</label>
                                <input type="file" name="section_icon" id='section_icon' class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" placeholder ='Choisir une icon'>
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Telecharger</button>
                                  </span>
                                </div>
                                @if($section['section_icon'])
                                    <a target="blank" href="{{ url('admin/images/icons/'.$section['section_icon'])}}">Voir l'icon de la section</a>
                                    <input type="hidden" id='current_section_icon' name='current_section_icon' value='{{ $section['section_icon'] }}'>
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
