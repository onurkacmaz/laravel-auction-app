@php use Carbon\Carbon; @endphp
@extends('base')
@section('title', isset($title) ? strip_tags($title) : 'Arşiv')

@section('content')
    <div class="container">
        <div class="row">
            <section class="col-12 px-4 lg:px-0">
                @if($auctions->count() > 0)
                    <div class="mt-10 grid-cols-2 lg:grid-cols-4 grid gap-10">
                        @foreach($auctions as $auction)
                            <a href="{{route('auctions.show', ['id' => $auction->id])}}"
                               class="border rounded-lg shadow bg-gray-50 hover:bg-gray-100 transition-all delay-75">
                                <div class="p-4 w-full flex justify-center relative">
                                    <div class="absolute left-0 bottom-0 right-0 bg-white/80 px-10 py-4">
                                        <div class=" text-black font-semibold text-center">
                                            <i class="fa fa-hourglass-end mr-2"></i>
                                            {{ Carbon::parse($auction->end_date)->diffForHumans() }}
                                            <small>({{Carbon::parse($auction->end_date)->format("Y-m-d H:i:s")}})</small>
                                        </div>
                                    </div>
                                    <img class="object-contain h-96 rounded-lg" src="{{$auction->image}}" alt="">
                                </div>
                                <div class="p-4 font-bold bg-gray-100 border-top text-xl text-center">
                                    {{$auction->name}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-10">
                        {{$auctions->links()}}
                    </div>
                @else
                    <div class="p-4 bg-gray-100 mt-10 rounded-lg font-semibold text-xl">Sonuç bulunamadı.</div>
                @endif
            </section>
        </div>
    </div>
@endsection
