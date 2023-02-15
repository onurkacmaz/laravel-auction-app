<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingSaveRequest;
use App\Http\Services\SettingService;
use App\Models\LimitSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(): View
    {
        $settings = $this->settingService->getSettings();
        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    public function new(): View
    {
        return view('admin.settings.form', [
            'setting' => new LimitSetting([
                "start_price" => 0,
                "end_price" => 0,
            ])
        ]);
    }

    public function edit(int $id): View
    {
        $setting = $this->settingService->getSetting($id);
        return view('admin.settings.form', [
            'setting' => $setting
        ]);
    }

    public function save(SettingSaveRequest $request, int $id = null): RedirectResponse {
        $setting = $this->settingService->updateOrCreate($request, $id);

        return redirect()->route('admin.settings.edit', [
            'id' => $setting->id
        ])->with('success', 'Kayıt başarıyla kaydedildi.');
    }

    public function destroy(int $id): RedirectResponse {
        $this->settingService->destroy($id);
        return redirect()->route('admin.settings.index')->with('success', 'Kayıt başarıyla silindi.');
    }
}
