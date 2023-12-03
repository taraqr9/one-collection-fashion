@extends('admin.master')

@section('title')
    Edit Product
@endsection

@section('breadcrumb')
    <a href="{{ url('admin/products/product') }}" class="breadcrumb-item">Product</a>
    <span class="breadcrumb-item active">Edit Product</span>
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
        <form class="tab-content flex-lg-fill" action="{{ url('admin/products/product/'.$product->id.'/edit') }}" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="tab-pane fade active show" id="generalInfo">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Product</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Name <span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name') ?? $product->name }}"
                                       placeholder="Enter name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Size:</label>
                                <input type="text" class="form-control" name="size"
                                       value="{{ old('size') ?? $product->size }}"
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
                                            value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
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
                                <input type="number" class="form-control" name="price"
                                       value="{{ old('price') ?? $product->price }}"
                                       placeholder="Enter price" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Offer Price:</label>
                                <input type="number" class="form-control" name="offer_price"
                                       value="{{ old('offer_price') ?? $product->offer_price }}"
                                       placeholder="Enter old price"
                                       autocomplete="off" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Stock <span class="text-danger">*</span>:</label>
                                <input type="number" class="form-control" name="stock"
                                       value="{{ old('stock') ?? $product->stock }}"
                                       placeholder="Enter stock" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Status:</label>
                                <select name="status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    @foreach(App\Enums\ProductStatusEnum::cases() as $status)
                                        <option value="{{ $status }}"
                                            @selected($status->value == $product->status)
                                        >{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            @isset($product->color)
                            <label class="fw-bold">Colors:</label>
                                @foreach(json_decode($product->color) as $key => $value)
                                    <div class="col-md-2 mt-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ Storage::url($value) }}" alt="color"
                                                 style="width: 100%; height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <a onclick="return confirm('Are you sure?')"
                                                   href="{{ url('admin/products/product/'.$product->id.'/color/'.$key.'/delete') }}"
                                                   class="btn btn-danger btn-sm delete-btn">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>

                        <div class="row">
                            @isset($product->image)
                            <label class="fw-bold">Images:</label>
                                @foreach(json_decode($product->image) as $key => $value)
                                    <div class="col-md-2 mt-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ Storage::url($value) }}" alt="color"
                                                 style="width: 100%; height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <a onclick="return confirm('Are you sure?')"
                                                   href="{{ url('admin/products/product/'.$product->id.'/image/'.$key.'/delete') }}"
                                                   class="btn btn-danger btn-sm delete-btn">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>

                        <div class="row">
                            <label class="fw-bold">Thumbnail:</label>
                            <div class="col-md-2 mt-3">
                                <div class="card">
                                    <img class="card-img-top" src="{{ Storage::url($product->thumbnail) }}" alt="color"
                                         style="width: 100%; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="fw-bold">Color:</label>
                            <input type="file" name="color[]" class="file-input-caption" multiple>
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <label class="fw-bold">Image <span class="text-danger">*</span>:</label>
                            <input type="file" name="image[]" class="file-input-caption" multiple>
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <label class="fw-bold">Thumbnail <span class="text-danger">*</span>:</label>
                            <input type="file" name="thumbnail" class="file-input-caption">
                        </div>
                        <hr>
                        <label class="fw-bold">Description <span class="text-danger">*</span>:</label>
                        <div class="mb-3">
                            <textarea class="form-control" id="ckeditor_classic_empty" name="description"
                                      placeholder="Enter your product description">{!! old('description') ?? $product->description !!}</textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary">Update</button>
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

            // Function to load and select sub-categories based on category_id and parent_id
            function loadAndSelectSubCategories(categoryId, parent_id) {
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
                                subCategorySelect.append('<option value="' + value.id + '" ' + (value.id == parent_id ? 'selected' : '') + '>' + value.name + '</option>');
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
            }

            // Trigger category change event on page load
            $('select[name="category_id"]').change();

            // Event listener for category change
            $('select[name="category_id"]').on('change', function () {
                var categoryId = $(this).val();
                var parent_id = @json($product->parent_id ?? null); // Get existing parent_id

                if (categoryId) {
                    loadAndSelectSubCategories(categoryId, parent_id);
                } else {
                    // If no category selected, disable the Sub Category select
                    subCategorySelect.prop('disabled', true);
                }
            });
        });

    </script>
@endsection
