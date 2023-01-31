@php use App\Http\Services\IdeaSoft\IdeaSoftService;use Illuminate\Support\Facades\Vite; @endphp
@php $categories = (new IdeaSoftService())->getCategories() @endphp
<header id="header">
    <div class="container">
        <div class="row align-items-center align-items-xl-end">
            <div class="order-1 col col-xl-2">
                <div class="logo">
                    <a href="/" aria-label="Logo">
                        <img
                            src="{{ Vite::asset('resources/image/logo.webp') }}"
                            alt="">
                    </a>
                </div>
            </div>
            <div class="order-2 col-xl-5 position-static d-none d-xl-block">
                <div class="header-menu-container">
                    <ul>
                        <li class="navigation-container">
                            <nav id="navigation">
                                <div class="category-level-1">
                                    <ul>
                                        @foreach($categories as $category)
                                            <li class="has-sub-category"
                                                data-selector="first-level-navigation">
                                                <a target="_blank"
                                                   href="{{config("app.base_site_url") . '/kategori/' . $category['slug']}}"
                                                   title="{{$category['name']}}">
                                                    <span>{{$category['name']}}</span>
                                                </a>

                                                @if(isset($category['subCategories']))
                                                    <div class="sub-category category-level-2">
                                                        <div class="row">
                                                            <div class="navigation-banner col-xl-3">
                                                                <div class="banner"><a
                                                                        href="{{ $generalSettings['menu_banner_link'] ?? null }}"
                                                                        data-banner-alt=""><img
                                                                            src="{{ $generalSettings['menu_banner'] ?? null }}"
                                                                            alt=""></a></div>
                                                            </div>
                                                            <div class="col-xl-9">
                                                                <ul>
                                                                    @foreach($category['subCategories'] as $subCategory)
                                                                        <li class="navigation-category-image">
                                                                            <a target="_blank"
                                                                               href="{{config("app.base_site_url") . '/kategori/' . $subCategory['slug']}}"
                                                                               title="{{$subCategory['name']}}">
                                                                                <div>
                                                                                    <img
                                                                                        data-id="{{$subCategory['id']}}"
                                                                                        src="{{$subCategory['imageUrl']}}"
                                                                                        alt="{{$subCategory['name']}}"/>
                                                                                </div>
                                                                                <span>{{$subCategory['name']}}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <ul>

                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </nav>
                        </li>
                        <li class="active">
                            <a href="/">
                                <span>MÜZAYEDELER</span>
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://sergikur.com/">
                                <span>GÜNCEL ETKİNLİKLER</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="order-xl-3 order-4 col-xl-3">
                <div class="search">
                    <form action="{{route('search')}}">
                        <input type="text" name="q" value="{{request()->get('q')}}" placeholder="Eser adı"
                               aria-label="Search"
                               class="auto-complete">
                        <button type="submit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21.779 20.6697L17.1358 16.0364C18.5454 14.3438 19.2482 12.1731 19.098 9.97556C18.9479 7.77807 17.9564 5.72305 16.3297 4.23798C14.703 2.75291 12.5664 1.95213 10.3644 2.00222C8.16232 2.0523 6.06435 2.94938 4.50687 4.50687C2.94938 6.06435 2.0523 8.16233 2.00222 10.3644C1.95213 12.5664 2.75291 14.703 4.23798 16.3297C5.72305 17.9564 7.77807 18.9479 9.97556 19.0981C12.173 19.2482 14.3438 18.5454 16.0363 17.1358L20.6697 21.7692C20.8147 21.9171 21.0123 22.0018 21.2194 22.0048C21.4296 22.0023 21.6304 21.9177 21.779 21.7692C21.9208 21.6213 22 21.4243 22 21.2194C22 21.0146 21.9208 20.8176 21.779 20.6697ZM10.5686 17.5579C8.71617 17.5538 6.94082 16.816 5.63096 15.5062C4.32111 14.1963 3.5834 12.421 3.57925 10.5686C3.5816 8.71652 4.31903 6.94112 5.62956 5.63244C6.94009 4.32375 8.71651 3.58881 10.5686 3.58907C12.421 3.58907 14.1975 4.32493 15.5073 5.63476C16.8171 6.94459 17.553 8.72111 17.553 10.5735C17.553 12.4259 16.8171 14.2024 15.5073 15.5122C14.1975 16.822 12.421 17.5579 10.5686 17.5579Z"
                                    fill="#252525"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="order-xl-4 order-3 col-auto col-xl-2">
                <div class="header-user-buttons">
                    @auth()
                        <div class="header-menu-container d-flex justify-content-end">
                            <ul>
                                <li class="navigation-container">
                                    @include('components.notifications-button')
                                </li>
                                <li class="navigation-container">
                                    <a href="{{ route('profile.edit') }}">
                                        <i class="fas fa-2x fa-user-circle"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                    @guest()
                        <div class="header-user-buttons">
                            <div>
                                <a href="{{route('login')}}">
                                    <svg width="40" height="20" viewBox="0 0 40 20" fill="none">
                                        <path d="M4 16L14 9.99998L4 4L4 16Z" fill="white"/>
                                        <path d="M36 16L26 9.99998L36 4L36 16Z" fill="white"/>
                                    </svg>
                                    <span>{{ __('messages.buy_sell_swap') }}</span>
                                </a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>
@include('components.notifications-modal')
<script>
    var navigationMenu = {
        "settings": {
            "columnWidth": 0,
            "numberOfColumns": 0,
            "leftMargin": 0,
            "menuEffect": "fade",
            "openingEffect": "jswing",
            "closingEffect": "jswing",
            "openingSpeed": 0,
            "closingSpeed": 0,
            "useCategoryImage": 1,
            "hideThirdLevelCategories": 0,
            "thirdLevelCategoryCount": 0
        },
        "categories": {!! json_encode($categories) !!}
    };
</script>
