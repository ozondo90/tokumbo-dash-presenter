@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Gestion des sections</h3>
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

        {{-- Succes message --}}
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Success : </strong> {{ Session::get('success_message') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title  d-flex justify-content-between align-items-center">
                    <span> Listes des sections  </span>
                    {{-- <a href="{{ url('admin/edit-section/') }}" title="Ajouter nouvelle section">
                        <i style="font-size: 45px;" class="mdi mdi-plus-circle-outline"></i>
                    </a> --}}
                    <a href="{{ url('admin/edit-section/') }}" type="button" class="btn btn-info btn-md" style='background:#4b49ad;color:#fff;'> Nouvelle section </a>
                </h4>
                <div class="table-responsive pt-3">
                  <table  id="sectionsTable" style="width:100%" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                        <th class="text-center">Modifier </th>
                        <th class="text-center">Supprimer </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                        <tr>
                            <td class="text-center"> {{ $section['id'] }} </td>
                            <td class="text-center"> {{ $section['name'] }} </td>
                            <td class="text-center">
                                <a href="{{ url('admin/view-section-description/'.$section['description']) }}">
                                    Voir description
                                </a>
                            </td>
                            <td class="text-center">
                                @if ($section['status'] == 1)
                                <div id="status-{{$section['id']}}">Active</div>
                                @else
                                <div id="status-{{$section['id']}}">Inactive</div>
                                @endif

                            </td>
                            <td class="text-center">
                                @if ($section['status'] == 1)
                                <a class="updateSectionsStatus" id="section-{{$section['id']}}" section_id="{{$section['id']}}" href="javascript:void(0)">
                                    <i style="font-size:30px;" class="mdi mdi-toggle-switch" status="Active "></i>
                                </a>
                                @else
                                    <a class="updateSectionsStatus" id="section-{{$section['id']}}" section_id="{{$section['id']}}" href="javascript:void(0)">
                                        <i style='font-size: 30px; color: #666;' class='mdi mdi mdi-toggle-switch-off' status='Inactive'></i>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="" href="{{ url('admin/edit-section/'.$section['id']) }}">
                                    <i style="font-size:22px;" class="mdi mdi-table-edit"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a module='section' module_id='{{ $section['id'] }}' class="confirmDelete" href="javascript:void(0)">
                                    <i style="font-size:22px;" class="mdi mdi-delete-sweep"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>



    </div>
</div>

@endsection
