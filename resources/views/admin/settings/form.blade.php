@php use Illuminate\Support\Str; @endphp
<x-admin-layout>
    <x-slot name="header" :url="route('admin.settings.index')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $setting->start_price && $setting->end_price ? Str::currency($setting->start_price) . " - " . Str::currency($setting->end_price) : 'Yeni Limit Ayarı' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="p-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 gap-4">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ route("admin.settings.save", ['id' => $setting->id]) }}">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_price" class="block text-sm font-medium text-gray-700">Başlangıç
                                Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span
                                            class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($setting->start_price),0, 1)}}</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="start_price" id="start_price"
                                       value="{{$setting->start_price}}"
                                       class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="end_price" class="block text-sm font-medium text-gray-700">Başlangıç
                                Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span
                                            class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($setting->end_price),0, 1)}}</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="end_price" id="end_price"
                                       value="{{$setting->end_price}}"
                                       class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="min_bid_amount" class="block text-sm font-medium text-gray-700">Başlangıç
                            Fiyatı</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span
                                            class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($setting->min_bid_amount),0, 1)}}</span>
                            </div>
                            <input type="number" step="0.01" min="0" name="min_bid_amount" id="min_bid_amount"
                                   value="{{$setting->min_bid_amount}}"
                                   class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                        </div>
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
