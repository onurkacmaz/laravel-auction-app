@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.my_artworks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if($userArtWorks->count() > 0)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    @foreach($userArtWorks as $userArtWork)
                        <a href="{{ route('profile.artworks.show', ['id' => $userArtWork->artwork->id]) }}"
                           class="p-4 flex flex-col bg-white border rounded-lg shadow-md md:flex-row md:max-w-xl">
                            <img class="rounded bg-gray-100 object-contain h-52 lg:h-full w-full lg:w-52 w-full md:w-48"
                                 src="{{ $userArtWork->artwork->images()?->first()?->path }}" alt="">
                            <div class="flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $userArtWork->artwork->title }}</h5>
                                <h5 class="mb-2 font-bold tracking-tight text-gray-900">{{ $userArtWork->artwork->auction->name }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 lg:w-80 md:w-30 sm:w-full">{{ strip_tags(Str::limit($userArtWork->artwork->description, 150)) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="text-center">
                    {{ $userArtWorks->links() }}
                </div>
            </div>
        @else
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white p-4 max-w-7xl mx-auto text-center text-gray-400 font-bold shadow rounded">
                    Herhangi bir eseriniz bulunamadı.
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
