@extends('admin.master')

@section('title')
    Edit Area
@endsection

@section('breadcrumb')
    <a href="{{ url('/cards/area') }}" class="breadcrumb-item">Area</a>
    <span class="breadcrumb-item active">Edit Area</span>
@endsection

@section('page_content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <form method="post" class="col-lg-8 border rounded-xl p-2"
                      action="{{ url('/cards/area/'.$area->id.'/edit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{$area->name}}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name in Bangla</label>
                        <div class="col-sm-10">
                            <input type="text" name="name_in_bangla" class="form-control"
                                   value="{{$area->name_in_bangla}}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Division</label>
                        <div class="col-sm-10">
                            <select name="card_division_id" class="form-control">
                                <option value="{{$area->division->id}}" selected>{{$area->division->name}}
                                    - {{$area->division->name_in_bangla}}</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}
                                        - {{ $division->name_in_bangla }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Update Area</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
