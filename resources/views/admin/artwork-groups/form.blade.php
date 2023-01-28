@php use Illuminate\Support\Str; @endphp
<x-admin-layout>
    <x-slot name="header" :url="route('admin.artwork-groups.index')">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $group->title ? : 'Yeni Grup' }}
        </h2>
    </x-slot>
    @include('components.errors')
    <div class="p-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 gap-4">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <form method="post"
                      action="{{ route("admin.artwork-groups.save", ['id' => $group->id]) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Başlık</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <input type="text" name="title" id="title"
                                   value="{{$group->title}}"
                                   class="block price border rounded bg-gray-50 border-gray-300 w-full">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="begin" class="block text-sm font-medium text-gray-700">Başlangıç
                                Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span
                                            class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($group->begin),0, 1)}}</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="begin" id="begin"
                                       value="{{$group->begin}}"
                                       class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="end" class="block text-sm font-medium text-gray-700">Başlangıç
                                Fiyatı</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span
                                            class="text-gray-500 sm:text-sm">{{Str::substr(Str::currency($group->end),0, 1)}}</span>
                                </div>
                                <input type="number" step="0.01" min="0" name="end" id="end"
                                       value="{{$group->end}}"
                                       class="block price border pl-7 rounded bg-gray-50 border-gray-300 w-full">
                            </div>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700">Sıra</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <input type="number" step="1" min="1" name="order" id="order"
                                       value="{{$group->order}}"
                                       class="block price border rounded bg-gray-50 border-gray-300 w-full">
                            </div>
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
