<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SettingBannerEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMiniBottomBannerRequest;
use App\Http\Requests\Admin\UpdateMiniBottomBannerRequest;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MiniBottomBannerController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.mini_bottom_banner'));

        $mini_bottom_banners = Setting::query()->where('key', 'mini_bottom_banner')->first();
        $mini_bottom_banners = $mini_bottom_banners ? json_decode($mini_bottom_banners->value) : [];

        return view('admin.setting.mini_bottom_banner.index', compact('mini_bottom_banners'));
    }

    public function store(StoreMiniBottomBannerRequest $request): View|RedirectResponse
    {
        $mini_bottom_banner = Setting::query()->where('key', 'mini_bottom_banner')->first();

        if (!$mini_bottom_banner) {
            $mini_bottom_banner_store_on_local[] = $request->file('mini_bottom_banner')->store('/setting/mini_bottom_banners', 'public');
            $mini_bottom_banner_store = Setting::create([
                'key' => SettingBannerEnum::MINI_BOTTOM_BANNER->value,
                'value' => json_encode($mini_bottom_banner_store_on_local)
            ]);

            if (!$mini_bottom_banner_store) {
                return redirect()->back()->with('error', 'Banner upload failed!');
            }

            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        $banners = json_decode($mini_bottom_banner->value);
        $banners[] = $request->file('mini_bottom_banner')->store('setting/mini_bottom_banners', 'public');

        if (!$mini_bottom_banner->update(['value' => json_encode($banners)])) {
            return redirect()->back()->with('error', 'Banner upload failed!');
        }

        return redirect()->back()->with('success', 'Banner uploaded successfully!');
    }

    public function update(UpdateMiniBottomBannerRequest $request, $banner): View|RedirectResponse
    {
        $mini_bottom_banners = $this->getBannersDecoded();
        $mini_bottom_banners_decoded = $mini_bottom_banners['value'];
        $old_image = $mini_bottom_banners_decoded[$banner];

        if ($old_image) {
            $store_image = $request->file('mini_bottom_banner')->store('setting/mini_bottom_banners', 'public');

            if ($store_image) {
                $mini_bottom_banners_decoded[$banner] = $store_image;
                $banner_update = $mini_bottom_banners->update(['value' => json_encode($mini_bottom_banners_decoded)]);

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
        $banners = Setting::query()->where('key', 'mini_bottom_banner')->first();
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
