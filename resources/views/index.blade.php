@php use Illuminate\Support\Str; @endphp
@extends('base')
@section('title', 'Anasayfa')

@section('content')
    <div class="container">
        <div class="row">
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
                    @endif
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
                                                        <div class="hidden md:block lg:block absolute top-0 left-0 right-0 !bg-transparent bottom-0 showcase-content !w-full !p-0">
                                                            <div class="showcase-content !bottom-auto">
                                                                <div>
                                                                    <a class="showcase-title"
                                                                       href="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}"
                                                                       title="{{ $artWork->title }}">{{ $artWork->title }}</a>
                                                                </div>
                                                                <div class="showcase-price mt-4">
                                                                    <div class="showcase-price-new current-bid a{{$artWork->id}}">
                                                                        {{Str::currency($artWork->end_price)}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="p-4 text-white bottom-0 absolute right-0 left-0 !bg-[#333]/70 text-center">
                                                                <div class="flex justify-center">
                                                                    <input id="bid_amount" type="number"
                                                                           name="bid_amount" placeholder="Pey"
                                                                           min="{{ $artWork->getHighestBid()->bid_amount }}"
                                                                           class="bid_amount border-0 text-dark font-bold rounded-tl-lg rounded-bl-lg rounded-br-none p-3">
                                                                    <button
                                                                        data-id="{{ $artWork->id }}"
                                                                        class="bidding bg-gray-900 text-white font-bold p-3 align-baseline rounded-tr-lg rounded-br-lg w-20">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="flex justify-center mt-4">
                                                                    <div
                                                                        class="grid bg-gray-100 text-dark grid-cols-4 divide-x border rounded-lg">
                                                                        <a  href="#" data-is-favorite="{{!is_null($artWork->favorite())}}" data-id="{{$artWork->id}}"
                                                                            class="add-favorite p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                            <span class="hidden lg:block">Favori</span>
                                                                            <div>
                                                                                <i class="fas fa-star {{ !is_null($artWork->favorite()) ? 'text-red-600' : 'text-gray-500' }} fa-sm mt-2"></i>
                                                                                <span
                                                                                    class="text-sm">{{$artWork->favorites->count()}}</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" data-is-follow="{{!is_null($artWork->followed())}}" data-id="{{$artWork->id}}"
                                                                           class="follow p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                            <span class="hidden lg:block">Takibe Al</span>
                                                                            <div>
                                                                                <i class="fas fa-plus-circle {{ !is_null($artWork->followed()) ? 'text-red-600' : 'text-gray-500' }} fa-sm mt-2"></i>
                                                                                <span
                                                                                    class="text-sm">{{$artWork->follows->count()}}</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}#bids"
                                                                           class="p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                            <span class="hidden lg:block">Peyler</span>
                                                                            <div>
                                                                                <i class="fas fa-coins fa-sm mt-2"></i>
                                                                                <span
                                                                                    class="text-sm">{{$artWork->bids->count()}}</span>
                                                                            </div>
                                                                        </a>
                                                                        <a href="#" data-url="{{ route('auctions.artworks.show', ['id' => $artWork->id]) }}" class="share p-3 font-bold hover:bg-gray-200 text-[1rem] flex flex-column">
                                                                            <span class="hidden lg:block">Paylaş</span>
                                                                            <i class="fas fa-share-alt fa-sm mt-2"></i>
                                                                        </a>
                                                                    </div>
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
                @endif
                <div class="share-modal hidden">
                    <div
                        class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
                        id="share-modal">
                        <div class="relative w-auto my-6 mx-auto max-w-3xl">
                            <div
                                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                <div
                                    class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                                    <h3 class="text-3xl m-0 font-semibold">
                                        Paylaş
                                    </h3>
                                </div>
                                <div class="relative p-6 flex-auto modal-body"></div>
                                <div
                                    class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                                    <button
                                        class="share-close-modal text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Kapat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="opacity-25 fixed inset-0 z-40 bg-black" id="share-modal-backdrop"></div>
                </div>
            </section>
        </div>
    </div>
@endsection
