<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingBannerEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMidBannerRequest;
use App\Http\Requests\Admin\UpdateMidBannerRequest;
use App\Services\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MidBannerController extends Controller
{
    public function __construct(
        protected BannerService $banner
    ) {
    }

    public function index(): View
    {
        view()->share('page', config('app.nav.mid_banner'));

        $banners = $this->banner->get(SettingBannerEnum::MID_BANNER->value);

        return view('admin.setting.mid_banner.index', compact('banners'));
    }

    public function store(StoreMidBannerRequest $request): RedirectResponse
    {
        view()->share('page', config('app.nav.mid_banner'));

        $store = $this->banner->store(SettingBannerEnum::MID_BANNER->value, $request->validated());

        if ($store) {
            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        return redirect()->back()->with('success', 'Banner upload failed!');
    }

    public function update(UpdateMidBannerRequest $request, $index): RedirectResponse
    {
        view()->share('page', config('app.nav.banner'));

        $update = $this->banner->update(SettingBannerEnum::MID_BANNER->value, $request->validated(), $index);

        if ($update) {
            return redirect()->back()->with('success', 'Banner updated successfully!');
        }

        return redirect()->back()->with('error', 'Banner update failed!');
    }

    public function delete($index): RedirectResponse
    {
        $delete = $this->banner->delete(SettingBannerEnum::MID_BANNER->value, $index);

        if ($delete) {
            return redirect()->back()->with('success', 'Banner deleted successfully!');
        }

        return redirect()->back()->with('error', 'Banner delete failed!');
    }
}
