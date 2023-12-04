<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAndUpdateFooterRequest;
use App\Models\Setting;
use Illuminate\View\View;

class FooterController extends Controller
{
    public function index(): View
    {
        view()->share('page', config('app.nav.footer'));

        return view('admin.setting.footer.index');
    }

    public function create($type): View
    {
        view()->share('page', config('app.nav.footer'));

        $data = Setting::query()->where('key', $type)->first();

        return view('admin.setting.footer.create', compact('type', 'data'));
    }

    public function storeOrUpdate(StoreAndUpdateFooterRequest $request)
    {
        $data = Setting::query()->where('key', $request->type)->first();

        if (! $data) {
            $store = Setting::create([
                'key' => $request->type,
                'value' => $request->data,
            ]);

            if (! $store) {
                return redirect()->back()->with('error', strtoupper(str_replace('_', ' ', $request->type)).' create failed!');
            }

            return redirect()->back()->with('success', strtoupper(str_replace('_', ' ', $request->type)).' create successfully!');
        }

        if (! $data->update(['value' => $request->data])) {
            return redirect()->back()->with('error', strtoupper(str_replace('_', ' ', $request->type)).' update failed!');
        }

        return redirect()->back()->with('success', strtoupper(str_replace('_', ' ', $request->type)).' updated successfully!');
    }

    public function details($type): View
    {
        view()->share('page', config('app.nav.footer'));

        $data = Setting::query()->where('key', $type)->first();

        return view('admin.setting.footer.details', compact('type', 'data'));
    }
}
