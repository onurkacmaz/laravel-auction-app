@php use App\Models\ArtWork;use Carbon\Carbon; @endphp
<x-admin-layout>
    <x-slot name="header" :url="route('admin.auctions.index')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $auction->name ?: 'Yeni Müzayede' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="p-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 @if($auction->id) lg:grid-cols-2 @endif gap-4">
            <div class="p-6 bg-white shadow sm:rounded-lg">
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
                    <div class="mt-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Görsel Linki</label>
                        <input type="text" id="image_link" name="image_link"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$auction->image_link}}" placeholder="Görsel Linki">
                    </div>
                    <div class="pt-4 text-right">
                        <button type="submit"
                                class="bg-indigo-600 text-white font-bold py-2 px-4 rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Kaydet
                        </button>
                    </div>
                </form>
            </div>
            @if(!is_null($auction->id))
                <div class="h-max p-6 bg-white shadow sm:rounded-lg">
                    <div class="grid grid-cols-2 mb-4">
                        <h3 class="text-3xl font-bold text-dark">Eserler</h3>
                        <div class="flex justify-end">
                            <a href="{{ route('admin.auctions.artworks.new', ['auction_id' => $auction->id]) }}"
                               class="bg-indigo-600 text-sm font-bold text-white px-5 py-2.5 rounded">Yeni Ekle</a>
                        </div>
                    </div>
                    @if($auction->artWorks->count() > 0)
                        @php $artWorks = $auction->artWorks()->paginate(ArtWork::PAGINATION_LIMIT); @endphp
                        <x-table>
                            <table class="w-full">
                                <thead>
                                <tr>
                                    <th class="text-sm text-left p-4 bg-indigo-50">Eser Adı</th>
                                    <th class="text-sm text-left p-4 bg-indigo-50">Başlangıç Fiyatı</th>
                                    <th class="text-sm text-left p-4 bg-indigo-50">Verilen Son Teklif</th>
                                    <th class="text-sm text-center p-4 bg-indigo-50">Düzenle</th>
                                    <th class="text-sm text-center p-4 bg-indigo-50">Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($artWorks as $artWork)
                                    <tr class="border-b last:border-b-0">
                                        <td class="text-sm text-left font-bold p-4">{{$artWork->title}}</td>
                                        <td class="text-sm text-left font-bold p-4">{{Str::currency($artWork->start_price)}}</td>
                                        <td class="text-sm text-left font-bold p-4">{{Str::currency($artWork->end_price)}}</td>
                                        <td class="text-center font-bold p-4">
                                            <a href="{{ route('admin.auctions.artworks.edit', ['auction_id' => $auction->id, 'id' => $artWork->id]) }}">
                                                <i class="fa fa-edit text-green-600"></i>
                                            </a>
                                        </td>
                                        <td class="text-center font-bold p-4">
                                            <a class="delete-artwork" href="{{ route('admin.auctions.artworks.destroy', ['auction_id' => $auction->id, 'id' => $artWork->id]) }}">
                                                <i class="fa fa-times text-red-600"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </x-table>
                        @if($artWorks->hasPages() > 0)
                            <div class="py-4">
                                {{ $artWorks->onEachSide(0)->links() }}
                            </div>
                        @endif
                    @else
                        <h3 class="font-bold">Eser bulunamadı.</h3>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
