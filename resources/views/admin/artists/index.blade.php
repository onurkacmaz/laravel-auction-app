<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.artists') }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-end pr-4 md:pr-0 lg:pr-0">
                <a href="{{ route('admin.artists.new') }}" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded">Oluştur</a>
            </div>
            <div class="overflow-hidden p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-table>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-sm text-left p-4 bg-indigo-50">Sanatçı Adı</th>
                            <th class="hidden lg:table-cell text-sm text-left p-4 bg-indigo-50">E-Mail</th>
                            <th class="hidden lg:table-cell text-sm text-left p-4 bg-indigo-50">Telefon Numarası</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Düzenle</th>
                            <th class="text-sm text-left p-4 bg-indigo-50">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($artists as $artist)
                            <tr class="border-b">
                                <td class="text-sm text-left font-bold p-4">{{$artist->name}}</td>
                                <td class="hidden lg:table-cell text-sm text-left font-bold p-4">{{$artist->email}}</td>
                                <td class="hidden lg:table-cell text-sm text-left font-bold p-4">{{$artist->phone}}</td>
                                <td class="text-left font-bold p-4">
                                    <a href="{{ route('admin.artists.edit', ['id' => $artist->id]) }}">
                                        <i class="fa fa-edit text-green-600"></i>
                                    </a>
                                </td>
                                <td class="text-left font-bold p-4">
                                    <a href="{{ route('admin.artists.destroy', ['id' => $artist->id]) }}">
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
                {{ $artists->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
