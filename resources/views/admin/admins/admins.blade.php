@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="mb-4 col-12 col-xl-8 mb-xl-0">
                  <h3 class="font-weight-bold">Gestion des administrteurs et vendeur</h3>
                  <h6 class="mb-0 font-weight-normal">Gerer les administreteur</h6>
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

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"> {{ $title }} </h4>
                {{-- <p class="card-description">
                  Add class <code>.table-border</code>
                </p> --}}
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nom & Prenoms</th>
                        <th>Type</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Profil</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Voir details</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td> {{ $admin['id'] }} </td>
                            <td> {{ $admin['name'] }} </td>
                            <td> {{ $admin['type'] }} </td>
                            <td> {{ $admin['mobile'] }} </td>
                            <td> {{ $admin['email'] }} </td>
                            <td> <img src=" {{ asset('admin/images/photos/'.$admin['image']) }} " alt=""/> </td>
                            <td>
                                @if ($admin['status'] == 1)
                                <div id="status-{{$admin['id']}}">Active</div>
                                @else
                                <div id="status-{{$admin['id']}}">Inactive</div>
                                @endif

                            </td>
                            <td>
                                @if ($admin['type'] !== 'superadmin')

                                    @if ($admin['status'] == 1)
                                        <a class="updateAdminsStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)">
                                            <i style="font-size:30px;" class="mdi mdi-toggle-switch" status="Active "></i>
                                        </a>
                                    @else
                                        <a class="updateAdminsStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)">
                                            <i style='font-size: 30px; color: #666;' class='mdi mdi mdi-toggle-switch-off' status='Inactive'></i>
                                        </a>
                                    @endif

                                @endif
                            </td>
                            <td>
                                @if ($admin['type'] == 'vendor')
                                    <a href="{{ url('admin/view-vendor-details/'.$admin['id']) }}">
                                        <i style="font-size:30px;" class="mdi mdi-file-document-box"></i>
                                    </a>
                                @endif
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
