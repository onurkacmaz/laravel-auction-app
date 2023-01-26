<?php

namespace App\Http\Services\IdeaSoft;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IdeaSoftService
{
    const AUTH_URL = "https://sergikur.myideasoft.com/admin/user/auth";
    const CATEGORIES_URL = "https://sergikur.myideasoft.com/api/categories";
    const THEMES_URL = "https://sergikur.myideasoft.com/api/themes";
    private IdeaSoftCallService $ideaSoftCallService;

    public function __construct()
    {
        $this->ideaSoftCallService = new IdeaSoftCallService();
    }

    public function authorize(Request $request): RedirectResponse
    {
        if ($request->getQueryString()) {

            if ($request->has('error')) {
                throw new Exception($request->get('error_description'));
            }

            $this->ideaSoftCallService->token(code: $request->get('code'));

            return redirect()->route('home');
        }

        $p = [
            "client_id" => $this->ideaSoftCallService->getClientId(),
            "response_type" => "code",
            "state" => rand(100000, 999999),
            "redirect_uri" => route('ideasoft.authorize'),
        ];
        return redirect(sprintf("%s?%s", self::AUTH_URL, http_build_query($p)));
    }

    public function getCategories(): array {
        if (Cache::has('categories')) {
            return Cache::get('categories');
        }

        try {
            $request = $this->ideaSoftCallService->getClient()->get(self::CATEGORIES_URL, [
                "headers" => [
                    "Authorization" => sprintf("Bearer %s", $this->ideaSoftCallService->getAccessToken())
                ],
                "query" => [
                    "status" => 1,
                ]
            ]);

            $data = json_decode($request->getBody()->getContents(), true);

            if (isset($data['error']) && isset($data['error_description'])) {
                throw new Exception($data['error_description']);
            }

            $data = $this->prepareCategories($data);

            Cache::put('categories', $data);

            return $data;
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function prepareCategories(array $data): array {
        $categories = [];

        foreach ($data as $k => $category) {
            if (!empty($category['parent'])) {
                $parentIndex = array_search($category['parent']['id'], array_column($categories, 'id'), true);

                if ($parentIndex === false) {
                    $categories[] = $category['parent'];
                    $parentIndex = array_search($category['parent']['id'], array_column($categories, 'id'), true);
                }

                $category['subCategories'] = [];
                $category['url'] = sprintf("%s/kategori/%s", config("app.base_site_url"), $category['slug']);
                $category['imageUrl'] = sprintf("https://st.myideasoft.com/idea/lc/38/myassets/categories/%s/%s", $category['id'], $category['imageFile']);

                $categories[$parentIndex]['subCategories'][] = $category;

                usort($categories[$parentIndex]['subCategories'], function ($a, $b) {
                    return $a['sortOrder'] > $b['sortOrder'];
                });
            }else {
                $categories[$k]['url'] = sprintf("%s/kategori/%s", config("app.base_site_url"), $category['slug']);
                $categories[$k]['imageUrl'] = sprintf("https://st.myideasoft.com/idea/lc/38/myassets/categories/%s/%s", $category['id'], $category['imageFile']);
            }
        }

        return array_filter($categories, fn($category) => $category['status']);
    }

    public function getThemeSettings(): array {
        if (Cache::has('themeSettings')) {
            return Cache::get('themeSettings');
        }

        $request = $this->ideaSoftCallService->getClient()->get(sprintf("%s/%s", self::THEMES_URL, config("ideasoft.defaultThemeId")), [
            "headers" => [
                "Authorization" => sprintf("Bearer %s", $this->ideaSoftCallService->getAccessToken())
            ]
        ]);

        $data = json_decode($request->getBody()->getContents(), true);

        Cache::put('themeSettings', $data['attachment']);

        return json_decode($data['attachment'], true);
    }
}
