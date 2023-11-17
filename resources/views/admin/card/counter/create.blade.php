@extends('admin.master')

@section('title')
    Add Counter
@endsection

@section('breadcrumb')
    <a href="{{ url('/cards/counter') }}" class="breadcrumb-item">Counter</a>
    <span class="breadcrumb-item active">Add Counter</span>
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2" action="{{ url('/cards/counter') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Counter name"
                                   value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Name in Bangla</label>
                        <div class="col-sm-10">
                            <input type="text" name="name_in_bangla" class="form-control"
                                   placeholder="Counter name in Bangla" value="{{ old('name_in_bangla') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Divisions</label>
                        <div class="col-sm-10">
                            <select name="card_division_id" class="form-control input-division"
                                    onchange="divisionOnchangeEvent()" required>
                                <option value="" selected>Select Divisions First</option>
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}
                                        - {{$division->name_in_bangla}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr class="hr-area @if(!request('card_division_id')) {{'d-none'}} @endif">
                    <div
                            class="form-group row m-1 input-area-div @if(!request('card_division_id')) {{'d-none'}} @endif">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Areas</label>
                        <div class="col-sm-10">
                            <select name="card_area_id" class="form-control input-area" required>
                                <option value="" selected>Select Area</option>
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
                                    <option value="{{ $value }}">{{ str_replace("_", " ", $key) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Add Counter</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footer_js')
    <script>
        function divisionOnchangeEvent() {
            const division_id = $(".input-division").val();
            $('.input-area').find('option').not(':first').remove();
            if (division_id !== '' && division_id !== null) {
                $(".input-area-div").removeClass('d-none');
                $(".hr-area").removeClass('d-none');
                getDivisionWiseArea(division_id).then((res) => {
                    if (res) {
                        if (res.length > 0) {
                            $.each(res, function (i, item) {
                                $('.input-area').append($('<option>', {
                                    value: item.id,
                                    text: item.name + ' - ' + item.name_in_bangla
                                }));
                            });
                        }
                    }
                });
            } else {
                $(".input-area-div").addClass('d-none');
            }
        }

        function getDivisionWiseArea(division_id) {
            return $.ajax({
                url: "/cards/division/" + division_id,    //the page containing php script
                type: "get",    //request type,
                dataType: 'json',
                success: function (res) {
                }
            });
        }
    </script>
@endsection
