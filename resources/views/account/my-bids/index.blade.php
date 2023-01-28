<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.my_bids') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if($bids->count() > 0)
            <div class="max-w-7xl mx-auto px-6 space-y-6">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <div class="flex items-center justify-between pb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="bids-search"
                                   name="q"
                                   class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Eser ismi...">
                        </div>
                    </div>
                    <div class="my-bids">
                        @include('components.my-bids', ['bids' => $bids])
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="bg-white p-4 max-w-7xl mx-auto text-center text-gray-400 font-bold shadow rounded">
                    Herhangi bir pey bulunamadı.
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
