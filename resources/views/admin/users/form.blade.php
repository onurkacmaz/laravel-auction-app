<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name ?: 'Yeni Sanatçı' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ route("admin.users.save", ['id' => $user->id]) }}">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Ad Soyad</label>
                        <input type="text" id="name" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$user->name}}" placeholder="Müzayede Adı" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">E-Mail</label>
                        <input type="email" id="email" name="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$user->email}}" placeholder="E-Mail">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Şifre</label>
                        <input type="password" id="password" name="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Şifre">
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Şifre Tekrarı</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Şifre Tekrarı">
                    </div>
                    <div class="mb-6 grid grid-cols-2 gap-4">
                        <div>
                            <label for="is_admin" class="block mb-2 text-sm font-medium text-gray-900">Yönetici</label>
                            <select name="is_admin" id="is_admin" class="appearance-none w-full">
                                <option value="1" @if($user->is_admin === 1) selected @endif>Evet</option>
                                <option value="0" @if($user->is_admin === 0) selected @endif>Hayır</option>
                            </select>
                        </div>
                        <div>
                            <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900">Rol</label>
                            <select name="role_id" id="role_id" class="appearance-none w-full">
                                <option value="">Seçiniz...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
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
