@extends('admin.master')

@section('title')
    Add Product
@endsection

@section('breadcrumb')
    <a href="{{ url('admin/products/product') }}" class="breadcrumb-item">Product</a>
    <span class="breadcrumb-item active">Add Product</span>
@endsection

@section('external_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url()->asset('assets/js/bootstrap/fileinput.min.js') }}"></script>
    <script src="{{ url()->asset('assets/js/bootstrap/uploader_bootstrap.js') }}"></script>
    <script src="{{ url()->asset('assets/js/ckeditor/ckeditor_classic.js') }}"></script>
    <script src="{{ url()->asset('assets/js/ckeditor/editor_ckeditor_classic.js') }}"></script>
@endsection

@section('page_content')
    <div class="d-md-flex align-items-md-start">
        <form class="tab-content flex-lg-fill" action="{{ url('admin/products/product') }}" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="tab-pane fade active show" id="generalInfo">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create Product</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Name <span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       placeholder="Enter name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Size:</label>
                                <input type="text" class="form-control" name="size"
                                       value="{{ old('size') }}"
                                       placeholder="Enter size like this: M, L, XL">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Category <span class="text-danger">*</span>:</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="" selected>Select Category</option>
                                    @foreach($categories->whereNull('parent_id') as $category)
                                        <option
                                            value="{{ $category->id }}" @selected(old('category') == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sub-category col-md-6">
                                <label class="fw-bold">Sub Category:</label>
                                <select name="parent_id" class="form-control">
                                    <option value="" selected>Select Sub Category</option>
                                    <!-- Options will be dynamically loaded using Ajax -->
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Price <span class="text-danger">*</span>:</label>
                                <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                                       placeholder="Enter price" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Old Price:</label>
                                <input type="text" class="form-control" name="old_price" value="{{ old('old_price') }}"
                                       placeholder="Enter old price"
                                       autocomplete="off" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Stock <span class="text-danger">*</span>:</label>
                                <input type="number" class="form-control" name="stock" value="{{ old('stock') }}"
                                       placeholder="Enter stock" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Color:</label>
                                <input type="file" name="color[]" class="file-input-caption" multiple>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Image <span class="text-danger">*</span>:</label>
                                <input type="file" name="image[]" class="file-input-caption" multiple required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Thumbnail <span class="text-danger">*</span>:</label>
                                <input type="file" name="thumbnail" class="file-input-caption" required>
                            </div>
                        </div>
                        <br>
                        <label class="fw-bold">Description <span class="text-danger">*</span>:</label>
                        <div class="mb-3">
                            <textarea class="form-control" id="ckeditor_classic_empty" name="description"
                                      placeholder="Enter your product description">{!! old('description') !!}</textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {
            // Cache the Sub Category section
            var subCategorySelect = $('select[name="parent_id"]');

            // Initial disable
            subCategorySelect.prop('disabled', true);

            $('select[name="category_id"]').on('change', function () {
                var categoryId = $(this).val();

                if (categoryId) {
                    $.ajax({
                        url: '/admin/products/sub_category/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            subCategorySelect.empty(); // Clear existing options

                            if (data.length > 0) {
                                // If subcategories are available, enable and update the Sub Category select
                                subCategorySelect.prop('disabled', false);
                                $.each(data, function (key, value) {
                                    subCategorySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                                // Hide the sub-category message
                                $('.sub-category-message').hide();
                            } else {
                                // If no subcategories, disable the Sub Category select
                                subCategorySelect.prop('disabled', true);
                                // Show the sub-category message
                                $('.sub-category-message').show();
                            }
                        }
                    });
                } else {
                    // If no category selected, disable the Sub Category select
                    subCategorySelect.prop('disabled', true);
                }
            });
        });
    </script>
@endsection
