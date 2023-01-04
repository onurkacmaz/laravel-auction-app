@php use Illuminate\Support\Facades\Vite; @endphp
<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name='description' content="" />
    <meta name='keywords' content="" />
    <meta name='title' content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, user-scalable=no, minimal-ui"/>
    <link rel='canonical' href='{{ config("app.url") }}' />
    <link rel="alternate" href="{{ config("app.url") }}" hreflang="tr" />
    <meta name='copyright' content='' />
    <link rel='icon' href='{{ Vite::asset('resources/image/favicon.ico') }}' type='image/x-icon'>
    <link rel='shortcut icon' href='{{ Vite::asset('resources/image/favicon.ico') }}' type='image/x-icon'>
    <script type="text/javascript">
        let mainCurrency = 'TL', client = {"isDesktop": true, "isMobile": false, "isTablet": false, "isIos": 0}, route = {group: 'default', name: 'entry'}
    </script>
    <link rel='stylesheet' type='text/css' href='//st1.myideasoft.com/7.2.4.5/storefront/assets/css/global.css?revision=7.2.4.5-10' />
    <link rel='stylesheet' type='text/css' href='//st2.myideasoft.com/idea/lc/38/themes/selftpl_63a0c6bbd7a25/assets/css/theme.css?revision=7.2.4.5-10-1672415869' />
    <script type='text/javascript' src='//st2.myideasoft.com/7.2.4.5/storefront/assets/javascript/vendor/jquery-3.2.1.min.js?revision=7.2.4.5-10'></script>
    @vite(['resources/js/app.js'])
</head>
<body class="current-page-default-entry">
@include('header')
<main id="main">
    <div class="container">
        <div class="row">
            <section class="col-12">
                @yield('content')
            </section>
        </div>
    </div>
</main>
@include('footer')
<script type="text/javascript" src="//st.myideasoft.com/idea/lc/38/themes/selftpl_63a0c6bbd7a25/assets/javascript/theme.js?revision=7.2.4.5-10-1672415869"></script>
<script type="text/javascript" src="//st3.myideasoft.com/idea/lc/38/themes/selftpl_63a0c6bbd7a25/assets/javascript/navigation-menu.js?revision=7.2.4.5-10-1672415869"></script>
<script type="text/javascript" src="//st.myideasoft.com/idea/lc/38/themes/selftpl_63a0c6bbd7a25/assets/javascript/lazyload.min.js?revision=7.2.4.5-10-1672415869"></script>
<script type='text/javascript' src='//st2.myideasoft.com/7.2.4.5/storefront/assets/javascript/vendor/combined-base.min.js?revision=7.2.4.5-10'></script>
<script type="text/javascript" src="//st2.myideasoft.com/7.2.4.5/storefront/assets/javascript/layout/default.js?revision=7.2.4.5-10"></script>
@yield('scripts')
</body>
</html>
