@php use Illuminate\Support\Facades\Vite; @endphp
    <!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8"/>
    <title>{{config("app.name")}} | @yield('title')</title>
    @yield('meta')
    <meta name='description' content="{{config("app.name")}}"/>
    <meta name='keywords' content="{{config("app.name")}}"/>
    <meta name='title' content="{{config("app.name")}}"/>

    <meta name="robots" content="noindex, follow" />
    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="nosnippet">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, viewport-fit=cover, user-scalable=no, minimal-ui"/>
    <link rel='canonical' href='{{ config("app.url") }}'/>
    <link rel="alternate" href="{{ config("app.url") }}" hreflang="tr"/>
    <meta name='copyright' content='Copyright © {{date("Y")}} {{config("app.name")}}'/>
    <link rel='icon' href='{{Vite::asset('resources/image/favicon.ico')}}' type='image/x-icon'>
    <link rel='shortcut icon' href='{{Vite::asset('resources/image/favicon.ico')}}' type='image/x-icon'>
    <script type="text/javascript">var visitor = {}, mainCurrency = 'TL', menuItems = [], route = {group: 'default', name: 'entry'};</script>
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/js/notification.js'])
    <link rel='stylesheet' type='text/css' href='//st1.myideasoft.com/7.2.4.8/storefront/assets/css/global.css?revision=7.2.4.8-10' />
    <link rel='stylesheet' type='text/css' href='https://ideacdn.net/idea/lc/38/themes/selftpl_63a0c6bbd7a25/renders/css/theme.css?revision=7.2.7.1-9-1680318920' />
    <script type='text/javascript' src='//st2.myideasoft.com/7.2.4.8/storefront/assets/javascript/vendor/jquery-3.2.1.min.js?revision=7.2.4.8-10'></script>
    <link rel="stylesheet" href="https://s1.digitalfikirler.com/sergikur/assets/css/style.css" />
    <script type="text/javascript" src="https://s1.digitalfikirler.com/sergikur/assets/js/script.js"></script>
</head>
<body class="current-page-@yield('bodyClass', 'default-entry')">
@include('header')
<main id="main">
   @yield('content')
</main>
</body>
@include('footer')
<script type="text/javascript" src="//st.myideasoft.com/idea/lc/38/themes/selftpl_63a0c6bbd7a25/assets/javascript/theme.js?revision=7.2.4.8-10-1674554005"></script>
<script type="text/javascript" src="https://ideacdn.net/idea/lc/38/themes/selftpl_63a0c6bbd7a25/renders/javascript/navigation-menu.js?revision=7.2.7.1-9-1680318920"></script>
<script type="text/javascript" src="https://ideacdn.net/idea/lc/38/themes/selftpl_63a0c6bbd7a25/renders/javascript/lazyload.min.js?revision=7.2.7.1-9-1680318920"></script>
<script type='text/javascript' src='//st2.myideasoft.com/7.2.4.8/storefront/assets/javascript/vendor/combined-base.min.js?revision=7.2.4.8-10'></script>
<script type="text/javascript" src="//st2.myideasoft.com/7.2.4.8/storefront/assets/javascript/layout/default.js?revision=7.2.4.8-10"></script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js"></script>
<script>
    window.isLoggedId = {{auth()->check() ? 'true' : 'false'}};
    window.userId = {{auth()->check() ? auth()->user()->id : 'null'}};
</script>
@yield('js')
</html>
