@extends('admin.master')

@section('title')
    Footer
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Footer</span>
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
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="{{ url('admin/settings/footer/about_us/details') }}">About Us</a></td>
                                <td>
                                    <a href="{{ url('admin/settings/footer/about_us/create') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-pencil-line"></i>
                                    </a>
                                    <a href="{{ url('admin/settings/footer/about_us/details') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td><a href="{{ url('admin/settings/footer/return_policy/details') }}">Return Policy</a></td>
                                <td>
                                    <a href="{{ url('admin/settings/footer/return_policy/create') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-pencil-line"></i>
                                    </a>
                                    <a href="{{ url('admin/settings/footer/return_policy/details') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td><a href="{{ url('admin/settings/footer/term_and_conditions/details') }}">Terms & Conditions</a></td>
                                <td>
                                    <a href="{{ url('admin/settings/footer/term_and_conditions/create') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-pencil-line"></i>
                                    </a>
                                    <a href="{{ url('admin/settings/footer/term_and_conditions/details') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td><a href="{{ url('admin/settings/footer/privacy_and_policy/details') }}">Privacy & Policy</a></td>
                                <td>
                                    <a href="{{ url('admin/settings/footer/privacy_and_policy/create') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-pencil-line"></i>
                                    </a>
                                    <a href="{{ url('admin/settings/footer/privacy_and_policy/details') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td><a href="{{ url('admin/settings/footer/faq/details') }}">FAQ</a></td>
                                <td>
                                    <a href="{{ url('admin/settings/footer/faq/create') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-pencil-line"></i>
                                    </a>
                                    <a href="{{ url('admin/settings/footer/faq/details') }}"
                                       class="btn btn-outline-dark btn-sm">
                                        <i class="ph-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
