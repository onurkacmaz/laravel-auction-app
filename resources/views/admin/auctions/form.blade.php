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
                        <textarea id="description" name="description" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Açıklama">{{$auction->description}}</textarea>
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
                    <div class="pt-4">
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Kaydet
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>
