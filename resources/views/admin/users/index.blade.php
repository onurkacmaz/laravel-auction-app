<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.users') }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-table>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-sm text-center p-4 bg-indigo-50">Ad Soyad</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">E-Mail</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">TC Kimlik Numarası</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">Düzenle</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">Engelle/Engeli Kaldır</th>
                            <th class="text-sm text-center p-4 bg-indigo-50">Sil</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="border-b">
                                <td class="text-sm text-center font-bold p-4">{{$user->name}}</td>
                                <td class="text-sm text-center font-bold p-4">{{$user->email}}</td>
                                <td class="text-sm text-center font-bold p-4">{{$user->tc_identification_number}}</td>
                                <td class="text-center font-bold p-4">
                                    <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">
                                        <i class="fa fa-edit text-green-600"></i>
                                    </a>
                                </td>
                                <td class="text-center font-bold p-4">
                                    @if($user->isBanned())
                                        <a href="{{ route('admin.users.unban', ['id' => $user->id]) }}">
                                            <i class="fa fa-ban text-blue-600"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.users.ban', ['id' => $user->id]) }}">
                                            <i class="fa fa-ban text-red-600"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center font-bold p-4">
                                    <a href="{{ route('admin.users.destroy', ['id' => $user->id]) }}">
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
