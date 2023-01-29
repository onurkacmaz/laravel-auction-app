@php use Carbon\Carbon;use Illuminate\Support\Str; @endphp
@extends('base')
@section('title', isset($title) ? strip_tags($title) : 'Anasayfa')

@section('content')
    <div class="container">
        <div class="row">
            @if(!is_null($auction) && Carbon::parse($auction->end_date)->isPast())
                <section class="col-12">
                    <div class="p-4 col-12 mt-10 mb-10 border-red-700 bg-red-50">
                        <i class="fas fa-info-circle fa-lg"></i>
                        <span class="ml-2 font-semibold">Şu an görüntülemekte olduğunuz müzayedenin süresi dolmuştur. Görüntülenmekte olan eserler kayıtlara geçen son durumlarıyla, arşiv amaçlı listelenmektedir.</span>
                    </div>
                </section>
            @endif
            <section class="col-12">
                @if($auction)
                    @if($auction->image)
                        <div id="entry-slider">
                            <div>
                                <div class="entry-slider entry-slider-1">
                                    <a href="#">
                                        <div class="entry-slider-img">
                                            <img
                                                src="{{ $auction->image }}"
                                                alt=""/>
                                        </div>
                                        <div class="entry-slider-container">
                                            <div class="entry-slider-content">
                                                <div class="entry-slider-title">
                                                    {{ $auction->name }}
                                                </div>
                                                <div class="entry-slider-sub-title">
                                                    {!! $auction->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <h4 class="mt-10">{!! $auction->title !!}</h4>
                    @endif
                    @if(count(array_merge_recursive(...array_column($groups, 'artWorks'))) > 0)
                        @foreach($groups as $group)
                            @if(count($group["artWorks"]) > 0)
                                <div class="default-products category-product-carousel">
                                    <div class="row align-items-center">
                                        <div class="col-lg-1">
                                            <div class="category-products-header">
                                                <span>{{ $group["title"] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="products-content products-content-1 row">
                                                @foreach($group['artWorks'] as $artWork)
                                                    <div class="col-auto">
                                                        <div class="showcase">
                                                            <div class="showcase-image-container">
                                                                <div class="showcase-image">
                                                                    <a href="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}"
                                                                       title="Yapı">
                                                                        <img class="lazyload object-cover object-center"
                                                                             src="{{ $artWork->images()->first()->path }}"
                                                                             data-src="{{ $artWork->images()->first()->path }}">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="hidden md:block lg:block absolute top-0 left-0 right-0 !bg-transparent bottom-0 showcase-content !w-full !p-0">
                                                                <div class="showcase-content !bottom-auto">
                                                                    <div>
                                                                        <a class="showcase-title"
                                                                           href="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}"
                                                                           title="{{ $artWork->title }}">{{ $artWork->title }}</a>
                                                                    </div>
                                                                    <div class="showcase-price mt-4">
                                                                        <div
                                                                            class="showcase-price-new current-bid a{{$artWork->id}}">
                                                                            {{Str::currency($artWork->end_price)}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="p-4 text-white bottom-0 absolute right-0 left-0 !bg-[#333]/70 text-center">
                                                                    @if(!Carbon::parse($auction->end_date)->isPast())
                                                                        <div class="flex justify-center mb-4">
                                                                            <input id="bid_amount" type="number"
                                                                                   name="bid_amount"
                                                                                   placeholder="Örn. {{ Str::currency($artWork->minimum_bid + $artWork->limit_value) }}"
                                                                                   min="{{ $artWork->minimum_bid }}"
                                                                                   class="bid_amount border-0 flex-[0.6] text-dark font-bold rounded-tl-lg rounded-bl-lg rounded-br-none p-3">
                                                                            <button
                                                                                data-id="{{ $artWork->id }}"
                                                                                class="bidding bg-gray-900 text-white flex-[0.1] font-bold p-3 align-baseline rounded-tr-lg rounded-br-lg w-20">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    <div class="product-social">
                                                                        <div
                                                                            class="product-social-content product-social-content-{{$artWork->id}}  openbox-content">
                                                                            <div>
                                                                                <div>
                                                                                    <a target="_blank"
                                                                                       href="http://www.facebook.com/sharer.php?&u={{route('auctions.artworks.show', ['id' => $artWork->id])}}&t="
                                                                                       class="product-social-facebook"
                                                                                       data-selector="share-link"
                                                                                       data-type="facebook">
                                                                                        <svg width="20" height="20"
                                                                                             viewBox="0 0 20 20"
                                                                                             fill="none">
                                                                                            <path
                                                                                                d="M7.812 4.487V6.965H6V10H7.816V19H11.546V10H14.046C14.046 10 14.28 8.547 14.394 6.958H11.557V4.882C11.5911 4.68787 11.6893 4.5108 11.836 4.37916C11.9827 4.24752 12.1693 4.16894 12.366 4.156H14.4V1H11.637C7.719 1 7.812 4.034 7.812 4.487Z"
                                                                                                fill="white"/>
                                                                                        </svg>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="https://twitter.com/intent/tweet?url={{route('auctions.artworks.show', ['id' => $artWork->id])}}&text="
                                                                                       class="product-social-twitter"
                                                                                       data-selector="share-link"
                                                                                       data-type="twitter">
                                                                                        <svg width="20" height="20"
                                                                                             viewBox="0 0 20 20"
                                                                                             fill="none">
                                                                                            <path
                                                                                                d="M18.231 4.65668C17.583 4.93939 16.8976 5.12732 16.196 5.21468C16.9354 4.77608 17.4883 4.08158 17.75 3.26268C17.0576 3.67333 16.3 3.9625 15.51 4.11768C15.0257 3.60056 14.3971 3.24103 13.7058 3.08581C13.0146 2.93059 12.2926 2.98685 11.6337 3.24727C10.9748 3.5077 10.4095 3.96026 10.0111 4.54615C9.6128 5.13205 9.39986 5.8242 9.4 6.53268C9.39723 6.80356 9.42474 7.07391 9.482 7.33868C8.07656 7.26979 6.70149 6.90506 5.44666 6.26834C4.19183 5.63162 3.08551 4.73725 2.2 3.64368C1.7454 4.42082 1.60464 5.34219 1.80648 6.21961C2.00832 7.09703 2.53752 7.8643 3.286 8.36468C2.72546 8.35036 2.17663 8.20114 1.686 7.92968V7.96868C1.68701 8.78434 1.96895 9.57476 2.48438 10.2069C2.9998 10.8391 3.71725 11.2744 4.516 11.4397C4.21384 11.5192 3.90244 11.5582 3.59 11.5557C3.36549 11.5598 3.14119 11.5397 2.921 11.4957C3.1492 12.1967 3.58905 12.8097 4.18002 13.2504C4.77099 13.6912 5.48403 13.9379 6.221 13.9567C4.97052 14.9345 3.42841 15.4651 1.841 15.4637C1.55991 15.4652 1.27901 15.4489 1 15.4147C2.61528 16.4554 4.49748 17.006 6.419 16.9997C7.7417 17.0089 9.05304 16.7551 10.2769 16.2532C11.5007 15.7513 12.6126 15.0113 13.548 14.0761C14.4834 13.1409 15.2237 12.0291 15.7258 10.8054C16.2279 9.58167 16.4819 8.27038 16.473 6.94768C16.473 6.79168 16.468 6.64068 16.46 6.49068C17.1569 5.99211 17.7571 5.37061 18.231 4.65668Z"
                                                                                                fill="white"/>
                                                                                        </svg>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <a target="_blank"
                                                                                       href="https://www.pinterest.com/pin/create/button/?url={{route('auctions.artworks.show', ['id' => $artWork->id])}}"
                                                                                       class="product-social-pinterest"
                                                                                       data-selector="share-link"
                                                                                       data-type="pinterest">
                                                                                        <svg width="20" height="20"
                                                                                             viewBox="0 0 20 20"
                                                                                             fill="none">
                                                                                            <path
                                                                                                d="M10.561 2C5.628 2 3 5.161 3 8.609C3 10.209 3.893 12.201 5.323 12.834C5.54 12.934 5.658 12.89 5.707 12.689C5.75 12.536 5.938 11.799 6.029 11.451C6.04522 11.3967 6.04663 11.3391 6.0331 11.284C6.01956 11.229 5.99156 11.1786 5.952 11.138C5.40251 10.4247 5.1031 9.55039 5.1 8.65C5.11346 7.99513 5.25947 7.34978 5.5292 6.75289C5.79893 6.156 6.18679 5.61994 6.66938 5.17707C7.15197 4.73419 7.71929 4.39368 8.33709 4.17609C8.9549 3.95849 9.61039 3.86831 10.264 3.911C13.077 3.911 15.044 5.738 15.044 8.352C15.044 11.305 13.481 13.352 11.451 13.352C11.1978 13.3732 10.9432 13.3341 10.7081 13.2379C10.4729 13.1418 10.2639 12.9913 10.098 12.7989C9.93221 12.6064 9.81431 12.3774 9.75399 12.1306C9.69367 11.8838 9.69264 11.6263 9.751 11.379C10.1736 10.1979 10.4915 8.98185 10.701 7.745C10.7205 7.5462 10.6973 7.34552 10.6329 7.15644C10.5684 6.96736 10.4643 6.79426 10.3274 6.64876C10.1905 6.50327 10.0241 6.38875 9.83931 6.3129C9.65451 6.23705 9.45562 6.20162 9.256 6.209C8.112 6.209 7.184 7.342 7.184 8.863C7.17716 9.42129 7.29395 9.97417 7.526 10.482C7.526 10.482 6.4 15.051 6.192 15.9C5.99963 17.2248 6.02768 18.5723 6.275 19.888C6.27764 19.9121 6.28756 19.9348 6.30345 19.9531C6.31934 19.9714 6.34044 19.9844 6.36393 19.9904C6.38742 19.9964 6.41217 19.995 6.43488 19.9866C6.45758 19.9781 6.47717 19.9629 6.491 19.943C7.27365 18.8666 7.90081 17.6853 8.354 16.434C8.494 15.92 9.066 13.834 9.066 13.834C9.3684 14.2405 9.76553 14.5669 10.2228 14.785C10.6802 15.003 11.1838 15.106 11.69 15.085C15.137 15.085 17.628 12.055 17.628 8.295C17.616 4.7 14.531 2 10.561 2Z"
                                                                                                fill="white"/>
                                                                                        </svg>
                                                                                    </a>
                                                                                </div>
                                                                                <div>
                                                                                    <a target="_blank"
                                                                                       href="https://web.whatsapp.com/send?text={{route('auctions.artworks.show', ['id' => $artWork->id])}}"
                                                                                       class="product-social-whatsapp"
                                                                                       data-selector="share-link"
                                                                                       data-type="whatsapp">
                                                                                        <svg width="20" height="20"
                                                                                             viewBox="0 0 20 20"
                                                                                             fill="none">
                                                                                            <path fill-rule="evenodd"
                                                                                                  clip-rule="evenodd"
                                                                                                  d="M16.377 3.61331C15.1243 2.36619 13.531 1.51696 11.7973 1.17224C10.0636 0.827523 8.26663 1.00268 6.63211 1.67572C4.99759 2.34876 3.59833 3.48968 2.61001 4.95524C1.62169 6.4208 1.08837 8.14568 1.077 9.91331C1.07636 11.4795 1.49039 13.018 2.277 14.3723L1 18.9973L5.75 17.7573C7.06504 18.4701 8.5372 18.8434 10.033 18.8433C12.4041 18.8468 14.6798 17.9096 16.3608 16.2374C18.0419 14.5651 18.991 12.2944 19 9.92331C19.0032 8.75013 18.773 7.58803 18.3226 6.50471C17.8723 5.42139 17.2109 4.43851 16.377 3.61331ZM10.038 17.3363C8.70477 17.3366 7.39579 16.9799 6.247 16.3033L5.975 16.1423L3.15 16.8783L3.903 14.1423L3.726 13.8623C3.0182 12.7379 2.62568 11.444 2.58952 10.1159C2.55337 8.78777 2.8749 7.47436 3.52048 6.31315C4.16605 5.15194 5.11191 4.18563 6.25905 3.51537C7.40619 2.84511 8.71242 2.49556 10.041 2.50331C11.0149 2.50331 11.9794 2.69514 12.8792 3.06786C13.779 3.44057 14.5966 3.98687 15.2853 4.67555C15.9739 5.36424 16.5202 6.18183 16.893 7.08164C17.2657 7.98145 17.4575 8.94586 17.4575 9.91981C17.4575 10.8938 17.2657 11.8582 16.893 12.758C16.5202 13.6578 15.9739 14.4754 15.2853 15.1641C14.5966 15.8528 13.779 16.399 12.8792 16.7718C11.9794 17.1445 11.0149 17.3363 10.041 17.3363H10.038ZM14.124 11.7843C13.9 11.6723 12.799 11.1333 12.594 11.0593C12.389 10.9853 12.239 10.9483 12.094 11.1713C11.949 11.3943 11.516 11.8963 11.385 12.0453C11.254 12.1943 11.124 12.2123 10.9 12.1013C10.2385 11.8409 9.62734 11.4674 9.094 10.9973C8.60511 10.546 8.18588 10.0247 7.85 9.45031C7.72 9.22731 7.85 9.11831 7.95 8.99531C8.15548 8.75569 8.34267 8.50097 8.51 8.23331C8.53969 8.1719 8.5535 8.10402 8.55018 8.03589C8.54686 7.96776 8.52652 7.90155 8.491 7.84331C8.435 7.73131 7.991 6.63531 7.801 6.18831C7.611 5.74131 7.435 5.81231 7.301 5.80531C7.167 5.79831 7.014 5.79731 6.865 5.79731C6.75114 5.79983 6.63903 5.82592 6.53576 5.87394C6.43249 5.92196 6.3403 5.99087 6.265 6.07631C6.01234 6.3147 5.81213 6.60314 5.67714 6.92321C5.54216 7.24329 5.47535 7.58798 5.481 7.93531C5.55417 8.77638 5.87189 9.57765 6.395 10.2403C7.35711 11.6746 8.67556 12.8342 10.221 13.6053C10.6381 13.7844 11.0643 13.9413 11.498 14.0753C11.9549 14.2134 12.4375 14.2435 12.908 14.1633C13.2194 14.1003 13.5145 13.9736 13.7747 13.7912C14.0349 13.6088 14.2546 13.3746 14.42 13.1033C14.5664 12.7704 14.6116 12.4017 14.55 12.0433C14.497 11.9513 14.35 11.8973 14.124 11.7843Z"
                                                                                                  fill="white"/>
                                                                                        </svg>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="flex justify-center grid bg-gray-100 text-dark grid-cols-{{Carbon::parse($auction->end_date)->isPast() ? 2 : 4}} divide-x border rounded-lg">
                                                                        @if(!Carbon::parse($auction->end_date)->isPast())
                                                                            <a href="#"
                                                                               data-is-favorite="{{(int)!is_null($artWork->favorite())}}"
                                                                               data-id="{{$artWork->id}}"
                                                                               class="add-favorite p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                                <span
                                                                                    class="hidden lg:block">Favori</span>
                                                                                <div>
                                                                                    <i class="fas fa-star {{ !is_null($artWork->favorite()) ? 'text-red-600' : 'text-gray-500' }} fa-sm mt-2"></i>
                                                                                    <span
                                                                                        class="text-sm">{{$artWork->favorites->count()}}</span>
                                                                                </div>
                                                                            </a>
                                                                            <a href="#"
                                                                               data-is-follow="{{(int)!is_null($artWork->followed())}}"
                                                                               data-id="{{$artWork->id}}"
                                                                               class="follow p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                                <span
                                                                                    class="hidden lg:block">Takibe Al</span>
                                                                                <div>
                                                                                    <i class="fas fa-plus-circle {{ !is_null($artWork->followed()) ? 'text-red-600' : 'text-gray-500' }} fa-sm mt-2"></i>
                                                                                    <span
                                                                                        class="text-sm">{{$artWork->follows->count()}}</span>
                                                                                </div>
                                                                            </a>
                                                                        @endif
                                                                        <a href="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}#bids"
                                                                           class="p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                            <span class="hidden lg:block">Peyler</span>
                                                                            <div>
                                                                                <i class="fas fa-coins fa-sm mt-2"></i>
                                                                                <span
                                                                                    class="text-sm bid{{$artWork->id}}">{{$artWork->bids->count()}}</span>
                                                                            </div>
                                                                        </a>
                                                                        <a data-target="product-social-content-{{$artWork->id}}"
                                                                           href="javascript:void(0);"
                                                                           class="share p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column openbox product-social-icon">
                                                                            <span class="hidden lg:block">Paylaş</span>
                                                                            <i class="fas fa-share-alt fa-sm mt-2"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="showcase-content lg:hidden md:hidden">
                                                                <div class="showcase-brand">
                                                                    <a href="">{{ $artWork->title }}</a>
                                                                </div>
                                                                <div class="showcase-price">
                                                                    <div class="showcase-price-new">
                                                                        {{ Str::currency($artWork->end_price) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="p-4 bg-gray-100 mt-10 rounded-lg font-semibold text-xl">Sonuç bulunamadı.</div>
                    @endif
                @else
                    <div class="p-4 bg-gray-100 mt-10 rounded-lg font-semibold text-xl">Sonuç bulunamadı.</div>
                @endif
            </section>
        </div>
    </div>
@endsection
