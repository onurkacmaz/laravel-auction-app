@php use Illuminate\Support\Str; @endphp
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.limit_settings') }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-end pr-4 md:pr-0 lg:pr-0">
                <a href="{{ route('admin.settings.new') }}" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">Oluştur</a>
            </div>
            <div class="overflow-hidden p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-table>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-sm text-left p-4 bg-indigo-50">Değer Aralığı</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Minimum Teklif Değeri</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Düzenle</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings as $setting)
                            <tr class="border-b">
                                <td class="text-sm text-left font-bold p-4">{{Str::currency($setting->start_price)}} - {{Str::currency($setting->end_price)}}</td>
                                <td class="text-sm text-left font-bold p-4">{{Str::currency($setting->min_bid_amount)}}</td>
                                <td class="text-left font-bold p-4">
                                    <a href="{{ route('admin.settings.edit', ['id' => $setting->id]) }}">
                                        <i class="fa fa-edit text-green-600"></i>
                                    </a>
                                </td>
                                <td class="text-left font-bold p-4">
                                    <a href="{{ route('admin.settings.destroy', ['id' => $setting->id]) }}">
                                        <i class="fa fa-times text-red-600"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </x-table>
            </div>
            <div class="text-center">
                {{ $settings->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
