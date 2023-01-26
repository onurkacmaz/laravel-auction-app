@php use Carbon\Carbon; @endphp
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.auctions') }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-end pr-4 md:pr-0 lg:pr-0">
                <a href="{{ route('admin.auctions.new') }}" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">Oluştur</a>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-table>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-sm text-left p-4 bg-indigo-50">Müzayede Adı</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Başlangıç Tarihi</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Bitiş Tarihi</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Bitişe Kalan Süre</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Düzenle</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($auctions as $auction)
                            <tr class="border-b">
                                <td class="text-sm text-left font-bold p-4">{{$auction->name}}</td>
                                <td class="text-sm text-left font-bold p-4">{{$auction->start_date}}</td>
                                <td class="text-sm text-left font-bold p-4">{{$auction->end_date}}</td>
                                <td class="text-sm text-left font-bold p-4">
                                    @if(Carbon::now()->greaterThan(Carbon::parse($auction->end_date)))
                                        <span class="text-red-600">Müzayede Bitti</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 border border-gray-500">
  <svg aria-hidden="true" class="hidden lg:block w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
  {{Carbon::now()->diffAsCarbonInterval($auction->end_date)}}
</span>
                                    @endif
                                </td>
                                <td class="text-left text-center font-bold p-4">
                                    <a href="{{ route('admin.auctions.edit', ['id' => $auction->id]) }}">
                                        <i class="fa fa-edit text-green-600"></i>
                                    </a>
                                </td>
                                <td class="text-left text-center font-bold p-4">
                                    <a class="delete-auction" href="{{ route('admin.auctions.destroy', ['id' => $auction->id]) }}">
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
                {{ $auctions->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
