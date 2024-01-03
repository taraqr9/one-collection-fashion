<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;

class BannerService
{
    public function get($key)
    {
        $banners = Setting::query()->where('key', $key)->first();
        return $banners ? json_decode($banners->value) : [];
    }

    public function store($key, $file): RedirectResponse
    {
        $banner = Setting::query()->where('key', $key)->first();

        if (!$banner) {
            $store_on_local[] = $file->file($key)->store('/setting/' . $key, 'public');
            $store = Setting::create([
                'key' => $key,
                'value' => json_encode($store_on_local),
            ]);

            if (!$store) {
                return redirect()->back()->with('error', 'Banner upload failed!');
            }

            return redirect()->back()->with('success', 'Banner uploaded successfully!');
        }

        $banners = json_decode($banner->value);
        $banners[] = $file->file($key)->store('setting/' . $key, 'public');

        if (!$banner->update(['value' => json_encode($banners)])) {
            return redirect()->back()->with('error', 'Banner upload failed!');
        }

        return redirect()->back()->with('success', 'Banner uploaded successfully!');
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getBannerDecoded()
    {

    }

    public function deleteOldImage()
    {

    }
}
