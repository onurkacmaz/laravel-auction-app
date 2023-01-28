<?php

namespace App\Http\Services;

use App\Http\Requests\ArtWorkGroupSaveRequest;
use App\Models\ArtWorkGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ArtWorkGroupService
{
    public const GROUPS_CACHE_KEY = 'groups';
    public const GROUP_CACHE_KEY = 'group';

    public function getGroups(): LengthAwarePaginator
    {
        if (Cache::has(self::GROUPS_CACHE_KEY)) {
            return Cache::get(self::GROUPS_CACHE_KEY);
        }

        $groups = ArtWorkGroup::query()->paginate(ArtWorkGroup::PAGINATION_LIMIT);
        Cache::put(self::GROUPS_CACHE_KEY, $groups);

        return $groups;
    }

    public function getGroup(int $id): ArtWorkGroup|Model|null
    {
        if (Cache::has(self::GROUP_CACHE_KEY)) {
            return Cache::get(self::GROUP_CACHE_KEY);
        }

        $group = ArtWorkGroup::query()->where('id', $id)->first();
        Cache::put(self::GROUP_CACHE_KEY, $group);

        return $group;
    }

    public function updateOrCreate(ArtWorkGroupSaveRequest $request, null|int $id = null): ArtWorkGroup|Model
    {
        $group = ArtWorkGroup::query()->updateOrCreate([
            'id' => $id
        ], $request->all());
        Cache::delete(self::GROUP_CACHE_KEY);
        Cache::delete(self::GROUPS_CACHE_KEY);

        return $group;
    }

    public function destroy(int $id): void
    {
        ArtWorkGroup::query()->where('id', $id)->delete();
        Cache::delete(self::GROUP_CACHE_KEY);
        Cache::delete(self::GROUPS_CACHE_KEY);
    }
}
