@php use Illuminate\Support\Facades\Storage; @endphp
@extends('admin.master')

@section('title')
    Top Banner
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Top Banner</span>
@endsection


@section('page_actions')
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
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($top_banners as $key => $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ Storage::url($banner) }}" alt="avatar"
                                             class="img-fluid" style="max-width: 120px;">
                                    </td>
                                    <td>
                                        <a href="#" data-id="{{ $key }}" id="edit_banner_image"
                                           class="btn btn-outline-dark btn-sm" data-bs-toggle="modal"
                                           data-bs-target="#banner_image"
                                           onclick="edit( '{{ $key }}')">
                                            <i class="ph-pencil-line"></i>
                                        </a>

                                        <a onclick="return confirm('Are you sure?')"
                                           href="{{ route("settings.top_banner.delete", $key) }}"
                                           class="btn btn-outline-danger btn-sm">
                                            <i class="ph-minus-circle"></i>
                                        </a>
                                    </td>
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
                            <input id="gallery-photo-add" type="file" class="form-control" name="top_banner">
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

        function edit(banner_image) {
            $('textarea[name="banner_image"]').val(banner_image);
        }

        //Add Banner------
        $('#add_banner_image').click(function (e) {
            $('#banner_form')[0].reset();
            $('.header_change').html('Banner Image');
            $('#banner_form').attr('action', '/admin/settings/top_banner');
        });

        //Edit Banner------
        $(document).on("click", "#edit_banner_image", function () {
            var id = parseInt($(this).attr('data-id'));
            $('.header_change').html(id + 1 + ' Number Banner Image Edit');
            $('#banner_form').attr('action', '/admin/settings/top_banner/' + id + '/edit');
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

