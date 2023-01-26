@php use Illuminate\Support\Carbon;use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $userArtWork->artwork->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="flex flex-col md:flex-row -mx-4">
                        <div class="md:flex-1 px-4">
                            <div x-data="{ image: 1 }" x-cloak>
                                <div class="rounded bg-gray-100 flex justify-center p-4 mb-4">
                                    @foreach($userArtWork->artWork->images as $image)
                                        <div x-show="image === {{ $loop->iteration }}">
                                            <img src="{{$image->path}}"
                                                 class="h-80 rounded hover:object-contain hover:bg-gray-100 object-cover hover:scale-125 transition ease-in-out delay-150 hover:shadow-2xl hover:shadow-black"
                                                 alt="">
                                        </div>
                                    @endforeach
                                </div>

                                <div class="gap-2 grid grid-cols-3 md:grid-cols-2 lg:grid-cols-3">
                                    @foreach($userArtWork->artWork->images as $key => $image)
                                        @php($key = $key + 1)
                                        <div class="flex-1">
                                            <button x-on:click="image = {{$key}}"
                                                    :class="{ 'transition ease-in-out delay-150 ring-2 ring-indigo-300 ring-inset': image === {{$key}} }"
                                                    class="focus:outline-none w-full rounded-lg bg-gray-100 flex items-center justify-center p-2">
                                                <img src="{{$image->path}}" class="h-24 object-cover md:h-32 w-full rounded" alt="">
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="md:flex-1 px-4">
                            <h2 class="mt-8 lg:mt-0 md:mt-0 mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">{{ $userArtWork->artwork->title }}</h2>
                            <p class="text-gray-500 text-sm"><a
                                    class="text-indigo-600 hover:underline font-bold">{{ $userArtWork->artwork->auction->name }}</a>
                            </p>
                            <p class="text-gray-500 text-sm mt-2">Sanatçı: <a

                                    class="text-indigo-600 hover:underline">{{ $userArtWork->artwork->artist->name }}</a>
                            </p>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center space-x-4 my-4">
                                    <div>
                                        <b>Müzayede Başlangıç Tarihi</b>
                                        <div class="mt-2 rounded-lg bg-gray-100 flex py-2 px-3">
                                            <span
                                                class="text-indigo-400 font-bold mr-1 mt-1">{{ Carbon::parse($userArtWork->artWork->auction->start_date)->isoFormat("D MMMM YYYY, dddd h:mm") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 my-4">
                                    <div>
                                        <b>Eser Satın Alma Tarihi</b>
                                        <div class="mt-2 rounded-lg bg-gray-100 flex py-2 px-3">
                                            <span
                                                class="text-indigo-400 font-bold mr-1 mt-1">{{ Carbon::parse($userArtWork->created_at)->isoFormat("D MMMM YYYY, dddd h:mm") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 my-4">
                                    <div>
                                        <b>Başlangıç Fiyatı</b>
                                        <div class="mt-2 rounded-lg bg-gray-100 flex py-2 px-3">
                                        <span
                                            class="text-indigo-400 mr-1 mt-1 lg:text-lg text-sm">{{ Str::substr(Str::currency($userArtWork->artWork->start_price), 0, 1) }}</span>
                                            <span
                                                class="font-bold text-indigo-600 text-xl lg:text-3xl">{{ Str::substr(Str::currency($userArtWork->artWork->start_price), 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 my-4">
                                    <div>
                                        <b>Bitiş Fiyatı</b>
                                        <div class="mt-2 rounded-lg bg-gray-100 flex py-2 px-3">
                                        <span
                                            class="text-indigo-400 mr-1 mt-1 lg:text-lg text-sm">{{ Str::substr(Str::currency($userArtWork->artWork->end_price), 0, 1) }}</span>
                                            <span
                                                class="font-bold text-indigo-600 text-xl lg:text-3xl">{{ Str::substr(Str::currency($userArtWork->artWork->end_price), 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-gray-500">{!! $userArtWork->artWork->description !!}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
