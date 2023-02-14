<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GeneralSettingController extends Controller
{
    public function form(): View
    {
        $settings = GeneralSetting::query()->get();

        return view('admin.general-settings.form', [
            'settings' => $settings
        ]);
    }

    public function save(Request $request): RedirectResponse
    {
        $settings = GeneralSetting::query()->whereIn('key', array_keys($request->all()))->get();

        foreach ($settings as $setting) {
            switch ($setting->key) {
                case "footer":
                    $request->request->set($setting->key, preg_replace('/<a href="\/(.+)">/', '<a href="https://sergikurartcenter.com/$1">', $request->input($setting->key)));
                    break;
                case "menu_banner":
                    $request->request->set('menu_banner', sprintf("data:image/png;base64, %s", json_decode($request->get('menu_banner'), true)['data']));
                    break;
                case "homepage_slider":
                    if (count(array_filter($request->get('homepage_slider'))) <= 0) {
                        $request->request->set('homepage_slider', json_encode([]));
                        break;
                    }

                    foreach ($request->get('homepage_slider') as $sliderItem) {
                        $sliderItem = json_decode($sliderItem, true);
                        $homepageSlider[] = sprintf("data:image/png;base64, %s", $sliderItem['data']);
                    }
                    $request->request->set('homepage_slider', json_encode($homepageSlider ?? []));
                    break;
            }

            $setting->value = $request->input($setting->key);
            $setting->save();
        }

        Cache::put('generalSettings', GeneralSetting::all()->pluck('value', 'key')->toArray());

        return redirect()->route('admin.general-settings.edit');
    }
}
