@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Gestion des categories</h3>
                  <h6 class="font-weight-light" style="font-size: 14px;">
                    <a href="{{ url('admin/categories') }}" class="text-decoration-none">Retour à la liste de categories</a>
                </h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class=" flex-md-grow-1 flex-xl-grow-0">
                    <button class="bg-white btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> {{ \Carbon\Carbon::now()->toFormattedDateString() }}
                    </button>
                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">Janvier - Mars</a>
                      <a class="dropdown-item" href="#">Mars - Juin</a>
                      <a class="dropdown-item" href="#">Juin - Aout</a>
                      <a class="dropdown-item" href="#">Aout - Novembre</a>
                    </div> --}}
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


                        <form class="forms-sample" method="POST" action="{{ empty($category['id']) ? url('admin/edit-category/') : url('admin/edit-category/'.$category['id']) }}" name="editcategoryForm" id="editcategoryForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="categoryid" name="categoryid" value="{{ $category['id'] }}">

                            <div class="form-group">
                                <label for="category_name">Nom de categorie</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder='Nom de la categorie' @if(!empty($category['category_name'])) value='{{ $category['category_name'] }}' @else value='{{ old('category_name') }}' @endif required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name='description' placeholder='Description de categories' @if(!empty($category['description'])) value='{{ $category['description'] }}' @else value='{{ old('description') }}'  @endif aria-label="Placeholder" aria-describedby="basic-addon1"></input>
                            </div>
                            <div class="form-group">
                                <label for="section">Section de produits</label>
                                <select class="form-control" id="section" name="section" style="color:#495057;">
                                    @foreach ($sections as  $section)
                                    <option value="{{$section['id']}}" {{ $section['id'] == $category['section_id']? 'selected' : '' }}>{{$section['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="parent_category">Category Parent</label>
                                <select class="form-control" id="parent_category" name="parent_category" style="color:#495057;">
                                    <option value="0" selected>Choisir une categorie parent</option>
                                    @foreach ($parentCategories as  $parentCategory)
                                    <option value="{{$parentCategory['id']}}" {{ $parentCategory['id'] == $category['parent_id']? 'selected' : '' }}>{{$parentCategory['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" style="color:#495057;" required>
                                    <option value="1" {{ $category['status'] == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $category['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_discount">Category discount</label>
                                <input type="text" class="form-control" id="category_discount" name='category_discount' placeholder='discount' @if(!empty($category['category_discount'])) value='{{ $category['category_discount'] }}' @else value='{{ old('category_discount') }}'  @endif aria-label="Placeholder">
                            </div>
                            <div class="form-group">
                                <label for="meta_title">SEO meta titre</label>
                                <input type="text" class="form-control" id="meta_title" name='meta_title' placeholder='Meta titre' @if(!empty($category['meta_title'])) value='{{ $category['meta_title'] }}' @else value='{{ old('meta_title') }}'  @endif aria-label="Placeholder">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">SEO meta description</label>
                                <textarea type="text" class="form-control" id="meta_description" name='meta_description' placeholder='Meta description' aria-label="Meta description">@if(!empty($category['meta_description'])) {{ $category['meta_description'] }}@else{{ old('meta_description') }}@endif</textarea>



                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">SEO mot clés</label>
                                <input type="text" class="form-control" id="meta_keywords" name='meta_keywords' placeholder='Mots clés' @if(!empty($category['meta_keywords'])) value='{{ $category['meta_keywords'] }}' @else value='{{ old('meta_keywords') }}'  @endif aria-label="Placeholder">
                            </div>
                            <div class="form-group">
                                <label>Categorie Icon</label>
                                <input type="file" name="category_icon" id='category_icon' class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" placeholder ='Choisir une icon'>
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Telecharger</button>
                                  </span>
                                </div>
                                @if($category['category_icon'])
                                    <a target="blank" href="{{ url('admin/images/icons/'.$category['category_icon'])}}">Voir l'icon de la categorie</a>
                                    <input type="hidden" id='current_category_icon' name='current_category_icon' value='{{ $category['category_icon'] }}'>
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
