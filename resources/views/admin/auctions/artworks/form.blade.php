@php use App\Models\BidLog;use Carbon\Carbon;use Illuminate\Support\Str; @endphp
<x-admin-layout>
    <x-slot name="header" :url="route('admin.auctions.edit', ['id' => $artWork->auction->id])">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $artWork->title ?: 'Yeni Eser' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="p-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 @if($artWork->title) lg:grid-cols-2 @endif gap-4">
            <div class="p-6 bg-white shadow sm:rounded-lg">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                        <div>
                            <label for="start_price" class="block text-sm font-medium text-gray-700">Başlangıç
                                Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span
                                        class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($artWork->start_price),0, 1)}}</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="start_price" id="start_price"
                                       value="{{$artWork->start_price}}"
                                       class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="estimated_market_price" class="block text-sm font-medium text-gray-700">Tahmini Piyasa Değeri</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span
                                        class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($artWork->estimated_market_price),0, 1)}}</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="estimated_market_price" id="estimated_market_price"
                                       value="{{$artWork->estimated_market_price}}"
                                       class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="artist_id" class="block mb-2 text-sm font-medium text-gray-900">Sanatçı</label>
                            <select id="artist_id" name="artist_id"
                                    class="block border rounded bg-gray-50 border-gray-300 w-full">
                                <option value="">Seçiniz...</option>
                                @foreach($artists as $artist)
                                    <option @if($artist->id == $artWork->artist_id) selected
                                            @endif value="{{$artist->id}}">{{$artist->name}}</option>
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
                        <input type="file" class="filepond" name="images[]" multiple accept="image/*"
                               @if($artWork->images->count() > 0) data-file-metadata-images="{{json_encode($artWork->images->map(function ($v) {
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
            @if($artWork->title)
                <div class="h-max p-6 bg-white shadow sm:rounded-lg">
                    @if($artWork->bids->count() > 0)
                        @php $bids = $artWork->bids()->paginate(BidLog::PAGINATION_LIMIT); @endphp

                        <h3 class="text-xl font-bold text-dark mb-4">Tüm Teklifler</h3>
                        <x-table>
                            <table class="w-full">
                                <thead>
                                <tr>
                                    <th class="text-sm text-left p-4 bg-indigo-50">Teklif</th>
                                    <th class="text-sm text-left p-4 bg-indigo-50">Teklif Yapan Kullanıcı</th>
                                    <th class="text-sm text-left p-4 bg-indigo-50">Teklif Tarihi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bids as $id => $bid)
                                    <tr class="border-b last:border-b-0">
                                        <td class="text-sm text-left font-bold p-4">{{Str::currency($bid->bid_amount)}}</td>
                                        <td class="text-sm text-left font-bold p-4">{{$bid->user->name}}</td>
                                        <td class="text-sm text-left font-bold p-4">
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 border border-gray-500">
  <svg aria-hidden="true" class="w-3 h-3 mr-1 hidden lg:block" fill="currentColor" viewBox="0 0 20 20"
       xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"></path></svg>
  {{Carbon::parse($bid->created_at)->diffForHumans(["parts" => 4])}}
</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </x-table>
                        @if($bids->hasPages() > 0)
                            <div class="py-4">
                                {{ $bids->onEachSide(0)->links() }}
                            </div>
                        @endif
                    @else
                        <h3 class="font-bold">Henüz teklif yapılmadı.</h3>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
