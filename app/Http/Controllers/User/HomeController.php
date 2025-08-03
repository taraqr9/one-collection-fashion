<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = Setting::pluck('value', 'key');

        $top_banners = [];
        $mini_top_banners = [];
        $mini_bottom_banners = [];
        $mid_banners = [];

        if (!empty($settings['top_banner'])) {
            $top_banners = json_decode($settings['top_banner'], true);
        }

        if (!empty($settings['mini_top_banner'])) {
            $mini_top_banners = json_decode($settings['mini_top_banner'], true);
        }

        if (!empty($settings['mini_bottom_banner'])) {
            $mini_bottom_banners = json_decode($settings['mini_bottom_banner'], true);
        }

        if (!empty($settings['mid_banner'])) {
            $mid_banners = json_decode($settings['mid_banner'], true);
        }

        return view('user.home', compact('top_banners', 'mini_top_banners', 'mini_bottom_banners', 'mid_banners'));
    }
}
