@php use Illuminate\Support\Facades\Vite;use Illuminate\Support\Str; @endphp
@extends('base')

@section('title', $artWork->title)
@section('bodyClass', 'product-detail')

@section('content')
    <section>
        <div id="product-detail-container">
            <div class="container">
                <div id="breadcrumbs">
                    <ol vocab="http://schema.org/" typeof="BreadcrumbList">
                        <li property="itemListElement" typeof="ListItem">
                            <a property="item" typeof="WebPage" href="/">
                <span property="name">
                    <span>Anasayfa</span>
                </span>
                            </a>
                            <meta property="position" content="1">
                        </li>
                        <li property="itemListElement" typeof="ListItem">
                            <a property="item" typeof="WebPage" href="/kategori/painting">
                    <span property="name">
                        <i></i>
                        <span>Temalar</span>
                    </span>
                            </a>
                            <meta property="position" content="2">
                        </li>
                        <li>
            <span>
                <i></i>
                <span>Baskı 1</span>
            </span>
                        </li>
                    </ol>
                </div>
                <div class="product-area-top">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-left position-relative">
                                <div class="product-image">
                                    <div id="product-primary-image" class="pswp-gallery">
                                        @foreach($artWork->images as $key => $image)
                                            <a href="{{ $image->path }}" data-pswp-width="800" data-pswp-height="600" class="{{!$loop->first ? 'hidden' : null}} p-{{$key}}">
                                                <img id="primary-image" src="{{ $image->path }}" alt="{{ $artWork->title }}" />
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="product-thumb-image" class="grid grid-cols-4 lg:grid-cols-6 gap-4 !h-auto">
                                    @foreach($artWork->images as $key => $image)
                                        <a href="{{$key}}">
                                            <img src="{{$image->path}}" alt="">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-detail-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mb-5 mb-lg-0">
                                        <div class="title-area custom-title">ESER HAKKINDA</div>
                                        <div class="text-area">{!! $artWork->description !!}</div>
                                    </div>
                                    <div class="col-lg-6 mb-5 mb-lg-0">
                                        <div class="title-area">SANATÇI HAKKINDA</div>
                                        <div class="text-area">{!! $artWork->artist->bio !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-5 offset-xl-1">
                            <div class="product-right">
                                <div class="product-box-1">
                                    <div>
                                        <div class="product-brand">
                                            <a href="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}">{{ $artWork->title }}</a>
                                        </div>
                                        <div class="product-title mt-2">
                                            <a href="{{ route('artists.show', ['id' => $artWork->artist->id]) }}">
                                                <h1>{{ $artWork->auction->name }}</h1></a>
                                        </div>
                                        <div class="product-market-price mt-4">
                                            {{ Str::currency($artWork->estimated_market_price) }}
                                        </div>
                                    </div>
                                    <div id="product-user-buttons">
                                        <div class="group">
                                            <a href="javascript:void(0);"
                                               class="add-my-favorites favorite-product"
                                               data-selector="add-my-favorites"
                                               data-product-id="{{ $artWork->id }}"
                                               aria-label="Add To Favorites">
                                                <i class="far fa-heart fa-2x group-hover:fa"></i>
                                            </a>
                                        </div>
                                        <div class="product-social">
                                            <a href="javascript:void(0);" class="openbox"
                                               data-target="product-social-content" class="product-social-icon">
                                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                                    <path
                                                        d="M26.7143 22.4286C25.2966 22.4286 24.0473 23.1284 23.2667 24.192L19.3664 22.2414C19.4872 21.8458 19.5714 21.4345 19.5714 21C19.5714 20.5654 19.4872 20.1541 19.3664 19.7585L23.2667 17.8079C24.0473 18.8716 25.2966 19.5714 26.7143 19.5714C29.0776 19.5714 31 17.6489 31 15.2857C31 12.9224 29.0776 11 26.7143 11C24.351 11 22.4286 12.9224 22.4286 15.2857C22.4286 15.7203 22.5129 16.1316 22.6337 16.5271L18.7332 18.4778C17.9527 17.4141 16.7034 16.7143 15.2857 16.7143C12.9224 16.7143 11 18.6367 11 21C11 23.3633 12.9224 25.2857 15.2857 25.2857C16.7034 25.2857 17.9527 24.5859 18.7333 23.5223L22.6336 25.4729C22.5128 25.8684 22.4286 26.2797 22.4286 26.7143C22.4286 29.0776 24.351 31 26.7143 31C29.0776 31 31 29.0776 31 26.7143C31 24.3511 29.0776 22.4286 26.7143 22.4286V22.4286ZM26.7143 12.4286C28.2901 12.4286 29.5714 13.7107 29.5714 15.2857C29.5714 16.8608 28.29 18.1428 26.7143 18.1428C25.1385 18.1428 23.8572 16.8607 23.8572 15.2857C23.8572 13.7107 25.1385 12.4286 26.7143 12.4286ZM15.2857 23.8572C13.7099 23.8572 12.4286 22.575 12.4286 21C12.4286 19.425 13.71 18.1429 15.2857 18.1429C16.8615 18.1429 18.1428 19.425 18.1428 21C18.1428 22.575 16.8615 23.8572 15.2857 23.8572V23.8572ZM26.7143 29.5714C25.1385 29.5714 23.8572 28.2893 23.8572 26.7143C23.8572 25.1393 25.1385 23.8572 26.7143 23.8572C28.2901 23.8572 29.5714 25.1393 29.5714 26.7143C29.5714 28.2894 28.2901 29.5714 26.7143 29.5714Z"
                                                        fill="#252525"/>
                                                </svg>
                                            </a>
                                            <div class="product-social-content openbox-content">
                                                <div>
                                                    <div>
                                                        <a href="javascript:void(0);"
                                                           class="product-social-facebook"
                                                           data-selector="share-link" data-type="facebook">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                 fill="none">
                                                                <path
                                                                    d="M7.812 4.487V6.965H6V10H7.816V19H11.546V10H14.046C14.046 10 14.28 8.547 14.394 6.958H11.557V4.882C11.5911 4.68787 11.6893 4.5108 11.836 4.37916C11.9827 4.24752 12.1693 4.16894 12.366 4.156H14.4V1H11.637C7.719 1 7.812 4.034 7.812 4.487Z"
                                                                    fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);"
                                                           class="product-social-twitter"
                                                           data-selector="share-link" data-type="twitter">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                 fill="none">
                                                                <path
                                                                    d="M18.231 4.65668C17.583 4.93939 16.8976 5.12732 16.196 5.21468C16.9354 4.77608 17.4883 4.08158 17.75 3.26268C17.0576 3.67333 16.3 3.9625 15.51 4.11768C15.0257 3.60056 14.3971 3.24103 13.7058 3.08581C13.0146 2.93059 12.2926 2.98685 11.6337 3.24727C10.9748 3.5077 10.4095 3.96026 10.0111 4.54615C9.6128 5.13205 9.39986 5.8242 9.4 6.53268C9.39723 6.80356 9.42474 7.07391 9.482 7.33868C8.07656 7.26979 6.70149 6.90506 5.44666 6.26834C4.19183 5.63162 3.08551 4.73725 2.2 3.64368C1.7454 4.42082 1.60464 5.34219 1.80648 6.21961C2.00832 7.09703 2.53752 7.8643 3.286 8.36468C2.72546 8.35036 2.17663 8.20114 1.686 7.92968V7.96868C1.68701 8.78434 1.96895 9.57476 2.48438 10.2069C2.9998 10.8391 3.71725 11.2744 4.516 11.4397C4.21384 11.5192 3.90244 11.5582 3.59 11.5557C3.36549 11.5598 3.14119 11.5397 2.921 11.4957C3.1492 12.1967 3.58905 12.8097 4.18002 13.2504C4.77099 13.6912 5.48403 13.9379 6.221 13.9567C4.97052 14.9345 3.42841 15.4651 1.841 15.4637C1.55991 15.4652 1.27901 15.4489 1 15.4147C2.61528 16.4554 4.49748 17.006 6.419 16.9997C7.7417 17.0089 9.05304 16.7551 10.2769 16.2532C11.5007 15.7513 12.6126 15.0113 13.548 14.0761C14.4834 13.1409 15.2237 12.0291 15.7258 10.8054C16.2279 9.58167 16.4819 8.27038 16.473 6.94768C16.473 6.79168 16.468 6.64068 16.46 6.49068C17.1569 5.99211 17.7571 5.37061 18.231 4.65668Z"
                                                                    fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);"
                                                           class="product-social-pinterest"
                                                           data-selector="share-link" data-type="pinterest">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                 fill="none">
                                                                <path
                                                                    d="M10.561 2C5.628 2 3 5.161 3 8.609C3 10.209 3.893 12.201 5.323 12.834C5.54 12.934 5.658 12.89 5.707 12.689C5.75 12.536 5.938 11.799 6.029 11.451C6.04522 11.3967 6.04663 11.3391 6.0331 11.284C6.01956 11.229 5.99156 11.1786 5.952 11.138C5.40251 10.4247 5.1031 9.55039 5.1 8.65C5.11346 7.99513 5.25947 7.34978 5.5292 6.75289C5.79893 6.156 6.18679 5.61994 6.66938 5.17707C7.15197 4.73419 7.71929 4.39368 8.33709 4.17609C8.9549 3.95849 9.61039 3.86831 10.264 3.911C13.077 3.911 15.044 5.738 15.044 8.352C15.044 11.305 13.481 13.352 11.451 13.352C11.1978 13.3732 10.9432 13.3341 10.7081 13.2379C10.4729 13.1418 10.2639 12.9913 10.098 12.7989C9.93221 12.6064 9.81431 12.3774 9.75399 12.1306C9.69367 11.8838 9.69264 11.6263 9.751 11.379C10.1736 10.1979 10.4915 8.98185 10.701 7.745C10.7205 7.5462 10.6973 7.34552 10.6329 7.15644C10.5684 6.96736 10.4643 6.79426 10.3274 6.64876C10.1905 6.50327 10.0241 6.38875 9.83931 6.3129C9.65451 6.23705 9.45562 6.20162 9.256 6.209C8.112 6.209 7.184 7.342 7.184 8.863C7.17716 9.42129 7.29395 9.97417 7.526 10.482C7.526 10.482 6.4 15.051 6.192 15.9C5.99963 17.2248 6.02768 18.5723 6.275 19.888C6.27764 19.9121 6.28756 19.9348 6.30345 19.9531C6.31934 19.9714 6.34044 19.9844 6.36393 19.9904C6.38742 19.9964 6.41217 19.995 6.43488 19.9866C6.45758 19.9781 6.47717 19.9629 6.491 19.943C7.27365 18.8666 7.90081 17.6853 8.354 16.434C8.494 15.92 9.066 13.834 9.066 13.834C9.3684 14.2405 9.76553 14.5669 10.2228 14.785C10.6802 15.003 11.1838 15.106 11.69 15.085C15.137 15.085 17.628 12.055 17.628 8.295C17.616 4.7 14.531 2 10.561 2Z"
                                                                    fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);"
                                                           class="product-social-whatsapp"
                                                           data-selector="share-link" data-type="whatsapp">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                 fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M16.377 3.61331C15.1243 2.36619 13.531 1.51696 11.7973 1.17224C10.0636 0.827523 8.26663 1.00268 6.63211 1.67572C4.99759 2.34876 3.59833 3.48968 2.61001 4.95524C1.62169 6.4208 1.08837 8.14568 1.077 9.91331C1.07636 11.4795 1.49039 13.018 2.277 14.3723L1 18.9973L5.75 17.7573C7.06504 18.4701 8.5372 18.8434 10.033 18.8433C12.4041 18.8468 14.6798 17.9096 16.3608 16.2374C18.0419 14.5651 18.991 12.2944 19 9.92331C19.0032 8.75013 18.773 7.58803 18.3226 6.50471C17.8723 5.42139 17.2109 4.43851 16.377 3.61331ZM10.038 17.3363C8.70477 17.3366 7.39579 16.9799 6.247 16.3033L5.975 16.1423L3.15 16.8783L3.903 14.1423L3.726 13.8623C3.0182 12.7379 2.62568 11.444 2.58952 10.1159C2.55337 8.78777 2.8749 7.47436 3.52048 6.31315C4.16605 5.15194 5.11191 4.18563 6.25905 3.51537C7.40619 2.84511 8.71242 2.49556 10.041 2.50331C11.0149 2.50331 11.9794 2.69514 12.8792 3.06786C13.779 3.44057 14.5966 3.98687 15.2853 4.67555C15.9739 5.36424 16.5202 6.18183 16.893 7.08164C17.2657 7.98145 17.4575 8.94586 17.4575 9.91981C17.4575 10.8938 17.2657 11.8582 16.893 12.758C16.5202 13.6578 15.9739 14.4754 15.2853 15.1641C14.5966 15.8528 13.779 16.399 12.8792 16.7718C11.9794 17.1445 11.0149 17.3363 10.041 17.3363H10.038ZM14.124 11.7843C13.9 11.6723 12.799 11.1333 12.594 11.0593C12.389 10.9853 12.239 10.9483 12.094 11.1713C11.949 11.3943 11.516 11.8963 11.385 12.0453C11.254 12.1943 11.124 12.2123 10.9 12.1013C10.2385 11.8409 9.62734 11.4674 9.094 10.9973C8.60511 10.546 8.18588 10.0247 7.85 9.45031C7.72 9.22731 7.85 9.11831 7.95 8.99531C8.15548 8.75569 8.34267 8.50097 8.51 8.23331C8.53969 8.1719 8.5535 8.10402 8.55018 8.03589C8.54686 7.96776 8.52652 7.90155 8.491 7.84331C8.435 7.73131 7.991 6.63531 7.801 6.18831C7.611 5.74131 7.435 5.81231 7.301 5.80531C7.167 5.79831 7.014 5.79731 6.865 5.79731C6.75114 5.79983 6.63903 5.82592 6.53576 5.87394C6.43249 5.92196 6.3403 5.99087 6.265 6.07631C6.01234 6.3147 5.81213 6.60314 5.67714 6.92321C5.54216 7.24329 5.47535 7.58798 5.481 7.93531C5.55417 8.77638 5.87189 9.57765 6.395 10.2403C7.35711 11.6746 8.67556 12.8342 10.221 13.6053C10.6381 13.7844 11.0643 13.9413 11.498 14.0753C11.9549 14.2134 12.4375 14.2435 12.908 14.1633C13.2194 14.1003 13.5145 13.9736 13.7747 13.7912C14.0349 13.6088 14.2546 13.3746 14.42 13.1033C14.5664 12.7704 14.6116 12.4017 14.55 12.0433C14.497 11.9513 14.35 11.8973 14.124 11.7843Z"
                                                                      fill="white"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-short-details">
                                    {{ $artWork->artist->name }}
                                </div>
                                <div class="product-price">
                                    <div class="product-price-new a{{$artWork->id}}">
                                        {{ Str::currency($artWork->end_price) }}
                                    </div>
                                </div>
                                <div class="product-cart-buttons">
                                    <div class="product-buttons-wrapper">
                                        <div class="product-buttons-row">
                                            <div class="form-modal flex flex-row">
                                                <input type="number" min="{{ $artWork->end_price }}"
                                                       class="p-4 text-2xl rounded-tl-lg rounded-bl-lg border-r-0 w-full"
                                                       placeholder="Pey">
                                                <a href="#" data-id="{{$artWork->id}}"
                                                   class="bidding !w-1/2 p-4 bg-[#333] text-center rounded-lg !rounded-tl-none !rounded-bl-none ">
                                                    <span class="text-white font-bold text-2xl">
                                                        Pey Ver
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-button-box">
                                    <a href="#">
                                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                                            <path
                                                d="M34.0423 24.5205L34.0851 24.5885L34.1607 24.5613C34.6129 24.3991 35.0995 24.3102 35.6069 24.3102C37.975 24.3102 39.9015 26.2369 39.9015 28.605C39.9015 30.9731 37.9747 32.9 35.6066 32.9C33.2385 32.9 31.3116 30.9731 31.3116 28.605C31.3116 27.5406 31.7018 26.5661 32.3456 25.8148L32.3935 25.7588L32.3543 25.6965L30.2 22.273L30.1521 22.1968L30.0714 22.2364C29.1543 22.6861 28.1243 22.9395 27.0358 22.9395C25.5307 22.9395 24.1374 22.455 23.0004 21.6357L22.9312 21.5858L22.871 21.6463L18.6424 25.9016L18.59 25.9543L18.6254 26.0197C18.9185 26.5611 19.0851 27.1804 19.0851 27.8382C19.0851 29.9518 17.3654 31.6715 15.2519 31.6715C13.1383 31.6715 11.4186 29.9518 11.4186 27.8382C11.4186 27.1723 11.5895 26.5459 11.8893 25.9998L11.9246 25.9356L11.8741 25.8827L9.19491 23.0721L9.14618 23.021L9.08171 23.0498C8.46429 23.3259 7.78141 23.4807 7.06259 23.4807C4.32518 23.4807 2.09805 21.2534 2.09805 18.516C2.09805 15.7786 4.3253 13.5513 7.06271 13.5513C9.80013 13.5513 12.0274 15.7786 12.0274 18.516C12.0274 19.7317 11.5874 20.8461 10.8591 21.7103L10.8013 21.7789L10.8632 21.8438L13.3336 24.4354L13.3861 24.4904L13.4531 24.4546C13.9899 24.1679 14.6021 24.0049 15.252 24.0049C15.9103 24.0049 16.53 24.1717 17.0718 24.4652L17.1376 24.5008L17.1903 24.4478L21.4172 20.1943L21.4771 20.1341L21.4273 20.0652C20.6036 18.9264 20.1163 17.5294 20.1163 16.0198C20.1163 12.2043 23.2205 9.1 27.036 9.1C30.8515 9.1 33.9558 12.2043 33.9558 16.0198C33.9558 17.947 33.1632 19.6918 31.8872 20.948L31.8299 21.0045L31.8727 21.0725L34.0423 24.5205ZM27.0359 11.1549C24.3532 11.1549 22.171 13.3371 22.171 16.0198C22.171 18.7023 24.3532 20.8846 27.0359 20.8846C29.7185 20.8846 31.9008 18.7024 31.9008 16.0198C31.9008 13.3371 29.7185 11.1549 27.0359 11.1549ZM13.4735 27.8382C13.4735 28.8188 14.2711 29.6166 15.2519 29.6166C16.2326 29.6166 17.0302 28.8188 17.0302 27.8382C17.0302 26.8576 16.2325 26.0599 15.2519 26.0599C14.2713 26.0599 13.4735 26.8576 13.4735 27.8382ZM7.06259 15.6062C5.45814 15.6062 4.15291 16.9114 4.15291 18.516C4.15291 20.1206 5.45801 21.4258 7.06259 21.4258C8.66715 21.4258 9.97239 20.1206 9.97239 18.516C9.97239 16.9114 8.66703 15.6062 7.06259 15.6062ZM33.3667 28.605C33.3667 29.8403 34.3716 30.8451 35.6069 30.8451C36.842 30.8451 37.8468 29.8403 37.8468 28.605C37.8468 27.3697 36.8421 26.3649 35.6069 26.3649C34.3716 26.3649 33.3667 27.3697 33.3667 28.605Z"
                                                fill="#252525" stroke="white" stroke-width="0.2"/>
                                        </svg>
                                        <div>
                                            <div class="title">SERGİKUR GÜVENCESİ İLE AL / SAT</div>
                                            <div class="text">Nodio euismod lacinia at quis risus. Massa id
                                                neque.Vestibulum<br/>morbi
                                                blandit cursus. Sed turpis tincidunt id.
                                            </div>
                                            <div class="other-text">
                                                <div>KDV: TRY 2,500</div>
                                                <div>Komisyon: TRY 2,500</div>
                                                <div>Toplam Fiyat: <b>TRY 5,000</b></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="product-banners">
                                    <div class="product-banners-title">
                                        <div><img
                                                src="{{Vite::asset('resources/image/uploads/product_banners_image.png')}}"
                                                alt=""/></div>
                                        <a target="_blank"
                                           href="https://www.sergikurartcenter.com/Hizmet-Destek-Talep-Formu,DFO-3.html">
                                            <span>için tıklayınız</span>
                                            <i>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M23.7938 19.8166L19.7387 15.7615L21.7275 13.7728C21.8998 13.6005 21.9706 13.3513 21.9146 13.1141C21.8586 12.8769 21.6838 12.6856 21.4526 12.6086L9.52024 8.63108C9.26763 8.54685 8.98901 8.61261 8.80071 8.80095C8.61237 8.9893 8.5466 9.26783 8.63084 9.52049L12.6083 21.4529C12.6854 21.6841 12.8767 21.8589 13.1138 21.9149C13.351 21.971 13.6002 21.9001 13.7726 21.7278L15.7613 19.739L19.8164 23.7941C19.9537 23.9314 20.1336 24 20.3135 24C20.4934 24 20.6734 23.9314 20.8107 23.7941L23.7938 20.8109C24.0684 20.5363 24.0684 20.0912 23.7938 19.8166ZM20.3135 22.3025L16.2584 18.2475C15.9839 17.9729 15.5386 17.9729 15.2641 18.2475L13.5826 19.9289L10.4096 10.4099L19.9286 13.5829L18.2472 15.2644C17.9728 15.5387 17.9726 15.9842 18.2472 16.2587L22.3023 20.3138L20.3135 22.3025Z"
                                                        fill="#A40017"/>
                                                    <path
                                                        d="M9.14062 5.625C9.52894 5.625 9.84375 5.31019 9.84375 4.92188V0.703125C9.84375 0.314812 9.52894 0 9.14062 0C8.75231 0 8.4375 0.314812 8.4375 0.703125V4.92188C8.4375 5.31019 8.75231 5.625 9.14062 5.625Z"
                                                        fill="#A40017"/>
                                                    <path
                                                        d="M3.67198 2.6772C3.39744 2.4026 2.95222 2.4026 2.67762 2.6772C2.40303 2.95179 2.40303 3.39696 2.67762 3.67156L5.66075 6.65468C5.9353 6.92928 6.38056 6.92928 6.65511 6.65468C6.9297 6.38009 6.9297 5.93492 6.65511 5.66032L3.67198 2.6772Z"
                                                        fill="#A40017"/>
                                                    <path
                                                        d="M5.66075 11.6265L2.67762 14.6097C2.40303 14.8843 2.40303 15.3294 2.67762 15.604C2.95217 15.8786 3.39744 15.8786 3.67198 15.604L6.65511 12.6209C6.9297 12.3463 6.9297 11.9011 6.65511 11.6265C6.38052 11.3519 5.9353 11.3519 5.66075 11.6265Z"
                                                        fill="#A40017"/>
                                                    <path
                                                        d="M12.6212 6.65468L15.6043 3.67156C15.8789 3.39696 15.8789 2.95179 15.6043 2.6772C15.3298 2.4026 14.8846 2.4026 14.61 2.6772L11.6268 5.66032C11.3523 5.93492 11.3523 6.38009 11.6268 6.65468C11.9014 6.92928 12.3467 6.92928 12.6212 6.65468Z"
                                                        fill="#A40017"/>
                                                    <path
                                                        d="M5.625 9.14062C5.625 8.75231 5.31019 8.4375 4.92188 8.4375H0.703125C0.314812 8.4375 0 8.75231 0 9.14062C0 9.52894 0.314812 9.84375 0.703125 9.84375H4.92188C5.31019 9.84375 5.625 9.52894 5.625 9.14062Z"
                                                        fill="#A40017"/>
                                                </svg>
                                            </i>
                                        </a>
                                    </div>
                                    <div class="product-banner">
                                        <div class="product-banner-img">
                                            <img
                                                src="{{Vite::asset('resources/image/uploads/product_banner_image_1.png')}}"
                                                alt="">
                                        </div>
                                        <div class="product-banner-content">
                                            <div class="product-banner-title">TAŞIMA</div>
                                            <div class="product-banner-sub-title">
                                                <div>Eserleriniz şehir içinde ve şehirler arası mesafelerde,
                                                    alanında uzman, profesyonel çalışanlarımız tarafından özenle
                                                    paketlenip taşınmaktadır. Sanat eserinin hassasiyetle
                                                    taşınabilmesi için gerekli ambaljlama yöntemi uzmanlarımız
                                                    tarafından belirlenip, gerekli işlemler tamamlandıktan ve
                                                    eserin etiketlemesi gerçekleştikten sonra teslimat noktasına
                                                    ulaştırılmaktadır. Şehir içi teslimatlar maksimum 7 gün
                                                    içerisinde, şehirler arası teslimatlar maksimum 14 gün
                                                    içerisinde gerçekleşmektedir. Uluslararası gönderileriniz
                                                    için de yukarıdaki link üzerinden veya mail yoluyla
                                                    ekibimize ulaşarak bilgi alabilirsiniz. Sergikur
                                                    hizmetlerine ilişkin teklif ve bilgi alabileceğiniz mail
                                                    adresi: info@sergikur.com.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-banner">
                                        <div class="product-banner-img">
                                            <img

                                                src="{{Vite::asset('resources/image/uploads/product_banner_image_2.png')}}"
                                                alt="">
                                        </div>
                                        <div class="product-banner-content">
                                            <div class="product-banner-title">DEPOLAMA</div>
                                            <div class="product-banner-sub-title">
                                                <div>Değerli eserlerinizi ideal nem ve sıcaklık koşullarında,
                                                    7/24 güvenlik kameralarının gözetiminde muhafaza ediyoruz.
                                                    Eserleriniz değerlendirilmeyi beklerken gönül rahatlığıyla
                                                    onları Sergikur’a teslim ederek dilediğiniz zaman
                                                    eserlerinizi görebilir, ilgilisine gösterebilir veya
                                                    belirteceğiniz bir lokasyona teslimatını talep
                                                    edebilirsiniz. Daha fazla bilgi için: info@sergikur.com.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-banner">
                                        <div class="product-banner-img">
                                            <img

                                                src="{{Vite::asset('resources/image/uploads/product_banner_image_3.png')}}"
                                                alt="">
                                        </div>
                                        <div class="product-banner-content">
                                            <div class="product-banner-title">EKSPERTİZ</div>
                                            <div class="product-banner-sub-title">
                                                <div>Satın almak istediğiniz eserin orjinalliğinden emin olmak
                                                    istiyorsanız Sergikur’a ulaşarak uzman görüşü talep
                                                    edebilirsiniz. Sanat tarihi, resim tekniği konularında uzman
                                                    bir yetkili sizin için gerekli incelemeleri yaparak bir
                                                    rapor oluşturur.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-area-bottom">
                <div class="container">
                    <div class="default-products similar-products">
                        <div class="products-header">
                            <span>Başka Eserler</span>
                        </div>
                        <div class="products-content row">
                            {% for item in similar_product_showcase_items %}
                            <div class="col-auto">
                                {% include 'html/snippets/showcase-item.twig' %}
                            </div>
                            {% endfor %}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript" src="//st1.myideasoft.com/idea/lc/38/themes/selftpl_63a0c6bbd7a25/assets/javascript/product.js?revision=7.2.4.5-11-1674025251"></script>
@endsection
