<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $artist->name ?: 'Yeni Sanatçı' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ is_null($artist->id) ? route("admin.artists.save") : route("admin.artists.save", ['id' => $artist->id]) }}">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Sanatçı Adı</label>
                        <input type="text" id="name" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$artist->name}}" placeholder="Sanatçı Adı" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">E-Mail</label>
                        <input type="email" id="email" name="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$artist->email}}" placeholder="E-Mail">
                    </div>
                    <div class="mb-6">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Telefon Numarası</label>
                        <input type="tel" id="phone" name="phone"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                               value="{{$artist->phone}}" placeholder="Telefon Numarası">
                    </div>
                    <div class="mb-6">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Adres</label>
                        <textarea type="tel" id="address" name="address"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Adres">{{$artist->address}}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="bio" class="block mb-2 text-sm font-medium text-gray-900">Bio</label>
                        <div class="quill-editor" data-input="bio">{!! $artist->bio !!}</div>
                        <input type="hidden" name="bio" id="bio">
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
