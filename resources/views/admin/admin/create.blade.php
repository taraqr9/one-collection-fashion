@extends('admin.master')

@section('title')
    Admins
@endsection

@section('breadcrumb')
    <a href="{{ url('/admins') }}" class="breadcrumb-item">Admin List</a>
    <span class="breadcrumb-item active">Add New</span>
@endsection

@section('page_content')

<div class="d-md-flex align-items-md-start">

 <!-- Left sidebar component -->
     <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md d-block">

        <!-- Sidebar content -->
        <div class="sidebar-content">
        <!-- Navigation -->
            <div class="card me-2">
                <div class="card-body p-0">
                    <ul class="nav nav-sidebar mb-2">
                        <li class="nav-item">
                            <a href="#generalInfo" class="nav-link active" data-bs-toggle="tab" data-bs-target="#generalInfo">
                                <i class="icon-info22"></i> Profile Information
                            </a>
                        </li>

                        @foreach(config('access.access-name') as $key => $value)

                            @if(auth()->user()->admin_type == 'REGULAR' && !count(array_intersect(array_values(config('access.'.$key)), $admin_roles)) > 0)
                                @continue
                            @endif

                            <li class="nav-item">
                                <a href="#{{ $key }}" class="nav-link" data-bs-toggle="tab" data-bs-target="#{{ $key }}">
                                    <i class="icon-info22"></i> {{ $value }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- /navigation -->


    <!-- Right content -->
    <form class="tab-content flex-lg-fill" action="{{ url('/admins') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Profile Information --}}
        <div class="tab-pane fade active show" id="generalInfo">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Profile Information</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name"  autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Phone:</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone"  autocomplete="off">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email"  autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Designation:</label>
                            <input type="text" class="form-control" name="designation" placeholder="Enter Designation"  autocomplete="off">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password"  autocomplete="new-password">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold">Confirm Password:</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm Password"  autocomplete="new-password">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold">Admin Type:</label>
                            <select name="admin_type" class="form-control">
                                <option value="REGULAR" selected>REGULAR</option>
                                @if (isset(auth()->user()->admin_type) && (auth()->user()->admin_type == "SYSTEM_ADMIN"))
                                    <option value="SYSTEM_ADMIN">SYSTEM ADMIN</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="fw-bold">Avatar:</label>
                            <input id="gallery-photo-add" type="file" class="form-control" name="avatar">
                        </div>

                        <div class="col-md-3 gallery"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Other Permission --}}
        @foreach(config('access') as $key => $data)

            <div class="tab-pane fade" id="{{ $key }}">

                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h5 class="card-title">
                            @foreach(config('access.access-name') as $key2 => $value)
                                @if($key == $key2)
                                    {{ $value }} - Permissions
                                @endif
                            @endforeach
                        </h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($data as $key2 => $value)

                                @if(auth()->user()->admin_type == "REGULAR" && in_array($value, json_decode(auth()->user()->roles)))
                                    <label class="col-md-4 form-check mb-4">
                                        <input type="checkbox" name="roles[]" class="form-check-input" value={{ $value }}>
                                        <span class="form-check-label fw-bold">{{ ucwords(str_replace('-', ' ', $key2)) }}</span>
                                    </label>
                                @elseif(auth()->user()->admin_type == "SYSTEM_ADMIN")

                                    <label class="col-md-4 form-check mb-4">
                                        <input type="checkbox" name="roles[]" class="form-check-input" value={{ $value }}>
                                        <span class="form-check-label fw-bold">{{ ucwords(str_replace('-', ' ', $key2)) }}</span>
                                    </label>
                                @endif
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-end">
            <button type="submit" class="btn btn-outline-dark">Submit</button>
        </div>
    </form>
    <!-- /right content -->

</div>

@endsection

@section('footer_js')
    <script>
        $( document ).ready(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img class="rounded-circle" style="height: 100px; margin-left: 35%; width: 100px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $(document).on('change', '#gallery-photo-add', function() {
                $('div.gallery').empty();
                imagesPreview(this,'div.gallery');
            });
        });
    </script>
@endsection
