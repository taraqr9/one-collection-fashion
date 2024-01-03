<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingBannerEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMiniBottomBannerRequest;
use App\Http\Requests\Admin\UpdateMiniBottomBannerRequest;
use App\Services\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MiniBottomBannerController extends Controller
{
    public function __construct(
        protected BannerService $banner
    ) {
    }

    public function index(): View
    {
        view()->share('page', config('app.nav.mini_bottom_banner'));

        $mini_bottom_banners = $this->banner->get(SettingBannerEnum::MINI_BOTTOM_BANNER->value);

        return view('admin.setting.mini_bottom_banner.index', compact('mini_bottom_banners'));
    }

    public function store(StoreMinibottomBannerRequest $request): RedirectResponse
    {
        view()->share('page', config('app.nav.mini_bottom_banner'));

        $store = $this->banner->store(SettingBannerEnum::MINI_BOTTOM_BANNER->value, $request->validated());

        if ($store) {
            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        return redirect()->back()->with('success', 'Banner upload failed!');
    }

    public function update(UpdateMinibottomBannerRequest $request, $index): RedirectResponse
    {
        view()->share('page', config('app.nav.banner'));

        $update = $this->banner->update(SettingBannerEnum::MINI_BOTTOM_BANNER->value, $request->validated(), $index);

        if ($update) {
            return redirect()->back()->with('success', 'Banner updated successfully!');
        }

        return redirect()->back()->with('error', 'Banner update failed!');
    }

    public function delete($index): RedirectResponse
    {
        $delete = $this->banner->delete(SettingBannerEnum::MINI_BOTTOM_BANNER->value, $index);

        if ($delete) {
            return redirect()->back()->with('success', 'Banner deleted successfully!');
        }

        return redirect()->back()->with('error', 'Banner delete failed!');
    }
}
