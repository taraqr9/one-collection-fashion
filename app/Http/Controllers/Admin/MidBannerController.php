<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingBannerEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMidBannerRequest;
use App\Http\Requests\Admin\StoreTopBannerRequest;
use App\Http\Requests\Admin\UpdateMidBannerRequest;
use App\Http\Requests\Admin\UpdateTopBannerRequest;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MidBannerController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.mid_banner'));

        $mid_banners = Setting::query()->where('key', 'mid_banner')->first();
        $mid_banners = $mid_banners ? json_decode($mid_banners->value) : [];

        return view('admin.setting.mid_banner.index', compact('mid_banners'));
    }

    public function store(StoreMidBannerRequest $request): View|RedirectResponse
    {
        view()->share('page', config('app.nav.mid_banner'));

        $mid_banner = Setting::query()->where('key', 'mid_banner')->first();

        if (!$mid_banner) {
            $mid_banner_store_on_local[] = $request->file('mid_banner')->store('/setting/mid_banners', 'public');
            $mid_banner_store = Setting::create([
                'key' => SettingBannerEnum::MID_BANNER->value,
                'value' => json_encode($mid_banner_store_on_local)
            ]);

            if (!$mid_banner_store) {
                return redirect()->back()->with('error', 'Banner upload failed!');
            }

            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        $banners = json_decode($mid_banner->value);
        $banners[] = $request->file('mid_banner')->store('setting/mid_banners', 'public');

        if (!$mid_banner->update(['value' => json_encode($banners)])) {
            return redirect()->back()->with('error', 'Banner upload failed!');
        }

        return redirect()->back()->with('success', 'Banner uploaded successfully!');
    }

    public function update(UpdateMidBannerRequest $request, $banner): View|RedirectResponse
    {
        view()->share('page', config('app.nav.banner'));

        $mid_banners = $this->getBannersDecoded();
        $mid_banners_decoded = $mid_banners['value'];
        $old_image = $mid_banners_decoded[$banner];

        if ($old_image) {
            $store_image = $request->file('mid_banner')->store('setting/mid_banners', 'public');

            if ($store_image) {
                $mid_banners_decoded[$banner] = $store_image;
                $banner_update = $mid_banners->update(['value' => json_encode($mid_banners_decoded)]);

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
        $banners = Setting::query()->where('key', 'mid_banner')->first();
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
