@extends('admin.master')

@section('title')
    Add Area
@endsection

@section('breadcrumb')
    <a href="{{ url('/career/area') }}" class="breadcrumb-item">Area</a>
    <span class="breadcrumb-item active">Add Area</span>
@endsection

@section('page_content')
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <form method="post" class="col-lg-8 border rounded-xl p-2" action="{{ url('/cards/area') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Area name"
                                   value="{{ old('name') }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name in Bangla</label>
                        <div class="col-sm-10">
                            <input type="text" name="name_in_bangla" class="form-control"
                                   placeholder="Area name in Bangla" value="{{ old('name_in_bangla') }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Division</label>
                        <div class="col-sm-10">
                            <select name="card_division_id" class="form-control">
                                <option value="" selected>Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}
                                        - {{$division->name_in_bangla}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-primary">Add Area</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
