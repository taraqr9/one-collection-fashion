@extends('user.master')

@section('title')
    {{ config('app.name') }} - Profile Update
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="#" class="active">Profile</a>
        </div>
    </div>

    <div class="register_wrap section_padding_b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-7 col-md-9">
                    <div class="register_form padding_default shadow_sm">
                        <h4 class="title_2">Update Profile</h4>
                        <p class="mb-4 text_md">Update your personal information below.</p>

                        <form action="{{ route('users.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" name="name" placeholder="John Doe"
                                               value="{{ old('name', $user->name) }}" required/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Email Address <span>*</span></label>
                                        <input type="email" name="email" placeholder="example@mail.com"
                                               value="{{ old('email', $user->email) }}" required/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Phone <span>*</span></label>
                                        <input type="text" name="phone" placeholder="017********"
                                               value="{{ old('phone', $user->phone) }}" required/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Password </label>
                                        <input type="password" name="password" placeholder="password"/>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="default_btn xs_btn rounded px-4 d-block w-100">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>

                        <p class="text-end mt-3 mb-0">
                            <a href="{{ route('home') }}" class="text-color">Back to Home</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
