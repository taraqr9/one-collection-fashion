@extends('admin.master')

@section('title')
    Profile
@endsection

@section('breadcrumb')
    <a href="{{ url('/admins') }}" class="breadcrumb-item">Admins</a>
    <span class="breadcrumb-item active">Profile</span>
@endsection

@section('page_content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ $user->avatar ? \Illuminate\Support\Facades\Storage::url($user->avatar)  : url()->asset('global_assets/images/admin_default.jpg') }}" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ $user->name }}</h5>
                            <h6 class="my-3">{{ $user->email }}</h6>
                            <p class="text-muted mb-1">{{ $user->designation }}</p>
                        </div>
                    </div>
                </div>
                <form method="post" class="col-lg-8 border p-2" action="{{ url('/admins/profile-update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Avatar</label>
                        <div class="col-sm-10">
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footer')

@endsection
