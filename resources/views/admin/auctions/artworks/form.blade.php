@php use Illuminate\Support\Str; @endphp
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $artWork->title ?: 'Yeni Eser' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pb-4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ is_null($artWork->id) ? route("admin.auctions.artworks.save", ['auction_id' => $artWork->auction->id]) : route("admin.auctions.artworks.save", ['auction_id' => $artWork->auction->id, 'id' => $artWork->id]) }}">
                    @csrf
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Eser Adı</label>
                        <input type="text" id="title" name="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$artWork->title}}" placeholder="Eser Adı" required>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Açıklama</label>
                        <div class="quill-editor" data-input="description">{!! $artWork->description !!}</div>
                        <input type="hidden" name="description" id="description" value="{!! $artWork->description !!}">
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Başlangıç Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($artWork->start_price),0, 1)}}</span>
                                </div>
                                <input type="number" name="start_price" id="start_price"
                                       value="{{$artWork->start_price}}"
                                       class="block border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Bitiş Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($artWork->end_price),0, 1)}}</span>
                                </div>
                                <input type="number" name="end_price" id="end_price"
                                       value="{{$artWork->end_price}}"
                                       class="block border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="artist_id" class="block mb-2 text-sm font-medium text-gray-900">Sanatçı</label>
                            <select id="artist_id" name="artist_id"
                                    class="block border rounded bg-gray-50 border-gray-300 w-full">
                                @foreach($artists as $artist)
                                    <option value="">Seçiniz...</option>
                                    <option @if($artist->id == $artWork->artist_id) selected @endif value="{{$artist->id}}">{{$artist->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Durum</label>
                            <select id="status" name="status"
                                    class="block border rounded bg-gray-50 border-gray-300 w-full">
                                <option @if($artWork->status) selected @endif value="1">Aktif</option>
                                <option @if(!$artWork->status) selected @endif value="0">Pasif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <input type="file" class="filepond" name="images[]" multiple accept="image/*" @if($artWork->images->count() > 0) data-file-metadata-images="{{json_encode($artWork->images->map(function ($v) {
    return ['source' => $v->path];
}))}}" @endif>
                    </div>
                    <div class="pt-4 text-right">
                        <button type="submit"
                                class="bg-indigo-600 text-white font-bold py-2 px-4 rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
