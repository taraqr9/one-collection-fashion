<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingBannerEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTopBannerRequest;
use App\Http\Requests\Admin\UpdateTopBannerRequest;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TopBannerController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.top_banner'));

        $top_banners = Setting::query()->where('key', 'top_banner')->first();
        $top_banners = $top_banners ? json_decode($top_banners->value) : [];

        return view('admin.setting.top_banner.index', compact('top_banners'));
    }

    public function create(): View
    {
        view()->share('page', config('app.nav.top_banner'));

        return view('admin.setting.top_banner.create');
    }

    public function store(StoreTopBannerRequest $request): View|RedirectResponse
    {
        view()->share('page', config('app.nav.top_banner'));

        $top_banner = Setting::query()->where('key', 'top_banner')->first();

        if (!$top_banner) {
            $top_banner_store_on_local[] = $request->file('top_banner')->store('/setting/top_banners', 'public');
            $top_banner_store = Setting::create([
                'key' => SettingBannerEnum::TOP_BANNER->value,
                'value' => json_encode($top_banner_store_on_local)
            ]);

            if (!$top_banner_store) {
                return redirect()->back()->with('error', 'Banner upload failed!');
            }

            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        $banners = json_decode($top_banner->value);
        $banners[] = $request->file('top_banner')->store('setting/top_banners', 'public');

        if (!$top_banner->update(['value' => json_encode($banners)])) {
            return redirect()->back()->with('error', 'Banner upload failed!');
        }

        return redirect()->back()->with('success', 'Banner uploaded successfully!');
    }

    public function update(UpdateTopBannerRequest $request, $banner): View|RedirectResponse
    {
        view()->share('page', config('app.nav.banner'));

        $top_banners = $this->getBannersDecoded();
        $top_banners_decoded = $top_banners['value'];
        $old_image = $top_banners_decoded[$banner];

        if ($old_image) {
            $store_image = $request->file('top_banner')->store('setting/top_banners', 'public');

            if ($store_image) {
                $top_banners_decoded[$banner] = $store_image;
                $banner_update = $top_banners->update(['value' => json_encode($top_banners_decoded)]);

                if ($banner_update) {
                    $this->deleteOldImage($old_image);
                    return redirect()->back()->with('success', 'Banner updated successfully!');
                }
            }
        }

        return redirect()->back()->with('error', 'Banner update failed!');
    }

    public function delete($banner): RedirectResponse
    {
        $all_banners = $this->getBannersDecoded();
        $banners = $all_banners['value'];
        $old_image = $banners[$banner];

        array_splice($banners, $banner, 1);
        $all_banners['value'] = count($all_banners['value']) > 0 ? json_encode($banners) : [];


        if ($all_banners->update()) {
            $this->deleteOldImage($old_image);
            return redirect()->back()->with('success', 'Banner deleted successfully!');
        }

        return redirect()->back()->with('error', 'Banner delete failed!');
    }

    public function getBannersDecoded(): Model|array
    {
        $banners = Setting::query()->where('key', 'top_banner')->first();
        $banners['value'] = json_decode($banners->value);

        return $banners;
    }


    private function deleteOldImage($oldImage): void
    {
        if ($oldImage) {
            Storage::delete($oldImage);
        }
    }
}
