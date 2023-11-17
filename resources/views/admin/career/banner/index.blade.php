@extends('admin.master')

@section('title')
    Banner
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Banner</span>
@endsection

@section('page_actions')
    @if(in_array(config('access.careers.banner'), $admin_roles) && count($career_banners)<10)
        <div class="dropdown ms-lg-3">
            <a href="#" class="d-flex align-items-center text-body dropdown-toggle py-2" data-bs-toggle="dropdown">
                <i class="ph-gear me-2"></i>
                <span class="flex-1">Actions</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end w-100 w-lg-auto">

                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#banner_image" id="add_banner_image">
                    <i class="ph-image me-2"></i>&nbsp; Add New
                </button>
            </div>
        </div>
    @endif
@endsection

@section('page_content')
    <div class="col-12">
        <div class="row card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr class="bg-dark text-white">
                                <th>#</th>
                                <th>Dimension</th>
                                <th>Image</th>
                                @if(in_array(config('access.careers.banner'), $admin_roles))
                                    <th>Edit</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($career_banners as $key => $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dimensions[$loop->index] }}</td>
                                    <td>
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($banner) }}" alt="avatar"
                                             class="img-fluid" style="max-width: 120px;">
                                    </td>
                                    @if(in_array(config('access.careers.banner'), $admin_roles))
                                        <td>
                                            <a href="#" data-id="{{ $key }}" id="edit_banner_image"
                                               class="btn btn-outline-dark btn-sm" data-bs-toggle="modal"
                                               data-bs-target="#banner_image"
                                               onclick="adminEdit( '{{ $key }}')">
                                                <i class="ph-pencil-line"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <h4>No data found!</h4>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Banner Image-->
    <div id="banner_image" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title header_change">Banner Image Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="post" id="banner_form" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="col-md-12 gallery">
                        </div>

                        <div class="col-md-12">
                            <label class="fw-bold">Banner Image:</label>
                            <input id="gallery-photo-add" type="file" class="form-control" name="banner_image">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-dark">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script>

        function adminEdit(banner_image) {
            $('textarea[name="banner_image"]').val(banner_image);
        }

        //Add Banner------
        $('#add_banner_image').click(function (e) {
            $('#banner_form')[0].reset();
            $('.header_change').html('Banner Image');
            $('#banner_form').attr('action', '/careers/banner');
        });

        //Edit Banner------
        $(document).on("click", "#edit_banner_image", function () {
            var id = parseInt($(this).attr('data-id'));
            var dimensions = {!! json_encode($dimensions) !!};
            $('.header_change').html(id + 1 + ' Number Banner Image Edit (' + dimensions[id] + ')');
            $('#banner_form').attr('action', '/careers/banner/' + id + '/edit');
        });

        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function (event) {
                            $($.parseHTML('<img class="rounded-circle" style="height: 100px; margin-left: 35%; width: 100px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function () {
                $('div.gallery').empty();
                imagesPreview(this, 'div.gallery');
            });
        });

    </script>
@endsection
