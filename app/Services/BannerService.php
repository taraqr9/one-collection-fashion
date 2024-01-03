<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    public function get($key)
    {
        $banners = Setting::query()->where('key', $key)->first();

        return $banners ? json_decode($banners->value) : [];
    }

    public function store($key, $file): bool
    {
        $banner = Setting::query()->where('key', $key)->first();

        if (! $banner) {
            return $this->storeNewBanner($key, $file);
        }

        $banners = json_decode($banner->value);
        $banners[] = $file[$key]->store('setting/'.$key, 'public');

        if ($banner->update(['value' => json_encode($banners)])) {
            return true;
        }

        return false;
    }

    public function update($key, $file, $index): bool
    {
        $banners = $this->getBannersDecoded($key);
        $banners_decoded = $banners['value'];
        $old_image = $banners_decoded[$index];

        if ($old_image) {
            $store_image = $file[$key]->store('/setting/'.$key, 'public');

            if ($store_image) {
                $banners_decoded[$index] = $store_image;
                $banner_update = $banners->update(['value' => json_encode($banners_decoded)]);

                if ($banner_update) {
                    Storage::delete($old_image);

                    return true;
                }
            }
        }

        return false;
    }

    public function delete($key, $index): bool
    {
        $all_banners = $this->getBannersDecoded($key);
        $banners = $all_banners['value'];

        if (empty($banners[$index])) {
            return false;
        }

        $old_image = $banners[$index];

        array_splice($banners, $index, 1);
        $all_banners['value'] = count($all_banners['value']) > 0 ? json_encode($banners) : [];

        if ($all_banners->update()) {
            Storage::delete($old_image);

            return true;
        }

        return false;
    }

    public function storeNewBanner($key, $file): bool
    {
        $store_path[] = $file[$key]->store('/setting/'.$key, 'public');

        $store = Setting::create([
            'key' => $key,
            'value' => json_encode($store_path),
        ]);

        return $store ? true : false;
    }

    public function getBannersDecoded($key): Model
    {
        $banners = Setting::query()->where('key', $key)->first();
        $banners['value'] = json_decode($banners->value);

        return $banners;
    }
}
