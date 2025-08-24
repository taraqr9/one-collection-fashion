@php use App\Enums\SettingKeyEnum;use Illuminate\Support\Facades\Storage; @endphp
    <!-- footer area -->
<footer class="colored">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-md-0">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="footer_logo">
                            <img
                                src="{{ Storage::url(getSettingImages($settings, SettingKeyEnum::Logo->value)['images'][0]) ?? '' }}"
                                alt="logo"/>
                        </div>
                        <div class="footet_text">
                            <p>
                                Lorem ipsum, or lipsum as it is sometimes kno wn, is dummy text used in laying out
                                print, gra phic or web designs the passage.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-md-0">
                <div class="row">
                    <div class="col-6">
                        <div class="footer_menu">
                            <h4 class="footer_title">My Account</h4>
                            <a href="#">Orders</a>
                            <a href="#">Wishlist</a>
                            <a href="#">Track Order</a>
                            <a href="#">Manage Account</a>
                            <a href="#">Return Order</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="footer_menu">
                            <h4 class="footer_title">Information</h4>
                            <a href="#">About Us</a>
                            <a href="#">Return Policy</a>
                            <a href="#">Terms & condition</a>
                            <a href="#">Privacy Policy</a>
                            <a href="#">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer_download">
                    <div class="row">
                        <div class="col-lg-6 col-lg-12">
                            <h4 class="footer_title">Contact</h4>
                            <div class="footer_contact">
                                <p>
                                    <span class="icn"><i class="las la-map-marker-alt"></i></span>
                                    {{ config('app.address') }}
                                </p>
                                <p class="phn">
                                    <span class="icn"><i class="las la-phone"></i></span>
                                    {{ config('app.phone') }}
                                </p>
                                <p class="eml">
                                    <span class="icn"><i class="lar la-envelope"></i></span>
                                    {{ config('app.email') }}
                                </p>
                            </div>
                        </div>
                        <div class="footer_social col-lg-6 col-lg-12">
                            <div class="footer_icon d-flex">
                                <a href="#" class="facebook"><i class="lab la-facebook-f"></i></a>
                                <a href="#" class="twitter"><i class="lab la-twitter"></i></a>
                                <a href="#" class="instagram"><i class="lab la-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- copyright -->
<div class="copyright_wrap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <p class="copyright_text text-center"> &copy; {{ config('app.name') }} - All Right Reserved</p>
            </div>
        </div>
    </div>
</div>
