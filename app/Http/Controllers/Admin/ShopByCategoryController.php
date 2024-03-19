<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BannerService;
use Illuminate\View\View;

class ShopByCategoryController extends Controller
{
    public function __construct(
        protected BannerService $banner
    ) {
    }

    public function index(): View
    {
        view()->share('page', config('app.nav.mini_bottom_banner'));

        return view('admin.setting.shop_by_category.index');
    }


}
