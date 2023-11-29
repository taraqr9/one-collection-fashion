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
@endsection

@section('page_content')
    <section style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <form method="post" class="col-lg-8 border rounded-xl p-2"
                      action="{{ url('admin/products/product') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Category name"
                                   value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-control" required>
                                <option value="" selected>Select Category</option>
                                @foreach($categories->whereNull('parent_id') as $category)
                                    <option
                                        value="{{ $category->id }}" @selected(old('category') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="sub-category form-group row m-1">
                        <label class="col-sm-2 col-form-label">Sub Category</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control">
                                <option value="" selected>Select Sub Category</option>
                                <!-- Options will be dynamically loaded using Ajax -->
                            </select>
                        </div>
                    </div>
                    <hr class="sub-category">
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" class="form-control" placeholder="Price"
                                   value="{{ old('price') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Offer Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="offer_price" class="form-control" placeholder="Offer price"
                                   value="{{ old('offer_price') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Color</label>
                        <div class="col-sm-10">
                            <input type="file" name="color[]" class="file-input-caption" multiple>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Size</label>
                        <div class="col-sm-10">
                            <input type="text" name="size" class="form-control" placeholder="Enter size like this: M, L, XL"
                                   value="{{ old('size') }}">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            <input type="number" name="stock" class="form-control" placeholder="Stock"
                                   value="{{ old('stock') }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="description" class="form-control" placeholder="Description"
                                      required>
                                {{ old('description') }}
                            </textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row m-1">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image[]" class="file-input-caption" multiple>
                        </div>
                    </div>
                    <hr>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {
            // Cache the Sub Category section
            var subCategorySection = $('.sub-category');

            // Initial hide
            subCategorySection.hide();

            $('select[name="category_id"]').on('change', function () {
                var categoryId = $(this).val();

                if (categoryId) {
                    $.ajax({
                        url: '/admin/products/sub_category/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            var subCategorySelect = $('select[name="parent_id"]');
                            subCategorySelect.empty(); // Clear existing options

                            if (data.length > 0) {
                                // If subcategories are available, show the Sub Category section
                                subCategorySection.show();
                                // Populate and update the Sub Category select as needed
                                $.each(data, function (key, value) {
                                    subCategorySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                                // Hide the sub-category message
                                $('.sub-category-message').hide();
                            } else {
                                // If no subcategories, hide the Sub Category section
                                subCategorySection.hide();
                                // Show the sub-category message
                                $('.sub-category-message').show();
                            }
                        }
                    });
                } else {
                    // If no category selected, hide the Sub Category section
                    subCategorySection.hide();
                }
            });
        });
    </script>
@endsection
