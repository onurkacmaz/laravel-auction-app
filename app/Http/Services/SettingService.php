<?php

namespace App\Http\Services;

use App\Http\Requests\SettingSaveRequest;
use App\Models\LimitSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public const SETTINGS_CACHE_KEY = 'settings';
    public const SETTING_CACHE_KEY = 'setting';
    public function getSettings(): LengthAwarePaginator
    {
        if (Cache::has(self::SETTINGS_CACHE_KEY)) {
            return Cache::get(self::SETTINGS_CACHE_KEY);
        }

        $settings = LimitSetting::query()->paginate(LimitSetting::PAGINATION_LIMIT);
        Cache::put(self::SETTINGS_CACHE_KEY, $settings);

        return $settings;
    }

    public function getSetting(int $id): LimitSetting|Model|null
    {
        if (Cache::has(sprintf("%s.%s", self::SETTING_CACHE_KEY, $id))) {
            return Cache::get(sprintf("%s.%s", self::SETTING_CACHE_KEY, $id));
        }

        $setting = LimitSetting::query()->where('id', $id)->first();
        Cache::put(sprintf("%s.%s", self::SETTING_CACHE_KEY, $id), $setting);

        return $setting;
    }

    public function updateOrCreate(SettingSaveRequest $request, null|int $id = null): LimitSetting|Model
    {
        $setting = LimitSetting::query()->updateOrCreate([
            'id' => $id
        ], $request->all());
        Cache::delete(sprintf("%s.%s", self::SETTING_CACHE_KEY, $id));
        Cache::delete(self::SETTINGS_CACHE_KEY);

        return $setting;
    }

    public function destroy(int $id): void
    {
        LimitSetting::query()->where('id', $id)->delete();
        Cache::delete(sprintf("%s.%s", self::SETTING_CACHE_KEY, $id));
        Cache::delete(self::SETTINGS_CACHE_KEY);
    }
}
