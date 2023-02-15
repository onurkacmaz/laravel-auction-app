<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtWorkGroupSaveRequest;
use App\Http\Services\ArtWorkGroupService;
use App\Models\ArtWorkGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArtWorkGroupController extends Controller
{

    private ArtWorkGroupService $artWorkGroupService;

    public function __construct(ArtWorkGroupService $artWorkGroupService)
    {
        $this->artWorkGroupService = $artWorkGroupService;
    }

    public function index(): View
    {
        $groups = $this->artWorkGroupService->getGroups();

        return view('admin.artwork-groups.index', [
            'groups' => $groups
        ]);
    }

    public function new(): View
    {
        return view('admin.artwork-groups.form', [
            'group' => new ArtWorkGroup([
                "begin" => 0,
                "end" => 0,
            ])
        ]);
    }

    public function edit(int $id): View
    {
        $group = $this->artWorkGroupService->getGroup($id);
        return view('admin.artwork-groups.form', [
            'group' => $group
        ]);
    }

    public function save(ArtWorkGroupSaveRequest $request, int $id = null): RedirectResponse {
        $group = $this->artWorkGroupService->updateOrCreate($request, $id);

        return redirect()->route('admin.artwork-groups.edit', [
            'id' => $group->id
        ])->with('success', 'Kayıt başarıyla kaydedildi.');
    }

    public function destroy(int $id): RedirectResponse {
        $this->artWorkGroupService->destroy($id);
        return redirect()->route('admin.artwork-groups.index')->with('success', 'Kayıt başarıyla silindi.');
    }
}
