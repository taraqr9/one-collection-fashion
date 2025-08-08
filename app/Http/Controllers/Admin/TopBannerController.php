<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingBannerEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTopBannerRequest;
use App\Http\Requests\Admin\UpdateTopBannerRequest;
use App\Services\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TopBannerController extends Controller
{
    public function __construct(
        protected BannerService $banner
    ) {}

    public function index(): View
    {
        view()->share('page', config('app.nav.top_banner'));

        $top_banners = $this->banner->get(SettingBannerEnum::TOP_BANNER->value);

        return view('admin.setting.top_banner.index', compact('top_banners'));
    }

    public function store(StoreTopBannerRequest $request): RedirectResponse
    {
        view()->share('page', config('app.nav.top_banner'));

        $store = $this->banner->store(SettingBannerEnum::TOP_BANNER->value, $request->validated());

        if ($store) {
            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        return redirect()->back()->with('success', 'Banner upload failed!');
    }

    public function update(UpdateTopBannerRequest $request, $index): RedirectResponse
    {
        view()->share('page', config('app.nav.banner'));

        $update = $this->banner->update(SettingBannerEnum::TOP_BANNER->value, $request->validated(), $index);

        if ($update) {
            return redirect()->back()->with('success', 'Banner updated successfully!');
        }

        return redirect()->back()->with('error', 'Banner update failed!');
    }

    public function delete($index): RedirectResponse
    {
        $delete = $this->banner->delete(SettingBannerEnum::TOP_BANNER->value, $index);

        if ($delete) {
            return redirect()->back()->with('success', 'Banner deleted successfully!');
        }

        return redirect()->back()->with('error', 'Banner delete failed!');
    }
}
