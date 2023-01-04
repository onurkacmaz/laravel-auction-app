<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController
{
    const CLIENT_ID = "1zp80ickqqyskc8cckw0kcoc84o44k48sk0gcoosw88wck480o";
    const CLIENT_SECRET = "65qa0whmirs4ggc40swk00g0gw0408osko8sswgk4g0o8g40og";
    const AUTH_URL = "http://sergikur.myideasoft.com/admin/user/auth";
    const TOKEN_URL = "http://sergikur.myideasoft.com/oauth/v2/token";

    public function index(): View {
        return view('login');
    }

    public function login(Request $request): RedirectResponse {
        if (!is_null($request->getQueryString())) {
            if ($request->has('error')) {
                return redirect()->route('auth.index')->with('error', $request->get('error_description'));
            }

            $code = $request->get('code');

            $client = new Client([
                'http_errors' => false,
            ]);

            try {
                $request = $client->get(self::TOKEN_URL, [
                    "query" => [
                        "grant_type" => "authorization_code",
                        "client_id" => self::CLIENT_ID,
                        "client_secret" => self::CLIENT_SECRET,
                        "code" => $code,
                        "redirect_uri" => route('auth.authorize')
                    ]
                ]);
                $data = json_decode($request->getBody()->getContents(), true);

                if (isset($data['error']) && isset($data['error_description'])) {
                    return redirect()->route('auth.index')->with('error', $data['error_description']);
                }

                $now = Carbon::now();
                $expiredAt = $now->addSeconds($data['expires_in'])->format("Y-m-d H:i:s");
                session()->put('access_token', $data['access_token']);
                session()->put('expires_in', $data['expires_in']);
                session()->put('scope', $data['scope']);

                redirect()->route('auth.index')->with('success', 'You have successfully logged in!');
            } catch (GuzzleException $e) {
                return redirect()->route('auth.index')->with('error', $e->getMessage());
            }
        }

        $p = [
            "client_id" => self::CLIENT_ID,
            "response_type" => "code",
            "state" => rand(100000, 999999),
            "redirect_uri" => route('auth.authorize'),
        ];

        return redirect(sprintf("%s?%s", self::AUTH_URL, http_build_query($p)));
    }
}
