@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.my_favorites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if($favorites->count() > 0)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    @foreach($favorites as $favorite)
                        <div>
                            <div class="text-right">
                                <a href="{{route('profile.my-favorites.destroy', ['id' => $favorite->id])}}" class="bg-red-500 px-3 py-2 rounded-full">
                                    <i class="fa fa-times text-white"></i>
                                </a>
                            </div>
                            <a href="{{route('auctions.artworks.show', ['id' => $favorite->artwork->id]) }}"
                               class="p-4 flex flex-col bg-white border rounded-lg shadow-md md:flex-row md:max-w-xl">
                                <img class="rounded bg-gray-100 object-contain h-52 lg:h-full w-full lg:w-52 w-full md:w-48"
                                     src="{{ $favorite->artwork->images()?->first()?->path }}" alt="">
                                <div class="flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $favorite->artwork->title }}</h5>
                                    <h5 class="mb-2 font-bold tracking-tight text-gray-900">{{ $favorite->artwork->auction->name }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 lg:w-80 md:w-30 sm:w-full">{{ strip_tags(Str::limit($favorite->artwork->description, 150)) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $favorites->links() }}
                </div>
            </div>
        @else
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white p-4 max-w-7xl mx-auto text-center text-gray-400 font-bold shadow rounded">
                    Herhangi bir eser bulunamadı.
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
