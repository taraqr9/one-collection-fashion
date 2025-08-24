@extends('user.master')

@section('title')
    {{ config('app.name') }}
@endsection

@section('page_content')
    <!-- breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="{{ route('home') }}"><i class="las la-home"></i></a>
            <a href="#" class="active">Registration</a>
        </div>
    </div>


    <div class="register_wrap section_padding_b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-7 col-md-9">
                    <div class="register_form padding_default shadow_sm">
                        <h4 class="title_2">Create an account</h4>
                        <p class="mb-4 text_md">Register here if you are a new customer.</p>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Full Name <span>*</span></label>
                                        <input type="text" name="name" placeholder="Jone Doe" value="{{ old('name') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Email Address <span>*</span></label>
                                        <input type="email" name="email" placeholder="example@mail.com" value="{{ old('email') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Password <span>*</span></label>
                                        <input type="password" name="password" placeholder="type password" required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single_billing_inp">
                                        <label>Phone <span>*</span></label>
                                        <input type="number" name="phone" placeholder="017********" value="{{ old('phone') }}" required/>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="custom_check check_2 d-flex align-items-center">
                                        <input type="checkbox" class="check_inp" hidden id="save-default" checked/>
                                        <label for="save-default">I have read and agree to the <a href="terms-condition.html" class="text-color">terms & conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="default_btn xs_btn rounded px-4 d-block w-100">
                                        create account
                                    </button>
                                </div>
                            </div>
                        </form>

                        <p class="text-end mt-3 mb-0">Already have an account.?
                            <a href="{{ route('login') }}" class="text-color">Login Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
