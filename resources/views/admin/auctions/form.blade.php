@php use Carbon\Carbon; @endphp
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $auction->name ?: 'Yeni Müzayede' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ is_null($auction->id) ? route("admin.auctions.save") : route("admin.auctions.save", ['id' => $auction->id]) }}">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Müzayede Adı</label>
                        <input type="text" id="name" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$auction->name}}" placeholder="Müzayede Adı" required>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Açıklama</label>
                        <div class="quill-editor" data-input="description">{!! $auction->description !!}</div>
                        <input type="hidden" name="description" id="description">
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Başlangıç
                                Tarihi</label>
                            <input type="datetime-local" name="start_date" id="start_date"
                                   value="{{Carbon::parse($auction->start_date)->format('Y-m-d\TH:i')}}"
                                   class="block border rounded bg-gray-50 border-gray-300 w-full">
                        </div>
                        <div>
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Bitiş
                                Tarihi</label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                   value="{{Carbon::parse($auction->end_date)->format('Y-m-d\TH:i')}}"
                                   class="block border rounded bg-gray-50 border-gray-300 w-full">
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Durum</label>
                            <select id="status" name="status"
                                    class="block border rounded bg-gray-50 border-gray-300 w-full">
                                <option @if($auction->status) selected @endif value="1">Aktif</option>
                                <option @if(!$auction->status) selected @endif value="0">Pasif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <input type="file" class="filepond" name="image" accept="image/*"
                               @if($auction->image) data-file-metadata-images="{{json_encode([["source" => $auction->image]])}}" @endif>
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
        @if(!is_null($auction->id))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 pb-4">
            <div class="overflow-hidden p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-end">
                    <a href="{{ route('admin.auctions.artworks.new', ['auction_id' => $auction->id]) }}"
                       class="bg-indigo-600 text-sm font-bold text-white px-5 py-2.5 rounded">Yeni Ekle</a>
                </div>
                <h3 class="text-3xl font-bold text-dark mb-4">Eserler</h3>
                @if($auction->artWorks->count() > 0)
                    <table class="max-w-xl lg:max-w-full w-full">
                        <thead>
                        <tr>
                            <th class="hidden sm:block text-sm text-left p-4 bg-indigo-50">Resim</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Eser Adı</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Başlangıç Fiyatı</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Verilen Son Teklif</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">Düzenle</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auction->artWorks as $artWork)
                            <tr class="border-b">
                                <td class="hidden sm:block text-sm text-left font-bold p-4 w-28">
                                    <img src="{{$artWork->images->first()?->path}}"
                                         class="h-20 object-scale-down w-20 rounded-full p-2 bg-gray-300" alt="">
                                </td>
                                <td class="text-sm text-left font-bold p-4">{{$artWork->title}}</td>
                                <td class="text-sm text-left font-bold p-4">{{Str::currency($artWork->start_price)}}</td>
                                <td class="text-sm text-left font-bold p-4">{{Str::currency($artWork->end_price)}}</td>
                                <td class="text-center font-bold p-4">
                                    <a href="{{ route('admin.auctions.artworks.edit', ['auction_id' => $auction->id, 'id' => $artWork->id]) }}">
                                        <i class="fa fa-edit text-green-600"></i>
                                    </a>
                                </td>
                                <td class="text-center font-bold p-4">
                                    <a href="{{ route('admin.auctions.artworks.destroy', ['auction_id' => $auction->id, 'id' => $artWork->id]) }}">
                                        <i class="fa fa-times text-red-600"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="font-bold">Eser bulunamadı.</h3>
                @endif
            </div>
        </div>
        @endif
    </div>
</x-admin-layout>
