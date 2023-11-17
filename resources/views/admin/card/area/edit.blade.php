@extends('admin.master')

@section('title')
    Edit Area
@endsection

@section('breadcrumb')
    <a href="{{ url('/cards/area') }}" class="breadcrumb-item">Area</a>
    <span class="breadcrumb-item active">Edit Area</span>
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2"
                      action="{{ url('/cards/area/'.$area->id.'/edit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{$area->name}}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name in Bangla</label>
                        <div class="col-sm-10">
                            <input type="text" name="name_in_bangla" class="form-control"
                                   value="{{$area->name_in_bangla}}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Division</label>
                        <div class="col-sm-10">
                            <select name="card_division_id" class="form-control" required>
                                <option value="{{$area->division->id}}" selected>{{$area->division->name}}
                                    - {{$area->division->name_in_bangla}}</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}
                                        - {{ $division->name_in_bangla }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control" required>
                                <option value="" selected>Select Status</option>
                                @foreach(\App\Constants\CardIntegerStatus::all() as $key => $value)
                                    <option value="{{ $value}}" {{ $area->status == $value ? 'selected' : '' }}>{{ str_replace("_", " ", $key) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Update Area</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
